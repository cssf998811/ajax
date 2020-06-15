<?php
$servername = "localhost";
$username = "cssf998811";
$password = "cssf118899";
$dbname = "dindin";
$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// try {

//     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

//     // set the PDO error mode to exception
//     $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     echo "連線成功 Connected successfully!";

// } catch(PDOException $e) {

//     echo "無法連線 Connection failed: " . $e->getMessage();

// }
?>