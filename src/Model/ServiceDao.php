<?php

require_once('../../../../common-class/Database.php');
require_once('Service.php');

class ServiceDao{

  const _table = '_service';

  public function __construct() { }

  public function create($provider){
    
    $db = Database::singleton();

    $sql = 'INSERT INTO '. self::_table .' (iduser, idprovider, dateservice, timeservice, localservice, typeservice, description) VALUES (?,?,?,?,?,?,?)';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $provider->getIdUser(), PDO::PARAM_STR);
    $sth->bindValue(2, $provider->getIdProvider(), PDO::PARAM_STR);
    $sth->bindValue(3, $provider->getDateService(), PDO::PARAM_STR);
    $sth->bindValue(4, $provider->getTimeService(), PDO::PARAM_STR);
    $sth->bindValue(5, $provider->getLocalService(), PDO::PARAM_STR);
    $sth->bindValue(6, $provider->getTypeService(), PDO::PARAM_STR);
    $sth->bindValue(7, $provider->getDescription(), PDO::PARAM_STR);
    
    return $sth->execute();

  }

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

  public function check($idprovider,$dateservice){

    
    $db = Database::singleton();

    $sql = 'SELECT * FROM ' . self::_table . ' WHERE idprovider = ? AND dateservice = ?';

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $idprovider, PDO::PARAM_STR);
    $sth->bindValue(2, $dateservice, PDO::PARAM_STR);

    $sth->execute();

    $services = array();

    while($obj = $sth->fetch(PDO::FETCH_OBJ)){
      
      $service = new Service();

      $service->setId($obj->id);
      $service->setIdProvider($obj->idprovider);
      $service->setDateService($obj->dateservice);
      $service->setTimeService($obj->timeservice);

      $services[] = $service;
    }

    if($services){
      return $services;
    }else{
      return false;
    }
    
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

  public function getByUser($id){

    $db = Database::singleton();

    $sql = 'SELECT serv.id, serv.iduser, prov.name idprovider, serv.dateservice, serv.localservice, serv.typeservice, serv.description, serv.timeservice
    FROM  _service AS serv INNER JOIN _provider as prov ON prov.id = CAST(serv.idprovider AS integer) WHERE serv.iduser=?' ;

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

    $services = array();

    while($obj = $sth->fetch(PDO::FETCH_OBJ)){
      
      $service = new Service();

      $service->setId($obj->id);
      $service->setIdUser($obj->iduser);
      $service->setIdProvider($obj->idprovider);
      $service->setDateService($obj->dateservice);
      $service->setTimeService($obj->timeservice);
      $service->setLocalService($obj->localservice);
      $service->setTypeService($obj->typeservice);
      $service->setDescription($obj->description);

      $services[] = $service;
    }
    return $services;
  }

  public function delete($id){  
    
    $db = Database::singleton();

    $sql = 'DELETE FROM ' . self::_table . ' WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_INT);
    
    return $sth->execute();    
  }

  public function getServiceByProvider($idprovider,$date){
    
    $db = Database::singleton();

    $sql = 'SELECT serv.id, usr.name, prov.name idprovider, serv.dateservice, serv.localservice, serv.typeservice, serv.description, serv.timeservice
    FROM  _service AS serv 
    INNER JOIN _provider as prov ON prov.id = CAST(serv.idprovider AS integer)
    INNER JOIN _user as usr ON CAST(serv.iduser AS integer) = usr.id
    WHERE prov.id= ? AND serv.dateservice= ?
    ORDER BY serv.timeservice';
    $sth = $db->prepare($sql);
    $sth->bindValue(1, $idprovider, PDO::PARAM_STR);
    $sth->bindValue(2, $date, PDO::PARAM_STR);

    $sth->execute();

    $services = array();

    while($obj = $sth->fetch(PDO::FETCH_OBJ)){
      
      $service = new Service();

      $service->setId($obj->id);
      $service->setIdUser($obj->iduser);
      $service->setIdProvider($obj->idprovider);
      $service->setDateService($obj->dateservice);
      $service->setTimeService($obj->timeservice);
      $service->setLocalService($obj->localservice);
      $service->setTypeService($obj->typeservice);
      $service->setDescription($obj->description);

      $services[] = $service;
    }
    return $services;

  }

}