<?php

require_once('../../../Model/ScheduleDao.php');
require_once('../../../Model/Schedule.php');
require_once('../../../Model/ServiceDao.php');
require_once('../../../Model/Service.php');
require_once('../../../Model/Agenda.php');
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
        
      die('Entrou no IF');
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

        $horarios = array();
        
        // VERIFICA SE NESTE DIA EXISTE HORARIOS AGENDADOS
        if(($services = $this->serviceDao->check($json->idprovider, $json->date))==false){
          
          $inicio = $schedule->getInicio();
          $fim = $schedule->getFim();
          $almoco = $schedule->getAlmoco();
          $retorno = $schedule->getRetorno();

          switch($inicio){
            case "00:00":
              $inicio= 0;
            break;
            case "01:00":
              $inicio = 1;
            break;
            case "02:00":
              $inicio = 2;
            break;
            case "03:00":
              $inicio = 3;
            break;
            case "04:00":
              $inicio = 4;
            break;
            case "05:00":
              $inicio = 5;
            break;
            case "06:00":
              $inicio = 6;
            break;
            case "07:00":
              $inicio = 7;
            break;
            case "08:00":
              $inicio = 8;
            break;
            case "09:00":
              $inicio = 9;
            break;
            case "10:00":
              $inicio = 10;
            break;
            case "11:00":
              $inicio = 11;
            break;
            case "12:00":
              $inicio = 12;
            break;
            case "13:00":
              $inicio = 13;
            break;
            case "14:00":
              $inicio = 14;
            break;
            case "15:00":
              $inicio = 15;
            break;
            case "16:00":
              $inicio = 16;
            break;
            case "17:00":
              $inicio = 17;
            break;
            case "18:00":
              $inicio = 18;
            break;
            case "19:00":
              $inicio = 19;
            break;
            case "20:00":
              $inicio = 20;
            break;
            case "21:00":
              $inicio = 21;
            break;
            case "22:00":
              $inicio = 22;
            break;
            case "23:00":
              $inicio = 23;
            break;
          }
          switch($fim){
            case "00:00":
              $fim= 0;
            break;
            case "01:00":
              $fim = 1;
            break;
            case "02:00":
              $fim = 2;
            break;
            case "03:00":
              $fim = 3;
            break;
            case "04:00":
              $fim = 4;
            break;
            case "05:00":
              $fim = 5;
            break;
            case "06:00":
              $fim = 6;
            break;
            case "07:00":
              $fim = 7;
            break;
            case "08:00":
              $fim = 8;
            break;
            case "09:00":
              $fim = 9;
            break;
            case "10:00":
              $fim = 10;
            break;
            case "11:00":
              $fim = 11;
            break;
            case "12:00":
              $fim = 12;
            break;
            case "13:00":
              $fim = 13;
            break;
            case "14:00":
              $fim = 14;
            break;
            case "15:00":
              $fim = 15;
            break;
            case "16:00":
              $fim = 16;
            break;
            case "17:00":
              $fim = 17;
            break;
            case "18:00":
              $fim = 18;
            break;
            case "19:00":
              $fim = 19;
            break;
            case "20:00":
              $fim = 20;
            break;
            case "21:00":
              $fim = 21;
            break;
            case "22:00":
              $fim = 22;
            break;
            case "23:00":
              $fim = 23;
            break;
          }
          switch($almoco){
            case "00:00":
              $almoco= 0;
            break;
            case "01:00":
              $almoco = 1;
            break;
            case "02:00":
              $almoco = 2;
            break;
            case "03:00":
              $almoco = 3;
            break;
            case "04:00":
              $almoco = 4;
            break;
            case "05:00":
              $almoco = 5;
            break;
            case "06:00":
              $almoco = 6;
            break;
            case "07:00":
              $almoco = 7;
            break;
            case "08:00":
              $almoco = 8;
            break;
            case "09:00":
              $almoco = 9;
            break;
            case "10:00":
              $almoco = 10;
            break;
            case "11:00":
              $almoco = 11;
            break;
            case "12:00":
              $almoco = 12;
            break;
            case "13:00":
              $almoco = 13;
            break;
            case "14:00":
              $almoco = 14;
            break;
            case "15:00":
              $almoco = 15;
            break;
            case "16:00":
              $almoco = 16;
            break;
            case "17:00":
              $almoco = 17;
            break;
            case "18:00":
              $almoco = 18;
            break;
            case "19:00":
              $almoco = 19;
            break;
            case "20:00":
              $almoco = 20;
            break;
            case "21:00":
              $almoco = 21;
            break;
            case "22:00":
              $almoco = 22;
            break;
            case "23:00":
              $almoco = 23;
            break;
          }
          switch($retorno){
            case "00:00":
              $retorno= 0;
            break;
            case "01:00":
              $retorno = 1;
            break;
            case "02:00":
              $retorno = 2;
            break;
            case "03:00":
              $retorno = 3;
            break;
            case "04:00":
              $retorno = 4;
            break;
            case "05:00":
              $retorno = 5;
            break;
            case "06:00":
              $retorno = 6;
            break;
            case "07:00":
              $retorno = 7;
            break;
            case "08:00":
              $retorno = 8;
            break;
            case "09:00":
              $retorno = 9;
            break;
            case "10:00":
              $retorno = 10;
            break;
            case "11:00":
              $retorno = 11;
            break;
            case "12:00":
              $retorno = 12;
            break;
            case "13:00":
              $retorno = 13;
            break;
            case "14:00":
              $retorno = 14;
            break;
            case "15:00":
              $retorno = 15;
            break;
            case "16:00":
              $retorno = 16;
            break;
            case "17:00":
              $retorno = 17;
            break;
            case "18:00":
              $retorno = 18;
            break;
            case "19:00":
              $retorno = 19;
            break;
            case "20:00":
              $retorno = 20;
            break;
            case "21:00":
              $retorno = 21;
            break;
            case "22:00":
              $retorno = 22;
            break;
            case "23:00":
              $retorno = 23;
            break;
          }
          
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

          echo json_encode($disponiveis);
          
        }else{
             
          
          foreach($services as $service){
            
            $horaservico = $service->getTimeService();

            switch($horaservico){
              case "00:00":
                $horarios[] = 0;
              break;
              case "01:00":
                $horarios[] = 1;
              break;
              case "02:00":
                $horarios[] = 2;
              break;
              case "03:00":
                $horarios[] = 3;
              break;
              case "04:00":
                $horarios[] = 4;
              break;
              case "05:00":
                $horarios[] = 5;
              break;
              case "06:00":
                $horarios[] = 6;
              break;
              case "07:00":
                $horarios[] = 7;
              break;
              case "08:00":
                $horarios[] = 8;
              break;
              case "09:00":
                $horarios[] = 9;
              break;
              case "10:00":
                $horarios[] = 10;
              break;
              case "11:00":
                $horarios[] = 11;
              break;
              case "12:00":
                $horarios[] = 12;
              break;
              case "13:00":
                $horarios[] = 13;
              break;
              case "14:00":
                $horarios[] = 14;
              break;
              case "15:00":
                $horarios[] = 15;
              break;
              case "16:00":
                $horarios[] = 16;
              break;
              case "17:00":
                $horarios[] = 17;
              break;
              case "18:00":
                $horarios[] = 18;
              break;
              case "19:00":
                $horarios[] = 19;
              break;
              case "20:00":
                $horarios[] = 20;
              break;
              case "21:00":
                $horarios[] = 21;
              break;
              case "22:00":
                $horarios[] = 22;
              break;
              case "23:00":
                $horarios[] = 23;
              break;
            }
          }
        }
        // BUSCA TODOS OS HORARIOS DISPONIVEIS EXCETO OS AGENDADOS
        //no meu $schedule tem os horarios de inicio e fim de expediente e os horarios de almoço.
        
        $inicio = $schedule->getInicio();
        $fim = $schedule->getFim();
        $almoco = $schedule->getAlmoco();
        $retorno = $schedule->getRetorno();

        switch($inicio){
          case "00:00":
            $inicio = 0;
          break;
          case "01:00":
            $inicio = 1;
          break;
          case "02:00":
            $inicio = 2;
          break;
          case "03:00":
            $inicio = 3;
          break;
          case "04:00":
            $inicio = 4;
          break;
          case "05:00":
            $inicio = 5;
          break;
          case "06:00":
            $inicio = 6;
          break;
          case "07:00":
            $inicio = 7;
          break;
          case "08:00":
            $inicio = 8;
          break;
          case "09:00":
            $inicio = 9;
          break;
          case "10:00":
            $inicio = 10;
          break;
          case "11:00":
            $inicio = 11;
          break;
          case "12:00":
            $inicio = 12;
          break;
          case "13:00":
            $inicio = 13;
          break;
          case "14:00":
            $inicio = 14;
          break;
          case "15:00":
            $inicio = 15;
          break;
          case "16:00":
            $inicio = 16;
          break;
          case "17:00":
            $inicio = 17;
          break;
          case "18:00":
            $inicio = 18;
          break;
          case "19:00":
            $inicio = 19;
          break;
          case "20:00":
            $inicio = 20;
          break;
          case "21:00":
            $inicio = 21;
          break;
          case "22:00":
            $inicio = 22;
          break;
          case "23:00":
            $inicio = 23;
          break;
        }

        switch($fim){
          case "00:00":
            $fim = 0;
          break;
          case "01:00":
            $fim = 1;
          break;
          case "02:00":
            $fim = 2;
          break;
          case "03:00":
            $fim = 3;
          break;
          case "04:00":
            $fim = 4;
          break;
          case "05:00":
            $fim = 5;
          break;
          case "06:00":
            $fim = 6;
          break;
          case "07:00":
            $fim = 7;
          break;
          case "08:00":
            $fim = 8;
          break;
          case "09:00":
            $fim = 9;
          break;
          case "10:00":
            $fim = 10;
          break;
          case "11:00":
            $fim = 11;
          break;
          case "12:00":
            $fim = 12;
          break;
          case "13:00":
            $fim = 13;
          break;
          case "14:00":
            $fim = 14;
          break;
          case "15:00":
            $fim = 15;
          break;
          case "16:00":
            $fim = 16;
          break;
          case "17:00":
            $fim = 17;
          break;
          case "18:00":
            $fim = 18;
          break;
          case "19:00":
            $fim = 19;
          break;
          case "20:00":
            $fim = 20;
          break;
          case "21:00":
            $inicio = 21;
          break;
          case "22:00":
            $fim = 22;
          break;
          case "23:00":
            $fim = 23;
          break;
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
  
 