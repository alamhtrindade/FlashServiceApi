<?php

class Provider{
  
  private $id;
  private $name;
  private $email;
  private $phone;

  
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

}