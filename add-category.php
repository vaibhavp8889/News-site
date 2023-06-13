<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                <?php
                    if(isset($_POST['save'])){
                    include 'config.php';
                    $category = mysqli_real_escape_string($conn,$_POST['cat']);
                    $post = mysqli_real_escape_string($conn,$_POST['post']);
                    $sql ="INSERT INTO category(category_name,post) VALUES('{$category}', {$post})";
                    $result = mysqli_query($conn,$sql) or die("Query Failed");

                    header("Location: {$hostname}/admin/category.php");

                    



                    }

                ?>
                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <div class="form-group">
                          <label>Post</label>
                          <input type="number" name="post" class="form-control" placeholder="post number" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
