<?php require "top.inc.php"; 
$sql=mysqli_query($con,"select * from user_table");
$user_count=mysqli_num_rows($sql);
$res=mysqli_query($con,"select * from order_table");
$order_count=mysqli_num_rows($res);
$resp=mysqli_query($con,"select * from products");
$product_count=mysqli_num_rows($resp);
$respc=mysqli_query($con,"select * from category");
$category_count=mysqli_num_rows($respc);
$respcont=mysqli_query($con,"select * from contact_us");
$contact_count=mysqli_num_rows($respcont);



?>
<section class="home_content "> 

<div class="row">
<h2>Dashboard</h2>
</div>
</section>
<section class="dashboard">
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Total Category</h5>
    <h6 class="card-subtitle mb-2 "><?php echo $category_count?></h6>
  
   
  </div>
</div>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Total Products</h5>
    <h6 class="card-subtitle mb-2 "><?php echo $product_count?></h6>
 
   
  </div>
</div>
<div class="card" >
  <div class="card-body">
    <h5 class="card-title">Total Customers</h5>
    <h6 class="card-subtitle mb-2 "><?php echo $user_count?></h6>
    
    
  </div>
</div>
<div class="card" >
  <div class="card-body">
    <h5 class="card-title">Total Orders</h5>
    <h6 class="card-subtitle mb-2 "><?php echo $order_count?></h6>
   
    
  </div>
</div>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Customer query</h5>
    <h6 class="card-subtitle mb-2"><?php echo $contact_count?></h6>
  
    
  </div>

                       
        
      </div>
    
</section>
      <?php include "footer.inc.php"?>
  