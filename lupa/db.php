<?php
 $servername = "10.10.7.91:3306";
  $username = "surat";
  $password = "surat2020";
  $dbname = "surat";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>