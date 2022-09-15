<?php

  require_once('../../../Controller/ScheduleController.php');

  $json = json_decode(file_get_contents('php://input',true));

  $controller = 'Schedule';
  $action = 'create';

  $controller = new ScheduleController();
  $controller->createAction($json);

?>