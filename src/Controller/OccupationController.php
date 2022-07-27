<?php

require_once('../../../Model/OccupationDao.php');
require_once('../../../Model/Occupation.php');
require_once('../../../Model/Erro.php');

header("Content-Type:application/json");

class OccupationController{
  
  public $occupationDao;
  public $erro;

  public function __construct(){
    $this->occupationDao = new OccupationDao();
    $this->erro = new Erro();
  }

  public function createAction($json){
      try{

        $name = $json->name;

        if(empty($name)){
          $this->erro->setMessage("Nome é Obrigatório!");
          echo json_encode($this->erro);
          die();
        }else{
          $occupation = new Occupation();

          $occupation->setName($name);
          
          if($this->occupationDao->create($occupation)){
            $this->erro->setMessage("Nova Ocupação Cadastrada com Sucesso!");
            echo json_encode($this->erro);
          }else{
            $this->erro->setMessage("Ocorreu um Erro, Tente Novamente!");
            echo json_encode($this->erro);
            die();
          }
        } 
      }catch(Exception $e){
        return $e->getMessage();
      }
  }

  public function readAction(){
    try{
      
      $occupations = array('occupations' => $this->occupationDao->read(),);

      echo json_encode($occupations);

    }catch(Exception $e){
      return $e->getMessage();
    }
  }

  public function getOccupationAction($json){
    try{
      

      $occupations = array('occupations' => $this->occupationDao->getOccupation($json->name),);

      echo json_encode($occupations);

    }catch(Exception $e){
      return $e->getMessage();
    }
  }
}