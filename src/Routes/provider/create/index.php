<?php

  require_once('../../../Controller/ProviderController.php');

  $json = json_decode(file_get_contents('php://input',true));

  $controller = 'Provider';
  $action = 'create';

  $controller = new ProviderController();
  $controller->createAction($json);

?>