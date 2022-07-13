<?php require "top.inc.php";
$category_id='';
$name='';
$mrp='';
$selling_price='';
$qty='';
$image='';
$tmp_name='';
$new_img_name='';
$msg='';
$image_required='';
if(isset($_GET['id']) && $_GET['id']!==''){
    $image_required='';
    $id=get_safe_value($con,$_GET['id']);
    $res=mysqli_query($con,"select * from products where id='$id'");
    $check=mysqli_num_rows($res);
    if($check>0){
    $row=mysqli_fetch_assoc($res);
    $category_id=$row['category_id'];
    $name=$row['name'];
    $mrp=$row['mrp'];
    $selling_price=$row['selling_price'];
    $qty=$row['qty'];
    
    }else{
        header('location:products.php');
    die(); 
    }
}
if(isset($_POST['submit'])){
    $category_id=get_safe_value($con,$_POST['category_id']);
    $name=get_safe_value($con,$_POST['name']);
    $mrp=get_safe_value($con,$_POST['mrp']);
    $selling_price=get_safe_value($con,$_POST['price']);
    $qty=get_safe_value($con,$_POST['qty']);
    
    $res=mysqli_query($con,"select * from products where name='$name'");
    $check=mysqli_num_rows($res);
    if($check>0){
        if(isset($_GET['id']) && $_GET['id']!==''){
            $getData=mysqli_fetch_assoc($res);
            if($id==$getData['id']){

            }else{
                $msg="Product already exists"; 
            }
        }else{
         $msg="Product already exists";
        }
    }
    if(($_FILES['image']['type']!='') && ($_FILES['image']['type']!='image/png')&& ($_FILES['image']['type']!='image/jpg')&&($_FILES['image']['type']!='image/jpeg')){
      $msg= "please select only png,jpg ang jpeg format";  
    }
    if($msg==''){
        if(isset($_GET['id']) && $_GET['id']!=='' )
         {  

             
                if($_FILES['image']['name']!=''){
                    $result=mysqli_query($con,"SELECT image FROM products WHERE id='$id'") or die(mysql_error());
                   $row=mysqli_fetch_assoc($result) or die(mysql_error());
                   $oldimage=$row['image'];
                     unlink(PRODUCT_IMAGE_SERVER_PATH.$oldimage);
                    $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
                    $update_sql="update products set category_id='$category_id',name='$name',mrp='$mrp',selling_price='$selling_price',qty='$qty', image='$image' where id='$id'";
                }else{
                    $update_sql="update products set category_id='$category_id',name='$name',mrp='$mrp',selling_price='$selling_price',qty='$qty' where id='$id'";
                }
                mysqli_query($con,$update_sql); 
         }
           
        else{
            $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
           
                 mysqli_query($con,"insert into products(category_id,name,mrp,selling_price,qty,image,status) values ('$category_id','$name','$mrp','$selling_price','$qty','$image','1')");
             }    
             header('location:products.php');
            die();
}
}
?>
<section class="home_content" >
<div class="container">
<form  method="post" enctype="multipart/form-data">
<h3>Products</h3>
<div class="col-sm-12">
    <label for="products" class="form-label">Category Name</label>
      <select class="form-select" aria-label="Default select example" name="category_id">
        <option>Select Category</option>
        <?php
        $res=mysqli_query($con,"select id, categories from category order by categories asc");
        while($row=mysqli_fetch_assoc($res)){
            if($row['id']==$category_id){
            echo "<option selected value=".$row['id'].">".$row['categories']. "</option>";
            }else{
                echo "<option value=".$row['id'].">".$row['categories']. "</option>";
            }
        }
        ?>
        </select>
</div>
 <div class="col-sm-12">
         <label for="pname" class="form-label">Product Name</label>
         <input type="text" name="name" class="form-control" id="pname" palceholder="enter product name" value="<?php echo $name ?>"  required/>
</div>
<div class="col-sm-12">
    <label for="mrp" class="form-label">Mrp</label>
    <input type="text" name="mrp" class="form-control" id="mrp" palceholder="enter product mrp" value="<?php echo $mrp ?>"  required>
</div>
<div class="col-sm-12">
    <label for="sp" class="form-label">Selling_Price</label>
    <input type="text" name="price" class="form-control" id="sp" palceholder="enter product price" value="<?php echo $selling_price ?>"  required>
</div>
<div class="col-sm-12">
    <label for="qty" class="form-label">Qty</label>
    <input type="text" name="qty" class="form-control" id="qty" palceholder="enter qty" value="<?php echo $qty ?>"  required>
</div>
<div class="col-sm-12">
    <label for="img" class="form-label">Select Image</label>
    <input type="file" name="image" class="form-control" id="img" <?php echo $image_required?>> 
</div>
<div class="col-12 my-4">
    <button class="btn btn-primary" type="submit" name="submit">Add</button>
</div>
</form>
<div class="field-error"><?php echo $msg; ?></div>
</div>

    </section>
 

 
 
<?php require "footer.inc.php"; ?>