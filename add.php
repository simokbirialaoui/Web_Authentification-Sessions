<?php
 require_once("Database.php") ;
 require_once('user_validator.php');
 require_once('user.php') ;

$errors = [];

if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])){
    // validate entries
    // session_start() ;
    $validation = new UserValidator($_POST);
    $errors = $validation->validateForm();
    
    // if errors is empty --> save data to db
    if(count($errors) == 0){
        $data = $validation->getData();
        $user = new User($data);
        $user->add() ;
    }
}

?>