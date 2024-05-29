<?php

$env= parse_ini_file('.env');

$servername = $env ["SERVER"];
$username = $env ["NAME"];
$password = $env ["PASSWORD"];
$dbname = $env ["DBNAME"];

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
