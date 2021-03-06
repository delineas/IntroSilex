<?php

use Silex\Provider\MonologServiceProvider;
use Silex\Provider\WebProfilerServiceProvider;
use Silex\Provider\DebugServiceProvider;

// include the prod configuration
require __DIR__.'/prod.php';

// enable the debug mode
$app['debug'] = true;

$app->register(new MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../var/logs/silex_dev.log',
));


$app->register(new WebProfilerServiceProvider(), array(
    'profiler.cache_dir' => __DIR__.'/../var/cache/profiler',
));

$app['data_collector.templates'] = $app->extend('data_collector.templates', function ($templates) {
            $templates[] = array('dump','@Debug/Profiler/dump.html.twig');
            return $templates;
        });


$app->register(new DebugServiceProvider(), array(
    'debug.max_items' => 250, // this is the default
    'debug.max_string_length' => -1, // this is the default
));


$app['twig.cache'] = false;
