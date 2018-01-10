<?php
  // define page specific info

  $title = "Simple CRUD Application";
  $dropdown = ""; // parent dropdown name if the page is dropdown list
  $page = "home"; // current page

  ##############################

  // MySQL connection & crud functions
  require_once('inc/functions.php');

  if(isset($_POST['post'])) {
    $fieldError = false;
    if (isset($_POST['username']) && isset($_POST['comment'])) {

    } else {
      $fieldError = true;
    }
  }

  include('inc/header.php');

?>

  <div class="section">

    <div class="add-post">
      <form enctype="multipart/form-data" method="POST">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="customFile">
          <label class="custom-file-label" for="image">Choose Image</label>
          <small id="emailHelp" class="form-text text-muted">File size < [filesize_limit]</small>
          <small id="emailHelp" class="form-text text-muted">aspect ratio limit</small>
          <small id="emailHelp" class="form-text text-muted">Image type: jpg, png</small>
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
          if ($fieldError) {
            echo "<div class='alert alert-danger' role='alert'>
              All fields need to be filled!
            </div>";
          }
        ?>
        <button type="submit" class="btn btn-primary" name="post">Post</button>
      </form>
    </div> <!-- end of .add-post -->

    <div class="post-section">
      <?php
        while($row = mysqli_fetch_array($table)) {
          echo "<div class='card'>";
            echo "<div class='row justify-content-center'>";
              echo "<div class='col-sm-4'>";
                echo "<img class='card-img-top' src='img/upload/".$row['image']."' alt='".$row['image']."'>";
              echo "</div>";
              echo "<div class='col-sm-8'>";
                echo "<div class='card-body'>";
                  echo "<h5 class='card-title'>".$row['username']."</h5>";
                  echo "<p class='card-text'>".$row['comment']."</p>";
                echo "</div>"; // end of card-body
              echo "</div>"; // end of .col
            echo "</div>"; // end of .row
          echo "</div>"; // end of .card
        }
      ?>
      <!-- <div class='card'>
        <div class='row justify-content-center'>
          <div class='col-sm-4'>
            <img class='card-img-top' src='img/250by200.jpg' alt='Card image cap'>
          </div>
          <div class='col-sm-8'>
            <div class='card-body'>
              <h5 class='card-title'>Special title treatment</h5>
              <p class='card-text'>With supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="row justify-content-center">
          <div class="col-sm-4">
            <img class="card-img-top" src="img/240by300.png" alt="Card image cap">
          </div>
          <div class="col-sm-8">
            <div class="card-body">
              <h5 class="card-title">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="row justify-content-center">
          <div class="col-sm-4">
            <img class="card-img-top" src="img/350by150.png" alt="Card image cap">
          </div>
          <div class="col-sm-8">
            <div class="card-body">
              <h5 class="card-title">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="row justify-content-center">
          <div class="col-sm-4">
            <img class="card-img-top" src="img/1280by720.png" alt="Card image cap">
          </div>
          <div class="col-sm-8">
            <div class="card-body">
              <h5 class="card-title">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
        </div>
      </div> -->

    </div> <!-- end of .post-section -->

  </div> <!-- end of .section -->

<?php include('inc/footer.php'); ?>
