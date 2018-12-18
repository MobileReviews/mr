<?php
require_once "config.php";
session_start();
 
// Check if logged in as an admin
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true
            || $_SESSION["admin"] !== "true"){
    header("location: welcome.php");
    exit;
}
    
$target_dir = "brand_img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
//if ($uploadOk == 0) {
//    echo "Sorry, your file was not uploaded.";
//// if everything is ok, try to upload file
//} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $name = $_POST["brand"];
        $sql = "INSERT INTO brands (brand_name, image) VALUES ('$name', '$target_file')";
            if(mysqli_query($link, $sql)){
                header("Location: welcome.php");
            }
else die("Error uploading brand: ". mysqli_error($link));
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading brand picture.";
    }
//}



?>