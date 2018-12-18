<?php
require_once "config.php";
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php $navigation = include_once "navigation.php";
      echo $navigation;?>
    <?php
    
    echo "<div class='row'>";
    echo "<h2 class='welcometitle'>Mobile phone brands</h2>";
    echo "</div>";

    $sql = "SELECT * FROM brands";
    $result = mysqli_query($link, $sql);
 //   echo '<div style="width: 80%;  margin:0 auto; text-align: center">';
    $index = 3;
    $index2 = 1;
    while($row = mysqli_fetch_assoc($result)) {
        $idBrand = $row['id'];
        $nameBrand = $row['brand_name'];
        $image = $row['image'];
        
//        echo '<div class="paveiksliukai" style="margin: 10px">';
//        echo '<img  src="data:image/jpeg;base64,'.base64_encode( $row['paveiksliukas'] ).'" class="image" />';
//        echo '  <div class="middle"><div class="text">'.$namer.'</div></div>';

        if($index % 3 == 0){
           echo "<div class='row'>";
        }
        else {
            $index2++;
        }
        
        echo "<div class='col-sm-4'>";
            echo "<div class='imagebox'>";
                echo "<img class = 'brandsLogo' src='$image'>";
                    echo "<div class='overlay'>";
                        echo '<a href="models.php?id='.$idBrand.'&brandName='.urlencode($nameBrand).'" class="text">'.$nameBrand.'</a>';
                    echo "</div>";
//        echo '<a href="models.php?id='.$idBrand.'" class="btn btn-primary btn-block btn-large buttons" >Read More</a>';
                   
            echo "</div>";
        echo "</div>";
        
        $index++;

        if($index2 % 3 == 0){
            echo "</div>";
            $index2 = 1;
        }
//        echo '</div>';
    }
//    echo '</div>';
    ?>
    
    <?php $footer = include_once "footer.php";
      echo $footer;?>
    
</body>
</html>