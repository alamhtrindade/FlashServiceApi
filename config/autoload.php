<?php

function my_autoload($className){
  if(file_exists('common-class/'. $className . '.php'))
      require_once('common-class/'. $className . '.php');

  if(file_exists('src/Controller/'. $className . '.php'))
      require_once('src/Controller/'. $className . '.php');

  if(file_exists('src/Model/'. $className . '.php'))
      require_once('src/Model/'. $className . '.php');


    //login    
    if(file_exists('src/Routes/login/index.php'))
        require_once('src/Routes/login/index.php');

    //favorits    
    if(file_exists('src/Routes/favorits/create/index.php'))
        require_once('src/Routes/favorits/create/index.php');

    if(file_exists('src/Routes/favorits/read/index.php'))
        require_once('src/Routes/favorits/read/index.php');

    if(file_exists('src/Routes/favorits/update/index.php'))
        require_once('src/Routes/favorits/update/index.php');

    if(file_exists('src/Routes/favorits/delete/index.php'))
        require_once('src/Routes/favorits/delete/index.php');

    //provider
    if(file_exists('src/Routes/provider/create/index.php'))
        require_once('src/Routes/provider/create/index.php');

    if(file_exists('src/Routes/provider/read/index.php'))
        require_once('src/Routes/provider/read/index.php');

    if(file_exists('src/Routes/provider/update/index.php'))
        require_once('src/Routes/provider/update/index.php');

    if(file_exists('src/Routes/provider/delete/index.php'))
        require_once('src/Routes/provider/delete/index.php');

    //recents
    if(file_exists('src/Routes/recents/create/index.php'))
        require_once('src/Routes/recents/create/index.php');

    if(file_exists('src/Routes/recents/read/index.php'))
        require_once('src/Routes/recents/read/index.php');

    if(file_exists('src/Routes/recents/update/index.php'))
        require_once('src/Routes/recents/update/index.php');

    if(file_exists('src/Routes/recents/delete/index.php'))
        require_once('src/Routes/recents/delete/index.php');

    //user
    if(file_exists('src/Routes/user/create/index.php'))
        require_once('src/Routes/user/create/index.php');

    if(file_exists('src/Routes/user/read/index.php'))
        require_once('src/Routes/user/read/index.php');

    if(file_exists('src/Routes/user/update/index.php'))
        require_once('src/Routes/user/update/index.php');

    if(file_exists('src/Routes/user/delete/index.php'))
        require_once('src/Routes/user/delete/index.php');

    
    spl_autoload_register("my_autoload");
}

