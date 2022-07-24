<?php

class Service{

  private $id;
  private $data_service;
  private $place_service;

  
  public function __construct() { }
  
  public function setId($id){
    $this->id = $id;
  }
  public function getId(){
    return $this->id;
  }

  public function setData_service($data_service){
    $this->data_service = $data_service;
  }
  public function getData_service(){
    return $this->data_service;
  }

  public function setPlace_service($place_service){
    $this->place_service = $place_service;
  }
  public function getPlace_service(){
    return $this->place_service;
  }

}