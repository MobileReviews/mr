<?php
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }

    echo "<ul class='ul'>";
    echo "<a class='logo' href='welcome.php'><img src='https://i.imgur.com/JjCj9JC.png'
          alt='logo' height='32' width='100'></a>";
    echo "<li><a class='navlink' href='logout.php'>Logout</a></li>";
    echo "<li><a class='navlink' href='reset-password.php'>Reset Password</a></li>";
    if($_SESSION["admin"] == "true"){
        echo "<li><a class='navlink' href='admin-panel.php'>Admin Panel</a></li>";
    }
    echo "<li><a class='navlink' href='welcome.php'>Home</a></li>";
    echo "</ul>";
?>

