<?php

require_once('../../../Model/ScheduleDao.php');
require_once('../../../Model/Schedule.php');
require_once('../../../Model/ServiceDao.php');
require_once('../../../Model/Service.php');

require_once('../../../Model/Erro.php');

header("Content-Type:application/json");

class ScheduleController{
  
  public $scheduleDao;
  public $serviceDao;
  public $erro;

  public function __construct(){
    $this->scheduleDao = new ScheduleDao();
    $this->serviceDao = new ServiceDao();
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

  
  public function readAction($json){
    try{
      
      $schedule = $this->scheduleDao->validaDia($json->idprovider);
      $validadia = false;

      //PEGAR QUAL DIA DA SEMANA É
      if(setlocale(LC_TIME, 'pt')) {
        $dia = utf8_encode(strftime("%A",strtotime($json->date)));
        
        //VERIFICA SE O DIA DA SEMANA É VALIDO
        switch ($dia){
          case 'segunda-feira':
            if($schedule->getSegunda()=="true"){
              $validadia = true;  
            }
          break;
          case 'terça-feira':
            if($schedule->getTerca()=="true"){
              $validadia = true;  
            }
          break;
          case 'quarta-feira':
            if($schedule->getQuarta()=="true"){
              $validadia = true;  
            }
          break;
          case 'quinta-feira':
            if($schedule->getQuinta()=="true"){
              $validadia = true;  
            }
          break;
          case 'sexta-feira':
            if($schedule->getSexta()=="true"){
              $validadia = true;  
            }
          break;
          case 'sábado':
            if($schedule->getSabado()=="true"){
              $validadia = true;  
            }
          break;
          case 'domingo':
            if($schedule->getDomingo()=="true"){
              $validadia = true;  
            }
          break;
        }
        
        // VERIFICA SE NESTE DIA EXISTE HORARIOS AGENDADOS
        if($services = $this->serviceDao->check($json->idprovider, $json->date)){
          foreach($services as $service){
            echo("Dia ".$service->getDateService()." - ".$service->getTimeService()."\n");
          }
        }

        die("Parou");
        // BUSCA TODOS OS HORARIOS DISPONIVEIS EXCETO OS AGENDADOS
        
        // AGORA RETORNA OS HORARIOS DISPONIVEIS


        $erro = new Erro();

        if($validadia==true){
          $this->erro->setMessage("True");
        }
        if($validadia==false){
          $this->erro->setMessage("False");
        }
        
        echo json_encode($this->erro);
      }
    }catch(Exception $e){
      return $e->getMessage();
    }
  }

  /*
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
  
 