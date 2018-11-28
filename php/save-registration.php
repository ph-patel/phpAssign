<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving the users</title>
</head>
<body>
<?php
try {

    //storing the data from register.php
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    $ok = true ;


    //validate inputs

    if (empty($username)) {
          echo 'Username is required <br />' ;
          $ok = false ;
      }
    if (strlen($password) < 8 ) {
          echo 'Password is invalid <br />' ;
          $ok = false ;
      }
      if ($password != $confirm) {
          echo 'Passwords does not match <br />' ;
          $ok = false ;
      }

    if ($ok) {

        // hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // connect
        require('db.php');

        // set up & execute the insert
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->bindParam(':password', $hashedPassword, PDO::PARAM_STR, 255);
        $cmd->execute();

        // disconnect
        $db = null;

        //redirect
        header('location:login.php') ;
    }
}
catch (Exception $e){
    mail('priyeshhingrajia2601@gmail.com','Error From Privago', $e);
    header('location:error.php');
}

 ?>
</body>
</html>
