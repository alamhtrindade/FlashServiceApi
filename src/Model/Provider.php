<?php

class Provider{
  public $id;
  public $name;
  public $email;
  public $phone;
  public $photo;
  public $password;
  public $cash;
  public $idoccupation;
  public $servicesoffered;

    
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
  
  public function setCash($cash){
    $this->cash = $cash;
  }
  public function getCash(){
    return $this->cash;
  }

  public function setIdOccupation($idoccupation){
    $this->idoccupation = $idoccupation;
  }
  public function getIdOccupation(){
    return $this->idoccupation;
  }

  public function setServicesOffered($servicesoffered){
    $this->servicesoffered = $servicesoffered;
  }
  public function getServicesOffered(){
    return $this->servicesoffered;
  }

}