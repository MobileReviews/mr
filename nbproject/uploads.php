<?php
require_once "config.php";
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true
            || $_SESSION["admin"] !== "true"){
    header("location: welcome.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php 

 $navigation = include_once "navigation.php";
  echo $navigation;
?>
    
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload" required="required">
    <input type="text" name="brand" id="brandName" required="required" placeholder="Name of a brand">
    <input type="submit" value="Upload brand" name="submit">
</form>

</body>
</html>