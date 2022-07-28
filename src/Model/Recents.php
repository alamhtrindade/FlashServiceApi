<?php

class Recents{
  public $id;
  public $iduser;
  public $search;
  public $datesearch;
  
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

  public function setSearch($search){
    $this->search = $search;
  }
  public function getSearch(){
    return $this->search;
  }

  public function setDateSearch($datesearch){
    $this->datesearch = $datesearch;
  }
  public function getDateSearch(){
    return $this->datesearch;
  }

}