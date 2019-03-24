<?php


require __DIR__ . '/vendor/autoload.php';

use Client\Example\phpExample\MyError;
use Client\Example\phpExample\MyFirstServiceClient;
use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TBufferedTransport;
use Thrift\Transport\THttpClient;

try{

    $socket = new THttpClient('localhost', 8000, '/');
    $transport = new TBufferedTransport($socket);
    $protocol = new TBinaryProtocol($transport);
    $client = new MyFirstServiceClient($protocol);

    $transport->open();


    $res1 = $client->multiply(1,4);
    echo "Multiplication result: $res1\n";

    // $client->log('test');
    $res = $client->get_log_size('test');
    var_dump($res);
    echo "Log file size: $res bytes\n";


// Do NOT catch a generic exception or a transport exception
//because the description and code are not passed.
//They only exist in your own struct!
}catch (MyError $e){
    echo $e->error_description . "\n";
}

