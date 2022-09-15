<?php

class Schedule{
  public $id;
  public $idprovider;
  public $domingo;
  public $segunda;
  public $terca;
  public $quarta;
  public $quinta;
  public $sexta;
  public $sabado;
  public $inicio;
  public $fim;
  public $almoco;
  public $retorno;

  
  public function __construct() { }
  
  public function setId($id){
    $this->id = $id;
  }
  public function getId(){
    return $this->id;
  }

  public function setIdProvider($idprovider){
    $this->idprovider = $idprovider;
  }
  public function getIdProvider(){
    return $this->idprovider;
  }

  public function setDomingo($domingo){
    $this->domingo = $domingo;
  }
  public function getDomingo(){
    return $this->domingo;
  }

  public function setSegunda($segunda){
    $this->segunda = $segunda;
  }
  public function getSegunda(){
    return $this->segunda;
  }

  public function setTerca($terca){
    $this->terca = $terca;
  }
  public function getTerca(){
    return $this->terca;
  }

  public function setQuarta($quarta){
    $this->quarta = $quarta;
  }
  public function getQuarta(){
    return $this->quarta;
  }

  public function setQuinta($quinta){
    $this->quinta = $quinta;
  }
  public function getQuinta(){
    return $this->quinta;
  }

  public function setSexta($sexta){
    $this->sexta = $sexta;
  }
  public function getSexta(){
    return $this->sexta;
  }

  public function setSabado($sabado){
    $this->sabado = $sabado;
  }
  public function getSabado(){
    return $this->sabado;
  }

  public function setInicio($inicio){
    $this->inicio = $inicio;
  }
  public function getInicio(){
    return $this->inicio;
  }

  public function setFim($fim){
    $this->fim = $fim;
  }
  public function getFim(){
    return $this->fim;
  }

  public function setAlmoco($almoco){
    $this->almoco = $almoco;
  }
  public function getAlmoco(){
    return $this->almoco;
  }

  public function setRetorno($retorno){
    $this->retorno = $retorno;
  }
  public function getRetorno(){
    return $this->retorno;
  }
}