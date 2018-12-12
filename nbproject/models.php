<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>

<?php
require_once "config.php";
echo "<h1>Models</h1>";

    $submited_id = $_GET['id'];
    $sql = "SELECT * FROM models WHERE brand_id = ".$submited_id.";";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $idModel = $row['id'];
        $nameModel = $row['model_name'];
        echo $nameModel;
        echo '<a href="review.php?id='.$idModel.'"  style="text-decoration:none;" class="btn btn-primary btn-block btn-large" >Read Review</a>';
    }
    ?>
</body>
</html>