<?php

require_once('../../../../common-class/Database.php');
require_once('Occupation.php');

class OccupationDao{

  const _table = '_occupation';

  public function __construct() { }

  public function create($occupation){
    
    $db = Database::singleton();

    $sql = 'INSERT INTO '. self::_table .' (name) VALUES (?)';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, strtoupper($occupation->getName()), PDO::PARAM_STR);
   
    return $sth->execute();

  }

  public function read(){

    $db = Database::singleton();

    $sql = 'SELECT * FROM ' . self::_table ;

    $sth = $db->prepare($sql);

    $sth->execute();

    $occupations = array();

    while($obj = $sth->fetch(PDO::FETCH_OBJ)){
      
      $occupation = new Occupation();

      $occupation->setId($obj->id);
      $occupation->setName($obj->name);
     

      $occupations[] = $occupation;
    }
    return $occupations;
  }

  public function getOccupation($occupation){
    
    $db = Database::singleton();

    $concA="'%";
    $concB="%'";
    $name = $concA.strtoupper($occupation).$concB;
  
    $sql = 'SELECT * FROM ' . self::_table . ' WHERE name LIKE '.$name;

    $sth = $db->prepare($sql);

    $sth->execute();

    $occupations = array();

    while($obj = $sth->fetch(PDO::FETCH_OBJ)){
      
      $occupation = new Occupation();

      $occupation->setId($obj->id);
      $occupation->setName($obj->name);

      $occupations[] = $occupation;
    }
    return $occupations;
  }

}