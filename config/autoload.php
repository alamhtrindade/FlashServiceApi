<?php

function __autoload($className){
    
  if(file_exists('common-class/'. $className . '.php'))
      require_once('common-class/'. $className . '.php');

  if(file_exists('src/Controller/'. $className . '.php'))
      require_once('src/Controller/'. $className . '.php');

  if(file_exists('src/Model/'. $className . '.php'))
      require_once('src/Model/'. $className . '.php');

}