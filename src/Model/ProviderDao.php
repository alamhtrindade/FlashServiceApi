<?php

class ProviderDao{

  const _table = 'provider';

  public function __construct() { }

  public function insert($provider){
    $db = Database::singleton();

    $sql = 'INSERT INTO '. self::_table .' (name, email, phone) VALUES (?,?,?)';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, strtolower(trim ($provider->getName())), PDO::PARAM_STR);
    $sth->bindValue(2, trim ($provider->getEmail()), PDO::PARAM_STR);
    $sth->bindValue(3, $provider->getPhone(), PDO::PARAM_STR);
    
    return $sth->execute();
  }

  public function update($provider){  
    $db = Database::singleton();

    $sql = 'UPDATE '. self::_table .' SET name = ?, phone = ?, address = ? WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, strtolower(trim ($provider->getName())), PDO::PARAM_STR);
    $sth->bindValue(2, $provider->getPhone(), PDO::PARAM_STR);
    $sth->bindValue(3, $provider->getAddress(), PDO::PARAM_STR);
    $sth->bindValue(4, $provider->getId(), PDO::PARAM_INT);
    
    return $sth->execute();    
  }


  public function delete($id){  
    $db = Database::singleton();

    $sql = 'DELETE FROM ' . self::_table . ' WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_INT);
    
    return $sth->execute();    
  }


  public function getProvider($id){
    $db = Database::singleton();

    $sql = 'SELECT * FROM ' . self::_table . ' WHERE id = ?';

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

    if($obj = $sth->fetch(PDO::FETCH_OBJ)){
     
      $provider = new Provider();

      $provider->setId($obj->id);
      $provider->setName($obj->name);
      $provider->setEmail($obj->email);
      $provider->setPhone($obj->phone);

      return $provider;
    }

    return false;
  }

}