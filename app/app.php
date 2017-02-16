<?php
    date_default_timezone_set('America/Los_Angeles');

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/scrabble.php";

    $app = new Silex\Application();

    $app->get('/', function() use ($app) {
        $test = new Scrabble;
        $result = $test->check_word('hypocrite');
        return $result;
    });

    return $app;

 ?>
