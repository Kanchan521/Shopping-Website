<?php require "top.inc.php";
$order_id=get_safe_value($con,$_GET['id']);
$r=mysqli_query($con,"select user_table.username,user_table.mobile,order_table.address,order_table.city,order_table.pin_code from user_table,order_table where order_table.order_id='$order_id'  and order_table.user_id=user_table.user_id");
?>
<section class="home_content ">

<div class="row">
<h2>Order Detail</h2>
</div>
</section>
  <section class="detail-table">
    <div class="responsiveness">
        <table class="table table-bordered table-sm">
          <thead>
          <tr>
                      <th class="text-center bg-info">#</th>
                      <th class="text-center bg-info ">product id</th>
                      <th class="text-center bg-info">image</th>                      
                      <th class="text-center bg-info">Product name</th>                      
                      <th class="text-center bg-info">quantity</th>                      
                      <th class="text-center bg-info">price</th>                      
                      <th class="text-center bg-info">sub total</th>                      
           </tr>
          </thead>
        <tbody  id="myTable">
        <?php
         $i=0;
         $total_price=0;
         $res=mysqli_query($con,"select distinct(order_details.order_id),order_details.*,products.name,products.image,products.qty from order_details,products,order_table where order_details.order_id='$order_id' and  products.id=order_details.product_id");
         while($row=mysqli_fetch_assoc($res))
         {  
           $total_price=$total_price+($row['quantity']*$row['price']);
           $i++;
         ?>
          <tr>
             <td class="text-center py-4"><?php echo $i;?></td>
             <td class="text-center py-4"><?php echo '#'.$row['product_id'];?> </td>
              <td class="text-center py-4"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'];?>" height="100px" width="120px"alt=""></td>
              <td class="text-center py-4"><?php echo $row['name'];?> </td>
              <td class="text-center py-4">Qty.<?php echo ' '.$row['quantity'].' ';echo $row['qty'];?></td>
              <td class="text-center py-4"><?php echo '    Rs.'.$row['price'].'/';echo $row['qty'];?></td>
              <td class="text-center py-4"><?php echo '    Rs.'.$row['quantity']*$row['price'];?></td>
         </tr>
        <?php
           }
        ?>
          <tr>
            <td colspan="6"><strong>Total Price</strong></td>
            <td><strong> Rs.<?php echo $total_price;?></strong></td>
         </tr>
</tbody>
</table>
</div>
</section>
        <section class="container-detail">
          <div class="container">
        <h2 style="border-bottom:1px solid red;">customer detail</h2>
                   <?php
                   while($row=mysqli_fetch_assoc($r)){
                    ?>
                   <p> <strong>Name :</strong><?php echo '  '.$row['username'];?></p>
                   <p> <strong>Address :</strong></p>
                   <p><?php echo $row['address'];?></p>
             <p><?php echo $row['city'];?></p>
             <p><?php echo $row['pin_code'];?></p>
             <p><strong>contact:</strong> <?php echo $row['mobile'];?> </p>
            <?php
          }
         $res=mysqli_query($con,"select order_status.name as order_status_str from order_status,order_table where  order_table.order_id='$order_id' && order_table.order_status=order_status.id ");
          while($row=mysqli_fetch_assoc($res)){
        ?>
        <p><strong>Order-Status : </strong> <?php echo $row['order_status_str'];?></p>
        <?php
          }
        ?>
        <div>
          <form method="post" id="change_status">
          <label for="products" class="form-label"><strong>Change Order status</strong></label>
      <select class="form-select"  name="order_status">
        <option value="select" selected>Select order</option>
        <?php
        $res=mysqli_query($con,"select * from order_status");
        while($row=mysqli_fetch_assoc($res)){
            
            echo "<option  value=".$row['id'].">".$row['name']. "</option>";
            }
        
        ?>
        </select>
        <div class="form-group">
                <input type="submit" name="submit" value="Change_status" class="btn btn-primary">               
                <span id="message" class="text-danger"></span>

                <input type="hidden" name="order_id" value="<?php echo $order_id;?>" class="btn btn-primary">
                <input type="hidden" name="page" value="status" class="btn">
                <input type="hidden" name="action" value="status" class="btn">
        </div>
          </form>
        </div>
      
    </div>
          </section>
<script>
$(document).ready(function(){
$('#change_status').on('submit', function(event){
  event.preventDefault();
   $.ajax({
      url:"ajax_action.php",
      method:"POST",
      data:$(this).serialize(),
      dataType:"json",
     success:function(data)
      {
        if(data.success)
      {
         location.reload(true);
        setTimeout(() => {
          $('#message').html(data.msg);
        }, 1000);
      }
    }
  });
});
});

</script>
 
<?php require "footer.inc.php"; ?>