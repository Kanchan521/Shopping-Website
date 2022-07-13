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
        <div class="row">
    		<div class="col-md-3">

    		</div>
    		<div class="col-md-6" >
    			<span id="message"></span>
          </div>
          </div>
          <form class="sign-in-form" method="post" id="register_form">
            <h2 class="title">Sign Up</h2>
            <div class="input-field">
            <span class="icons"><i class="fas fa-user"></i></span>
              <input type="text" placeholder="Enter Your Name" required="true" name="user_name" id="user_name" data-parsley-length="[3,20]" data-parsley-trigger="keyup"/>
            </div>
            <div class="input-field">
            <span class="icons"><i class="fas fa-envelope-open-text"></i></i></span>
              <input type="email" placeholder="Enter Your Email" required="true" name="user_email_address" id="user_email_address" data-parsley-checkemail data-parsley-trigger="keyup" data-parsley-checkemail-message='Email Address already Exists' />
            </div>
            <div class="input-field">
              <span class="icons"><i class="fas fa-phone-alt"></i></span>
              <input type="text" name="user_contact" id="user_contact"  data-parsley-trigger="keyup" data-parsley-length="[10,10]"placeholder="Enter Your Mobile Number"  required="true"/>
            </div>
            <div class="input-field">
            <span class="icons"><i class="fas fa-lock"></i></span>
              <input type="password" placeholder="Enter Your password" data-parsley-length="[6,12]" data-parsley-trigger="keyup" required="true" name="user_password" id="user_password"/>
            </div>
            <div class="input-field">
            <span class="icons"><i class="fas fa-lock"></i></span>
              <input type="password" placeholder="confirm Password" name="confirm_user_password" id="confirm_user_password"  data-parsley-trigger="keyup" data-parsley-equalto ='#user_password' required="true" />
              
            </div>
            <input type="hidden" name="page" value="register" />
            <input type="hidden" name="action" value="register" />
            <input type="submit" value="Register" class="btn solid" name="user_register" id="user_register"/>

          
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
          <!-- <img src="img/log.svg" class="image" alt="" /> -->
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
   
    $('#user_name').attr('data-parsley-pattern', "^[a-zA-Z ]+$");
    $('#user_email_address').attr('required', 'required');

    $('#user_email_address').attr('data-parsley-type', 'email');

    $('#user_password').attr('required', 'required');

    $('#confirm_user_password').attr('required', 'required');

   

    $('#user_contact').attr('required', 'required');

     $('#user_contact').attr('data-parsley-pattern', '^[0-9]+$');

  

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
            // $('#message').html('<div class="alert alert-success">Please check your email</div>');
            $('#register_form')[0].reset();
            $('#register_form').parsley().reset();
            $('#user_register').attr('disabled', false);
          $('#user_register').val('Register');
          window.location.href="otp.php";
          }
        
        

        }
     });
    }

  });

});

</script>