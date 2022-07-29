<?php

  require_once('../../../Controller/ProviderController.php');

  $json = json_decode(file_get_contents('php://input',true));

  $controller = 'Provider';
  $action = 'search';

  $controller = new ProviderController();
  $controller->searchAction($json);

?>