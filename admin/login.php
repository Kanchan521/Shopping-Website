<?php
require('connection.inc.php');
require('function.inc.php');
 $msg='';
if(isset($_POST['submit'])){
  $username=get_safe_value($con,$_POST['username']);
    $password=get_safe_value($con,$_POST['password']);
    $sql="select * from admin_users where username='$username'and password='$password'";
    $res=mysqli_query($con,$sql);
    $count=mysqli_num_rows($res);
    if($count>0){
    $_SESSION['ADMIN_LOGIN']='yes';
    $_SESSION['ADMIN_USERNAME']=$username;
     header('location:dashboard.php');
     die();
     }else{
        $msg="please enter correct login details";
     }
 }

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
          <div class="field_error">
             <?php echo $msg?>
          </div>
          <form class="sign-in-form" method="post" id="login_form">
            <h2 class="title">Sign In</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Enter Your Name" required="true" name="username" id="username"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Enter Password" name="password" id="password" required="true" />
              
            </div>
            <!-- <span><a href="forgot_password.php">Forgot password ?</a></span> -->
            <button type="submit" class="btn " name="submit">login</button>

                 

           
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
            <!-- <button class="btn transparent" id="sign-up-btn">
              <a href="register.php" style="color : white;"> Sign up </a>
            </button> -->
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
         
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="../html/app.js"></script>
  </body>
</html>

