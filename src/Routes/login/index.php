<?php

require_once('../../Controller/LogonController.php');

$json = json_decode(file_get_contents('php://input',true));

if(session_status() !== PHP_SESSION_ACTIVE){

  $controller = 'Logon';
  $action = 'login';

  $controller = new LogonController();
  $controller->loginAction($json);

}else{
  $erro = new Erro();
  $erro->setMessage("Você Já está logado!");

  echo json_encode($erro);
  return header('HTTP/1.1 400');
}

?>