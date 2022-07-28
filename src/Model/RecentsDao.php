<?php

require_once('../../../../common-class/Database.php');
require_once('Recents.php');

class RecentsDao{

  const _table = '_recents';

  public function __construct() { }

  public function create($recents){
    

    $db = Database::singleton();

    $sql = 'INSERT INTO '. self::_table .' (iduser, search, datesearch) VALUES (?,?,?)';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $recents->getIdUser(), PDO::PARAM_STR);
    $sth->bindValue(2, $recents->getSearch(), PDO::PARAM_STR);
    $sth->bindValue(3, $recents->getDateSearch(), PDO::PARAM_STR);
     
    return $sth->execute();

  }

  public function read($id){

    $db = Database::singleton();

    $sql = 'SELECT * FROM ' . self::_table . ' WHERE iduser = ?';

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

    $recents = array();
    while($obj = $sth->fetch(PDO::FETCH_OBJ)){
      
      $recent = new Recents();

      $recent->setId($obj->id);
      $recent->setIdUser($obj->iduser);
      $recent->setSearch($obj->search);
      $recent->setDateSearch($obj->datesearch);
      

      $recents[] = $recent;
    }
    return $recents;
  }

  public function delete($id){  
    
    $db = Database::singleton();

    $sql = 'DELETE FROM ' . self::_table . ' WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_INT);
    
    return $sth->execute();    
  }

}