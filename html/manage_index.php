<?php
require('connection.inc.php');
$q="select * from category where status = 1";

$res=mysqli_query($con,$q);
if(mysqli_num_rows($res)>0){
    while($row=mysqli_fetch_array($res)){
    ?>
<div class="box">
<h3> <?php echo $row['categories'];?> </h3>
<p>upto 44% off</p>
<img src="<?php echo CATEGORY_IMAGE_SITE_PATH.$row['img']; ?>" alt="" height="150px" width="150px">
<a href="products.php?id=<?php echo $row['id'];?>" class="btn" id="btn">shop now</a>
</div>
<?php
}
}
?>

