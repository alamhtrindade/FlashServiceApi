<?php

require_once('../../../Model/RatingDao.php');
require_once('../../../Model/Rating.php');
require_once('../../../Model/Erro.php');

header("Content-Type:application/json");

class RatingController{
  
  public $ratingDao;
  public $erro;

  public function __construct(){
    $this->ratingDao = new RatingDao();
    $this->erro = new Erro();
  }

  public function createAction($json){
      try{

        $iduser = $json->iduser;
        $idprovider = $json->idprovider;
        $stars = $json->stars;
        $title = $json->title;
        $description = $json->description;
         
        if(empty($stars)){
          $this->erro->setMessage("Avalie com Estrelas!");
          echo json_encode($this->erro);
          die();
        }
          
        if(empty($title)){
          $this->erro->setMessage("Título é Obrigatório!");
          echo json_encode($this->erro);
          die();
        }
        
        $rating = new Rating();

        $rating->setIdUser($iduser);
        $rating->setIdProvider($idprovider);
        $rating->setStars($stars);
        $rating->setTitle($title);
        $rating->setDescription($description);
          
        if($this->ratingDao->create($rating)){
          $this->erro->setMessage("Obrigado pela sua Avaliação!");
          echo json_encode($this->erro);
        }else{
			    $this->erro->setMessage("Ocorreu um Erro, Tente Novamente!");
          echo json_encode($this->erro);
          die();
        }
      }catch(Exception $e){
        return $e->getMessage();
      }
  }

  public function readAction($id){
    try{
      
      $rating = array('rating' => $this->ratingDao->read($id->id),);

      echo json_encode($rating);

    }catch(Exception $e){
      return $e->getMessage();
    }
  }

  public function getAllAction($id){
    try{
      
      $ratings = array('ratings' => $this->ratingDao->getAll($id->id),);

      echo json_encode($ratings);

    }catch(Exception $e){
      return $e->getMessage();
    }
  }

  public function updateAction($json){
    try{

      $id = $json->id;
      $stars = $json->stars;
      $title = $json->title;
      $description = $json->description;
      
      $rating = new Rating();
            
      $rating->setId($id);
      $rating->setStars($stars);
      $rating->setTitle($title);
      $rating->setDescription($description);
      
      if($this->ratingDao->update($rating)){
        
        $erro = new Erro();
        $this->erro->setMessage("Obrigado por Atualizar sua Avaliação!");
        echo json_encode($this->erro);
              
      }else{
        
        $this->erro->setMessage("Ocorreu um Erro Durante a Atualização, Tente Novamente!");
        echo json_encode($this->erro);
      
      }
	    	
	  }catch(Exception $e){
        
      $this->erro->setMessage("Ocorreu um Erro Inesperado, Tente Novamente!");
      echo json_encode($this->erro);

    }
  }

  public function deleteAction($id){

    if($this->ratingDao->delete($id->id)){
      $this->erro->setMessage("Sua Avaliação foi Removida!");
          echo json_encode($this->erro);
    }else{
      $this->erro->setMessage("Falha ao Remover, Tente Novamente!");
          echo json_encode($this->erro);
    }
  }
}