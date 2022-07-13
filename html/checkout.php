<?php
include 'connection.inc.php';
include 'function.inc.php';

if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0)
{?>
<script>
    window.location.href="index.php";
</script>
<?php
}
if(!isset($_SESSION['user_login']))
{
    header("location:login.php");
}


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
    <title>Milk Island</title>
   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- library validate -->
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
    <!-- style css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="checkout.css">
    <style>
          .header-1 a{
    text-decoration: none;
    font-weight: bold;
  }
  .header-1{
    background:#0cc55a;
    display: flex;
    align-content: center;
   
    justify-content: space-between;
  
    padding:2rem 9%;
  }
  .header-1 img{
    width: 76px;
    height: 72px;
    border-radius: 100%;
  }
  @media(max-width:850px){
   
  
    .header-1{
      padding:2rem;
      
    }
    .header-1{
      
      flex-direction: column;
       align-content: center;
       flex-wrap: wrap;
       justify-content: center;
      
    }
    .container-checkout{
        top:210px;
    }
  
  
}
    </style>
   
</head>
<body>

<header id="header">
    <div class="header-1">
        <img src="images/download.jpg" alt="Milk Island Logo">
        <a href="index.php" class="logo"> Milk-Island</a>
       <h1 style="color:#fff;font-size:24px;font-weight:bolder;display:none;"  id="welcome">Welcome <?php echo $res;?></h1>
    </div>
</header>

<section class="container-checkout">
  <h1 style="text-align:center;">Checkout Details</h1>
<div class="row">
    <div class="col-50">
        <div class="container">
            <form id="checkout_form" method="post">
                <div class="row">
                    <div class="col-50">
                        <h3 style="text-align:center;">Shipping Address</h3>
                        <div class="form-group">
                        <label for="adr" class="form-label"><i class="fa fa-address-card-o"></i> Address</label>
                        <input type="text" id="adr" class="form-control" name="address" placeholder="Enter your address" required>
                        </div>
                        <div class="form-group">
                        <label for="city" class="form-label"><i class="fa fa-institution"></i> City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Enter your city" required>
                        </div>
                        <div class="row">
                            <div class="col-50">
                            <div class="form-group">
                                <label for="state"class="form-label">State</label>
                                <input type="text" class="form-control" id="state" name="state" placeholder="Enter your state"required>
                            </div>
                          </div>
                            <div class="col-50">
                            <div class="form-group">
                                <label for="zip" class="form-label">Zip</label>
                                <input type="text" id="zip" class="form-control" name="zip" placeholder="Enter your pincode"required>
                            </div>
                         </div>

                          

                        </div>
                    </div>

                
                </div>
               
                <h3>Payment Method</h3>

</br>
                <div class="form-group">
                <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_type" value="cod" id="flexRadioDefault1">
                  <label class="form-check-label" for="flexRadioDefault1">
              Cash On Delivery
               </label>
  
</div>
                </div>
                <div class="form-group">
                <input type="submit" name="submit"  id="checkout" value="Continue to checkout" class="btn">
                <input type="hidden" name="page" value="checkout" class="btn">
                <input type="hidden" name="action" value="checkout" class="btn">
</div>
            </form>
        </div>
    </div>
    <div class="col-50">
        <div class="container">
        <h2><b>Your Order <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php echo $totalProduct ?></b></span></h2>
            <?php 
            $cart_total=0;
        
            foreach($_SESSION['cart'] as $key=>$value)
              {
                $productArr=$object->getProduct($con,$key);
                  $pname=$productArr[0]['name'];
                  $mrp=$productArr[0]['mrp'];
                  $price=$productArr[0]['selling_price'];
                  $image=$productArr[0]['image'];
                  $qty=$value['qty'];
                  
                  $cart_total=$cart_total+($price*$qty);
            
            ?>
             <div class="row checkout">
                 <div class="checkout-image">
                <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image;?>" height="50px" width="60px"alt="">
                 </div>
                 <div class="checkout-name" style="width:100%;">
                 <span><h4 style="display:inline-block;margin-bottom:0;"><?php echo $pname;?></h4></span>
                 <span style="float:right;margin-top:30px"><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i class="fas fa-trash"></i></a></span>
                 <h4 style="margin-top:5px;margin-bottom:0;">qty.<?php echo $qty;?></h4>
                 <h4 style="margin-top:5px;">Rs.<?php echo $price;?></h4>
                
            </div>
            </div>
            <?php
        
              }?>
            <p><b>Total Amount <span class="price" style="color:black"><b>Rs.<?php echo $cart_total;?></b></p>
        </div>
    </div>
</div>
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

</section>
<!-- script validate js -->
<script>
    $('#validate').validate({
        roles: {
           
            address: {
                required: true,
            },
            city: {
                required: true,
            },
            state: {
                required: true,
            },
            zip: {
                required: true,
            },
            
           
        },
        messages: {
            
            
            city:"Please input city*",
            address:"Please input address*",
            state:"Please input state*",
            zip:"Please input address*",
            
        },
    });

    function manage_cart(pid,type)
{
    if(type=='update'){
        var qty = $("#"+pid+"qty").val();
    }else{
        var qty = $("#qty").val();
    }
 $.ajax({
        url:'ajax_action.php',
        type:'post',
        data:{page:'cart',pid:pid,qty:qty,action:type},
        success:function(data){
            if(type=='update'|| type=='remove'){
             window.location.href=window.location.href;
            }
          $('.icon-button__badge').html(data)
        }
    })

}
$(document).ready(function(){


$('#checkout_form').on('submit', function(event){
  event.preventDefault();

 
    $.ajax({
      url:"ajax_action.php",
      method:"POST",
      data:$(this).serialize(),
      dataType:"json",
      beforeSend:function(){
          $('#checkout').attr('disabled', 'disabled');
          $('#checkout').val('please wait...');
        },
      success:function(data)
      {
        
      if(data.success)
      {
     
        $('#checkout').attr('disabled', false);
          $('#checkout').val('checkout');
     window.location.href="thankyou.php"
         
      }
         
        

      }
    });
  

});
});

</script>
