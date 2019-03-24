
# What's Thrift

# Supported Languages



# Installation

## Docker


`docker build docker -t thrift_gen` 





`docker run -v "$(pwd)/thrift_example:/thrift_example" thrift_gen thrift -v -out thrift_example --gen php:server,nsglobal="Server\Example" thrift_example/tutorial.thrift`

`docker run -v "$(pwd)/thrift_example:/thrift_example" thrift_gen thrift -v -out thrift_example --gen php:nsglobal="Client\Example" thrift_example/tutorial.thrift`

# PHP installation

`mkdir php_project/client`
`mkdir php_project/server`


`sudo mv thrift_example/Client php_project/client`
`cp -r generated/php/client/* php_project/client`
`cd php_project/client && composer update`

`sudo mv thrift_example/Server php_project/server`
`cp -r generated/php/server/* php_project/server`
`cd php_project/server && composer update`



`php -S localhost:8000`
`php -f index.php`

## Client Code

