<?php
  // define page specific info

  $title = "Simple CRUD Application";
  $dropdown = ""; // parent dropdown name if the page is dropdown list
  $page = "home"; // current page

  ##############################

  // MySQL connection & crud functions
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

        if(isset($_POST['delete'])) {
          $id = $_POST['id'];
          delete($id);
          header("refresh: 0;");
        }

        ?>
        <button type="submit" class="btn btn-primary" name="post">Post</button>
      </form>
    </div> <!-- end of .add-post -->

    <div class="post-section">
      <?php
        while($row = mysqli_fetch_array($result)) {
          $id = $row['id'];
          $image = $row['image'];
          $username = $row['username'];
          $timestamp = $row['timestamp'];
          $comment = $row['comment'];

      ?>

      <div class='card'>
        <div class='row justify-content-center'>
          <div class='col-sm-4'>
            <img class='card-img-top' src='<?php if($image) { echo "img/upload/$image"; } else { echo "img/no-image.jpg";} ?>' alt='Card image cap'>
          </div>
          <div class='col-sm-8'>
            <div class='card-body'>
              <h5 class='card-title'>
                <div class="row ">
                  <div class="col-sm-8">
                    <span class="username"> <?php echo $username; ?> </span>
                    <span class="badge badge-secondary"> <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $timestamp; ?></span>
                  </div>
                  <div class="col-sm-4" style="text-align:right;">
                    <form class="edit-delete" action="edit.php" method="post">
                      <input type="number" name="id" value="<?php echo $id; ?>" hidden>
                      <button type="submit" class="btn btn-tooltip" data-toggle="tooltip" data-placement="top" title="Edit" name="edit">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                      </button>
                      <button type="submit" class="btn btn-tooltip btn-delete" data-toggle="tooltip" data-placement="top" title="Delete" data-id="<?php echo $id; ?>">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </button>
                    </form>
                  </div>
                </div>
              </h5>
              <p class='card-text'><?php echo nl2br(htmlspecialchars($comment)); ?></p>
            </div>
          </div>
        </div>
      </div>

      <?php } // end of while statement ?>

    </div> <!-- end of .post-section -->

  </div> <!-- end of .section -->

  <div class="modal fade" id="delete-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-title"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color:#dc3545; margin-right: 0.5rem;"></i>Are You Sure?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Deleting a post is permanent and not reversible.
        </div>
        <div class="modal-footer">
          <form method="POST">
            <input type='number' name='id' class='modal-data-id' hidden>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger" name="delete">DELETE</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php include('inc/footer.php'); ?>
