<?php

require_once('../../../../common-class/Database.php');
require_once('Rating.php');

class RatingDao{

  const _table = '_rating';

  public function __construct() { }

  public function create($rating){
    
    $db = Database::singleton();

    $sql = 'INSERT INTO '. self::_table .' (iduser, idprovider, stars, title, description) VALUES (?,?,?,?,?)';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $rating->getIdUser(), PDO::PARAM_STR);
    $sth->bindValue(2, $rating->getIdProvider(), PDO::PARAM_STR);
    $sth->bindValue(3, $rating->getStars(), PDO::PARAM_STR);
    $sth->bindValue(4, $rating->getTitle(), PDO::PARAM_STR);
    $sth->bindValue(5, $rating->getDescription(), PDO::PARAM_STR);
    
    return $sth->execute();

  }

  public function read($id){

    $db = Database::singleton();

    $sql = 'SELECT * FROM ' . self::_table . ' WHERE id = ?';

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

    if($obj = $sth->fetch(PDO::FETCH_OBJ)){
      
      $rating = new Rating();

      $rating->setId($obj->id);
      $rating->setIdUser($obj->iduser);
      $rating->setIdProvider($obj->idprovider);
      $rating->setStars($obj->stars);
      $rating->setTitle($obj->title);
      $rating->setDescription($obj->description);

      return $rating;
    }
    return false;
  }

  public function update($rating){  
    
    $db = Database::singleton();

    $sql = 'UPDATE '. self::_table .' SET stars = ?, title = ?, description = ?  WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $rating->getStars(), PDO::PARAM_STR);
    $sth->bindValue(2, $rating->getTitle(), PDO::PARAM_STR);
    $sth->bindValue(3, $rating->getDescription(), PDO::PARAM_STR);
    $sth->bindValue(4, $rating->getId(), PDO::PARAM_INT);
    
    return $sth->execute();    
  }

  public function delete($id){  
    
    $db = Database::singleton();

    $sql = 'DELETE FROM ' . self::_table . ' WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_INT);
    
    return $sth->execute();    
  }

  public function getAll($id){

    $db = Database::singleton();

    $sql = 'SELECT * FROM ' . self::_table . ' WHERE idprovider = ?';

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

    $ratings = array();

    while($obj = $sth->fetch(PDO::FETCH_OBJ)){
      
      $rating = new Rating();

      $rating->setId($obj->id);
      $rating->setIdUser($obj->iduser);
      $rating->setIdProvider($obj->idprovider);
      $rating->setStars($obj->stars);
      $rating->setTitle($obj->title);
      $rating->setDescription($obj->description);

      $ratings[] = $rating;
    }
    return $ratings;
  }
}