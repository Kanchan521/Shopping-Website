<?php
include 'connection.inc.php';
include 'function.inc.php';
include('controller.php');
if(!isset($_SESSION['user_id']))
{
  ?>
  <script>
    window.location.href="index.php";
  </script>
  <?php
}

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

$order_id=get_safe_value($con,$_GET['id']);

?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Milk Island</title>
   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- library validate -->
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
    <!-- style css -->
    
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
  

  $('#welcome').css('display','block');
})


</script>
<?php
}
?>
<section class="orderprofile">
 
<h1>
     
     Order Details
      </h1>
   
<div class="container">
<div class="row">
  <h3>Order Id - <?php echo "#".$order_id?></h3>
</div>
 <table class="table table-bordered table-sm">
           <thead>
             <tr>
             <th></th>
             <th>Product Name</th>
             <th>Qty.</th>
             <th>Price</th>
             <th>sub-Total</th>
             </tr>
           </thead>
       <tbody>
         
          <?php
           $total_price=0;
         
           $uid=$_SESSION['user_id'];
          
           $res=mysqli_query($con,"select distinct(order_details.order_id),order_details.*,products.name,products.image,products.qty from order_details,products,order_table where order_details.order_id='$order_id' and order_table.user_id='$uid' and products.id=order_details.product_id");
           while($row=mysqli_fetch_assoc($res)){
               $total_price=$total_price+($row['quantity']*$row['price']);
               ?>
          <tr>
            <td>
            <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'];?>" height="100px" width="120px"alt=""></td>
            <td><?php echo $row['name'];?></td>
              <td><?php echo ' '.$row['quantity'].' ';echo $row['qty'];?></td>
                 <td><?php echo '    Rs.'.$row['price'].'/';echo $row['qty'];?></td>
                     <td><?php echo '    Rs.'.$row['quantity']*$row['price'];?></td>
                     </tr>  
           <?php
           }
          
           ?>
           <tr>
             <td></td>
             <td></td>
             <td></td>
               <td><strong>Total Price</strong> </h3></td>
                
              <td><strong> Rs.<?php echo $total_price;?></strong></h3></td>
               
          
        </tr>
      <!-- </div> -->
    <!-- </div> -->
    </tbody>
    </table>

<div class="container-address">
  <div class="row">
        <h3>Address Detail</h3>
        </div>
   
          <?php
        
           $uid=$_SESSION['user_id'];
          $r=mysqli_query($con,"select user_table.username,user_table.mobile,order_table.address,order_table.city,order_table.pin_code from user_table,order_table where order_table.order_id='$order_id' and order_table.user_id='$uid' and order_table.user_id=user_table.user_id");
          while($row=mysqli_fetch_assoc($r)){
          ?>
           <p>Reciever name - <strong><?php echo '  '.$row['username'];?></strong></p>
           <p><strong>Address:-</strong> </p>
           <p><?php echo $row['address'];?></p>
             <p><?php echo $row['city'];?></p>
             <p><?php echo $row['pin_code'];?></p>
             <p><strong>contact:</strong> <?php echo $row['mobile'];?> </p>
      
       <?php
          }
        
       ?>
    
        </div>
 
</section>
<?php 
include "footer.inc.php";
?>