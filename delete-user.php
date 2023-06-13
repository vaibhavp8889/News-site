<?php

if($_SESSION['user_role'] == 0){
    header("Location: {$hostname}/admin/post.php");
 }

 
    include 'config.php';
    $usrid = $_GET['id'];

    $sql = "DELETE FROM user WHERE user_id = {$usrid}";
    $result = mysqli_query($conn, $sql);

    header("Location: {$hostname}/admin/users.php");
    mysqli_close($conn);
?>