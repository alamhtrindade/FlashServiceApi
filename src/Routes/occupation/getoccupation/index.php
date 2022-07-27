<?php

require_once('../../../Controller/OccupationController.php');

$json = json_decode(file_get_contents('php://input',true));

$controller = 'Occupation';
$action = 'get';

$controller = new OccupationController();
$controller->getOccupationAction($json);

?>