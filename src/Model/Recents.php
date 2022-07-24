<?php

class Recents{

  private $search;

  
  public function __construct() { }
  
  public function setSearch($search){
    $this->search = $search;
  }
  public function getSearch(){
    return $this->search;
  }

}