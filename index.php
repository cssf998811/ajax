<?php
session_start();

$servername = "localhost";
$username = "cssf998811";
$password = "cssf118899";
$dbname = "dindin";

try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

    // set the PDO error mode to exception
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM `user_data`");
    $stmt->execute();
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
					<?php
					if (isset($_SESSION["username"]) && $_SESSION["username"]!="") {
						$ulogin = TRUE;
					} else { $ulogin = FALSE; }

					if ($ulogin) {
						echo "<a href='#addEmployeeModal' class='btn btn-success' data-toggle='modal'><i class='material-icons'></i> <span>Add New User</span></a>";
						echo "<a href='JavaScript:void(0);' class='btn btn-danger' id='delete_multiple'><i class='material-icons'></i> <span>Delete</span></a>";
					}
					?>						
					</div>
                </div>
            </div>

			<?php
			  echo "共有".$stmt->rowCount()."筆資料 - ";
			  if ($ulogin) {
				echo $_SESSION["username"]." <a href='#' id='logout'>登出</a>";
			  } else {
				echo "<a href='#myModal' class='trigger-btn' data-toggle='modal'>登入</a>";
				echo "<span style='margin-left:70%;'>您尚未登入，請登入後再進行操作!</span>";
			  }
			?>

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
						<?php
						if ($ulogin) {
							echo "<th>ACTION</th>";
						}
						?>
                        
                    </tr>
                </thead>
				<tbody>
				
				<?php
				$i=0;
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC) )  {
				  $i++;
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

					<?php
					if ($ulogin) {
						echo "<td>";
							echo "<a href='#editEmployeeModal' class='edit' data-toggle='modal'>";
							echo "<i class='material-icons update' data-toggle='tooltip'";
							echo "data-id='" . $row["id"] . "'";
							echo "data-name='" . $row["name"] . "'";
							echo "data-account" . $row["account"] . "'";
							echo "data-password" . $row["password"] . "'";
							echo "data-phone" . $row["phone"] . "'";
							echo "data-email" . $row["email"] . "'";
							echo "title='Edit'></i>";
							echo "</a>";
							echo "<a href='#deleteEmployeeModal' class='delete' data-id='" . $row["id"] . "' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Delete'></i></a>";
						echo "</td>";
					}
					?>						
                    
				</tr>

				<?php
				}
				?>
				
				</tbody>
			</table>
			
        </div>
    </div>

	<!-- Modal HTML -->
<div id="myModal" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">				
				<h4 class="modal-title">Member Login</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					<div class="form-group">
						<i class="fa fa-user"></i>
						<input type="text" class="form-control" placeholder="Username" required="required" id="username">
					</div>
					<div class="form-group">
						<i class="fa fa-lock"></i>
						<input type="password" class="form-control" placeholder="Password" required="required" id="userpass">
					</div>
					<div class="form-group">
						<button class="btn btn-primary btn-block btn-lg" id="login_button">登入系統</button>
					</div>
				</form>				
				
			</div>
			<div class="modal-footer">
				<a href="#">Forgot Password?</a>
			</div>
		</div>
	</div>
</div>  
<?php
} catch(PDOException $e) {
	echo "無法連線 Connection failed: " . $e->getMessage();
}
?>

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
    $(document).ready( function () {

        $('#login_button').click(function(){  
           var username = $('#username').val();
           var userpass = $('#userpass').val();

           if(username != '' && userpass != ''){  
                $.ajax({  
                     url:"action.php",

                     method:"POST",

                     data: {"action":"login", "username":username, "userpass":userpass},

                     success:function(data){  
                          if(data == 'Yes'){  
                               alert("成功登入系統...");
                               // $('#myModal').hide();
                               location.reload();
                          }  
                          else{ 
                               alert("帳密找不到...");
                          } 
                     },
                     error:function(data){
                       alter('無法登入');
                     }
            	});  
           }else{  
                alert("兩個欄位都要填寫!");
           }  
      });

  $('#logout').click(function(){  
       var action = "logout";
       $.ajax({
            url:"action.php",  
            method:"POST",  
            data:{"action":action},
            success:function()
            {  
                 location.reload();  
            }  
       });  
  });  
  });
</script>

</html>    