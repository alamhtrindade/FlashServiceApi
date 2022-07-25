<?php

require_once('../../../Model/UserDao.php');
require_once('../../../Model/User.php');

class UserController{
  
  public $userDao;
  public $erro;

  public function __construct(){
    $this->userDao = new UserDao();
  }

  public function createAction($json){

      try{

        $name = $json->name;
        $email = $json->email;
        $password = $json->password;
        $confirmPassword = $json->confirmPassword;
         
        if(!empty($name)){
          $this->erro->setWarning("Nome é Obrigatório!");
          echo json_encode($this->erro);
          die();
        }
          
        if(!empty($email)){
          $this->erro->setWarning("Email é Obrigatório!");
          echo json_encode($this->erro);
          die();
        }
        
        if(!empty($password)){
          $this->erro->setWarning("Senha é Obrigatório!");
          echo json_encode($this->erro);
          die();
        }

        if(!empty($confirmPassword)){
          $this->erro->setWarning("Confirme a Senha é Obrigatório!");
          echo json_encode($this->erro);
          die();
        }

        if($this->userDao->getUserByEmail($email)){
          $this->erro->setWarning("Email já cadastrado!");
          echo json_encode($this->erro);
          die();
        }

        if($password!=$confirmPassword){
          $this->erro->setWarning("As senhas não conferem!");
          echo json_encode($this->erro);
          die();
        }else{
          
          $user = new User();

          $user->setName($name);
          $user->setEmail($email);
          $user->setPassword($password);
          
          if($this->userDao->create($user)){
            $this->erro->setWarning("Usuário Cadastrado com Sucesso!");
            echo json_encode($this->erro);
            die();
          }else{
			      $this->erro->setWarning("Ocorreu um Erro, Tente Novamente!");
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



  public function updateAction(){

    $message = Message::singleton();

    $id =  array_key_exists ('id', $_GET) ? $_GET['id'] : '';

	  if(array_key_exists ('submitUpdate', $_POST)){

	    $newName =  array_key_exists ('newName', $_POST) ? $_POST['newName'] : '';

      $newEmail =  array_key_exists ('newEmail', $_POST) ? $_POST['newEmail'] : '';

      $atualPassword = array_key_exists ('atualPassword', $_POST) ? $_POST['atualPassword'] : '';

      $newPassword = array_key_exists ('newPassword', $_POST) ? $_POST['newPassword'] : '';

      $confirmPassword = array_key_exists ('confirmPassword', $_POST) ? $_POST['confirmPassword'] : '';

	    try{
        if(empty($newPassword)){

          if($this->userDao->checkPassword($id,$atualPassword)){

            if(empty($newName))
              throw new Exception('Preencha o campo Nome!');
            if(empty($newEmail))
              throw new Exception('Preencha o campo Email!');

            $user = new User();
            
            $user->setId($id);
            
            $user->setName($newName);
            
            $user->setEmail($newEmail);
            
            if($this->userDao->update($user)){
              $message->addMessage('Usuário alterado com sucesso!');
              $viewModel = array();
              $viewModel = array(
                'checkins' => $this->checkinDao->getAll(),
              );
              $this->setRoute($this->view->getIndexRoute());
            }else{
              throw new Exception('Problema ao alterar um o usuário.');
              $this->setRoute($this->view->getIndexRoute());
            }
          }
	    	}else{
          if(empty($atualPassword))
              throw new Exception('Preencha o campo Senha Atual!');
          if(empty($newPassword))
              throw new Exception('Preencha o campo Nova Senha!');
          if(empty($confirmPassword))
            throw new Exception('Preencha o campo Confirme a Nova Senha!');

          if(!$this->userDao->checkPassword($id, $currentPassword))
            throw new Exception('Senha atual incorreta.');

          if($newPassword != $confirmPassword)
            throw new Exception('Senhas não conferem.');

          if(!$this->userDao->updatePassword($id, $newPassword))
            throw new Exception('Problema ao alterar senha');

          $message->addMessage('Senha alterada com sucesso');
          $viewModel = array();
          $viewModel = array(
            'checkins' => $this->checkinDao->getAll(),
          );
          $this->setRoute($this->view->getIndexRoute());
        }
	    }catch(Exception $e){
        
        $this->setRoute($this->view->getIndexRoute());
        
        $message->addWarning($e->getMessage());
        
        $viewModel = array();
        
        $viewModel = array(
          'checkins' => $this->checkinDao->getAll(),
        );
     
      }
	    
      return $this->showView($viewModel);
    }
    
    if(array_key_exists ('save', $_POST)){

      $name =  array_key_exists ('name', $_POST) ? $_POST['name'] : '';

      $email =  array_key_exists ('email', $_POST) ? $_POST['email'] : '';

      try{
        if(empty($name))
          throw new Exception('Preencha o campo Nome!');

        if(empty($email))
          throw new Exception('Preencha o campo Email!');

        $user = new User();
        $user->setId($id);
        $user->setName($name);
        $user->setEmail($email);

        if($this->userDao->update($user))
          $message->addMessage('Usuário alterado com sucesso!');
        else
          throw new Exception('Problema ao alterar um o usuário.');

        $viewModel = array(
			'checkins' => $this->checkinDao->getAll(),
            'users' => $this->userDao->getAll(),
        );

        $this->setRoute($this->view->getIndexRoute());
      }
      catch(Exception $e)
      {
		 $viewModel = array(
			'checkins' => $this->checkinDao->getAll(),
            'users' => $this->userDao->getAll(),
        );
        $this->setRoute($this->view->getIndexRoute());

        $message->addWarning($e->getMessage());
      }
    }
    else
    {

      $viewModel = array(
        'user' => $this->userDao->getUser($id),
		'checkins' => $this->checkinDao->getAll(),
      );

      $this->setRoute($this->view->getIndexRoute());
    }

    $this->showView($viewModel);

    return;
  }



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
