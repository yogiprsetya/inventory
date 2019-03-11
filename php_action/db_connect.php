<?php 	

$localhost = "localhost";
$username = "anekapet_inv";
$password = "u(V/]5bpB-";
$dbname = "anekapet_inv";

// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}

?>