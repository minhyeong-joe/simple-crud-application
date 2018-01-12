<?php
  // define page specific info

  $title = "Edit - Simple CRUD Application";
  $dropdown = ""; // parent dropdown name if the page is dropdown list
  $page = "home"; // current page

  ##############################

  // MySQL connection & crud functions
  include('inc/functions.php');

  include('inc/header.php');

  $id = $_POST['id'];


  $query = ("SELECT * FROM `".DB_TABLE."` WHERE id='$id'");
  $result = mysqli_query($db, $query) or die("ERROR! Failed to read data from database.".mysqli_error($db));

  $row = mysqli_fetch_array($result);

  $image_prev = $row['image'];
  $username_prev = $row['username'];
  $comment_prev = $row['comment'];


  if(isset($_POST['cancel'])) {
    header("Location: /");
  }

?>

  <div class="section">

    <div class="add-post">
      <img src='<?php if($image_prev) { echo "img/upload/$image_prev"; } else { echo "img/no-image.jpg";} ?>' alt='Card image cap'>
      <form enctype="multipart/form-data" method="POST">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="image" name="image">
          <label class="custom-file-label" for="image">Choose Image</label>
          <small id="emailHelp" class="form-text text-muted">File size < 200KB</small>
          <small id="emailHelp" class="form-text text-muted">Image type: jpg, png, jpeg</small>
        </div>
        <div class="form-group">
          <label for="username">Username <font color='red'>*</font></label>
          <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Username" name="username" maxlength="20" value="<?php if($username_new){echo $username_new;} else {echo $username_prev;} ?>">
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Comment <font color='red'>*</font></label>
          <textarea class="form-control" id="comment" rows="3" name="comment" maxlength="500"><?php if($comment_new){echo $comment_new;} else {echo $comment_prev;} ?></textarea>
        </div>

        <?php

        // When Edit clicked, UPDATE using update function in functions.php
        if(isset($_POST['edit'])) {
          $image_new = $_FILES['image']['name'];
          $uploadOk = 1;
          if ($image_new) {
            if (file_exists("img/upload/$image_prev")) {
              unlink("img/upload/$image_prev");
            }

            $path_info = pathinfo($image_new);
            $extension = $path_info['extension'];
            $imageFileType = strtolower($extension);
            $image_new = uniqid().".".$imageFileType;
            $target = "img/upload/$image_new";

            // check for image type
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
              echo "<div class='alert alert-danger' role='alert'>
                Sorry, only JPG, JPEG, PNG files are allowed.
              </div>";
              $uploadOk = 0;
            }

            //check for file size
            if ($_FILES['image']['size'] > 200000) {
              echo "<div class='alert alert-danger' role='alert'>
                Sorry, your file is too large.
              </div>";
              $uploadOk = 0;
            }
          } else {
            $image_new = $image;
          }
          $username_new = mysqli_real_escape_string($db, $_POST['username']);
          $comment_new = mysqli_real_escape_string($db, $_POST['comment']);
          if ($username_new && $comment_new) {
            if ($uploadOk) {
              update($id,$image_new,$username_new,$comment_new);
              if ($image_new) {
                move_uploaded_file($_FILES['image']['tmp_name'], $target) or die ("ERROR! Failed to upload the image.");
              }
              header("Location: /");
            }
          } else {
            echo "<div class='alert alert-danger' role='alert'>
              All fields need to be filled!
            </div>";
          }
        }

        ?>
        <input type="number" name="id" value="<?php echo $id; ?>" hidden>
        <button type="submit" class="btn btn-primary" name="edit">Update</button>
        <button type="submit" class="btn btn-primary" name="cancel">Cancel</button>
      </form>
    </div> <!-- end of .add-post -->

  </div>



    <?php include('inc/footer.php'); ?>
