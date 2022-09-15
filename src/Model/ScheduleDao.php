<?php

require_once('../../../../common-class/Database.php');
require_once('Schedule.php');

class ScheduleDao{

  const _table = '_schedule';

  public function __construct() { }

  public function create($schedule){
    
   
    $db = Database::singleton();

    $sql = 'INSERT INTO '. self::_table .' (id_provider, domingo, segunda, terca, quarta, quinta, sexta, sabado, inicio, fim, almoco, retorno) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $schedule->getIdProvider(), PDO::PARAM_STR);
    $sth->bindValue(2, $schedule->getDomingo(), PDO::PARAM_STR);
    $sth->bindValue(3, $schedule->getSegunda(), PDO::PARAM_STR);
    $sth->bindValue(4, $schedule->getTerca(), PDO::PARAM_STR);
    $sth->bindValue(5, $schedule->getQuarta(), PDO::PARAM_STR);
    $sth->bindValue(6, $schedule->getQuinta(), PDO::PARAM_STR);
    $sth->bindValue(7, $schedule->getSexta(), PDO::PARAM_STR);
    $sth->bindValue(8, $schedule->getSabado(), PDO::PARAM_STR);
    $sth->bindValue(9, $schedule->getInicio(), PDO::PARAM_STR);
    $sth->bindValue(10, $schedule->getFim(), PDO::PARAM_STR);
    $sth->bindValue(11, $schedule->getAlmoco(), PDO::PARAM_STR);
    $sth->bindValue(12, $schedule->getRetorno(), PDO::PARAM_STR);
   
    return $sth->execute();
  }

  public function validaDia($idprovider){

    $db = Database::singleton();

    $sql = 'SELECT * FROM ' . self::_table . ' WHERE id_provider = ?';

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $idprovider, PDO::PARAM_STR);

    $sth->execute();

    if($obj = $sth->fetch(PDO::FETCH_OBJ)){
      
      $schedule = new Schedule();

      $schedule->setId($obj->id);
      $schedule->setIdProvider($obj->id_provider);
      $schedule->setDomingo($obj->domingo);
      $schedule->setSegunda($obj->segunda);
      $schedule->setTerca($obj->terca);
      $schedule->setQuarta($obj->quarta);
      $schedule->setQuinta($obj->quinta);
      $schedule->setSexta($obj->sexta);
      $schedule->setSabado($obj->sabado);
      $schedule->setInicio($obj->inicio);
      $schedule->setFim($obj->fim);
      $schedule->setAlmoco($obj->almoco);
      $schedule->setRetorno($obj->retorno);

      return $schedule;
    }
    return false;
  }


  /*
  public function read($id){

    $db = Database::singleton();

    $sql = 'SELECT * FROM ' . self::_table . ' WHERE id = ?';

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

    if($obj = $sth->fetch(PDO::FETCH_OBJ)){
      
      $service = new Service();

      $service->setId($obj->id);
      $service->setIdUser($obj->iduser);
      $service->setIdProvider($obj->idprovider);
      $service->setDateService($obj->dateservice);
      $service->setTimeService($obj->timeservice);
      $service->setLocalService($obj->localservice);
      $service->setTypeService($obj->typeservice);
      $service->setDescription($obj->description);

      return $service;
    }
    return false;
  }

  public function update($provider){  
    
    $db = Database::singleton();

    $sql = 'UPDATE '. self::_table .' SET dateservice = ?, timeservice = ?, localservice = ?, typeservice = ?  WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $provider->getDateService(), PDO::PARAM_STR);
    $sth->bindValue(2, $provider->getTimeService(), PDO::PARAM_STR);
    $sth->bindValue(3, $provider->getLocalService(), PDO::PARAM_STR);
    $sth->bindValue(4, $provider->getTypeService(), PDO::PARAM_STR);
    $sth->bindValue(5, $provider->getId(), PDO::PARAM_INT);
    
    return $sth->execute();    
  }

  public function delete($id){  
    
    $db = Database::singleton();

    $sql = 'DELETE FROM ' . self::_table . ' WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_INT);
    
    return $sth->execute();    
  }
  */
}