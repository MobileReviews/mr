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

        $username = $_SESSION["username"];
        echo "<h2>Do your duty Mr. $username </h2>"; 
    ?>
    <div class='row'>
        <div class='col-buttons'>
            <form method='get' action='uploadbrand.php'>
                <button type="submit" class='butn butn3' >Upload a brand</button> 
            </form>
        </div>
        <div class='col-buttons'>
            <form method='get' action='uploadmodel.php'>
                <button type="submit" class='butn butn3' >Upload a model</button> 
            </form>  
        </div>
        <div class='col-buttons'>
            <form method='get' action='uploadreview.php'>
                <button type="submit" class='butn butn3' >Write a review</button> 
            </form>  
        </div>
    </div>
    <?php $footer = include_once "footer.php";
      echo $footer;?>
</body>
</html>