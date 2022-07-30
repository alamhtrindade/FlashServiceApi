<?php

  require_once('../../../Controller/RatingController.php');

  $json = json_decode(file_get_contents('php://input',true));

  $controller = 'Rating';
  $action = 'read';

  $controller = new RatingController();
  $controller->readAction($json);

?>