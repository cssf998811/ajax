<?php
$nameArr = json_decode($_POST["name"]);
$accountArr = json_decode($_POST["account"]);
$passwordArr = json_decode($_POST["password"]);

$con=mysqli_connect("localhost","cssf998811","cssf118899","dindin");

if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

for ($i = 0; $i < count($nameArr); $i++) {

    if(($nameArr[$i] != "")){ /*not allowing empty values and the row which has been removed.*/
        $sql="INSERT INTO user_data (name, account, password)
        VALUES
        ('$nameArr[$i]' , '$accountArr[$i]' , '$passwordArr[$i]')";
        if (!mysqli_query($con,$sql)){
            die('Error: ' . mysqli_error($con));
        }
    }
}
Print "Data added Successfully !";
mysqli_close($con);
?>