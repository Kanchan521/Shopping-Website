<?php
include 'connection.inc.php';

if(!isset($_SESSION['user_id']))
{?>
  <script>
  window.location.href="index.php";
  </script>
  
<?php
}
$res="";
if(isset($_SESSION['user_id']))
{
  $id=$_SESSION['user_id'];
$q="select * from user_table where user_id=$id";
$sql=mysqli_query($con,$q);
$row=mysqli_num_rows($sql);

if($row>0)
{
  while($data=mysqli_fetch_assoc($sql)){
    $res=$data['username'];
   
 }  
}
}


?>

<!DOCTYPE html>
<html lang="en">
 <head>
    <title>Milk Island</title>
   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- library validate -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
   
    
    <!-- style css -->
    
    <link rel="stylesheet" href="style.css">
  
</head>
<style>
  .containerlast{
    position:relative;
    top:165px;
  }
    @media(max-width:850px){
   .containerlast{
     top:180px;
   }
    
  }


</style>
<body>

<header id="header">
    <div class="header-1">
        <img src="images/download.jpg" alt="Milk Island Logo">
        <a href="index.php" class="logo"> Milk-Island</a>
       <h1 style="color:#fff;font-size:24px;font-weight:bolder;display:none;"  id="welcome">Welcome <?php echo $res;?></h1>
    </div>
    </header>

    <?php

if(isset($_SESSION['user_id']))
{?>
<script>
$(document).ready(function(){
  

  $('#welcome').css('display','block');
})


</script>
<?php
}
?>

<section class="containerlast">
  <div class="container">
<p><h2>Your Order has been placed successfully.</h2></p>
  <img src="thankyou.jpg" alt="Thank You" height="100px" width="200px">
  <hr class="my-2">
  <p class="leads">
    <button class="btn btn-primary btn-sm"  onclick="fun()">continue shopping</a>
  </p>
  </div>
</section>
<script>
  function fun()
  {
   window.location.href="index.php";
  }
</script>

<section class="footer">

<div class="box-container">

    <div class="box">
        <a href="#" class="logo"><i class="fas fa-shopping-basket"></i>Milk-Island</a>
        <p>As Indians, everyone wants pure and fresh milk and other dairy products everyday. We "Milk-Isand" fullfill our customer demands with pure & fresh products with discount over market price.</p>
        <div class="share">
            <a href="#" class="btn fab fa-facebook-f"></a>
            <a href="#" class="btn fab fa-twitter"></a>
            <a href="#" class="btn fab fa-instagram"></a>
            <a href="#" class="btn fab fa-linkedin"></a>
        </div>
    </div>
    
    <div class="box">
        <h3>our location</h3>
        <div class="links">
            <a href="#">India</a>
            <a href="#">India</a>
            <a href="#">India</a>
            <a href="#">India</a>
            <a href="#">India</a>
        </div>
    </div>

    <div class="box">
        <h3>quick links</h3>
        <div class="links">
            <a href="#">home</a>
            <a href="#">category</a>
            <a href="#">product</a>
            <a href="#">deal</a>
            <a href="#">contact</a>
        </div>
    </div>

   

</div>

<h1 class="credit"> created by <span> Milk-Island Web Developer </span> | all rights reserved! </h1>

</section>

