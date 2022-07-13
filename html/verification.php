<?php 
 $code=get_safe_value($con,$_GET['code']);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/gh/guillaumepotier/Parsley.js@2.9.1/dist/parsley.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <link rel="stylesheet" href="login.css">
</head>
<body>
   
<div class="container">
  		<div class="row">
    		<div class="col-md-3">

    		</div>
    		<div class="col-md-6" style="margin-top:20px;">
    			<span id="message">OTP sent, Please check your mobile</span>
      			<div class="card">
                 <div class="card-header bg-warning text-center" >verify otp</div>
        	<div class="card-body">
            <form method="post" id="verifyform">
              <div class="form-group">
                <label for="username" class="form-label">Enter Otp</label>
                <input type="number" name="otp" class="form-control" id="otp" >
            
              </div>
              <div class="form-group">
                  <input type="hidden" name="page" value="verify" />
                  <input type="hidden" name="action" value="verify" />
                  <input type="hidden" name="code" value= "<?php echo $code;?>"/>
                  <input type="submit" name="verify" id="verify" class="btn btn-warning" value="verify" />
                </div>
              </form>
              </div>
        			</div>
      			</div>
    		</div>
		    <div class="col-md-3">

		    </div>
  		</div>
	</div>
    <script>
    $(document).ready(function(){

$('#verifyform').parsley();

$('#verifyform').on('submit', function(event){
  event.preventDefault();

  $('#otp').attr('required', 'required');
 
  if($('#verifyform').parsley().validate())
    {
      $.ajax({
        url:"ajax_action.php",
        method:"POST",
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
          $('#verify').attr('disabled', 'disabled');
          $('#verify').val('please wait...');
        },
        success:function(data)
        {
          if(data.success)
          {
            location.href="login.php?verified=success";
          }
          else
          {
            $('#message').html('<div class="alert alert-danger">Otp verification failed</div>);
          }
          $('#admin_login').attr('disabled', false);
          $('#admin_login').val('verify');
        }
      });
    }

  });

});
});
    });
  </script>