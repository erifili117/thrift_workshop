<?php


require __DIR__ . '/vendor/autoload.php';

use Server\Example\phpExample\MyFirstServiceProcessor;
use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TBufferedTransport;
use Thrift\Transport\TPhpStream;

header('Content-Type', 'application/x-thrift');


$handler = new Handler();
$processor = new MyFirstServiceProcessor($handler);

$transport = new TBufferedTransport(new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W));
$protocol = new TBinaryProtocol($transport, true, true);

$transport->open();
$processor->process($protocol, $protocol);
$transport->close();
