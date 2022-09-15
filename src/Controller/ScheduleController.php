<?php

require_once('../../../Model/ScheduleDao.php');
require_once('../../../Model/Schedule.php');
require_once('../../../Model/Erro.php');

header("Content-Type:application/json");

class ScheduleController{
  
  public $scheduleDao;
  public $erro;

  public function __construct(){
    $this->scheduleDao = new ScheduleDao();
    $this->erro = new Erro();
  }

  public function createAction($json){
      try{

        $idprovider = $json->idprovider;
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
            
            $this->erro->setMessage("Horario de Trabalho Inserido com Sucesso!");
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

  /*
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
  */
}
  
 