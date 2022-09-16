<?php

class Agenda{
  public $hour;
  public $avaliable;
  
  public function __construct() { }
  
  public function setHour($hour){
    $this->hour = $hour;
  }
  public function getHour(){
    return $this->hour;
  }

  public function setAvaliable($avaliable){
    $this->avaliable = $avaliable;
  }
  public function getAvaliable(){
    return $this->avaliable;
  }

}