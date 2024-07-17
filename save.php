<?php

require_once("Database.php") ;
require_once('user_validator.php');
require_once('user.php') ;


if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $user = new User($_POST);
        $user->update($id) ;
    
}

?>