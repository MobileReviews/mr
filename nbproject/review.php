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

    echo "<div class='row'>";
    echo "<h2>Review</h2>";
    echo "</div>";

    $submited_id = $_GET['id'];
    $sql = "SELECT * FROM reviews WHERE model_id = ".$submited_id.";";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $idReview = $row['id'];
        $review = $row['review'];
        echo $review;
    }
    ?>
</body>
    <?php $footer = include_once "footer.php";
      echo $footer;?>

</html>