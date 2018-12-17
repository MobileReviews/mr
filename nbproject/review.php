<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
require_once "config.php";
echo "<h1>Review</h1>";

    $submited_id = $_GET['id'];
    $sql = "SELECT * FROM reviews WHERE model_id = ".$submited_id.";";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $idReview = $row['id'];
        $review = $row['review'];
        echo $review;
      
    }
    ?>
</body>
</html>