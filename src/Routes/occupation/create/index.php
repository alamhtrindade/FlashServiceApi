
<?php

require_once('../../../Controller/OccupationController.php');

$json = json_decode(file_get_contents('php://input',true));

$controller = 'Occupation';
$action = 'create';

$controller = new OccupationController();
$controller->createAction($json);

?>