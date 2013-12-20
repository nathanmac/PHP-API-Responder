<?php

include_once 'Responder.php';

$responder = new Responder();

$payload = array(
	'parameters' => array(
		'id' => 1231
	),
	'data' => array(
		'message' => 'Hello World'
	)
);

header('Content-Type: application/json');
header('HTTP/1.1: ' . 200);
header('Status: ' . 200);

echo $responder->to_json($payload);