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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php $navigation = include_once "navigation.php";
      echo $navigation;?>
    <?php
    $sql = "SELECT * FROM brands";
    $result = mysqli_query($link, $sql);
 //   echo '<div style="width: 80%;  margin:0 auto; text-align: center">';
    while($row = mysqli_fetch_assoc($result)) {
        $idBrand = $row['id'];
        $nameBrand = $row['brand_name'];
        $image = $row['image'];
//        echo '<div class="paveiksliukai" style="margin: 10px">';
//        echo '<img  src="data:image/jpeg;base64,'.base64_encode( $row['paveiksliukas'] ).'" class="image" />';
//        echo '  <div class="middle"><div class="text">'.$namer.'</div></div>';
        echo "<div class='col-sm-4'>";
            echo "<div class='imagebox'>";
                echo "<img class = 'brandsLogo' src='$image'>";
                    echo "<div class='overlay'>";
                        echo '<a href="models.php?id='.$idBrand.'&brandName='.urlencode($nameBrand).'" class="text" style="text-decoration:none;" >'.$nameBrand.'</a>';
                    echo "</div>";
//        echo '<a href="models.php?id='.$idBrand.'" class="btn btn-primary btn-block btn-large buttons" >Read More</a>';
                   
            echo "</div>";
        echo "</div>";


//        echo '</div>';
    }
//    echo '</div>';
    ?>
    
    
    
</body>
</html>