<?php

class ServiceDao{

  const _table = 'service';

  public function __construct() { }

  public function insert($service){
    $db = Database::singleton();

    $sql = 'INSERT INTO '. self::_table .' (date_service, place_service) VALUES (?,?)';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $service->getDate_service(), PDO::PARAM_STR);
    $sth->bindValue(2, $service->getPlace_service(), PDO::PARAM_STR);

    
    return $sth->execute();
  }

  public function update($service){  
    $db = Database::singleton();

    $sql = 'UPDATE '. self::_table .' SET date_service = ?, place_service = ? WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $service->getDate_service(), PDO::PARAM_STR);
    $sth->bindValue(2, $service->getPlace_service(), PDO::PARAM_STR);
    $sth->bindValue(3, $service->getId(), PDO::PARAM_STR);
    
    return $sth->execute();    
  }


  public function delete($id){  
    $db = Database::singleton();

    $sql = 'DELETE FROM ' . self::_table . ' WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_INT);
    
    return $sth->execute();    
  }


  public function getservice($id){
    $db = Database::singleton();

    $sql = 'SELECT * FROM ' . self::_table . ' WHERE id = ?';

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

    if($obj = $sth->fetch(PDO::FETCH_OBJ)){
      $service = new Service();
      $service->setId($obj->id);
      $service->setDate_service($obj->date_service);
      $service->setPlace_service($obj->place_service);
      return $service;
    }

    return false;
  }

}