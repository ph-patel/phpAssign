<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Names</title>
</head>
<body>

<?php
// connect to db
$sql = new PDO('mysql:host=localhost;dbname=learn_with_rich','root' , '');

// write an sql query to select the album titles
$sql =" SELECT name FROM restaurants";

// execute the query and store the results
$cmd->execute();
$restaurents = $cmd->fetchAll();

// loop through the data - $album is the current item in the list of $albums
//disconnect
 ?>
</body>
</html>
