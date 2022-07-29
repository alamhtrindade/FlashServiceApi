<?php

  require_once('../../../Controller/ProviderController.php');

  $json = json_decode(file_get_contents('php://input',true));

  $controller = 'Provider';
  $action = 'update';

  $controller = new ProviderController();
  $controller->updateAction($json);

?>