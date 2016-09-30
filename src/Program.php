<?php

/**
 * Created by PhpStorm.
 * User: Wessel Bosman
 * Date: 9/30/2016
 * Time: 10:08 PM
 */
require_once '../vendor/autoload.php';
require_once 'FizzBuzz.php';

use Symfony\Component\Console\Application;
use FizzBuzz\Command\FizzBuzzCommand;

$app = new Application('FizzBuzzApp', '1.0 (stable)');
$app->add(new FizzBuzzCommand());
$app->run();