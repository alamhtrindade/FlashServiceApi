<?php

require_once('../../Model/LogonDao.php');

header("Content-Type:application/json");

class LogonController{
	
	public $LogonDao;
	public $erro;

	public function __construct(){
		$this->logonDao = new LogonDao();
	}

	public function loginAction($json){

    try{

      if($user = $this->logonDao->login($json->email,$json->password)){
        
        
        $_SESSION['USER'] = serialize($user);

        echo json_encode($user);

      }else{

        $this->erro->setWarning("Usuário ou Senha Incorretos!");

        echo json_encode($this->erro);
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
