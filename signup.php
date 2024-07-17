<?php
 require_once("Database.php") ;
 require_once('user_validator.php');
 require_once('user.php') ;

$errors = [];

if(isset($_POST['submit'])){
    // validate entries
    // session_start() ;
    $validation = new UserValidator($_POST);
    $errors = $validation->validateForm();
    
    // if errors is empty --> save data to db
    if(count($errors) == 0){
        $data = $validation->getData();
        $user = new User($data);
        $user->signUp() ;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./styles/signup.css">
    <link rel="stylesheet" href="https://bootswatch.com/5/cerulean/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    
</head>
<body>
    <?php include 'nav_bar.php' ?>
    <div class="container">
    <div class="left-column">
        <img src="./images/signup.svg" alt="Login">
    </div>
    <div class="right-column">
        <form action="<?php echo $_SERVER["PHP_SELF"]?>"  method="POST" class="signUpForm" autocomplete="off" >
            <h1>Créer Votre Compte</h1>
            <div class="form-group w-75">
                <input type="text" id="email" class="form-control"  name="email" placeholder="Email" value="<?php 
                 echo $_POST['email'] ?? '' ?>" >
                <label for="email"><i class="fas fa-envelope"></i></label>
                <small id="emailHelp" class="form-text text-danger"><?php echo $errors['email'] ?? '' ?></small>
            </div>
            <div class="form-group  w-75">
          
                <input type="password" id="password-1" class="form-control "  name="password" placeholder='Mot de passe' value="<?php echo $_POST['password'] ?? '' ?>">
                <label for="password-1"><i class="fas fa-lock"></i></label>
                <small id="emailHelp" class="form-text text-danger"><?php echo $errors['password'] ?? '' ?></small>
      
            </div>
            <div class="form-group  w-75">
          
            <select name="role" class="form-select mb-3" id="">
                <option value="admin">Admin</option>
                <option value="author">author</option>
                <option value="editor">Editor</option>
                <option value="guest" selected>Guest</option>
            </select>
            </div>
            <div class="form-group  w-75">
            <button class="btn w-100" type="submit" name="submit">S'inscrire</button>
            </div>
            <p>Vous avez déjà un compte? <a href="login.php">connexion</a></p>
        </form>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" ></script>
</body>
</html>