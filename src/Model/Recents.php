<?php

class Recents{
  public $id;
  public $name;
  public $email;
  public $phone;
  public $address;
  public $photo;
  public $password;
  
  public function __construct() { }
  
  public function setId($id){
    $this->id = $id;
  }
  public function getId(){
    return $this->id;
  }

  public function setName($name){
    $this->name = $name;
  }
  public function getName(){
    return $this->name;
  }

  public function setEmail($email){
    $this->email = $email;
  }
  public function getEmail(){
    return $this->email;
  }

  public function setPhone($phone){
    $this->phone = $phone;
  }
  public function getPhone(){
    return $this->phone;
  }

  public function setAddress($address){
    $this->address = $address;
  }
  public function getAddress(){
    return $this->address;
  }

  public function setPhoto($photo){
    $this->photo = $photo;
  }
  public function getPhoto(){
    return $this->photo;
  }

  public function setPassword($password){
    $this->password = $password;
  }
  public function getPassword(){
    return $this->password;
  }
}