<?php

/*
 * Generic entry point/ front controller.

 */

use SkooppaOS\webMVc\HTTPConverter;

//autoload classes
require_once __DIR__.'/../vendor/autoload.php';

$httpConverter = new HTTPConverter();
$request = $httpConverter->createRequest();
$response = $httpConverter->handleRequest();
$httpConverter->sendResponse();



