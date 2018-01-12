
<!-- configuration - define constants used to access MySQL database -->

<?php

define("DB_HOST", "localhost"); // hostname
define("DB_USERNAME", "root"); // username
define("DB_PASSWORD", "root"); // password
define("DB_DATABASE", "crud-application"); // database name

define("DB_TABLE", "post"); // table name

$db = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if (!$db) {
  die("ERROR: Could not connect to data base: ".mysqli_connect_error());
}

?>
