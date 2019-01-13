<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload a review</title>
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

echo "<h2>Write a review</h2>"; 
  
include 'imagevalidation.php';
if(isset($_POST["submit"])) {
    $quer = "SELECT model_name FROM models WHERE id = ".$_POST["model"].";";
    $result = mysqli_query($link, $quer);
    $folder = mysqli_fetch_assoc($result);
    $directory = "review_img/".$folder["model_name"]."/";
    
    if (!file_exists($directory)) {
    mkdir($directory, 0777, true);
}
    
    $filePathTitle = $directory . basename($_FILES["title_picture"]["name"]);
    $filePathCamera = $directory . basename($_FILES["camera_picture"]["name"]);
    $filePathScreen = $directory . basename($_FILES["screen_picture"]["name"]);
    $filePathBattery = $directory . basename($_FILES["battery_picture"]["name"]);
    
    
    if (!checkImage($_FILES["title_picture"],$directory)
      || !checkImage($_FILES["camera_picture"],$directory)
      || !checkImage($_FILES["screen_picture"],$directory)
      || !checkImage($_FILES["battery_picture"],$directory)) {
        echo $_SESSION['uploadError'];
    } else {
    if (move_uploaded_file($_FILES["title_picture"]["tmp_name"], $filePathTitle)
        && move_uploaded_file($_FILES["camera_picture"]["tmp_name"], $filePathCamera)
        && move_uploaded_file($_FILES["screen_picture"]["tmp_name"], $filePathScreen)
        && move_uploaded_file($_FILES["battery_picture"]["tmp_name"], $filePathBattery)) {
        
    
        $model = $_POST["model"];
        $title = $_POST["title"];
        $camera_text = $_POST["camera_text"];
        $screen_text = $_POST["screen_text"];
        $battery_text = $_POST["battery_text"];
        $performance_text = $_POST["performance_text"];
        $youtube = $_POST["youtube"];
        $pros = $_POST["pros"];
        $cons = $_POST["cons"];
        $size = $_POST["size"];
        $color = $_POST["color"];
        $screen = $_POST["screen"];
        $camera = $_POST["camera"];
        $chipset = $_POST["chipset"];
        $memory = $_POST["memory"];
        $os = $_POST["os"];
        $battery = $_POST["battery"];
        
        
        
            $ytarray=explode("/", $youtube);
            $ytendstring=end($ytarray);
            $ytendarray=explode("?v=", $ytendstring);
            $ytendstring=end($ytendarray);
            $ytendarray=explode("&", $ytendstring);
            $video_fixed=$ytendarray[0];
            
        
        
        $sql = "INSERT INTO reviews (model_id, title, title_picture, camera_text, camera_picture,"
                . "screen_text, screen_picture, battery_text, battery_picture, performance_text, video,"
                . "cons, pros, size, color, screen, camera, chipset, memory, os, battery) VALUES"
                . " ('$model', '$title','$filePathTitle','$camera_text','$filePathCamera', '$screen_text',"
                . "'$filePathScreen', '$battery_text', '$filePathBattery','$performance_text', '$video_fixed',"
                . "'$cons','$pros','$size','$color','$screen','$camera','$chipset','$memory','$os','$battery')";
            if(mysqli_query($link, $sql)){
                header("Location: welcome.php");
            }
            else die("Error uploading review: ". mysqli_error($link));
    } 
    else {
        $_SESSION['uploadError'] = "Error uploading review picture";
        echo $_SESSION['uploadError'];
    }
    }
}
?>   
<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-2">
            <select style="width: 250px" name="model" required="required">
                                        <?php
                                        $sql = "SELECT model.id, model.model_name
                                        FROM models model
                                        LEFT JOIN reviews rev ON model.id = rev.model_id
                                        WHERE rev.model_id IS NULL";
                                        $result = mysqli_query($link, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {

                                            echo "<option value='{$row['id']}'>{$row['model_name']} </option>";
                                        }
                                        ?>
            </select>
        </div>
         <div class="col-2">
            <input type="text" name="title" id="title" required="required" placeholder="Title of the review">
        </div>
        <input type="file" name="title_picture" id="title_picture" required="required"><br><br>
        <div class="col-2">
            <textarea rows="4" cols="50" name="camera_text" id="camera_text" placeholder="Text about the camera" required="required"></textarea>
        </div>
         <input type="file" name="camera_picture" id="camera_picture" required="required"><br><br>
        <div class="col-2">
            <textarea rows="4" cols="50" name="screen_text" id="screen_text" placeholder="Text about the display" required="required"></textarea>
        </div>
            <input type="file" name="screen_picture" id="screen_picture" required="required"><br><br>
        <div class="col-2">
            <textarea rows="4" cols="50" name="battery_text" id="battery_text" placeholder="Text about the battery" required="required"></textarea>
        </div>
            <input type="file" name="battery_picture" id="battery_picture" required="required"><br><br>
         <div class="col-2">
            <textarea rows="4" cols="50" name="performance_text" id="performance_text" placeholder="Text about the performance" required="required"></textarea>
        </div>
        <div class="col-2">
            <input type="text" name="youtube" id="youtube" required="required" placeholder="Youtube video URL">
        </div>
        <div class="col-2">
            <input type="text" name="cons" id="cons" required="required" placeholder="Cons, seperated by ,">
        </div>
        <div class="col-2">
            <input type="text" name="pros" id="pros" required="required" placeholder="Pros, seperated by ,">
        </div>
        <div class="col-2">
            <input type="text" name="size" id="size" required="required" placeholder="Size">
        </div>
        <div class="col-2">
            <input type="text" name="color" id="color" required="required" placeholder="Color">
        </div>
        <div class="col-2">
            <input type="text" name="screen" id="screen" required="required" placeholder="Display">
        </div>
        <div class="col-2">
            <input type="text" name="camera" id="camera" required="required" placeholder="Camera">
        </div>
        <div class="col-2">
            <input type="text" name="chipset" id="chipset" required="required" placeholder="Chipset">
        </div>
        <div class="col-2">
            <input type="text" name="memory" id="memory" required="required" placeholder="Memory">
        </div>
        <div class="col-2">
            <input type="text" name="os" id="os" required="required" placeholder="Operating System">
        </div>
        <div class="col-2">
            <input type="text" name="battery" id="battery" required="required" placeholder="Battery">
        </div>
    </div>
    <label for="upload-review" class="custom-submit">
            Upload a review
        </label>
    <input type="submit" value="Upload review" id="upload-review" name="submit">
</form>
        <?php   $footer = include_once "footer.php";
        echo $footer;?>
</body>
</html>
