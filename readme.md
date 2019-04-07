# Thrift example 

This repository contains a Dockerfile with Thrift and PHP
in order to use the Thrift compiler and compile `.thrift` files
to PHP stubs.

It also contains 
 - An example `.thrift` file with a simple service defined, under `./thrift_example`.
 - Any generated files from Thrift in case something goes sideways when compiling, 
 under `./generated/thrift`.
 - Two simple composer projects (server/client) with an `index.php` file where all the thrift 
 functionality comes together, under `./generated/php/clent` and `./generated/php/server` respectively.

## Repo Usage

### Running the thrift compiler from docker

Build the image:

```bash
docker build docker -t thrift_gen
```
 

Run thrift to generate the server code: 

```bash
docker run -v "$(pwd)/thrift_example:/thrift_example" \ 
thrift_gen thrift -v -out thrift_example \ 
--gen php:server,nsglobal="Server\Example" \
thrift_example/tutorial.thrift
```


Run thrift to generate the client code:

```bash
docker run -v "$(pwd)/thrift_example:/thrift_example" \
thrift_gen thrift -v -out thrift_example \
--gen php:nsglobal="Client\Example" thrift_example/tutorial.thrift
```

### Using the PHP projects

Create the server/client directories:
```bash
$ mkdir php_project/client
$ mkdir php_project/server
```

Copy the included client files and update composer:

```bash
$ sudo mv thrift_example/Client php_project/client
$ cp -r generated/php/client/* php_project/client
$ cd php_project/client && composer update
```

Copy the included server files and update composer:

```bash
$ sudo mv thrift_example/Server php_project/server
$ cp -r generated/php/server/* php_project/server
$ cd php_project/server && composer update
```

Start the PHP server from `php_project/server` directory :

`php -S localhost:8000`

Run the client that calls the running server from `php_project/client` directory:

`php -f index.php`

## Code Explanation

### Composer 

Require the Apache Thrift package:

```json
"require": {
  "apache/thrift": "^0.12.0"
},
```

Add the compiled files path and namespace to the autoloader:

```json
"autoload": {
  "psr-4": {"Client\\Example\\phpExample\\": "Client/Example/phpExample"}
}
```

### PHP Client

Define where your client should send data.
In this example the THttpClient is used.

```php
$socket = new THttpClient('localhost', 8000, '/');
```

For the transport layer we're using the TBufferedTransport

```php
$transport = new TBufferedTransport($socket);
```

Create a new binary protocol and pass the transport

```php
$protocol = new TBinaryProtocol($transport);
```

Create our client and open the transport

```php
$client = new MyFirstServiceClient($protocol);

$transport->open();
```

Call the remote function `multiply` and save the result

```php
$res1 = $client->multiply(1,4);
```

Call the remote function `get_log_size` that throws an exception if
a log file with the input name does not exist

```php
$res = $client->get_log_size('test');
```

Catch our exception. Our exception contains two extra fields
`error_description` and `error_code`. If you catch a generic `Exception`
these two do not get passed to their respective exception fields.
Be sure to catch the exception you defined in the thrift file.

```php
}catch (MyError $e){
    echo $e->error_description . "\n";
}
```

Create a log file with the name test in the server 
by calling the remote function `log`

```php
$client->log('test');
```

### PHP Server

Add the thrift header

```php
header('Content-Type', 'application/x-thrift');
```

Create a new `Handler` and a `Processor`. The handler code
is created by the developer and extends the interface generated
by thrift. It's used to provide the functionality of the application.

The processor is a thrift generated file that handles to parse the request,
create a response in thrift format and send it.

```php
$handler = new Handler();
$processor = new MyFirstServiceProcessor($handler);
```

Create a new transport with thrift PHP stream and protocol

```php
$transport = new TBufferedTransport(new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W));
$protocol = new TBinaryProtocol($transport, true, true);
```

Open the transport, process the request and finally close it.

```php
$transport->open();
$processor->process($protocol, $protocol);
$transport->close();
```
