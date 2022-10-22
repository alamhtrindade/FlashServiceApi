<?php

  require_once('../../../Controller/ServiceController.php');

  $json = json_decode(file_get_contents('php://input',true));

  $controller = 'Service';
  $action = 'getServiceByProvider';

  $controller = new ServiceController();
  $controller->getServiceByProvider($json);

?>