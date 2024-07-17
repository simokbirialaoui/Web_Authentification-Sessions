<?php
 session_start() ;
 
 require_once("Database.php");
 require_once("add.php");

$database = new Database ;



if(!isset($_SESSION['userID'])){
    header('Location: login.php') ;
}else {
    $id = $_SESSION['userID'] ;
    $current_user = array("id"=>'', 'email'=>'', 'password'=> '','role'=>'') ;
    $db = new Database ;
    $sql = 'SELECT * FROM users WHERE id = ? ' ;
    $stmt = $db->query($sql,array($id)) ;
    if($stmt->rowCount() == 1){
        while($row = $stmt->fetch()){
            $current_user['id'] = $row['id'] ;
            $current_user['email'] = $row['email'] ;
            $current_user['password'] = $row['password'] ;
            $current_user['role'] = $row['role'] ;
        }
     }
     $hasPrivilege = in_array($current_user['role'],array('admin', 'author', 'editor'));
     $users = [] ;
     if($hasPrivilege){
            $sql = "SELECT * from users";
            $stmt = $database->query($sql);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/cerulean/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
<?php include 'nav_bar.php' ?>
    <div class="container mt-5">
        <?php if($hasPrivilege) : ?>
        <h1>User Manager</h1>
        <form action="<?php echo $_SERVER["PHP_SELF"]?>"  method="post">

        <div class="form-group mb-3">
            <input type="email" name="email" placeholder="Email" class="form-control" id="">
            <small id="emailHelp" class="form-text text-danger"><?php echo $errors['email'] ?? '' ?></small>
        </div>

        <div class="form-group mb-3">    
            <input type="password" name="password" placeholder="Password" class="form-control" id="">
            <small id="emailHelp" class="form-text text-danger"><?php echo $errors['password'] ?? '' ?></small>
        </div>

            <select name="role" class="form-select" id="">
                <option value="admin">Admin</option>
                <option value="author">author</option>
                <option value="editor">Editor</option>
                <option value="guest">Guest</option>
            </select>
            <button class="btn btn-outline-primary mb-4 d-block w-100 mt-5">Envoyer</button>
        </form>
        <?php endif ?>
        <table class="table table-stripped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>MAIL</th>
                    <th>PASSWORD</th>
                    <th>ROLE</th>
                    <th ></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php if($hasPrivilege) : ?>
                <?php foreach ($users as $user): ?>
                    <tr >
                        <td class="text-center">
                            <?= $user['id'] ?>
                        </td>
                        <td>
                            <?= $user['email'] ?>
                        </td>
                        <td>
                            <?= $user['password'] ?>
                        </td>
                        <td>
                            <?= $user['role'] ?>
                        </td>
                        <?php if($current_user['role'] == 'admin' || ($current_user['id'] == $user['id'])): ?>
                        <td class="text-center">
                            <a onclick="valider(event)" href="del.php?id=<?php echo $user['id'] ?>"
                                class="btn btn-outline-danger text-center"><i class="bi bi-trash"></i></a>
                        </td>
                        <td class="text-center">
                            <a  href="edit.php?id=<?php echo $user['id'] ?>"
                                class="btn btn-outline-primary text-center"><i class="bi bi-pencil"></i></a>
                        </td>
                        <?php endif ?>
                    </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr >
                        <td class="text-center">
                            <?=  $current_user['id'] ?>
                        </td>
                        <td>
                            <?=  $current_user['email'] ?>
                        </td>
                        <td>
                            <?=  $current_user['password'] ?>
                        </td>
                        <td>
                            <?=  $current_user['role'] ?>
                        </td>
                       
                        <td class="text-center">
                            <a href="del.php?id=<?php echo $current_user['id'] ?>"
                                class="btn btn-outline-danger text-center"><i class="bi bi-trash"></i></a>
                        </td>
                        <td class="text-center">
                            <a  href="edit.php?id=<?php echo $current_user['id'] ?>"
                                class="btn btn-outline-primary text-center"><i class="bi bi-pencil"></i></a>
                        </td>
            
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>

    <script>

    </script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

</html>