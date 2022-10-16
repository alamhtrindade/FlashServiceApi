<?php

require_once('../../../Model/ScheduleDao.php');
require_once('../../../Model/Schedule.php');
require_once('../../../Model/ServiceDao.php');
require_once('../../../Model/Service.php');
require_once('../../../Model/Agenda.php');
require_once('../../../Model/Erro.php');
require_once('ValidaController.php');

header("Content-Type:application/json");

class ScheduleController{
  
  public $scheduleDao;
  public $serviceDao;
  public $valida;
  public $erro;

  public function __construct(){
    $this->scheduleDao = new ScheduleDao();
    $this->serviceDao = new ServiceDao();
    $this->valida = new ValidaController();
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

  
  public function readAction($json){
    try{
      
      $schedule = $this->scheduleDao->validaDia($json->idprovider);
      $validadia = false;
      $dia = $this->valida->retornaDiaSemana($json->date);

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
           
      $inicio = $this->valida->retornaHora($schedule->getInicio());
      $fim = $this->valida->retornaHora($schedule->getFim());
      $almoco = $this->valida->retornaHora($schedule->getAlmoco());
      $retorno = $this->valida->retornaHora($schedule->getRetorno());

      //Verifica se no dia escolhido existe expediente
      if($validadia==false){

        $disponiveis = array();
        for($i=$inicio; $i<=$fim; $i++){
          
          $agenda = new Agenda();
          $agenda->setHour($i);
          $agenda->setAvaliable("false");
         
          $disponiveis[] = $agenda;
        }
        echo json_encode($disponiveis);
        return header('HTTP/1.1 200');

      }else{

        $verificaData = $this->valida->validaDia($json->date);

        //Verifica se a Data Solicitada é anterior a data atual
        if($verificaData<0){
          
          $this->erro->setMessage("Não é possível Agendar Serviço Para a Data Escolhida!");
          echo json_encode($this->erro);
          return header('HTTP/1.1 400');
        }elseif($verificaData==0){
          
          //NESTA VERIFICAÇÃO O DIA DO AGENDAMENTO É O MESMO DIA ATUAL
          //minha hora atual deve ser o inicio do atendimento
          date_default_timezone_set('America/Campo_Grande');
          $inicio = date('H');

          $inicio = $inicio-6;
          if(($services = $this->serviceDao->check($json->idprovider, $json->date))==false){
            $disponiveis = array();
            for($i=$inicio; $i<=$fim; $i++){
              $agenda = new Agenda();
              if($i>=$almoco && $i<$retorno){
                $agenda->setHour($i);
                $agenda->setAvaliable("false");
              }else{
                $agenda->setHour($i);
                $agenda->setAvaliable("true");
              }
              $disponiveis[] = $agenda;
            }
            echo(json_encode($disponiveis));
            return;
          }else{
            $horarios = array();
            foreach($services as $service){
              $horarios[] = $this->valida->retornaHora($service->getTimeService());
            }
          }
          // BUSCA TODOS OS HORARIOS DISPONIVEIS EXCETO OS AGENDADOS
          // AGORA RETORNA OS HORARIOS DISPONIVEIS
          $disponiveis = array();
          $result = count($horarios);
          $verifica = false;
          $x = 0;

          for($i=$inicio; $i<=$fim; $i++){
            $agenda = new Agenda();
            for($j=$x; $j<$result; $j++){
              if($i == $horarios[$j]){
                $x++;
                $verifica = true;
                $agenda->setHour($i);
                $agenda->setAvaliable("false");
              }
            }
            if($i>=$almoco && $i<$retorno){
              $verifica = true;
              $agenda->setHour($i);
              $agenda->setAvaliable("false");
            }
            if($verifica != true){
              $x = 0;
              $agenda->setHour($i);
              $agenda->setAvaliable("true");
            }
            $disponiveis[] = $agenda;
            $verifica = false;
          }

          echo json_encode($disponiveis);
          return;

        }else{
          
          //NESTE PONTO A DATA ESCOLHIDA É POSTERIOR A DATA DESEJADA
          // VERIFICA SE NESTE DIA EXISTE HORARIOS AGENDADOS
          if(($services = $this->serviceDao->check($json->idprovider, $json->date))==false){
            $disponiveis = array();
            for($i=$inicio; $i<=$fim; $i++){          
              $agenda = new Agenda();
              if($i>=$almoco && $i<$retorno){
                $agenda->setHour($i);
                $agenda->setAvaliable("false");
              }else{
                $agenda->setHour($i);
                $agenda->setAvaliable("true");
              }
              $disponiveis[] = $agenda;
            }

            echo(json_encode($disponiveis));
            return header('HTTP/1.1 200');

          }else{
            $horarios = array();
            foreach($services as $service){
              $horarios[] = $this->valida->retornaHora($service->getTimeService());
            }
          }
          // AGORA RETORNA OS HORARIOS DISPONIVEIS

          $disponiveis = array();

          $result = count($horarios);
          $verifica = false;
          $x = 0;

          for($i=$inicio; $i<=$fim; $i++){
            $agenda = new Agenda();
            for($j=$x; $j<$result; $j++){
              if($i == $horarios[$j]){
                $x++;
                $verifica = true;
                $agenda->setHour($i);
                $agenda->setAvaliable("false");
              }
            }
            if($i>=$almoco && $i<$retorno){
              $verifica = true;
              $agenda->setHour($i);
              $agenda->setAvaliable("false");
            }
            if($verifica != true){
              $x = 0;
              $agenda->setHour($i);
              $agenda->setAvaliable("true");
            }
            $disponiveis[] = $agenda;
            $verifica = false;
          }

          echo json_encode($disponiveis);
          return header('HTTP/1.1 200');
        }
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
  
 