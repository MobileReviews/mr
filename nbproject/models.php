<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
session_start();
require_once "config.php";
    $submited_id = $_GET['id'];
    $submited_branName = $_GET['brandName'];

echo "<h1>$submited_branName Models</h1>";


    $sql = "SELECT * FROM models WHERE brand_id = ".$submited_id.";";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $idModel = $row['id'];
        $nameModel = $row['model_name'];
        echo $nameModel;
        echo '<a href="review.php?id='.$idModel.'" class="btn btn-primary btn-block btn-large buttons" >Read Review</a>';
    }
    ?>
</body>
</html>