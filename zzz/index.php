<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<div style="margin: auto;width: 60%;">

    <form id="form1" name="form1" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" id="name">
        </div>
        <div class="form-group">
            <label for="account">Account:</label>
            <input type="text" name="account" class="form-control" id="account">
        </div>
        <div class="form-group">
            <label for="account">Password:</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <input type="button" name="send" class="btn btn-primary" value="add data" id="butsend">
        <input type="button" name="save" class="btn btn-primary" value="Save to database" id="butsave">
    </form>

    <table id="table1" name="table1" class="table table-bordered">
        <tbody>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Account</th>
                <th>Password</th>
                <th>Action</th>
            <tr>
        </tbody>
    </table>

</div>

<script>
$(document).ready(function() {

    var id = 1; 

    /*Assigning id and class for tr and td tags for separation.*/
    $("#butsend").click(function() {
        var newid = id++; 
        $("#table1").append('<tr valign="top" id="'+newid+'">\n\
        <td width="100px" >' + newid + '</td>\n\
        <td width="100px" class="name'+newid+'">' + $("#name").val() + '</td>\n\
        <td width="100px" class="account'+newid+'">' + $("#account").val() + '</td>\n\
        <td width="100px" class="password'+newid+'">' + $("#password").val() + '</td>\n\
        <td width="100px"><a href="javascript:void(0);" class="remCF">Remove</a></td>\n\ </tr>');
    });
    
    $("#table1").on('click', '.remCF', function() {
        $(this).parent().parent().remove();
    });

    /*crating new click event for save button*/
    $("#butsave").click(function() {

        var lastRowId = $('#table1 tr:last').attr("id"); /*finds id of the last row inside table*/
        var name = new Array(); 
        var account = new Array();
        var password = new Array();

        for ( var i = 1; i <= lastRowId; i++) {
        name.push($("#"+i+" .name"+i).html()); /*pushing all the names listed in the table*/
        account.push($("#"+i+" .account"+i).html()); /*pushing all the account listed in the table*/
        password.push($("#"+i+" .password"+i).html()); /*pushing all the password listed in the table*/
        }

        var sendName = JSON.stringify(name); 
        var sendAccount = JSON.stringify(account);
        var sendPassword = JSON.stringify(password);

        $.ajax({
            url: "insert-ajax.php",
            type: "post",
            data: {name : sendName , account : sendAccount , password : sendPassword},
            success : function(data){
            alert(data); /* alerts the response from php.*/
            }
        });

    });

});
</script>

</body>
</html>