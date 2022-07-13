
<?php

//register.php


include('controller.php');


$object = new Controller();

$object->user_session_public();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   
    <script src="https://cdn.jsdelivr.net/gh/guillaumepotier/Parsley.js@2.9.1/dist/parsley.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
   
  
  <link rel="stylesheet" href="login.css">
</head>
<body>
   
<div class="container ">
      <div class="row ">
        <div class="col-md-3">

        </div>
        <div class="col-md-6" style="margin-top:20px;">
          
          <span id="message">
          </span>
          <div class="card" style="margin:40px auto;">
            <div class="card-header bg-warning" style="text-align:center;">Forgot Password</div>
            <div class="card-body">
            
            <form method="post" id="login_form">
              <div class="form-group">
                <label for="email" class="form-label">enter email</label>
                <input type="email" name="email" class="form-control" id="email">
             
              </div>
            
              <div class="form-group">
                  <input type="hidden" name="page" value="forgot_password" />
                  <input type="hidden" name="action" value="forgot_password" />
                  <input type="submit" name="forgot_password" id="forgot_password" class="btn btn-warning" value="change password" />
                </div>
             </form>
                
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

  $('#login_form').parsley();

  $('#login_form').on('submit', function(event){
    event.preventDefault();

    $('#email').attr('required', 'required');


    if($('#login_form').parsley().validate())
    {
      $.ajax({
        url:"ajax_action.php",
        method:"POST",
        data:$(this).serialize(),
         dataType:"JSON",
				beforeSend:function()
                {
                    $('#forget_password').attr('disabled', 'disabled');
                    $('#forget_password').val('wait...');
                },
				success:function(data)
				{
					$('#forget_password').attr('disabled', false);
                    $('#message').html(data.error);
                    $('#forget_password').val('change password');
				}
      });
    }

  });

});

</script>