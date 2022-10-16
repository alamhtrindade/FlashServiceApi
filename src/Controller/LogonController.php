<?php

require_once('../../Model/LogonDao.php');
require_once('../../Model/Erro.php');

header("Content-Type:application/json");

class LogonController{
	
	public $LogonDao;

	public function __construct(){
		$this->logonDao = new LogonDao();
	}

	public function loginAction($json){

    try{

      if($user = $this->logonDao->login($json->email,$json->password)){
        
        
        $_SESSION['USER'] = serialize($user);

        echo json_encode($user);
				return header('HTTP/1.1 200');
      }else{

				$erro = new Erro();
        $erro->setMessage("Usuário ou Senha Incorretos!");

        echo json_encode($erro);
				return header('HTTP/1.1 400');
      }
    }catch(Exception $e){
      return $e->getMessage();
    }
	}
/*

	//função de loggof
	public function logoffAction(){
		unset($_SESSION['USER']);
		$this->setRoute($this->view->getLogonRoute());
		$message = Message::singleton();
		$message->addMessage('Você foi deslogado com sucesso!');
		$this->showView();
	} */
}
