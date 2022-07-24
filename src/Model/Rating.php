<?php

class Rating{

  
  private $id;
  private $id_client;
  private $stars;
  private $title;
  private $description;
  
  public function __construct() { }
  
  public function setId($id){
    $this->id = $id;
  }
  public function getId(){
    return $this->id;
  }

  public function setId_Client($id_client){
    $this->id_client = $id_client;
  }
  public function getId_Client(){
    return $this->id_client;
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