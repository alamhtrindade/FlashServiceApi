<?php

require_once('../../../Model/RecentsDao.php');
require_once('../../../Model/Recents.php');
require_once('../../../Model/Erro.php');

header("Content-Type:application/json");

class RecentsController{
  
  public $recentsDao;
  public $erro;

  public function __construct(){
    $this->recentsDao = new RecentsDao();
    $this->erro = new Erro();
  }

  public function createAction($json){
      try{

        $iduser = $json->iduser;
        $search = $json->search;
        $datesearch = date('d/m/Y H:i');
        
        $recent = new Recents();

        $recent->setIdUser($iduser);
        $recent->setSearch($search);
        $recent->setDateSearch($datesearch);
          
        if($this->recentsDao->create($recent)){
          $this->erro->setMessage("Sucess!");
          echo json_encode($this->erro);
          die();
        }else{
			    $this->erro->setMessage("Erro!");
          echo json_encode($this->erro);
          die();
        }
      }catch(Exception $e){
        return $e->getMessage();
      }
  }

  public function readAction($iduser){
    try{
      
      $recents = array('recents' => $this->recentsDao->read($iduser->iduser),);

      echo json_encode($recents);

    }catch(Exception $e){
      return $e->getMessage();
    }
  }

  public function deleteAction($id){

    if($this->recentsDao->delete($id->id)){
      $this->erro->setMessage("Removido!");
          echo json_encode($this->erro);
    }else{
      $this->erro->setMessage("Falha ao Remover, Tente Novamente!");
          echo json_encode($this->erro);
    }
  }
}