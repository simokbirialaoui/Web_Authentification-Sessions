<?php
 session_start() ;
require_once("Database.php");
require_once('user.php') ;
$current_user_id = $_SESSION['userID'];



if(isset($_GET['id'])){
    $id = $_GET['id'];
    $user = User::delete_user($current_user_id , $id);

}else{
    header('location: index.php');
}

?>