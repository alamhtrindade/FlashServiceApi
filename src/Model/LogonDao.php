<?php

require_once('../../../common-class/Database.php');
require_once('User.php');

class LogonDao{

  const _table = '_user';

  public function __construct() { }


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