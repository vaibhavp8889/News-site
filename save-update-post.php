<?php
    include 'config.php';
    
    if(empty($_FILES['new-image']['name'])){
        $new_name =$_POST['old-image'];
    }else{
        $errors = array();

        $file_size = $_FILES['new-image']['size'];
        $file_name = $_FILES['new-image']['name'];
        $file_tmp = $_FILES['new-image']['tmp_name'];
        $file_type = $_FILES['new-image']['type'];
        $file_ext = end(explode('.',$file_name));
        $extensions = array("jpeg","jpg","png"); 
        if(in_array($file_ext,$extensions)=== false){
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";

        }
        if($file_size >2097152){
            $errors[] = "File size must be 2 MB or lower";
        }
        $new_name = time(). "-".basename($file_name);
        $target = "upload/".$new_name;
        $image_name = $new_name;
        if(empty($errors) == true){
            move_uploaded_file($file_tmp,"upload/".$image_name);
        }else{
            print_r($errors);
            die();
        }
    
    }
    $desc = mysqli_real_escape_string($conn, $_POST['postdesc']);
    $title = mysqli_real_escape_string($conn,$_POST['post_title']);
    
     
    $sql = "UPDATE post SET title='{$title}',description='{$desc}',category= {$_POST['category']},post_img='{$image_name }' WHERE post_id= {$_POST['post_id']};";
    if($_POST['old_category'] != $_POST['category']){
        $sql .= "UPDATE category SET post = post - 1 WHERE category_id = {$_POST['old_category']};";
        $sql .= "UPDATE category SET post = post +  1 WHERE category_id = {$_POST['category']}";
    }
    

    $result = mysqli_multi_query($conn,$sql) or die("query failed");
    if($result){
        header("Location: {$hostname}/admin/post.php");
    }else{
        echo "Error updating post";
    }


?>