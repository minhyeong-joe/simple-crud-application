<?php
  // define page specific info

  $title = "Simple CRUD Application";
  $dropdown = ""; // parent dropdown name if the page is dropdown list
  $page = "home"; // current page

  ##############################

  // MySQL connection & crud functions
  include('inc/config.php');
  include('inc/functions.php');



  include('inc/header.php');

?>

  <div class="section">

    <div class="add-post">
      <form enctype="multipart/form-data" method="POST">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="image" name="image">
          <label class="custom-file-label" for="image">Choose Image</label>
          <small id="emailHelp" class="form-text text-muted">File size < 200KB</small>
          <small id="emailHelp" class="form-text text-muted">Image type: jpg, png, jpeg</small>
        </div>
        <div class="form-group">
          <label for="username">Username <font color='red'>*</font></label>
          <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Username" name="username" maxlength="20">
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Comment <font color='red'>*</font></label>
          <textarea class="form-control" id="comment" rows="3" name="comment" maxlength="500"></textarea>
        </div>
        <?php

        // When Post clicked, CREATE using create function in functions.php
        if(isset($_POST['post'])) {
          $image = $_FILES['image']['name'];
          $uploadOk = 1;
          if ($image) {
            $path_info = pathinfo($image);
            $extension = $path_info['extension'];
            $imageFileType = strtolower($extension);
            $image = uniqid().".".$imageFileType;
            $target = "img/upload/$image";

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
          }
          $username = mysqli_real_escape_string($db, $_POST['username']);
          $comment = mysqli_real_escape_string($db, $_POST['comment']);
          if ($username && $comment) {
            if ($uploadOk) {
              create($image, $username, $comment);
              if ($image) {
                move_uploaded_file($_FILES['image']['tmp_name'], $target) or die ("ERROR! Failed to upload the image.");
              }
              header("refresh: 0;");
            }
          } else {
            echo "<div class='alert alert-danger' role='alert'>
              All fields need to be filled!
            </div>";
          }
        }

        ?>
        <button type="submit" class="btn btn-primary" name="post">Post</button>
      </form>
    </div> <!-- end of .add-post -->

    <div class="post-section">
      <?php
        while($row = mysqli_fetch_array($result)) {
          $image = $row['image'];
          $username = $row['username'];
          $timestamp = $row['timestamp'];
          $comment = $row['comment'];

      ?>
      <div class='card'>
        <div class='row justify-content-center'>
          <div class='col-sm-4'>
            <img class='card-img-top' src='<?php if($image) { echo "img/upload/$image"; } else { echo "http://via.placeholder.com/250x200";} ?>' alt='Card image cap'>
          </div>
          <div class='col-sm-8'>
            <div class='card-body'>
              <h5 class='card-title'><?php echo $username; ?><span class="badge badge-secondary"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $timestamp; ?></span></h5>
              <p class='card-text'><?php echo nl2br(htmlspecialchars($comment)); ?></p>
            </div>
          </div>
        </div>
      </div>

      <?php } // end of while statement ?>

    </div> <!-- end of .post-section -->

  </div> <!-- end of .section -->

<?php include('inc/footer.php'); ?>
