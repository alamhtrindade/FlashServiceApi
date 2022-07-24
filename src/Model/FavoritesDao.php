<?php

class FavoritesDao{

  const _table = 'favorites';

  public function __construct() { }

  public function insert($favorites){
    $db = Database::singleton();

    $sql = 'INSERT INTO '. self::_table .' (search) VALUES (?)';
    
    $sth = $db->prepare($sql);
    
    $sth->bindValue(1, $favorites->getSearch(), PDO::PARAM_STR);
    
    return $sth->execute();
  }

  public function delete($id){  
    $db = Database::singleton();

    $sql = 'DELETE FROM ' . self::_table . ' WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_INT);
    
    return $sth->execute();    
  }


  public function getFavorites(){
    $db = Database::singleton();

    $sql = 'SELECT * FROM ' . self::_table;

    $sth = $db->prepare($sql);

    $sth->execute();

    $favorites = array();

    while($obj = $sth->fetch(PDO::FETCH_OBJ)){

      $favorite = new Favorites();

      $favorite->setId($obj->id);
      $favorite->setSearch($obj->search);

      $favorites[] = $favorite;
      
    }

    return $favorites;

  }
  

}