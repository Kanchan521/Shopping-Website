<?php

//register.php


include('controller.php');


$object = new Controller();

$object->user_session_public();

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" ></script>
    <link rel="stylesheet" href="../css/new_form_style.css" />
</head>
<body>


<div class="container">


      <div class="forms-container">
     
        <div class="signin-signup">
        <span id="message">
          <?php
          if(isset($_GET['verified']))
          {
            echo '
            <div class="alert alert-success">Please check your email</div>
            ';
          }
          ?>
          </span>
        <div class="row">
    	
    		<div class="col-md-6" >
    			<span id="message"></span>
          </div>
          </div>
          <form class="sign-in-form" method="post" id="register_form">
            <h2 class="title">OTP Verification</h2>
            <div class="input-field">
            <span class="icons"><i class="fas fa-keyboard"></i></span>
            
              <input type="text" placeholder="Enter The Six Digit Otp" pattern ="[0-9]{6}" required="true" name="user_name" id="user_name"/>
            </div>
            
            <input type="hidden" name="page" value="register" />
            <input type="hidden" name="action" value="otp" />
            <input type="submit" value="Otp Verify" class="btn solid" name="user_register" id="user_register"/>

          
          </form>
          
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Already a Member ?</h3><br>
            <img src="../html/images/download.jpg" alt="" style="width: 40%;" />
            
            <p>
              Sign In to our Milk_Island Family.

            </p>
            <button class="btn transparent" id="sign-up-btn">
              <a href="login.php" style="color : white;"> Sign In </a>
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        
      </div>
    </div>

    <script src="app.js"></script>
  </body>
</html>

<script>

$(document).ready(function(){
 
 


	window.Parsley.addValidator('checkemail', {
    validateString: function(value)
    {
      return $.ajax({
        url:"ajax_action.php",
        method:"POST",
        data:{page:'register', action:'check_email', email:value},
        dataType:"json",
        async: false,
        success:function(data)
        {
          
          console.log(data);
          
        }
      });
    }
  });


  $('#register_form').parsley();

    $('#register_form').on('submit', function(event){

   event.preventDefault();
   $('#user_name').attr('required', 'required');
   
   

    $('#user_name').attr('data-parsley-pattern', '^[0-9]+$');

  

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
        beforeSend:function(){
          $('#user_register').attr('disabled', 'disabled');
          $('#user_register').val('please wait...');
        },
        success:function(data)
        {
         if(data.status)
          {
           
            $('#register_form')[0].reset();
            $('#register_form').parsley().reset();
            $('#user_register').attr('disabled', false);
            $('#user_register').val('Otp Verify');
             window.location.href="login.php?verified=success";
          }else
          {
            $('#user_register').attr('disabled', false);
             $('#user_register').val('Otp Verify');
        
            $('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
          }

          
       
        }
     });
    }

  });

});

</script>