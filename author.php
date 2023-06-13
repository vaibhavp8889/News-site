<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <?php
                         include 'config.php';
                         if(isset($_GET['id'])){
                         $id = $_GET['id'];
                         
                         $query = "SELECT username FROM user WHERE user_id = $id";
                         $result1 = mysqli_query($conn, $query);
                         $row1 = mysqli_fetch_assoc($result1);
                         

                    ?>
                <div class="post-container">
                    
                  <h2 class="page-heading"><?php echo $row1['username']; ?></h2>
                    <div class="post-content">
                        <div class="row">
                            <?php
                                $limit = 3;
                                if(isset($_GET['page'])){
                                    $page = $_GET['page'];
                                }else{
                                    $page = 1;
                                }
                                $offset = ($page - 1) * $limit;
                                $sql = "SELECT post.post_id,post.author,post.title,post.description,post.post_date,post.post_img,category.category_name,user.username,post.category FROM post
                                        LEFT JOIN category ON post.category =category.category_id
                                        LEFT JOIN user ON post.author = user.user_id
                                        WHERE post.author = {$id}
                                        ORDER BY  post.post_id DESC LIMIT {$offset},{$limit}";
                                $result = mysqli_query($conn,$sql) or die("Query Failed");
                                if(mysqli_num_rows($result) > 0) {
                                   while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?id=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?id=<?php echo $row['author']; ?>'><?php echo $row['username']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date']; ?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo substr($row['description'],0,130) . "..."; ?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php'>read more</a>
                                </div>
                            </div>
                            <?php
                            }
                        }else{
                            echo "No Post";
                        }
                    }
                            ?>
                            
                        </div>
                    </div>
                    
                    
                    
                    
                </div><!-- /post-container -->
                <?php
                                   
                            $sql3 = "SELECT * from post WHERE author = {$id}";
                            $result3 = mysqli_query($conn,$sql3) or die("Query Failed");
                            echo "<ul class='pagination'>";
                            $total_rows = mysqli_num_rows($result3);
                            $total_page = ceil($total_rows / $limit);
                            if($page > 1){
                                echo '<li><a href="author.php?id='.$id.'&page='.($page - 1).'">prev</a></li>';
    
                            }
                            for($i = 1; $i <= $total_page; $i++){
                                echo '<li><a href="author.php?id='.$id.'&page='.$i.'">'.$i.'</a></li>';
                            }
    
                            if($page < $total_page){
                                echo '<li><a href="author.php?id='.$id.'&page='.($page + 1).'">next</a></li>';
    
                            }
                            echo "</ul>";
                            ?>
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
