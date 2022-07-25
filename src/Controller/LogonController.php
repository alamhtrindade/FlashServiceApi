<?php

require_once('../../Model/UserDao.php');

class LogonController{
	
	public $userDao;

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

        $erro2 = json_encode($this->erro);

        return print_r($erro2);
      }
    }catch(Exception $e){
      return $e->getMessage();
    }




  }
    /*
		if(array_key_exists ('submit', $_POST)){
			$email =  array_key_exists ('email', $_POST) ? $_POST['email'] : '';
			$password =  array_key_exists ('password', $_POST) ? $_POST['password'] : '';

			
			//verificar se está vindo em branco ou se o email e senha está correto
			try{

				if($user = $this->userDao->login($email,$password)){
					
					//se ele autenticar, setar a rota para o index/index.php
					//$viewModel = array(
						//	'clientes' => $this->clienteDao->birthdays(),
					//);
					$this->setRoute($this->view->getIndexRoute());
					//definir o nome da sessão para o usuário
					$_SESSION['USER'] = serialize($user);
					$viewModel = array(
						'clientes' => $this->clienteDao->birthdays(),
					);
					$this->showView($viewModel);	
				}
				else{

					//se ele NÃO autenticar, setar a rota para o login de novo
					$this->setRoute($this->view->getLogonRoute());
				}
			}
			catch(Exception $e){

				//se der erro, setar a rota para o login de novo
					$this->setRoute($this->view->getLogonRoute());
			}
		}
		else{
			$this->setRoute($this->view->getLogonRoute());
			//chamar esta página de login
			$this->showView();

		}


		return;
	}

	//função de loggof
	public function logoffAction(){
		unset($_SESSION['USER']);
		$this->setRoute($this->view->getLogonRoute());
		$message = Message::singleton();
		$message->addMessage('Você foi deslogado com sucesso!');
		$this->showView();
	} */
}
