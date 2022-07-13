<?php
include "connection.inc.php";
include "function.inc.php";
include('controller.php');

$object = new Controller();
$totalProduct=$object->totalProduct();


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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->

<!-- JavaScript Bundle with Popper -->
   
    <title>Milk-Island</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/guillaumepotier/Parsley.js@2.9.1/dist/parsley.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  
    <link rel="stylesheet" href="style.css">

   
</head>
<body>

<header id="header">
    <div class="header-1">
        <img src="images/download.jpg" alt="Milk Island Logo">
        <a href="index.php" class="logo"> Milk-Island</a>
       
        <form action="search.php" method="get" class="search-box-container">
          <div class="form-search">
            <input type="search" id="search-box" name="str"  placeholder="search here..." autocomplete="off"  required>
            <div id="searchlist"></div>
              </div>
              <button class="btn btn-sm"><i class="fas fa-search"></i></button>
          </form>

        <a href="login.php" class="btn btn-sm" id="register">Register/login</a>
        <h1 style="color:#fff;font-size:24px;font-weight:bolder;display:none;"  id="welcome">Welcome <?php echo $res;?></h1>
    </div>
    <div class="header-2">
        <div id="menu-bar" class="fas fa-bars"></div>
        <nav class="navbar">
            <a href="index.php#home">Home</a>
            <a href="index.php#category">Category</a>
            <a href="index.php#product">Product</a>
            <a href="aboutr.php">About us</a>
            <a href="index.php#contact">Contact us</a>
        </nav>
    
        <div class="icons">
        <div class="topnav" id="myTopnav">
          <a href="cart.php" class="fas fa-shopping-cart"><span class="icon-button__badge">
            <?php echo $totalProduct;?>
            </span></a>
            
              <div class="drpdown" id="drpbtn">  
               <a href="#" class="fas fa-user" id="users"class="dropbtn" ></a>
               <div class="drpdown-content">
               <a href="myorder.php">My Orders</a>
              <a href="logout.php" id="out"><i class="fas fa-sign-out-alt"></i>Logout</a>
             </div>
              </div>
              
          
  </div>
</div>
</div>
</header>


<?php

if(isset($_SESSION['user_id']))
{?>
<script>
$(document).ready(function(){
  $('#drpbtn').css("display","block");
  $('#register').css('display','none');
  $('#welcome').css('display','block');
})
</script>
<?php
}
?>
<script>
$(document).ready(function(){
  $("#search-box").keyup(function(){
      var search = $(this).val();

      if(search != ''){
         $.ajax({
            url: "ajax_action.php",
            method: "POST",
            data: { page:'search',action:'search',search: search},
            success: function(data){
              console.log(data);
              $("#searchlist").fadeIn("fast").html(data);
            }
         }); 
      }else{
        $("#searchlist").fadeOut();
        }
    });

    $(document).on('click','#searchlist li',function(){
      $('#search-box').val($(this).text());
      $("#searchlist").fadeOut();
    });
});

</script>
