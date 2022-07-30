<?php

class Rating{
  public $id;
  public $iduser;
  public $idprovider;
  public $stars;
  public $title;
  public $description;
  
  public function __construct() { }
  
  public function setId($id){
    $this->id = $id;
  }
  public function getId(){
    return $this->id;
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

  public function setStars($stars){
    $this->stars = $stars;
  }
  public function getStars(){
    return $this->stars;
  }

  public function setTitle($title){
    $this->title = $title;
  }
  public function getTitle(){
    return $this->title;
  }

  public function setDescription($description){
    $this->description = $description;
  }
  public function getDescription(){
    return $this->description;
  }

}