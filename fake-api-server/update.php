<?php
    header("Access-Control-Allow-Origin: *");
    require('database.php');

    $hasEmptyField = empty($_POST['updateName']) || empty($_POST['updateUnit']) || empty($_POST['updatePrice']) || empty($_POST['updateDate']) || empty($_POST['updateInventory']);
    $currentImage = $_POST['previousImage'];

    if (!empty($_FILES['updateImage']['name'])) {
        $newImage = $_FILES['updateImage']['name'];
        $imageType = $_FILES['updateImage']['type'];
        $imageUpload = "../img/" . $newImage;

        $allowed = array("image/jpeg", "image/jpg", "image/png");

        if (!in_array($imageType, $allowed)) {
            echo "Invalid File input";
            exit();
        }

        unlink("../img/" . $currentImage);
        move_uploaded_file($_FILES['updateImage']['tmp_name'], $imageUpload);
        $currentImage = $newImage;
    }

    if (!$hasEmptyField) {
        $id = $_POST['id'];
        $name = $_POST['updateName'];
        $unit = $_POST['updateUnit'];
        $price = $_POST['updatePrice'];
        $date = $_POST['updateDate'];
        $inventory = $_POST['updateInventory'];
        $cost = $price * $inventory;

        $sql = "
            UPDATE tbl_data 
            SET name = '$name', unit = '$unit', price = '$price', date = '$date', inventory = '$inventory', cost = '$cost', image = '$currentImage'
            WHERE id = '$id'
        ";
        updateQuery($conn, $sql);
        
    }
