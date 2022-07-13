
<?php




include('controller.php');


$object = new Controller();

$object->user_session_public();

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
   
    <title>Sign In to Milk_Island</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/gh/guillaumepotier/Parsley.js@2.9.1/dist/parsley.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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
            <div class="alert alert-success">
              Your email has been verified, now you can login
            </div>
            ';
          }
          ?>
          </span>
          <form class="sign-in-form" method="post" id="login_form">
            <h2 class="title">Sign In</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="email" placeholder="Enter Your Name" required="true" name="username" id="username"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Enter Password" name="password" id="password" required="true" />
              
            </div>
            <span><a href="forgot_password.php">Forgot password ?</a></span>
            <input type="hidden" name="page" value="login" />
            <input type="hidden" name="action" value="login" />
            <input type="submit" value="Login" class="btn solid" name="login" id="login"/>

                 

           
          </form>
          
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h4>New here ?</h4>
            <img src="../html/images/download.jpg" alt="" style="width: 40%;" />
            
            <p>
              Join Us to our Milk_Island Family.

            </p>
            <button class="btn transparent" id="sign-up-btn">
              <a href="register.php" style="color : white;"> Sign up </a>
            </button>
          </div>
        
        </div>
        <!-- <div class="panel right-panel">
         
         
        </div> -->
      </div>
    </div>

    <script src="../html/app.js"></script>
  </body>
</html>
<script>

$(document).ready(function(){

  $('#login_form').parsley();

  $('#login_form').on('submit', function(event){
    event.preventDefault();

    $('#username').attr('required', 'required');
$('#password').attr('required', 'required');

    if($('#login_form').parsley().validate())
    {
      $.ajax({
        url:"ajax_action.php",
        method:"POST",
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
          $('#login').attr('disabled', 'disabled');
          $('#login').val('please wait...');
        },
        success:function(data)
        {
          
          if(data.success)
          {
            location.href="index.php";
          }
          else
          {
            $('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
          }
          $('#login').attr('disabled', false);
          $('#login').val('Login');
        }
      });
    }

  });
  // setTimeout(() => {
  //   $('#message').css("display","none");
  // }, 3000);

});

</script>