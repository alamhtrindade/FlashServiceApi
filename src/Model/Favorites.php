<?php

class Favorites{
 
  private $id;
  private $search;
 
  
  public function __construct() { }
  
  public function setId($id){
    $this->id = $id;
  }
  public function getId(){
    return $this->id;
  }

  public function setSearch($search){
    $this->search = $search;
  }
  public function getSearch(){
    return $this->search;
  }

}