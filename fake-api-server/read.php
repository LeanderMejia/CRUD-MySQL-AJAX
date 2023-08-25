<?php
    header("Access-Control-Allow-Origin: *");
    require('database.php');
    
    $sql = "SELECT * FROM tbl_data";
    $data = readQuery($conn, $sql);

    echo json_encode($data);
    
    mysqli_close($conn);
?>