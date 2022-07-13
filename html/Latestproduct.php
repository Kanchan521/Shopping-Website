<?php
require('connection.inc.php');

$sql="select * from products where status=1 order by id desc limit 8";


$query=mysqli_query($con,$sql);
$output='';
if(mysqli_num_rows($query)>0){
while($row=mysqli_fetch_assoc($query))
{
    ?>

<div class="box" >
              <!-- <div class="icons">
                <a href="#" class="fas fa-heart"></a>
                <a href="#" class="fas fa-share"></a>
                <a href="#" class="fas fa-eye"></a>
            </div> -->
        <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'];?>" height="150px" width="160px"alt="">
           
            <h3><?php echo $row['name'];?></h3>
            
            <div class="price"><?php echo $row['selling_price'];?><span><?php echo $row['mrp'];?></span> </div>
            <div class="quantity">
                <span>quantity : </span>
                <input type="number" min="1" max="1000" value="1" id="qty">
                <span> /<?php echo $row['qty'];?></span>
            </div>
            <a href="javascript:void(0)" onclick="manage_cart('<?php echo $row['id'];?>','add')" class="btn">add to cart</a>
        </div>
        </div>




<?php
}
}

?>

