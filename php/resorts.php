<?php
$title = 'Resorts' ;
require('header.php');
?>


<div class="page-header">
    <h1>  Privago Resorts <small>Pick from the World Class Resorts</small></h1>
</div>
 <?php

 if (isset($_SESSION['userId'])) {
     echo '<a class="btn btn-warning" href="resort-form.php">Add Resort</a> <br/>' ;

 }

 try {
//connect to the database
     require('db.php');


     //setup and execute the query
     $sql = "SELECT * FROM demo_for_assignment1";
     $cmd = $db->prepare($sql);

//store the data
     $cmd->execute();
     $resort = $cmd->fetchAll();

//create table
     echo '<table class="table table-striped table-bordered table-responsive"><thead><th>Id.</th><th>Name</th><th>Logo</th><th>Address</th><th>Phone</th> <th>Location</th><th>Cost(in CAD per night)</th><th>Swimming pool</th>';


     if (isset($_SESSION['userId'])) {
         echo '<th>Actions</th>';
     }
     echo '</thead> <tbody>';

//loop through the data
     foreach ($resort as $r) {
         echo "<tr class=\"success\"><td>" . $r['resortId'] . "</td>
    <td>" . $r['name'] . "</td>" ;
         if (isset($r['logo'])) {
             echo "<td>" . "<img src=\"img/{$r['logo']}\" alt=\"Logo\" height=\"50px\" ></td>";
         }
    echo "<td>{$r['address']}</td>
    <td>{$r['phone']}</td>
    <td>{$r['location']}</td>
    <td>{$r['cost']}</td>
    <td>{$r['swimming']}</td>";

         if (isset($_SESSION['userId'])) {
             echo "<td><a  class=\"btn btn-danger confirmation\" href=\"delete-resort.php?resortId={$r['resortId']}\">Delete</a>
                  <a  class=\"btn btn-success\" href=\"resort-form.php?resortId={$r['resortId']}\">Edit</a></td>";

         }


         echo "</tr>";

     }

//close the table
     echo '</tbody></table>';

//disconnect
     $db = null;

 } catch (Exception  $e) {
     //sends email
     mail('priyeshhingrajia2601@gmail.com' , 'Privago Resorts Error' , $e);
     // show eror page
     header('location:error.php');
 }
 ?>











 <script
        src="http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
 </script>
<script src="js/scripts.js"></script>


</body>
</html>
