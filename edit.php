<?php
 session_start() ;
require_once("Database.php");
require_once("user.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $user = User::get_user($id);

}else{
    header('location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php?</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/cerulean/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
<?php include 'nav_bar.php' ?>
    <div class="container">
        <h1>User Manager</h1>
        <form  action="save.php"  method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="form-group mb-3">
            <input type="email" name="email" placeholder="Email" class="form-control mb-3" id="" value="<?= $user['email'] ?>">
            <small id="emailHelp" class="form-text text-danger"><?php echo $errors['email'] ?? '' ?></small>
            </div>
            <div class="form-group mb-3">
            <input type="password" name="password" placeholder="Password" class="form-control mb-3" id="">
            <small class="form-text text-danger"><?php echo $errors['password'] ?? '' ?></small>
            </div>
            <select name="role" class="form-select mb-3" id="">
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="author"  <?= $user['role'] === 'author' ? 'selected' : '' ?>>author</option>
                <option value="editor"  <?= $user['role'] === 'editor' ? 'selected' : '' ?>>Editor</option>
                <option value="guest"  <?= $user['role'] === 'guest' ? 'selected' : '' ?>>Guest</option>
            </select>
            <button class="btn btn-outline-primary mt-4 d-block w-100">Envoyer</button>
        </form>
    </div>
</body>
</html>