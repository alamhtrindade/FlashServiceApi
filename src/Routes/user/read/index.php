<?php

require_once('../../../Controller/UserController.php');

$json = json_decode(file_get_contents('php://input',true));

$controller = 'User';
$action = 'read';

$controller = new UserController();
$controller->readAction($json);

?>