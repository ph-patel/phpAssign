
<?php

try {
    require('header.php');
    require('auth.php');
    //assign the varible to store the value from the form
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $cost = $_POST['cost'];
    $swimming = $_POST['swimming'];
    $resortId = $_POST['resortId'];
    $logo = null;

    //Serverside validation
    $OK = true;

    //validation from server side
    if (empty($name)) {
        echo "Name is required. <br />";
        $OK = false;
    }
    if (empty($address)) {
        echo "Address is required <br />";
        $OK = false;
    }
    if (empty($phone)) {
        echo "Phone is required <br />";
        $OK = false;
    }
    if (empty($location)) {
        echo "Location is required <br />";
        $OK = false;
    }
    if (empty($cost)) {
        echo "cost is required <br />";
        $OK = false;
    }
    // check and validate logo upload
    if (isset($_FILES['logo'])) {
        $logoFile = $_FILES['logo'];

        if ($logoFile['size'] > 0) {
            // generate unique file name
            $logo = session_id() . "-" . $logoFile['name'];

            // check file type
            $fileType = null;
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $fileType = finfo_file($finfo, $logoFile['tmp_name']);

            // allow only jpeg & png
            if (($fileType != "image/jpeg") && ($fileType != "image/png")) {
                echo 'Please upload a valid JPG or PNG logo<br />';
                $OK = false;
            } else {
                // save the file
                move_uploaded_file($logoFile['tmp_name'], "img/{$logo}");
            }
        }
    }

    if ($OK == true) {

        //connect to the database
        require('db.php');

        //setup and execute the insert command
        if (empty($resortId)) {
            $sql = "INSERT INTO demo_for_assignment1 (name, address, phone, location , cost, swimming , logo) 
            VALUES (:name, :address, :phone, :location , :cost, :swimming , :logo)";
        } else {
            $sql = "UPDATE demo_for_assignment1 SET name = :name , address  = :address , location = :location , 
            cost = :cost , phone = :phone , swimming = :swimming , logo = :logo WHERE resortId = :resortId";
        }

        $cmd = $db->prepare($sql);
        $cmd->bindParam(':name', $name, PDO::PARAM_STR, 25);
        $cmd->bindParam(':address', $address, PDO::PARAM_STR, 50);
        $cmd->bindParam(':phone', $phone, PDO::PARAM_STR, 15);
        $cmd->bindParam(':location', $location, PDO::PARAM_STR, 20);
        $cmd->bindParam(':cost', $cost, PDO::PARAM_INT, 5);
        $cmd->bindParam(':swimming', $swimming, PDO::PARAM_STR, 20);
        $cmd->bindParam(':logo', $logo, PDO::PARAM_STR, 100);


        if (!empty($resortId)) {
            $cmd->bindParam(':resortId', $resortId, PDO::PARAM_INT);
        }
        $cmd->execute();

        //disconnect
        $db = null;
        header('location:resorts.php');
    }
}
catch (Exception $e){
    mail('priyeshhingrajia2601@gmail.com','Error From Privago', $e);
    header('location:error.php');
}
?>




 <div class="container">
     <a href="resorts.php" class="btn btn-lg btn-info">View all resorts</a>
 </div>

</body>
</html>
