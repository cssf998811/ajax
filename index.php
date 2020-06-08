<?php
include 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Data</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="ajax.js"></script>
</head>
<body>
<div class="container">
	<p id="success"></p>
        <div class="table-wrapper">

            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Users</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Add New User</span></a>
						<a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><i class="material-icons"></i> <span>Delete</span></a>						
						<!-- <button type="button" class="btn btn-success btn-sm" id="register">註冊</button> -->
						<button type="button" class="btn btn-success btn-sm" id="login">登入</button>
					</div>
                </div>
            </div>

			<!-- 註冊會員 -->
			<!-- <form id="register_form" name="form1" method="post">
				<div class="form-group">
					<label for="account">Account:</label>
					<input type="text" class="form-control" id="account" placeholder="Account" name="account">
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" class="form-control" id="password" placeholder="Password" name="password">
				</div>
				<div class="form-group">
					<label for="phone">Phone:</label>
					<input type="text" class="form-control" id="phone" placeholder="Phone" name="phone">
				</div>
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="email" class="form-control" id="email" placeholder="Email" name="email">
				</div>
				<input type="button" name="save" class="btn btn-primary" value="Register" id="butsave">
			</form> -->

			<!-- 登入會員 -->
			<form id="login_form" name="form1" method="post" style="display:none;">
				
				<div class="form-group">
					<label for="account">Account:</label>
					<input type="text" class="form-control" id="account_log" placeholder="Account" name="account">
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" class="form-control" id="password_log" placeholder="Password" name="password">
				</div>
				<input type="button" name="save" class="btn btn-primary" value="Login" id="butlogin">
			</form>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th>序號</th>
                        <th>NAME</th>
                        <th>ACCOUNT</th>
						<th>PASSWORD</th>
                        <th>PHONE</th>
						<th>EMAIL</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
				<tbody>
				
				<?php
				$result = mysqli_query($conn,"SELECT * FROM user_data");
					$i=1;
					while($row = mysqli_fetch_array($result)) {
				?>
				<tr id="<?php echo $row["id"]; ?>">
					<td>
						<span class="custom-checkbox">
							<input type="checkbox" class="user_checkbox" data-user-id="<?php echo $row["id"]; ?>">
							<label for="checkbox2"></label>
						</span>
					</td>
					<td><?php echo $i; ?></td>
					<td><?php echo $row["name"]; ?></td>
					<td><?php echo $row["account"]; ?></td>
					<td><?php echo $row["password"]; ?></td>
					<td><?php echo $row["phone"]; ?></td>
					<td><?php echo $row["email"]; ?></td>

					<td>
						<a href="#editEmployeeModal" class="edit" data-toggle="modal">
							<i class="material-icons update" data-toggle="tooltip" 
							data-id="<?php echo $row["id"]; ?>"
							data-name="<?php echo $row["name"]; ?>"
							data-account="<?php echo $row["account"]; ?>"
							data-password="<?php echo $row["password"]; ?>"
							data-phone="<?php echo $row["phone"]; ?>"
							data-email="<?php echo $row["email"]; ?>"
							title="Edit"></i>
						</a>
						<a href="#deleteEmployeeModal" class="delete" data-id="<?php echo $row["id"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" 
						 title="Delete"></i></a>
                    </td>
				</tr>
				<?php
				$i++;
				}
				?>
				</tbody>
			</table>
			
        </div>
    </div>

	<!-- 新增頁面 Add Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="user_form">
					<div class="modal-header">						
						<h4 class="modal-title">Add User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>NAME</label>
							<input type="text" id="name" name="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>ACCOUNT</label>
							<input type="account" id="account" name="account" class="form-control" required>
						</div>
						<div class="form-group">
							<label>PASSWORD</label>
							<input type="password" id="password" name="password" class="form-control" required>
						</div>				
						<div class="form-group">
							<label>PHONE</label>
							<input type="phone" id="phone" name="phone" class="form-control" required>
						</div>
						<div class="form-group">
							<label>EMAIL</label>
							<input type="email" id="email" name="email" class="form-control" required>
						</div>
					</div>
					
					<div class="modal-footer">
					    <input type="hidden" value="1" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-success" id="btn-add">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- 編輯頁面 Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="update_form">
					<div class="modal-header">						
						<h4 class="modal-title">Edit User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_u" name="id" class="form-control" required>					
						<div class="form-group">
							<label>Name</label>
							<input type="text" id="name_u" name="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Account</label>
							<input type="account" id="account_u" name="account" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" id="password_u" name="password" class="form-control" required>
						</div>				
						<div class="form-group">
							<label>PHONE</label>
							<input type="phone" id="phone_u" name="phone" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" id="email_u" name="email" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" value="2" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info" id="update">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- 刪除頁面 Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
						
					<div class="modal-header">						
						<h4 class="modal-title">Delete User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_d" name="id" class="form-control">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="delete">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>


</body>

<script>
$(document).ready(function() {
	$('#login').on('click', function() {
		$("#login_form").show();
		$("#register_form").hide();
	});
	$('#register').on('click', function() {
		$("#register_form").show();
		$("#login_form").hide();
	});
	$('#butsave').on('click', function() {
		$("#butsave").attr("disabled", "disabled");
		var account = $('#account').val();
		var password = $('#password').val();
		var phone = $('#phone').val();
		var email = $('#email').val();
		if(account!="" && password!="" && phone!="" && email!="" ){
			$.ajax({
				url: "check.php",
				type: "POST",
				data: {
					type: 1,
					account: account,
					password: password,				
					phone: phone,
					email: email
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$("#butsave").removeAttr("disabled");
						$('#register_form').find('input:text').val('');
						$("#success").show();
						$('#success').html('Registration successful !'); 						
					}
					else if(dataResult.statusCode==201){
						$("#error").show();
						$('#error').html('account already exists !');
					}
					
				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
	$('#butlogin').on('click', function() {
		var account = $('#account_log').val();
		var password = $('#password_log').val();
		if(account!="" && password!="" ){
			$.ajax({
				url: "check.php",
				type: "POST",
				data: {
					type:2,
					account: account,
					password: password						
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						// location.href = "welcome.php";
					}
					else if(dataResult.statusCode==201){
						$("#error").show();
						$('#error').html('Invalid account or Password !');
					}
					
				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
});
</script>

</html>    