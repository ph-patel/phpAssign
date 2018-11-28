<?php

try {
    $title = 'Resort Details' ;
    require('header.php');
    require('auth.php') ;

    //intialising variable
    $name = null;
    $address =null;
    $phone = null;
    $location = null;
    $cost = null;
    $swimming = null;
    $logo= null ;

    if (!empty($_GET['resortId'])) {

                $resortId = $_GET['resortId'];

        //connect
            require('db.php');

        //set up and execute query
            $sql = "SELECT * FROM demo_for_assignment1 WHERE resortId = :resortId";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':resortId', $resortId, PDO::PARAM_INT);
            $cmd->execute();
            $r = $cmd->fetch();


        //store variabbles
            $name = $r['name'];
            $address = $r['address'];
            $phone = $r['phone'];
            $location = $r['location'];
            $cost = $r['cost'];
            $swimming = $r['swimming'];
            $logo = $r['logo'];

        //disconnect
            $db = null;

    }
}
catch (Exception $e){
    mail('priyeshhingrajia2601@gmail.com','Error From Privago', $e);
    header('location:error.php');
}
?>

<div class="container">
    <div class="page-header">
        <h1>  Privago Resorts <small>Add a Wonderfull Resort Here !!</small></h1>
    </div>
</div>


<div class="container">
        <form method="post" action="save-resort.php" enctype="multipart/form-data">
            <div class="form-group">

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="name" type="text" class="form-control input-lg" name="name" placeholder="Name" value="<?php echo $name ;?>" required>
                    </div>



                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                    <input id="address" type="text" class="form-control input-lg" name="address" value="<?php echo $address ;?>" placeholder="Address" required>
                </div>

                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                    <input id="phone" type="tel" class="form-control input-lg" name="phone" value="<?php echo $phone ;?>" placeholder="Phone" required>
                </div>

                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-screenshot"></i></span>
                    <input id="location" type="text" class="form-control input-lg" name="location" value="<?php echo $location ;?>" placeholder="Province" required>
                </div>

                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                    <input id="cost" type="number" class="form-control input-lg" name="cost" value="<?php echo $cost ;?>" placeholder="Cost( per night in CAD)" required>
                </div>

                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-camera"></i></span>
                    <input id="logo" type="file" class="form-control input-lg" name="logo" >
                </div>
                    <div class="col-md-offset-1">
                        <?php
                        if (isset($logo)) {
                            echo "<img src=\"img/$logo\" alt=\"Logo\"  height=\"100px\" />";
                        }
                        ?>
                    </div>


                    <!--  Dropdown menu-->
                    <fieldset >
                        <label for="swimming" class="col-md-2">Is Swimming poll available : </label>
                        <select name="swimming" id="swimming">

                            <?php
                            //connect to DB
                            require('db.php');


                            //set up query
                            $sql = "SELECT * FROM swimming";

                            //execute and store in variable
                            $cmd = $db->prepare($sql);
                            $cmd->execute();
                            $swimming = $cmd->fetchAll();

                            //loop and print data
                            foreach($swimming as $s){
                                if($s['swimmingpool'] == $swimmingpool) {
                                    echo'<option selected>'. $s['swimmingpool'] .'</option>';
                                } else {
                                    echo'<option>'. $s['swimmingpool'] .'</option>';
                                }

                            }
                            ?>
                        </select>
                    </fieldset>
                <button class="btn btn-warning btn-lg">Add Resort</button>
                <input type="hidden" name="resortId" id="resortId" value="<?php echo $resortId ; ?>"
            </div>
        </form>
</div>


</body>
</html>
