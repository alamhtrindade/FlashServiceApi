<?php

require_once('../../../Model/ProviderDao.php');
require_once('../../../Model/Schedule.php');
require_once('../../../Model/ScheduleDao.php');
require_once('../../../Model/Provider.php');
require_once('../../../Model/Erro.php');

header("Content-Type:application/json");

class ProviderController{
  
  public $providerDao;
  public $scheduleDao;
  public $erro;

  public function __construct(){
    $this->providerDao = new ProviderDao();
    $this->scheduleDao = new ScheduleDao();
    $this->erro = new Erro();
  }

  public function createAction($json){
      try{

        $name = $json->name;
        $email = $json->email;
        $phone = $json->phone;
        $photo = $json->photo;
        $password = $json->password;
        $cash = 0;
        $idoccupation = $json->idoccupation;
        $confirmPassword = $json->confirmPassword;
        
        $domingo = $json->domingo;
        $segunda = $json->segunda;
        $terca = $json->terca;
        $quarta = $json->quarta;
        $quinta = $json->quinta;
        $sexta = $json->sexta;
        $sabado = $json->sabado;
        $inicio = $json->inicio;
        $fim = $json->fim;
        $almoco = $json->almoco;
        $retorno = $json->retorno;

        if(empty($name)){
          $this->erro->setMessage("Nome é Obrigatório!");
          echo json_encode($this->erro);
          return header('HTTP/1.1 400');
        }
          
        if(empty($email)){
          $this->erro->setMessage("Email é Obrigatório!");
          echo json_encode($this->erro);
          return header('HTTP/1.1 400');
        }

        if(empty($phone)){
          $this->erro->setMessage("Telefone é Obrigatório!");
          echo json_encode($this->erro);
          return header('HTTP/1.1 400');
        }

        if(empty($photo)){
          $this->erro->setMessage("Foto é Obrigatório!");
          echo json_encode($this->erro);
          return header('HTTP/1.1 400');
        }
                
        if(empty($password)){
          $this->erro->setMessage("Senha é Obrigatório!");
          echo json_encode($this->erro);
          return header('HTTP/1.1 400');
        }

        if(empty($confirmPassword)){
          $this->erro->setMessage("Confirme a Senha é Obrigatório!");
          echo json_encode($this->erro);
          return header('HTTP/1.1 400');
        }

        if($this->providerDao->getproviderByEmail($email)){
          $this->erro->setMessage("Email já cadastrado!");
          echo json_encode($this->erro);
          return header('HTTP/1.1 400');
        }

        if($password!=$confirmPassword){
          $this->erro->setMessage("As senhas não conferem!");
          echo json_encode($this->erro);
          return header('HTTP/1.1 400');
        }else{
          
          $provider = new Provider();

          $provider->setName($name);
          $provider->setEmail($email);
          $provider->setPhone($phone);
          $provider->setPhoto($photo);
          $provider->setPassword($password);
          $provider->setCash($cash);
          $provider->setIdOccupation($idoccupation);
          
          if($this->providerDao->create($provider)){
            
            $newprovider = $this->providerDao->getLast();
            
            $idprovider = $newprovider->getId();

            $schedule = new Schedule();

            $schedule->setIdProvider($idprovider);
            $schedule->setDomingo($domingo);
            $schedule->setSegunda($segunda);
            $schedule->setTerca($terca);
            $schedule->setQuarta($quarta);
            $schedule->setQuinta($quinta);
            $schedule->setSexta($sexta);
            $schedule->setSabado($sabado);
            $schedule->setInicio($inicio);
            $schedule->setFim($fim);
            $schedule->setAlmoco($almoco);
            $schedule->setRetorno($retorno);

            if($this->scheduleDao->create($schedule)){
              $this->erro->setMessage("Prestador de Serviço Cadastrado com Sucesso!");
              echo json_encode($this->erro);
              return header('HTTP/1.1 200');
            }else{
              $this->erro->setMessage("Houve um Problema ao Adicionar o Horário de Trabalho!");
              echo json_encode($this->erro);
              return header('HTTP/1.1 400');
            }
          }else{
			      $this->erro->setMessage("Ocorreu um Erro, Tente Novamente!");
            echo json_encode($this->erro);
            return header('HTTP/1.1 400');
          }
        }
      }catch(Exception $e){
        return $e->getMessage();
      }
  }

  public function searchAction($search){
    try{
      
      $providers = array('providers' => $this->providerDao->search($search->name),);

      echo json_encode($providers);
      return header('HTTP/1.1 200');
    }catch(Exception $e){
      return $e->getMessage();
    }
  }

  public function readAction($id){
    try{
      
      if($provider = $this->providerDao->read($id->id)){
        echo json_encode($provider);
        return header('HTTP/1.1 200');
      }else{
        $this->erro->setMessage("Ocorreu um Erro, Tente Novamente!");
        echo json_encode($this->erro);
        return header('HTTP/1.1 400');
      }

    }catch(Exception $e){
      return $e->getMessage();
    }
  }

  public function getAllAction($id){
    try{
      
      $providers = array('providers' => $this->providerDao->getAll(),);

      echo json_encode($providers);
      return header('HTTP/1.1 200');
    }catch(Exception $e){
      return $e->getMessage();
    }
  }

  public function updateAction($json){
    try{

      $id = $json->id;
      $name = $json->name;
      $phone = $json->phone;
      $photo = $json->photo;
      
      $provider = new Provider();
            
      $provider->setId($id);
      $provider->setName($name);
      $provider->setPhone($phone);
      $provider->setPhoto($photo);
      
      if($this->providerDao->update($provider)){
        
        $erro = new Erro();
        $this->erro->setMessage("Cadastro Atualizado!");
        echo json_encode($this->erro);
        return header('HTTP/1.1 200');       
      }else{
        
        $this->erro->setMessage("Ocorreu um Erro Durante a Atualização, Tente Novamente!");
        echo json_encode($this->erro);
        return header('HTTP/1.1 400');
      }
	    	
	  }catch(Exception $e){
        
      $this->erro->setMessage("Ocorreu um Erro Inesperado, Tente Novamente!");
      echo json_encode($this->erro);
      return header('HTTP/1.1 400');
    }
  }
  
  public function updatePasswordAction($json){
      try{
        $id = $json->id;
        $password = $json->password;
        $newPassword = $json->newPassword;
        $confirmPassword = $json->confirmPassword;
               
        if(empty($password)){
          $this->erro->setMessage("Senha é Obrigatório!");
          echo json_encode($this->erro);
          return header('HTTP/1.1 400');
        }

        if(empty($newPassword)){
          $this->erro->setMessage("Nova Senha é Obrigatório!");
          echo json_encode($this->erro);
          return header('HTTP/1.1 400');
        }

        if(empty($confirmPassword)){
          $this->erro->setMessage("Confirme a Nova Senha é Obrigatório!");
          echo json_encode($this->erro);
          return header('HTTP/1.1 400');
        }

        if($this->providerDao->getPassword($id,$password) == false){
          $this->erro->setMessage("Senha Atual Incorreta!");
          echo json_encode($this->erro);
          return header('HTTP/1.1 400');
        }

        if($newPassword!=$confirmPassword){
          $this->erro->setMessage("As senhas não conferem!");
          echo json_encode($this->erro);
          return header('HTTP/1.1 400');
        }else{     
          if($this->providerDao->updatePassword($id,$newPassword)){
            $this->erro->setMessage("Senha Atualizada com Sucesso!");
            echo json_encode($this->erro);
            return header('HTTP/1.1 200');
          }else{
			      $this->erro->setMessage("Ocorreu um ao Gravar a Nova Senha, Tente Novamente!");
            echo json_encode($this->erro);
            return header('HTTP/1.1 400');
          }
        }
      }catch(Exception $e){
        return $e->getMessage();
      }
    }

    public function deleteAction(){

  
      return;
    }
  

}