<?php 
    session_start() ;
    require_once("Database.php");

    require_once('user.php') ;

    $token = password_hash("protect-this-website",PASSWORD_DEFAULT);
    $_SESSION['token'] = $token ;
    $errors = ['email'=>'','password'=>''] ;
    $main_token = password_hash($_SESSION['token'],PASSWORD_DEFAULT); 
    
    if(isset($_POST["email"]) && isset($_POST["password"]) ){
        
        if(isset($_POST["token"]) == $main_token){
            $email = User::clean($_POST['email']) ;
            $password = User::clean($_POST['password']) ;
            User::login($email,$password);
            
        }
        else{
            die("Invalid Token") ;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://bootswatch.com/5/cerulean/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>
<body>
<?php include 'nav_bar.php' ?>
    <div class="container">
        <div class="left-column">
            <img src="./images/login.svg" alt="Login">
        </div>
        <div class="right-column">
            <form action="<?php echo $_SERVER["PHP_SELF"]?>"  method="POST" class="loginForm" autocomplete="off" >
                <h1>Connexion</h1>
                <?php if(User::$error != ""):?>
                    <span class='error'><?php echo User::$error ?></span>
                <?php endif; ?>
                <span>
                    <input type="text" id="email"  name="email" placeholder="Email" value="<?php 
                    echo $_POST['email'] ?? '' ?>">
                    <input type="hidden" name="token" id="token" value='<?php echo $main_token; ?>'>
                    <label for="email"><i class="fas fa-envelope"></i></label>
                </span>
                <span>
                    <input type="password" id="password" name="password" placeholder='Mot de passe' value="<?php echo $_POST['password'] ?? '' ?>">
                    <label for="password"><i class="fas fa-lock"></i></label>
                </span>
                <button class="btn" type="submit" name="submit">Connexion</button>
                <p>Vous avez un compte? <a href="signup.php"> s'inscrire</a></p>
            </form>
        </div>
    </div>

</body>
</html>