<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body> 
<?php
  session_start();
  include ("navigation.php");
require_once "config.php";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true
            || $_SESSION["admin"] !== "true"){
    header("location: welcome.php");
    exit;
}

echo "<h2>Upload a brand</h2>"; 
  
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
  
?>   
<form action="" method="post" enctype="multipart/form-data">
    
    <div class="row">
        <div class="col-4">
            <h3>Select image to upload:</h3>
            <input type="file" name="fileToUpload" id="fileToUpload" required="required">
        </div>
        <div class="col-4">
            <h3>Name a brand:</h3>
            <input type="text" name="brand" id="brandName" required="required" placeholder="Name of a brand">
        </div>
    </div>
    <div class="row">
        <label for="submit-button" class="custom-submit">
            Upload a brand
        </label>
        <input type="submit" value="Upload brand" id="submit-button" name="submit">
    </div>
</form>
    <?php $footer = include_once "footer.php";
      echo $footer; ?>
</body>
</html>