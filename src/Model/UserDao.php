<?php

require_once('../../../common-class/Database.php');
require_once('User.php');

class UserDao{

  const _table = '_user';

  public function __construct() { }

  public function create($user){
    
    $db = Database::singleton();

    $sql = 'INSERT INTO '. self::_table .' (name, email, phone, address,photo, password) VALUES (?,?,?,?,?,?)';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, strtolower(trim ($user->getName())), PDO::PARAM_STR);
    $sth->bindValue(2, trim ($user->getEmail()), PDO::PARAM_STR);
    $sth->bindValue(3, $user->getPhone(), PDO::PARAM_STR);
    $sth->bindValue(4, $user->getAddress(), PDO::PARAM_STR);
    $sth->bindValue(5, $user->getPhoto(), PDO::PARAM_STR);
    $sth->bindValue(6, trim (sha1($user->getPassword())), PDO::PARAM_STR);
    
    return $sth->execute();

  }

  public function read($id){

    $db = Database::singleton();

    $sql = 'SELECT * FROM ' . self::_table . ' WHERE id = ?';

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

    if($obj = $sth->fetch(PDO::FETCH_OBJ)){
      
      $user = new User();

      $user->setId($obj->id);
      $user->setName($obj->name);
      $user->setEmail($obj->email);
      $user->setPhone($obj->phone);
      $user->setAddress($obj->address);
      $user->setPhoto($obj->photo);
      $user->setPassword($obj->password);

      return $user;
    }
    return false;
  }

  public function update($user){  
    
    $db = Database::singleton();

    $sql = 'UPDATE '. self::_table .' SET name = ?, phone = ?, address = ?, photo = ?  WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, strtolower(trim ($user->getName())), PDO::PARAM_STR);
    $sth->bindValue(2, $user->getPhone(), PDO::PARAM_STR);
    $sth->bindValue(3, $user->getAddress(), PDO::PARAM_STR);
    $sth->bindValue(4, $user->getPhoto(), PDO::PARAM_STR);
    $sth->bindValue(5, $user->getId(), PDO::PARAM_INT);
    
    return $sth->execute();    
  }

  public function delete($id){  
    
    $db = Database::singleton();

    $sql = 'DELETE FROM ' . self::_table . ' WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_INT);
    
    return $sth->execute();    
  }


  public function updatePassword($id, $newPassword){  
    
    $db = Database::singleton();

    $sql = 'UPDATE '. self::_table .' SET password = ? WHERE id = ?';
    
    $sth = $db->prepare($sql);

    $sth->bindValue(1, sha1($newPassword), PDO::PARAM_STR);
    $sth->bindValue(2, $id, PDO::PARAM_INT);
    
    return $sth->execute();    
  }

 
  public function getLast(){
    
    $db = Database::singleton();

    $sql = 'SELECT * FROM ' . self::_table . ' ORDER BY id DESC';

    $sth = $db->prepare($sql);

    $sth->execute();

    if($obj = $sth->fetch(PDO::FETCH_OBJ)){
      
      $user = new User();

      $user->setId($obj->id);
      $user->setName($obj->name);
      $user->setEmail($obj->email);
      $user->setPhone($obj->phone);
      $user->setAddress($obj->address);
      $user->setPassword($obj->password);
      return $user;
    }
    return false;
  }

  public function login($email,$password){
    
    $db = Database::singleton();

    $sql = 'SELECT * FROM ' . self::_table . ' WHERE email = ? AND password = ?';

    $sth = $db->prepare($sql);

    $sth->bindValue(1, trim(strtolower($email)), PDO::PARAM_STR);
	  $sth->bindValue(2, trim(sha1($password)), PDO::PARAM_STR);
	
    $sth->execute();

    if($obj = $sth->fetch(PDO::FETCH_OBJ)){
      $user = new User();
      $user->setId($obj->id);
      $user->setName($obj->name);
      $user->setEmail($obj->email);
      $user->setPhone($obj->phone);
      $user->setAddress($obj->address);
      $user->setPhoto($obj->photo);
      $user->setPassword($obj->password);
      return $user;
    }
    return false;
  }
}