<?php

require_once('../../../Controller/RecentsController.php');

$json = json_decode(file_get_contents('php://input',true));

$controller = 'Recents';
$action = 'delete';

$controller = new RecentsController();
$controller->deleteAction($json);

?>