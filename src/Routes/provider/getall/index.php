<?php

  require_once('../../../Controller/ProviderController.php');

  $json = json_decode(file_get_contents('php://input',true));

  $controller = 'Provider';
  $action = 'getAll';

  $controller = new ProviderController();
  $controller->getAllAction($json);

?>