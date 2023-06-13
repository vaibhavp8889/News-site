<?php
    include 'config.php';
    $id = $_GET['id'];
    $cat_id = $_GET['catid'];

    $sql1 = "SELECT * FROM post WHERE post_id = $id;";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($result1);

    unlink("upload/".$row1['post_img']);

    $sql = "DELETE FROM post WHERE post_id = $id;";
    $sql .= "UPDATE category SET post = post - 1 WHERE category_id = {$cat_id}";
    if(mysqli_multi_query($conn, $sql)) { 
        header("Location: {$hostname}/admin/post.php");
    }else{
        echo mysqli_error($conn);
    }

    mysqli_close($conn);

?>