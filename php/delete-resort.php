<?php
try {


    require('header.php');
    require('auth.php');
    // get the id
    $resortId = $_GET['resortId'];

    if(empty($resortId)) {
        header('location:resorts.php');
    }

    //connect
    require('db.php');


    //setup and run query
    $sql = "DELETE FROM demo_for_assignment1 WHERE resortId = :resortId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':resortId', $resortId, PDO::PARAM_INT);
    $cmd->execute();

    //disconnect
    $db = null ;

    //redirect the page
    header('location:resorts.php');
}
catch (Exception $e){
    mail('priyeshhingrajia2601@gmail.com','Error From Privago', $e);
    header('location:error.php');
}
 ?>
</body>
</html>
