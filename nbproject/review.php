<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review</title>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php 
    session_start();
    include ("navigation.php");
    require_once "config.php";
    $submited_id = $_GET['id'];
    $sql = "SELECT * FROM reviews WHERE model_id = ".$submited_id.";";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $idReview = $row['id'];
        $title = $row['title'];
        $titlepicture = $row['title_picture'];
        $cameratext = $row['camera_text'];
        $camerapicture = $row['camera_picture'];
        $screentext = $row['screen_text'];
        $screenpicture = $row['screen_picture'];
        $batterytext = $row['battery_text'];
        $batterypicture = $row['battery_picture'];
        $performancetext = $row['performance_text'];
        $video = $row['video'];
        $cons = $row['cons'];
        $pros = $row['pros'];
        $size = $row['size'];
        $screen = $row['screen'];
        $camera = $row['camera'];
        $chipset = $row['chipset'];
        $memory = $row['memory'];
        $os = $row['os'];
        $battery = $row['battery'];
        
           echo "<div class='row'>";
           echo "<h2>$title</h2>";
           echo "</div>";
           echo "<center><img src='$titlepicture' alt='Title picture' height='400' width='800'></center>";
           echo "<h3>Camera</h3>";
           echo $cameratext;
           echo "<center><img src='$camerapicture' alt='Camera picture' height='400' width='800'></center>";
           echo "<h3>Display</h3>";
           echo $screentext;
           echo "<center><img src='$screenpicture' alt='Screen picture' height='600' width='800'></center>";
           echo "<h3>Battery</h3>";
           echo $batterytext;
           echo "<center><img src='$batterypicture' alt='Battery picture' height='400' width='800'></center>";
           echo "<h3>Performance</h3>";
           echo $performancetext;
           
           echo "<div class='container'>";
           echo "<br><div class='videoWrapper' style='float: none;margin: 0 auto'>"
           . "<iframe width='100%' height='inherit' src='https://www.youtube.com/embed/$video' frameborder='0' allowfullscreen>
           </iframe></div></div>";
          
           echo "<div class='container'>";
           echo "<div class='left-half'>";
           
           echo "<h3><b>Cons</b></h3>";
           echo "<ul style='list-style-type:circle; margin-left: 5px;'>";
           $pieces = explode(",", $cons);
           foreach ($pieces as &$con) {
                 echo "<li>".nl2br(ucfirst($con)."\r\n")."</li>";
                }
                echo"</ul>";
            echo "</div>";
            echo "<div class='right-half'>";
           echo "<h3><b>Pros</b></h3>";
           echo "<ul style='list-style-type:circle; margin-left: 5px;'>";
           $pieces = explode(",", $pros);
           foreach ($pieces as &$pro) {
                 echo "<li>".nl2br(ucfirst($pro)."\r\n")."</li>";
                }
                echo"</ul>";
                echo "</div>";
            echo "</div>";
            echo "<h3>Main specifications</h3>";
            echo "<div class='container'><ul style='list-style-type:none;'>
            <li><i class='fas fa-arrows-alt'></i><b> Size </b>$size</li>
            <li><i class='fas fa-mobile-alt'></i><b> Screen </b>$screen</li>
            <li><i class='fas fa-camera'></i><b> Camera </b>$camera</li>
            <li><i class='fas fa-microchip'></i><b> Chipset </b>$chipset</li>
            <li><i class='fas fa-memory'></i><b> Memory </b>$memory</li>
            <li><i class='fas fa-server'></i><b> OS </b>$os</li>
            <li><i class='fas fa-battery-three-quarters'></i><b> Battery </b>$battery</li>
            </ul></div>";
            
            
    }
    ?>
</body>
    <?php $footer = include_once "footer.php";
      echo $footer;?>

</html>