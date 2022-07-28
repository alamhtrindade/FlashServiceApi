<?php

require_once('../../../Controller/RecentsController.php');

$json = json_decode(file_get_contents('php://input',true));

$controller = 'Recents';
$action = 'create';

$controller = new RecentsController();
$controller->createAction($json);

?>