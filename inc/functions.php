
<!-- include Create, Read, Update, Delete functions -->

<?php

  // connect to database
  require_once('config.php');

  // CREATE
  function create($image, $username, $comment) {
    global $db;
    $query = ("INSERT INTO `".DB_TABLE."`(`image`, `username`, `comment`) VALUES ('$image', '$username', '$comment')");
    mysqli_query($db, $query) or die ("ERROR! Failed to upload a new post.".mysqli_error($db));
  }

  // READ
  $query = ("SELECT * FROM `".DB_TABLE."`");
  $result = mysqli_query($db, $query) or die("ERROR! Failed to read data from database.".mysqli_error($db));


  // UPDATE
  function update($id, $image, $username, $comment) {
    global $db;
    $query = ("UPDATE `".DB_TABLE."` SET `image`='$image',`username`='$username',`comment`='$comment' WHERE id='$id' LIMIT 1");
    $result = mysqli_query($db, $query) or die("ERROR! Failed to update data in database.".mysqli_error($db));
  }


  // DELETE
  function delete($id) {
    global $db;
    $query = ("DELETE FROM `".DB_TABLE."` WHERE id='$id' LIMIT 1");
    $result = mysqli_query($db, $query) or die("ERROR! Failed to delete data in database.".mysqli_error($db));
  }


?>
