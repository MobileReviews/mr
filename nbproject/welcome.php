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
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); if($_SESSION["admin"] == "true") echo '<p>You are ADMIN</p>'; ?></b>. Welcome to our site.</h1>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    
    
    <?php
    $sql = "SELECT * FROM brands";
    $result = mysqli_query($link, $sql);
 //   echo '<div style="width: 80%;  margin:0 auto; text-align: center">';
    while($row = mysqli_fetch_assoc($result)) {
        $idBrand = $row['id'];
        $nameBrand = $row['brand_name'];
//        echo '<div class="paveiksliukai" style="margin: 10px">';
//        echo '<img  src="data:image/jpeg;base64,'.base64_encode( $row['paveiksliukas'] ).'" class="image" />';
//        echo '  <div class="middle"><div class="text">'.$namer.'</div></div>';
        echo $nameBrand;
        echo '<a href="models.php?id='.$idBrand.'"  style="text-decoration:none;" class="btn btn-primary btn-block btn-large" >Read More</a>';
//        echo '</div>';
    }
//    echo '</div>';
    ?>
    
    
    
</body>
</html>