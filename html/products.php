<?php 
require('top.inc.php');
?>
<section class="product" id="product">

<?php

$id=$object->clean(get_safe_value($con,$_GET['id']));
if($id!=''){
$sql="select * from products where status = 1 and category_id={$id} order by id desc ";
$q=mysqli_query($con,$sql);  
}
else{
    ?>
        <script>
            window.location.href="index.php";
        </script>
    <?php
         
}
$p="select * from category where id={$id}";
$res=mysqli_query($con,$p);
$dataname='';
while($data=mysqli_fetch_assoc($res)){
  $dataname=$data['categories'];
}  
?>
<h1 class="heading"><?php echo $dataname;?></h1>
<div class="box-container">
<?php

while($row=mysqli_fetch_array($q)){
?>
<div class="box">
           
           
            <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'];?>" alt="">
            <h3 id="pname"><?php echo $row['name'];?></h3>
            
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
<script>
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