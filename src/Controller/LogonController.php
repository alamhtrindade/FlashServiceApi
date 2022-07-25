<?php

require_once('../../Model/UserDao.php');

header("Content-Type:application/json");

class LogonController{
	
	public $userDao;
	public $erro;

	public function __construct(){
		$this->userDao = new UserDao();
	}

	public function loginAction($json){

    try{

      if($user = $this->userDao->login($json->email,$json->password)){
        
        
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
