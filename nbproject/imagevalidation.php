<?php

function checkImage($image, $directory)
{
    $filePath = $directory . basename($image["name"]);
    $imageFileType = strtolower(pathinfo($filePath,PATHINFO_EXTENSION));
    if(getimagesize($image["tmp_name"]) !== false) {
        if (file_exists($filePath)) {
         $_SESSION['uploadError'] = "Image with such name already exists\r\n";
         return false;
        }
        if ($image["size"] > 500000) {
            $_SESSION['uploadError'] = "Image is too large to upload";
            return false;
        }
        if($imageFileType != "jpg" &&
           $imageFileType != "png" &&
           $imageFileType != "jpeg" ) {
           $_SESSION['uploadError'] = "Only JPG, PNG and JPEG is valid";
           return false;
        }
        return true;   
    } 
    else {
        $_SESSION['uploadError'] = "File is not an image.\r\n";
        return false;
    }
}
?>

