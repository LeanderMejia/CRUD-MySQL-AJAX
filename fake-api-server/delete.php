<?php 
   header("Access-Control-Allow-Origin: *");
   require('database.php');

   if (isset($_POST['id'])){
        $id = $_POST['id'];

        $imagePathQuery = "SELECT image FROM tbl_data WHERE id = '$id'";
        $result = mysqli_query($conn, $imagePathQuery);
        $row = mysqli_fetch_assoc($result);
        unlink("../img/" . $row['image']);
        
        $sql = "DELETE FROM tbl_data WHERE id = '$id'";
        deleteQuery($conn, $sql);
   } 

   mysqli_close($conn);
?>