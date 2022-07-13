<?php
include "top.inc.php";
?>
<section class="order-container">
  <h1>
   My Orders
  </h1>
<table class="table table-bordered table-sm">
<thead>
   
          <tr>
                
                      <th class="text-center">Order Id</th>
                      <th class="text-center">Order Date</th>   
                      <th class="text-center">Payment Type</th>                    
                      <th class="text-center">order Status</th>   
                      <th class="text-center">Cancel Order</th>                   
                              
                                 
                                       
             </tr>
            
          </thead>
          <tbody>
          <?php
    $uid=$_SESSION['user_id'];
    $res=mysqli_query($con,"select order_table.*,order_status.name as order_status_str from order_table,order_status where order_table.user_id='$uid' and order_status.id=order_table.order_status");
    while($row=mysqli_fetch_assoc($res))
    {

    
    ?>
    <tr>
              <td><a href="order_detail.php?id=<?php echo $row['order_id'];?>" class="btn ">#<?php echo $row['order_id'];?></a> </td>
              <td class="text-center"><?php echo $row['added_on'];?> </td>
              <td class="text-center"><?php echo $row['payment_type'];?> </td>
             
              <td class="text-center"><?php echo $row['order_status_str'];?></td>
              <td class="text-center"><button type="button" name="edit_button"  id="edit" class="btn btn-lg edit_button" data-id="<?php echo $row['order_id']?>">cancel</button></td>
              </tr>
              <?php
              }
             ?>
          </tbody>
</table>

</section>
<?php
include "footer.inc.php"
?>
<script>
  $(document).ready(function(){
    $(document).on('click', '.edit_button', function(){

        var id = $(this).data('id');
  var a=confirm("Do you want to cancel your order with order id #"+id+"?");
 if(a){
   alert('please wait your order is getting cancelled');
  $.ajax({
        url:"ajax_action.php",
        method:"POST",
        data:{action:"status",page:"order",id:id},
        dataType:"json",
        beforeSend:function(){
          $('#edit').attr('disabled', 'disabled');
          $('#edit').val('please wait...');
        },
        success:function(data)
        {
         if(data.success)
          {
            alert("Your order with order id #"+id+" has been cancelled");
            window.location.href='myorder.php';
           }
        }
  })
 }

  })
  });
</script>