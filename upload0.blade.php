<?php

    if (isset($_POST['image_couverture'])) {
        $data = $_POST['image_couverture'];
    
        $image_array_1 = explode(";", $data);
    
        $image_array_2 = explode(",", $image_array_1[1]);
    
        $data = base64_decode($image_array_2[1]);
    
        $imageName = "db/covers/" . $_POST['id'] . ".png";
    
        file_put_contents($imageName, $data);
        echo "FOUND";
    } else {
        echo "NOT FOUND";
    }

    
?>