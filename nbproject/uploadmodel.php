<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload a model</title>
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

echo "<h2>Upload a model</h2>"; 
  
include 'imagevalidation.php';
if(isset($_POST["submit"])) {
    $directory = "model_img/";
    $filePath = $directory . basename($_FILES["fileToUpload"]["name"]);
    if (!checkImage($_FILES["fileToUpload"],$directory)) {
        echo $_SESSION['uploadError'];
    } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filePath)) {
        $name = $_POST["model"];
        $cpu = $_POST["cpu"];
        $ram = $_POST["ram"];
        $rom = $_POST["rom"];
        $brand = $_POST["brand"];
        $sql = "INSERT INTO models (model_name,CPU,RAM,ROM, modelimage, brand_id) VALUES"
                . "                ('$name', '$cpu','$ram','$rom','$filePath', $brand)";
            if(mysqli_query($link, $sql)){
                header("Location: welcome.php");
            }
            else die("Error uploading model: ". mysqli_error($link));
    } 
    else {
        $_SESSION['uploadError'] = "Error uploading model picture";
        echo $_SESSION['uploadError'];
    }
    }
}
?>   
<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-2">
            <select style="width: 250px" name="brand" required="required">
                                        <?php
                                        $selected = " selected='selected'";
                                        $sql = "SELECT id, brand_name
                                        FROM brands";
                                        $result = mysqli_query($link, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {

                                            echo "<option value='{$row['id']}'>{$row['brand_name']} </option>";
                                        }
                                        ?>
            </select>
        </div>
        <div class="col-2">
            <input type="text" name="model" id="ModelName" required="required" placeholder="Name of a model">
        </div>
        <div class="col-2">
            <input type="text" name="cpu" id="cpu" required="required" placeholder="CPU">
        </div>
        <div class="col-2">
            <input type="text" name="ram" id="ram" required="required" placeholder="RAM">
        </div>
        <div class="col-2">
            <input type="text" name="rom" id="rom" required="required" placeholder="ROM">
        </div>
    </div>
    <input type="file" name="fileToUpload" id="fileToUpload" required="required"> <br>
    <label for="upload-model" class="custom-submit">
            Upload a model
        </label>
    <input type="submit" value="Upload model" id="upload-model" name="submit">
</form>
        <?php   $footer = include_once "footer.php";
        echo $footer;?>
</body>
</html>
