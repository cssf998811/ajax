<?php
//連結資料庫
include 'database.php';

//新增 type = 1
if(count($_POST)>0){
	if($_POST['type']==1){
		$name=$_POST['name'];
		$account=$_POST['account'];
		$password=$_POST['password'];
		$phone=$_POST['phone'];
		$email=$_POST['email'];

		$sql = "INSERT INTO `user_data`( `name`, `account`, `password`,`phone`, `email`) 
		VALUES ('$name', '$account', '$password', '$phone', '$email')";
		$stmt = $conn->prepare($sql);
		if ($stmt->execute()) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
}

//修改 type = 2
if(count($_POST)>0){
	if($_POST['type']==2){
		$id=$_POST['id'];
		$name=$_POST['name'];
		$account=$_POST['account'];
		$password=$_POST['password'];
		$phone=$_POST['phone'];
		$email=$_POST['email'];

		$sql = "UPDATE `user_data` SET `name`='$name', `account`='$account', `password`='$password', `phone`='$phone', `email`='$email' WHERE id=$id";
		$stmt = $conn->prepare($sql);
		if ($stmt->execute()) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
}

//刪除 type = 3、4
if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];

		$sql = "DELETE FROM `user_data` WHERE id = $id ";
		$stmt = $conn->prepare($sql);
		if ($stmt->execute()) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
}
if(count($_POST)>0){
	if($_POST['type']==4){
		$id=$_POST['id'];
		
		$sql = "DELETE FROM user_data WHERE id in ($id)";
		$stmt = $conn->prepare($sql);
		if ($stmt->execute()) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
}
?>