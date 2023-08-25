<?php 
    header("Access-Control-Allow-Origin: *");
    require('database.php');
    
    $hasEmptyField = empty($_POST['name']) || empty($_POST['unit']) || empty($_POST['price']) || empty($_POST['date']) || empty($_POST['inventory'] || empty($_FILES['image']['tmp_name']));

    if(!$hasEmptyField) {
        $image = $_FILES['image']['name'];
        $imageType = $_FILES['image']['type'];
        $imageUpload = "../img/" . $image;

        $allowed = array("image/jpeg", "image/jpg", "image/png");

        if (!in_array($imageType, $allowed)) {
            echo "Invalid File input";
            exit();
        } else {
            $name = $_POST['name'];
            $unit = $_POST['unit'];
            $price = $_POST['price'];
            $date = $_POST['date'];
            $inventory = $_POST['inventory'];
            $cost = $price * $inventory;

            $sql = "
                INSERT INTO tbl_data(name, unit, price, date, inventory, cost, image) 
                VALUES('$name', '$unit', '$price', '$date', '$inventory', '$cost', '$image')
                ";
            createQuery($conn, $sql);
            move_uploaded_file($_FILES['image']['tmp_name'], $imageUpload);
        }
    }
    
    mysqli_close($conn)
?>