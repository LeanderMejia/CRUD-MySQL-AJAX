<?php
    header("Access-Control-Allow-Origin: *");
    require('database.php');

    $itemId = $_GET['id'];
    $sql = "SELECT * FROM tbl_data WHERE id = '$itemId'";
    $data = readQuery($conn, $sql);

    echo json_encode($data);
    
    mysqli_close($conn);
