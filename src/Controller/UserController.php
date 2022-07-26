<?php

require_once('../../../Model/UserDao.php');
require_once('../../../Model/User.php');
require_once('../../../Model/Erro.php');

header("Content-Type:application/json");

class UserController{
  
  public $userDao;
  public $erro;

  public function __construct(){
    $this->userDao = new UserDao();
    $this->erro = new Erro();
  }

  public function createAction($json){

      try{

        
        $name = $json->name;
        $email = $json->email;
        $password = $json->password;
        $confirmPassword = $json->confirmPassword;
         
        if(empty($name)){
          $this->erro->setMessage("Nome é Obrigatório!");
          echo json_encode($this->erro);
          die();
        }
          
        if(empty($email)){
          $this->erro->setMessage("Email é Obrigatório!");
          echo json_encode($this->erro);
          die();
        }
        
        if(empty($password)){
          $this->erro->setMessage("Senha é Obrigatório!");
          echo json_encode($this->erro);
          die();
        }

        if(empty($confirmPassword)){
          $this->erro->setMessage("Confirme a Senha é Obrigatório!");
          echo json_encode($this->erro);
          die();
        }

        if($this->userDao->getUserByEmail($email)){
          $this->erro->setMessage("Email já cadastrado!");
          echo json_encode($this->erro);
          die();
        }

        if($password!=$confirmPassword){
          $this->erro->setMessage("As senhas não conferem!");
          echo json_encode($this->erro);
          die();
        }else{
          
          $user = new User();

          $user->setName($name);
          $user->setEmail($email);
          $user->setPassword($password);
          
          if($this->userDao->create($user)){
            $this->erro->setMessage("Usuário Cadastrado com Sucesso!");
            echo json_encode($this->erro);
            die();
          }else{
			      $this->erro->setMessage("Ocorreu um Erro, Tente Novamente!");
            echo json_encode($this->erro);
             die();
          }
        }
      }catch(Exception $e){
        return $e->getMessage();
      }
  }
/*
  public function listAction(){
    
    $userDao = new UserDao();

    $viewModel = array(
        'users' => $userDao->getAll(),
      );

    $this->setRoute($this->view->getListUsersRoute());
    
    return $this->showView($viewModel);
  }
*/


  public function updateAction($json){

    try{

      $id = $json->id;
      $name = $json->name;
      $email = $json->email;
      $phone = $json->phone;
      $address = $json->address;
      $photo = $json->photo;
      
      $user = new User();
            
      $user->setId($id);
      $user->setName($name);
      $user->setEmail($email);
      $user->setPhone($phone);
      $user->setAddress($address);
      $user->setPhoto($photo);
      
      if($this->userDao->update($user)){
        
        $erro = new Erro();
        $this->erro->setMessage("Cadastro Atualizado!");
        echo json_encode($this->erro);
              
      }else{
        
        $this->erro->setMessage("Ocorreu um Erro Durante a Atualização, Tente Novamente!");
        echo json_encode($this->erro);
      
      }
	    	
	  }catch(Exception $e){
        
      $this->erro->setMessage("Ocorreu um Erro Inesperado, Tente Novamente!");
      echo json_encode($this->erro);

    }
    
  }

/*

  public function deleteAction()
  {

    $message = Message::singleton();

    $id =  array_key_exists ('id', $_GET) ? $_GET['id'] : '';

    if($this->userDao->delete($id)){
        $message->addMessage('Usuário excluído com sucesso');
    $viewModel = array();
    $viewModel = array(
        'checkins' => $this->checkinDao->getAll(),
      );

    $this->setRoute($this->view->getIndexRoute());
    }
    $this->showView($viewModel);

    return;
  }

  public function updatePasswordAction()
  {

    $message = Message::singleton();

    $viewModel = array();

    $id =  array_key_exists ('id', $_GET) ? $_GET['id'] : '';

    if(array_key_exists ('save', $_POST))
    {
      $currentPassword =  array_key_exists ('currentPassword', $_POST) ? $_POST['currentPassword'] : '';

      $newPassword =  array_key_exists ('newPassword', $_POST) ? $_POST['newPassword'] : '';

      $confirmPassword =  array_key_exists ('confirmPassword', $_POST) ? $_POST['confirmPassword'] : '';

      $viewModel = array(
          'users' => $this->userDao->getAll(),
          'user' => $this->userDao->getUser($id),
        );

      try
      {
        if(empty($currentPassword))
          throw new Exception('Preencha o campo Senha Atual.');

        if(empty($newPassword))
          throw new Exception('Preencha o campo Nova Senha.');

        if(empty($confirmPassword))
          throw new Exception('Preencha o campo Confirme a Senha.');

        if(!$this->userDao->checkPassword($id, $currentPassword))
          throw new Exception('Senha atual incorreta.');

        if($newPassword != $confirmPassword)
          throw new Exception('Senhas não conferem.');

        if(!$this->userDao->updatePassword($id, $newPassword))
          throw new Exception('Problema ao alterar senha');

        $message->addMessage('Senha alterada com sucesso');

        $this->setRoute($this->view->getListRoute());
      }
      catch(PDOException $e)
      {
          $message->addWarning($e->getMessage());
      }
      catch(Exception $e)
      {
        $this->setRoute($this->view->getUpdatePasswordRoute());

        $message->addWarning($e->getMessage());
      }
    }
    else
    {
      $viewModel = array(
          'user' => $this->userDao->getUser($id),
      );

      $this->setRoute($this->view->getUpdatePasswordRoute());
    }
    $this->showView($viewModel);

    return;
  }

  public function showAction(){
	$this->setRoute($this->view->getProfileRoute());
	$this->showView();
	return;
  }
*/
}
