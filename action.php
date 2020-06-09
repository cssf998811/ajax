<?php
session_start();
$action = $_POST["action"];

if ($action == "login") {
    $name1 = $_POST["username"];
    $pass1 = $_POST["userpass"];

    $servername = "localhost";
    $username = "cssf998811";
    $password = "cssf118899";
    $dbname = "dindin";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

    // set the PDO error mode to exception
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM `user_data` WHERE `account`='$name1' AND `password`='$pass1';");
    $stmt->execute();

    //帳密正確
    if ($stmt->rowCount()==1) {
        $_SESSION["username"] = $name1;
        echo "Yes";
    } else {
        echo "No";
    }

} elseif ($action == "logout") {

    unset($_SESSION["username"]);
    session_destroy();  

}
?>