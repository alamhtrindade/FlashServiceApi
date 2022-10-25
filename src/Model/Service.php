<?php

class Service{
  public $id;
  public $iduser;
  public $idprovider;
  public $dateservice;
  public $localservice;
  public $typeservice;
  public $description;
  public $timeservice;
  public $isend;
  public $value;
  public $enddate;

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

  public function setDateService($dateservice){
    $this->dateservice = $dateservice;
  }
  public function getDateService(){
    return $this->dateservice;
  }

  public function setLocalService($localservice){
    $this->localservice = $localservice;
  }
  public function getLocalService(){
    return $this->localservice;
  }

  public function setTypeService($typeservice){
    $this->typeservice = $typeservice;
  }
  public function getTypeService(){
    return $this->typeservice;
  }

  public function setDescription($description){
    $this->description = $description;
  }
  public function getDescription(){
    return $this->description;
  }

  public function setTimeService($timeservice){
    $this->timeservice = $timeservice;
  }
  public function getTimeService(){
    return $this->timeservice;
  }

  public function setIsEnd($isend){
    $this->isend = $isend;
  }
  public function getIsEnd(){
    return $this->isend;
  }

  public function setValue($value){
    $this->value = $value;
  }
  public function getValue(){
    return $this->value;
  }

  public function setEndDate($enddate){
    $this->enddate = $enddate;
  }
  public function getEndDate(){
    return $this->enddate;
  }

}