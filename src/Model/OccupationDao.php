<?php

class OccupationDao{

  const _table = 'occupation';

  public function __construct() { }

  public function insert($occupation){
    $db = Database::singleton();

    $sql = 'INSERT INTO '. self::_table .' (type, description) VALUES (?,?)';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $occupation->getType(), PDO::PARAM_STR);
    $sth->bindValue(2, $occupation->getDescription(), PDO::PARAM_STR);
    
    return $sth->execute();
  }

  public function update($occupation){  
    $db = Database::singleton();

    $sql = 'UPDATE '. self::_table .' SET type = ?, description = ? WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $occupation->getType(), PDO::PARAM_STR);
    $sth->bindValue(2, $occupation->getDescription(), PDO::PARAM_STR);
    $sth->bindValue(3, $occupation->getId(), PDO::PARAM_INT);
    
    return $sth->execute();    
  }

  

  public function delete($id){  
    $db = Database::singleton();

    $sql = 'DELETE FROM ' . self::_table . ' WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_INT);
    
    return $sth->execute();    
  }


  public function getoccupation($id){
    $db = Database::singleton();

    $sql = 'SELECT * FROM ' . self::_table . ' WHERE id = ?';

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

    if($obj = $sth->fetch(PDO::FETCH_OBJ)){
     
      $occupation = new Occupation();

      $occupation->setId($obj->id);
      $occupation->setType($obj->type);
      $occupation->setDescription($obj->description);

      return $occupation;
    }

    return false;
  }

}