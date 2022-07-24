<?php

header("Content-Type:application/json");

$data['status'] = "SUCESS";
$data['method'] = $_SERVER['REQUEST_METHOD'];

echo json_encode($data);
