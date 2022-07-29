<?php

require_once('../../../../common-class/Database.php');
require_once('Favorites.php');

class FavoritesDao{

  const _table = '_favorites';

  public function __construct() { }

  public function create($favorites){
    
    $db = Database::singleton();

    $sql = 'INSERT INTO '. self::_table .' (iduser, idprovider) VALUES (?,?)';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $favorites->getIdUser(), PDO::PARAM_STR);
    $sth->bindValue(2, $favorites->getIdProvider(), PDO::PARAM_STR);

    return $sth->execute();

  }

  public function read($iduser){

    $db = Database::singleton();

    $sql =  'SELECT fav.id, prov.name FROM  _provider AS prov, _favorites AS fav WHERE fav.iduser = ?' ;

    $sth = $db->prepare($sql);

    $sth->bindValue(1, intval($iduser), PDO::PARAM_STR);

    $sth->execute();

    $favoritesarray = array();

    while($obj = $sth->fetch(PDO::FETCH_OBJ)){
      
      $favorites = new Favorites();

      $favorites->setId($obj->id);
      $favorites->setName($obj->name);

      $favoritesarray[] = $favorites;
    }
    return $favoritesarray;
  }

  public function delete($id){  
    
    $db = Database::singleton();

    $sql = 'DELETE FROM ' . self::_table . ' WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_INT);
    
    return $sth->execute();    
  }

}