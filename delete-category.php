<?php
    include 'config.php';
    $id = $_GET['id'];

    $sql = "DELETE FROM category WHERE category_id = {$id}";
    $result = mysqli_query($conn, $sql) or die("Query Failed");

    

    header("Location: {$hostname}/admin/category.php");
    mysqli_close($conn);

?>