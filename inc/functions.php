
<!-- include Create, Read, Update, Delete functions -->

<?php

  // connect to database
  require_once('config.php');

  // CREATE


  // READ
  $query = ("SELECT * FROM `".DB_TABLE."`");
  $table = mysqli_query($db, $query) or die("ERROR!");
  

  // UPDATE


  // DELETE


?>
