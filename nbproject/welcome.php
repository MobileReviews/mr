<?php
require_once "config.php";
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home page</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php 
    include ("navigation.php");
    
    echo "<div class='row'>";
    echo "<h2 class='welcometitle'>Pick a brand</h2>";
    echo "</div>";

    $sql = "SELECT * FROM brands";
    $result = mysqli_query($link, $sql);
    
    $index = 3;
    $index2 = 1;
    while($row = mysqli_fetch_assoc($result)) {
        $idBrand = $row['id'];
        $nameBrand = $row['brand_name'];
        $image = $row['image'];
        
        if($index % 3 == 0){
           echo "<div class='row'>";
           $rowIsClosed = false;
        }
        else {
            $index2++;
        }
        
        echo "<div class='col-4'>";
            echo "<div class='imagebox'>";
                echo "<img class = 'brandsLogo' src='$image'>";
                    echo "<div class='overlay'>";
                        echo '<a href="models.php?id='.$idBrand.'&brandName='.urlencode($nameBrand).'" class="text">'.$nameBrand.'</a>';
                    echo "</div>";
            echo "</div>";
        echo "</div>";
        
        $index++;

        if($index2 % 3 == 0){
            echo "</div>";
            $index2 = 1;
            $rowIsClosed = true;
        } 
    }
    if(!$rowIsClosed)
     echo "</div>";
    ?>
    
    <?php $footer = include_once "footer.php";
      echo $footer;?>
  
</body>
</html>