<?php

require_once('../../Controller/LogonController.php');

$json = json_decode(file_get_contents('php://input',true));

$controller = 'Logon';
$action = 'login';

$controller = new LogonController();
$controller->logoffAction($json);

?>