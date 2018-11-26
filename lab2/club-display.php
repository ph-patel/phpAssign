<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Privago Resorts</title>
    <!-- Bootstrap 3-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>



<div class="page-header">
    <h1> Welcome to Lab 2<small> Priyesh Hingrajia - 200397594</small></h1>
</div>
<?php
//connect to the database
$db = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200397594', 'gc200397594','i0Pntn7CEF');

//setup and execute the query
$sql = "SELECT * FROM clubs";
$cmd = $db->prepare($sql);

//store the data
$cmd->execute();
$cluby = $cmd->fetchAll();

//create table
echo'<table class="table table-striped table-bordered table-responsive"><thead><th>Club Id.</th><th>Club Name</th><th>Ground</th><th>Actions</th></thead> <tbody>';

//loop through the data
foreach ($cluby as $c) {
    echo "<tr class=\"success\"><td>".$c['club_id'].
        "</td><td>".$c['club_name'].
        "</td><td>".$c['ground'].
        "</td><td>" . '<a class="btn btn-danger" href="delete-club.php?club_Id='. $c['club_id'] . ' " >Delete</a>' ."  ".'<a  class="btn btn-warning" href="#">Edit</a>'.
        "</td></tr>";
}

//close the table
echo '</tbody></table>';

//disconnect
$db = null;

//closing php tag
?>


<script
        src="http://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
        crossorigin="anonymous">
</script>

</body>
</html>
