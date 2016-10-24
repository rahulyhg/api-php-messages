<?php

require_once 'dbHandler.php';
require './libs/Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

require_once '../models/messages.php';


function echoResponse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);

    // setting response content type to json
    $app->contentType('application/json');

    echo json_encode($response, JSON_PRETTY_PRINT);
}

$app->run();
?>