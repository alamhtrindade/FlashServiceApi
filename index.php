<?php

require_once('common-class/Database.php');
require_once('config/autoload.php');

$db = Database::singleton();

$sql = 'SELECT * FROM _user ORDER BY id DESC';

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
  
  echo json_encode($user);

}else{
  echo('Nao executou busca');
}


?>