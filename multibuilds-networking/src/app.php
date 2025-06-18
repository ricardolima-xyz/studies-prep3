<?php

$redis = new Redis();
$redis->connect('my-redis', 6379);
$redis->set('message', 'Hello from Redis!');
echo $redis->get('message') . PHP_EOL;