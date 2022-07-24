<?php

class Message{
  public $warning;

  public function __construct() { }
  
  public function setWarning($warning){
    $this->warning = $warning;
  }
  public function getWarning(){
    return $this->warning;
  }
}