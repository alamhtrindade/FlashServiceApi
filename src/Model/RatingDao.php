<?php

class RatingDao{

  const _table = 'rating';

  public function __construct() { }

  public function insert($rating){
    $db = Database::singleton();

    $sql = 'INSERT INTO '. self::_table .' (id_client, stars, title, description) VALUES (?,?,?,?)';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $rating->getId_client(), PDO::PARAM_STR);
    $sth->bindValue(2, $rating->getStars()), PDO::PARAM_STR);
    $sth->bindValue(3, $rating->getTitle(), PDO::PARAM_STR);
    $sth->bindValue(4, $rating->getDescription(), PDO::PARAM_STR);
    
    return $sth->execute();
  }

  /* VERIFICAR SE PODE EDITAR UMA AVALIAÇÃO 


  public function update($rating){  
    $db = Database::singleton();

    $sql = 'UPDATE '. self::_table .' SET stars = ?, title = ?, address = ? WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, strtolower(trim ($rating->getName())), PDO::PARAM_STR);
    $sth->bindValue(2, $rating->getPhone(), PDO::PARAM_STR);
    $sth->bindValue(3, $rating->getAddress(), PDO::PARAM_STR);
    $sth->bindValue(4, $rating->getId(), PDO::PARAM_INT);
    
    return $sth->execute();    
  }
*/


  public function delete($id){  
    $db = Database::singleton();

    $sql = 'DELETE FROM ' . self::_table . ' WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_INT);
    
    return $sth->execute();    
  }


  public function getrating($id){
    $db = Database::singleton();

    $sql = 'SELECT * FROM ' . self::_table . ' WHERE id = ?';

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

    $ratings = array();

    while($obj = $sth->fetch(PDO::FETCH_OBJ)){

      $rating = new Rating();

      $rating->setId($obj->id);
      $rating->setName($obj->name);
      $rating->setEmail($obj->email);
      $rating->setPhone($obj->phone);
      $rating->setAddress($obj->address);
      $rating->setPassword($obj->password);
      
      $ratings[] = $rating;
    }

    return $rating;
  }


}