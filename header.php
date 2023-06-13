<?php
include 'config.php';
    $page = basename($_SERVER['PHP_SELF']);

    switch($page){
        case 'single.php':
            if(isset($_GET['id'])){
                $sql_title = "SELECT * FROM post WHERE post_id = {$_GET['id']}";
                $result_title = mysqli_query($conn,$sql_title);
                $row_title = mysqli_fetch_assoc($result_title);
                $page_title = $row_title['title'];
            }else{
                $page_title = "No Post Found";
            }
            break;
        case 'category.php':
            if(isset($_GET['id'])){
                $sql_title = "SELECT * FROM category WHERE category_id = {$_GET['id']}";
                $result_title = mysqli_query($conn,$sql_title);
                $row_title = mysqli_fetch_assoc($result_title);
                $page_title = $row_title['category_name'] . " ". "News";
            }else{
                $page_title = "No Post Found";
            }
            break;
        case 'author.php':
            if(isset($_GET['id'])){
                $sql_title = "SELECT * FROM user WHERE user_id = {$_GET['id']}";
                $result_title = mysqli_query($conn,$sql_title);
                $row_title = mysqli_fetch_assoc($result_title);
                $page_title = $row_title['username'];
            }else{
                $page_title = "No Post Found";
            }
            break;
        case 'search.php':
            if(isset($_GET['search'])){
                $sql_title = "SELECT * FROM post WHERE title like '%{$_GET['search']}%'";
                $result_title = mysqli_query($conn,$sql_title);
                $row_title = mysqli_fetch_assoc($result_title);
                $page_title = $row_title['title'];
            }else{
                $page_title = "No Post Found";
            }
            break;
        case 'index.php':
            
                $page_title = "Home page";
            
            break;
        default:
            $page_title = "Page not found";
            break;

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    include 'config.php';
                    $sql = "SELECT * FROM category";
                    $result = mysqli_query($conn, $sql) or die("Query Failed");
                    if(mysqli_num_rows($result) > 0){
                        echo "<ul class='menu'>";
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<li><a href='category.php?id={$row['category_id']}'>{$row['category_name']}</a></li>";

                    }
                }

                ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
