<?php

require('connection.inc.php');
require('function.inc.php');

 if(isset($_SESSION['ADMIN_LOGIN'])&& $_SESSION['ADMIN_LOGIN']!=""){

 }else{
    header('location:login.php');
    die();
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
     
        <title>Dashboard Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <script src="https://cdn.jsdelivr.net/gh/guillaumepotier/Parsley.js@2.9.1/dist/parsley.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 

   
    <link rel="stylesheet" href="adminstyle.css">
  
</head>
<body>
<header class="adminlogin">
   <div class="container">
     <div class="logo">
        <img src="../html/images/download.jpg" alt="" >
        <h3>Milk Island</h3>
     </div>
<div class="admin">Welcome Admin
<a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
</div>
</div>
</header>


    <section class="sidebar">
        <div class="logo_content">
             <i class="fas fa-bars" id="btn"></i>
        </div> 
   
        <ul class="navlist">
        <li>
       <a href="dashboard.php">
       <i class="fas fa-tachometer-alt"></i>
        <span class="links_name">Dashboard</span>
       </a>
       <span class="tooltip">Dashboard</span>
   </li>
   <li>
       <a href="categories.php">
        <i class="fas fa-columns"></i>
        <span class="links_name">Category</span>
       </a>
       <span class="tooltip">Category</span>
   </li>
   <li>
       <a href="users.php">
        <i class="fas fa-user"></i>
        <span class="links_name">Customers</span>
       </a>
       <span class="tooltip">Customers</span>
   </li>
   <li>
       <a href="products.php">
        <i class="fas fa-shopping-bag"></i>
        <span class="links_name">Products</span>
       </a>
       <span class="tooltip">Products</span>
   </li>
   <li>
       <a href="orders.php">
        <i class="fas fa-shopping-cart"></i>
        <span class="links_name">orders</span>
       </a>
       <span class="tooltip">orders</span>
   </li>
   <li>
       <a href="contact_us.php">
        <i class="fas fa-comments"></i>
        <span class="links_name">messages</span>
       </a>
       <span class="tooltip">messages</span>
   </li>
        </ul>
</section>
  
         