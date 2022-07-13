<?php

include "top.inc.php";

?>


<section class="container-cart">
 
<table class="table table-sm table-bordered">
    <thead>
          <tr>
                    
                      <th>Products</th>
                      <th>Product Name</th>   
                      <th>Price</th>                    
                      <th>Quantity</th>                      
                      <th>Total</th>   
                      <th>remove </th>              
                                 
                                       
             </tr>
          </thead>
          <tbody>
              <?php 
              
               if(isset($_SESSION['cart']))
               {
               foreach($_SESSION['cart'] as $key=>$value)
              {
               
                  $productArr=$object->getProduct($con,$key);
                  $pname=$productArr[0]['name'];
                  $mrp=$productArr[0]['mrp'];
                  $price=$productArr[0]['selling_price'];
                  $image=$productArr[0]['image'];
                  $qty=$value['qty'];
                  ?>
              
              <tr>
                  <td> <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image;?>" height="100px" width="120px"alt="">
           </td>
                  <td><?php echo $pname;?></td>
                  <td><?php echo $price;?></td>
                  <td><input type="number" id="<?php echo $key?>qty"  value="<?php echo $qty;?>" onchange="manage_cart('<?php echo $key?>','<?php echo $price;?>','update')"/></br>
              
                  <td><?php echo $qty*$price;?></td>
                  <td><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','','remove')"><i class="fas fa-trash"></i></a></td>
                  
              </tr>
              <?php
              }
            }
            
              ?>
          </tbody>
</table>
</section>
<section class="container-shop-out">
    <div class="container-shop">
    <a href="<?php echo SITE_PATH1 ?>" type="button" class="btn btn-secondary">Continue Shopping</a>
    <a href="<?php echo SITE_PATH1 ?>checkout.php" type="button" class="btn btn-success">Checkout</a>
    </div>
 </section>

<script>
function manage_cart(pid,price,type)
{
    if(type=='update'){
        var qty = $("#"+pid+"qty").val();
    }else{
        var qty = $("#qty").val();
    }
 $.ajax({
        url:'ajax_action.php',
        type:'post',
        data:{page:'cart',pid:pid,qty:qty,price:price,action:type},
        success:function(data){
            if(type=='remove' || type=='update'){
             window.location.href='cart.php';
            }
          $('.icon-button__badge').html(data);
        }
    })
}

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
<?php
include 'footer.inc.php';
?>

       


