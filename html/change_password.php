<?php

//register.php
include('connection.inc.php');
include('function.inc.php');

include('controller.php');


$object = new Controller();

$object->user_session_public();

if(!isset($_GET['code']))
{
  ?>
  <script>
    window.location.href="forgot_password.php";
  </script>
  <?php

}

$code=get_safe_value($con,$_GET['code']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  	<title>Register page</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/gh/guillaumepotier/Parsley.js@2.9.1/dist/parsley.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body>


	<div class="container">
  		<div class="row">
    		<div class="col-md-3">

    		</div>
    		<div class="col-md-6" style="margin-top:20px;">
    			<span id="message"></span>
      			<div class="card">
        			<div class="card-header bg-warning ">Change Password</div>
        			<div class="card-body">
          				<form method="post" id="register_form">
                   
                    <div class="form-group">
                      <label>Enter New Password</label>
                      <input type="password" name="user_password" id="user_password" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Enter Confirm Password</label>
                      <input type="password" name="confirm_user_password" id="confirm_user_password" class="form-control" />
                    </div>
                   
                    <div class="form-group">
                      <input type="hidden" name="page" value="forgot_password" />
                      <input type="hidden" name="action" value="change_password" />
                      <input type="hidden" name="code" value="<?php echo $code;?>" />
                      <input type="submit" name="user_register" id="user_register" class="btn btn-info" value="Change Password" />
                    </div>
                  </form>
                  <div align="center">
          				<p><a href="login.php">Login Now</a></p>
          				</div>
        			</div>
      			</div>
    		</div>
		    <div class="col-md-3">

		    </div>
  		</div>
	</div>

</body>
</html>

<script>

$(document).ready(function(){




  $('#register_form').parsley();

    $('#register_form').on('submit', function(event){

   event.preventDefault();
  
    $('#user_password').attr('required', 'required');

    $('#confirm_user_password').attr('required', 'required');

    $('#confirm_user_password').attr('data-parsley-equalto', '#user_password');

   

  

    if($('#register_form').parsley().isValid())
    {
      $.ajax({
        url:"ajax_action.php",
        method:"POST",
        data:new FormData(this),
        dataType:"json",
        contentType:false,
        cache:false,
        processData:false,
      
        success:function(data)
        {
         if(data)
          {
            $('#message').html('<div class="alert alert-success">Password Changed Successfully</div>');
            $('#register_form')[0].reset();
            $('#register_form').parsley().reset();
          }else{
            $('#message').html('<div class="alert alert-success">error changing password</div>');
          }

        
        }
     });
    }

  });

});

</script>