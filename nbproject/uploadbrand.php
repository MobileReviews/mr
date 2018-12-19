<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">-->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body> 
<?php
  $navigation = include_once "navigation.php";
  echo $navigation;
require_once "config.php";
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true
            || $_SESSION["admin"] !== "true"){
    header("location: welcome.php");
    exit;
}


  
include 'imagevalidation.php';
if(isset($_POST["submit"])) {
    $directory = "brand_img/";
    $filePath = $directory . basename($_FILES["fileToUpload"]["name"]);
    if (!checkImage($_FILES["fileToUpload"],$directory)) {
        echo $_SESSION['uploadError'];
    } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filePath)) {
        $name = $_POST["brand"];
        $sql = "INSERT INTO brands (brand_name, image) VALUES ('$name', '$filePath')";
            if(mysqli_query($link, $sql)){
                header("Location: welcome.php");
            }
            else die("Error uploading brand: ". mysqli_error($link));
    } else {
        $_SESSION['uploadError'] = "Error uploading brand picture";
        echo $_SESSION['uploadError'];
    }
    }
}
  $footer = include_once "footer.php";
  echo $footer;
?>   
<form action="" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload" required="required">
    <input type="text" name="brand" id="brandName" required="required" placeholder="Name of a brand">
    <input type="submit" value="Upload brand" name="submit">
</form>
</body>
</html>