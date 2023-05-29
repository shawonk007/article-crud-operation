<?php
$server = "localhost";
$uname = "root";
$pass = "";
$database = "sk_articles";
$connection = new mysqli($server, $uname, $pass, $database);
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}
?>