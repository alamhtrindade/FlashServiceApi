<?php

require_once('../../../Model/ServiceDao.php');
require_once('../../../Model/Service.php');
require_once('../../../Model/Erro.php');

header("Content-Type:application/json");

class ServiceController{
  
  public $serviceDao;
  public $erro;

  public function __construct(){
    $this->serviceDao = new ServiceDao();
    $this->erro = new Erro();
  }

  public function createAction($json){
      try{

        $iduser = $json->iduser;
        $idprovider = $json->idprovider;
        $dateservice = $json->dateservice;
        $timeservice = $json->timeservice;
        $localservice = $json->localservice;
        $typeservice = $json->typeservice;
        $description = $json->description;
         
        if(empty($dateservice)){
          $this->erro->setMessage("Data é Obrigatório!");
          echo json_encode($this->erro);
          die();
        }
          
        if(empty($timeservice)){
          $this->erro->setMessage("Hora é Obrigatório!");
          echo json_encode($this->erro);
          die();
        }
        
        if(empty($localservice)){
          $this->erro->setMessage("Local é Obrigatório!");
          echo json_encode($this->erro);
          die();
        }

        if(empty($typeservice)){
          $this->erro->setMessage("Tipo do Serviço é Obrigatório!");
          echo json_encode($this->erro);
          die();
        }
  
        $service = new Service();

        $service->setIdUser($iduser);
        $service->setIdProvider($idprovider);
        $service->setDateService($dateservice);
        $service->setTimeService($timeservice);
        $service->setLocalService($localservice);
        $service->setTypeService($typeservice);
        $service->setDescription($description);

          if($this->serviceDao->create($service)){
            $this->erro->setMessage("Serviço Agendado com Sucesso!");
            echo json_encode($this->erro);
            die();
          }else{
			      $this->erro->setMessage("Ocorreu um Erro, Tente Novamente!");
            echo json_encode($this->erro);
             die();
          }
      }catch(Exception $e){
        return $e->getMessage();
      }
  }

  public function readAction($id){
    try{
      
      $service = array('service' => $this->serviceDao->read($id->id),);

      echo json_encode($service);

    }catch(Exception $e){
      return $e->getMessage();
    }
  }

  public function updateAction($json){
    try{

      $id = $json->id;
      $dateservice = $json->dateservice;
      $timeservice = $json->timeservice;
      $localservice = $json->localservice;
      $typeservice = $json->typeservice;
      
      $service = new Service();
            
      $service->setId($id);
      $service->setDateService($dateservice);
      $service->setTimeService($timeservice);
      $service->setLocalService($localservice);
      $service->setTypeService($typeservice);
      
      if($this->serviceDao->update($service)){
        
        $erro = new Erro();
        $this->erro->setMessage("Serviço Agendado foi Atualizado!");
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

  public function deleteAction($id){

    if($this->serviceDao->delete($id->id)){
      $this->erro->setMessage("Removido!");
          echo json_encode($this->erro);
    }else{
      $this->erro->setMessage("Falha ao Remover, Tente Novamente!");
          echo json_encode($this->erro);
    }
  }
}
  
 