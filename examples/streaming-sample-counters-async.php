<?php

use ApiClients\Twitter\Resource\Async\DeletedTweet;
use ApiClients\Twitter\Resource\Async\Tweet;
use React\EventLoop\Factory;
use ApiClients\Twitter\AsyncClient;
use function ApiClients\Foundation\resource_pretty_print;
use React\EventLoop\Timer\TimerInterface;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
$config = require 'resolve_config.php';

$loop = Factory::create();
$client = new AsyncClient(
    $config['consumer']['key'],
    $config['consumer']['secret'],
    $config['access_token']['token'],
    $config['access_token']['secret'],
    $loop
);

$counters = [
    DeletedTweet::class => 0,
    Tweet::class => 0,
];

$loop->addPeriodicTimer(60, function (TimerInterface $timer) {
    $timer->getLoop()->stop();
});

$loop->addPeriodicTimer(1, function () use (&$counters) {
    ksort($counters);
    print_r([
        'memory' => memory_get_usage() / 1024 / 1024,
        'memory_peak' => memory_get_peak_usage() / 1024 / 1024,
        'memory_true' => memory_get_usage(true) / 1024 / 1024,
        'memory_peak_true' => memory_get_peak_usage(true) / 1024 / 1024,
    ]);
    print_r($counters);
    foreach ($counters as $key => $value) {
        $counters[$key] = 0;
    }
});

$client->sampleStream()->subscribeCallback(function ($document) use(&$counters) {
    $class = get_class($document);

    if (!isset($counters[$class])) {
        $counters[$class] = 0;
    }

    $counters[$class]++;
});

$loop->run();