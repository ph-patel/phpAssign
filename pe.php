<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
$name = $_POST['name'];
echo "$name";

//connect to the database
$db = new PDO('mysql:host=localhost:80;learn_with_rich', 'root', '');
?>
</body>
</html>
