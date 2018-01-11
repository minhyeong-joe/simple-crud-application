
<!-- include Create, Read, Update, Delete functions -->

<?php

  // connect to database
  require_once('config.php');

  // CREATE
  function create($image, $username, $comment) {
    global $db;
    $query = ("INSERT INTO `post`(`image`, `username`, `comment`) VALUES ('$image', '$username', '$comment')");
    mysqli_query($db, $query) or die ("ERROR! Failed to upload a new post.".mysqli_error($db));
  }

  // READ
  $query = ("SELECT * FROM `".DB_TABLE."`");
  $result = mysqli_query($db, $query) or die("ERROR! Failed to read data from database.".mysqli_error($db));


  // UPDATE


  // DELETE


?>
