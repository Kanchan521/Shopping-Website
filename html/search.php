<?php
include 'connection.inc.php';
include 'function.inc.php';
$str=get_safe_value($con,$_GET['str']);
if($str!=''){
    $sql="select * from products where status = 1 and name like '%$str%'";
    $query=mysqli_query($con,$sql);  
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
<html>
<head>
    <title>Milk Island</title>
   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- library validate -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
       <h1 style="color:#fff;font-size:24px;font-weight:bolder;display:none;"  id="welcome">Welcome <?php echo $res;?></h1>
    
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
</header>
<section class="product" id="product">

<h1 class="heading">Searched Products</h1>
<div class="box-container">
    <?php
    

       
             while($row=mysqli_fetch_array($query)){
                ?>
        <div class="box">
           
            <div class="icons">
                <a href="#" class="fas fa-heart"></a>
                <a href="#" class="fas fa-share"></a>
                <a href="#" class="fas fa-eye"></a>
            </div>
            <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'];?>" alt="">
            <h3><?php echo $row['name'];?></h3>
            
            <div class="price"><?php echo $row['selling_price'];?><span><?php echo $row['mrp'];?></span> </div>
            <div class="quantity">
                <span>quantity : </span>
                <input type="number" min="1" max="1000" value="1" id="qty">
                <span>/<?php echo $row['qty'];?></span>
            </div>
          
            <a href="javascript:void(0)" onclick="manage_cart('<?php echo $row['id'];?>','add')" class="btn">add to cart</a>
       </div>

 <?php

}
        
 ?>
        
    </div>

</section>
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


function manage_cart(pid,type)
{
   
    var qty = $("#qty").val();
    
    $.ajax({
        url:'ajax_action.php',
        type:'post',
        data:{page:'cart',pid:pid,qty:qty,action:type},
        success:function(data){
          $('.icon-button__badge').html(data)
        }
    })
}
</script>

<?php require('footer.inc.php')?>

  