<?php

class Favorites{
  public $id;
  public $name;
  public $iduser;
  public $idprovider;
  public $phone;
  public $photo;
  
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

  public function setIdUser($iduser){
    $this->iduser = $iduser;
  }
  public function getIdUser(){
    return $this->iduser;
  }

  public function setIdProvider($idprovider){
    $this->idprovider = $idprovider;
  }
  public function getIdProvider(){
    return $this->idprovider;
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
}