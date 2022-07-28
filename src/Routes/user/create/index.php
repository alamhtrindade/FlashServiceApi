<?php

require_once('../../../Controller/UserController.php');

$json = json_decode(file_get_contents('php://input',true));

$controller = 'User';
$action = 'create';

$controller = new UserController();
$controller->createAction($json);

?>