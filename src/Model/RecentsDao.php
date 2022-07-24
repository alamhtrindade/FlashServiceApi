<?php

class RecentsDao{

  const _table = 'recents';

  public function __construct() { }

  public function insert($recents){
    $db = Database::singleton();

    $sql = 'INSERT INTO '. self::_table .' (search) VALUES (?)';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $recents->getSearch(), PDO::PARAM_STR);

    return $sth->execute();
  }

  public function delete($id){  
    $db = Database::singleton();

    $sql = 'DELETE FROM ' . self::_table . ' WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_INT);
    
    return $sth->execute();    
  }


  public function getRecents(){
    $db = Database::singleton();

    $sql = 'SELECT * FROM ' . self::_table . ' WHERE id = ?';

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

    $recents = array();

    while($obj = $sth->fetch(PDO::FETCH_OBJ)){

      $recent = new Recents();

      $recent->setId($obj->id);
      $recent->setSearch($obj->search);

      $recents[] = $recent;
    }

    return $recents;
  }

}