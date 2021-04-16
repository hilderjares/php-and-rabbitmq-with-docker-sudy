<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$data = implode(' ', array_slice($argv, 1));

$connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

$msg = new AMQPMessage($data);
$channel->basic_publish($msg, '', 'hello');

echo "['status' => 200, 'message' => 'Image uploaded']\n";

$channel->close();
$connection->close();
