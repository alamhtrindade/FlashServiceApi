<?php

  require_once('../../../Controller/ProviderController.php');

  $json = json_decode(file_get_contents('php://input',true));

  $controller = 'Provider';
  $action = 'login';

  $controller = new ProviderController();
  $controller->loginAction($json);

?>