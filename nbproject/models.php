<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<!--Navigacija-->
    <?php $navigation = include_once "navigation.php";
      echo $navigation;?>
<!--**********-->

<?php
session_start();
require_once "config.php";
    $submited_id = $_GET['id'];
    $submited_branName = $_GET['brandName'];

    echo "<div class='row'>";
    echo "<h2>$submited_branName Models</h2>";
    echo "</div>";
    
    $sql = "SELECT * FROM models WHERE brand_id = ".$submited_id.";";
    $result = mysqli_query($link, $sql);
    
    echo "<div class = 'line'>";
    while($row = mysqli_fetch_assoc($result)) {
        $idModel = $row['id'];
        $nameModel = $row['model_name'];

            echo "<div class = 'column'>";
                echo "<div class = 'card'>";
                    echo "<img class='card-image' src='https://www.cellularishop.com/791-large_default/huawei-p20-black-brand-mono-sim.jpg' alt='Photo'>";
                    echo "<div class = 'cardbox'>";
                        echo "<h3>$nameModel</h3>";
                        echo "<p class='title'>CPU:</p>";
                        echo "<p>RAM:</p>";
                        echo "<p>Camera:</p>";
                        echo '<a href="review.php?id='.$idModel.'" class="button" >Read Review</a>';
                    echo "</div>";    
                echo "</div>";    
            echo "</div>";          
    }
    echo "</div>";
    ?>


</body>
    <?php $footer = include_once "footer.php";
      echo $footer;?>
</html>