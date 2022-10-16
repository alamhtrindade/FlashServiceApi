<?php

require_once('../../../Model/FavoritesDao.php');
require_once('../../../Model/Favorites.php');
require_once('../../../Model/Erro.php');

header("Content-Type:application/json");

class FavoritesController{
  
  public $favoritesDao;
  public $erro;

  public function __construct(){
    $this->favoritesDao = new FavoritesDao();
    $this->erro = new Erro();
  }

  public function createAction($json){
      try{
        $iduser = $json->iduser;
        $idprovider = $json->idprovider;
        
        if(empty($iduser)){
          $this->erro->setMessage("Usuário em Branco!");
          echo json_encode($this->erro);
          return;
        }
        if(empty($idprovider)){
          $this->erro->setMessage("Prestador de Serviço em Branco!");
          echo json_encode($this->erro);
          return;
        }

        if($this->favoritesDao->verificaFavorito($iduser,$idprovider)==true){
          $this->erro->setMessage("Erro: Já Favoritado!");
          echo json_encode($this->erro);
          return;
        }

        $favorites = new Favorites();

        $favorites->setIdUser($iduser);
        $favorites->setIdProvider($idprovider);

        if($this->favoritesDao->create($favorites)){
          $this->erro->setMessage("Favoritado!");
          echo json_encode($this->erro);
        }else{
			    $this->erro->setMessage("Ocorreu um Erro, Tente Novamente!");
          echo json_encode($this->erro);
        }
      }catch(Exception $e){
        return $e->getMessage();
      }
  }

  public function readAction($iduser){
    try{
      
      $favorites = array('favorites' => $this->favoritesDao->read($iduser->iduser),);

      echo json_encode($favorites);

    }catch(Exception $e){
      return $e->getMessage();
    }
  }

  public function deleteAction($id){

    if($this->favoritesDao->delete($id->id)){
      $this->erro->setMessage("Removido!");
          echo json_encode($this->erro);
    }else{
      $this->erro->setMessage("Falha ao Remover, Tente Novamente!");
          echo json_encode($this->erro);
    }
  }
}