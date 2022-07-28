<?php

class Occupation{
  public $id;
  public $name;
  public $keywords;

  
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

  public function setKeywords($keywords){
    $this->keywords = $keywords;
  }
  public function getKeywords(){
    return $this->keywords;
  }

}