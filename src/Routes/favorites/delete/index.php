<?php

require_once('../../../Controller/FavoritesController.php');

$json = json_decode(file_get_contents('php://input',true));

$controller = 'Favorites';
$action = 'delete';

$controller = new FavoritesController();
$controller->deleteAction($json);

?>