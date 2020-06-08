<?php
$servername = "localhost";
$username = "cssf998811";
$password = "cssf118899";
$dbname = "dindin";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else{
    // echo "connect success!";
}
?>