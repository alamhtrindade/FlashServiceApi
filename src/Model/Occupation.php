<?php

class Occupation{
 
  private $id;
  private $type;
  private $description;

  
  public function __construct() { }
  
  public function setId($id){
    $this->id = $id;
  }
  public function getId(){
    return $this->id;
  }

  public function setType($type){
    $this->type = $type;
  }
  public function getType(){
    return $this->type;
  }

  public function setDescription($description){
    $this->description = $description;
  }
  public function getDescription(){
    return $this->description;
  }
}