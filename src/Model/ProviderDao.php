<?php

require_once('../../../../common-class/Database.php');
require_once('Provider.php');

class ProviderDao{

  const _table = '_provider';

  public function __construct() { }

  public function create($provider){
    
    $db = Database::singleton();

    $sql = 'INSERT INTO '. self::_table .' (name, email, phone, photo, password, cash, idoccupation) VALUES (?,?,?,?,?,?,?)';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, strtoupper($provider->getName()), PDO::PARAM_STR);
    $sth->bindValue(2, strtolower(trim($provider->getEmail())), PDO::PARAM_STR);
    $sth->bindValue(3, $provider->getPhone(), PDO::PARAM_STR);
    $sth->bindValue(4, $provider->getPhoto(), PDO::PARAM_STR);
    $sth->bindValue(5, trim (sha1($provider->getPassword())), PDO::PARAM_STR);
    $sth->bindValue(6, $provider->getCash(), PDO::PARAM_STR);
    $sth->bindValue(7, $provider->getIdOccupation(), PDO::PARAM_STR);
    
    return $sth->execute();

  }

  public function search($name){

    $db = Database::singleton();

    $sql =  "SELECT prov.id, prov.name, prov.email, prov.phone, prov.photo FROM  _provider AS prov INNER JOIN _occupation as occup ON occup.id = prov.idoccupation AND occup.keywords LIKE '%".strtoupper($name)."%'";

    $sth = $db->prepare($sql);

    $sth->execute();

    $providers = array();

    while($obj = $sth->fetch(PDO::FETCH_OBJ)){
      
      $provider = new Provider();

      $provider->setId($obj->id);
      $provider->setName($obj->name);
      $provider->setEmail($obj->email);
      $provider->setPhone($obj->phone);
      $provider->setPhoto($obj->photo);

      $providers[] = $provider;
    }
    return $providers;
  }

  public function read($id){

    $db = Database::singleton();

    $sql =  'SELECT * FROM '. self::_table .' WHERE id = ?';

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

    if($obj = $sth->fetch(PDO::FETCH_OBJ)){
      
      $provider = new Provider();

      $provider->setId($obj->id);
      $provider->setName($obj->name);
      $provider->setEmail($obj->email);
      $provider->setPhone($obj->phone);
      $provider->setPhoto($obj->photo);
      $provider->setCash($obj->cash);

      return $provider;
    }
    return false;
  }

  public function update($provider){  
    
    $db = Database::singleton();

    $sql = 'UPDATE '. self::_table .' SET name = ?, phone = ?, photo = ?  WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, strtoupper($provider->getName()), PDO::PARAM_STR);
    $sth->bindValue(2, $provider->getPhone(), PDO::PARAM_STR);
    $sth->bindValue(3, $provider->getPhoto(), PDO::PARAM_STR);
    $sth->bindValue(4, $provider->getId(), PDO::PARAM_STR);
    
    return $sth->execute();    
  }

  public function delete($id){  
    
    $db = Database::singleton();

    $sql = 'DELETE FROM ' . self::_table . ' WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_INT);
    
    return $sth->execute();    
  }

  public function getProviderByEmail($email){
    
    $db = Database::singleton();

    $sql = 'SELECT * FROM ' . self::_table . ' WHERE email = ?';

    $sth = $db->prepare($sql);

    $sth->bindValue(1, trim(strtolower($email)), PDO::PARAM_STR);

    $sth->execute();

    return ($sth->rowCount() > 0)?true:false;
  }

}