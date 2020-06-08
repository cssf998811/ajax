<?php
	include 'database.php';
	session_start();

	// 註冊會員
	if($_POST['type']==1){
		$account=$_POST['account'];
		$password=$_POST['password'];
		$phone=$_POST['phone'];
		$email=$_POST['email'];
		
		$duplicate=mysqli_query($conn,"select * from user_data where account='$account'");
		if (mysqli_num_rows($duplicate)>0)
		{
			echo json_encode(array("statusCode"=>201));
		}
		else{
			$sql = "INSERT INTO `user_data`( `account`, `password` , `phone`, `email`) 
			VALUES ('$account','$password','$phone','$email')";
			if (mysqli_query($conn, $sql)) {
				echo json_encode(array("statusCode"=>200));
			} 
			else {
				echo json_encode(array("statusCode"=>201));
			}
		}
		mysqli_close($conn);
	}

	// 登入會員
	if($_POST['type']==2){
		$account=$_POST['account'];
		$password=$_POST['password'];
		$check=mysqli_query($conn,"select * from user_data where account='$account' and password='$password'");
		if (mysqli_num_rows($check)>0)
		{
			$_SESSION['account']=$account;
			echo json_encode(array("statusCode"=>200));
		}
		else{
			echo json_encode(array("statusCode"=>201));
		}
		mysqli_close($conn);
	}
?>