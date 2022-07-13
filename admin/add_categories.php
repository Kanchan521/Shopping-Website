<?php require "top.inc.php";
$categories='';
$msg='';
$new_img_name='';
$image_required='';
if(isset($_GET['id']) && $_GET['id']!==''){
    $image_required='';
    $id=get_safe_value($con,$_GET['id']);
    $res=mysqli_query($con,"select * from category where id='$id'");
    $check=mysqli_num_rows($res);
    if($check>0){
    $row=mysqli_fetch_assoc($res);
    $categories=$row['categories'];
    }else{
        header('location:categories.php');
    die(); 
    }
}
              
if(isset($_POST['submit'])){
    $categories=get_safe_value($con,$_POST['categories']);
   
    $res=mysqli_query($con,"select * from category where categories='$categories'");
    $check=mysqli_num_rows($res);
    if($check>0){
        if(isset($_GET['id']) && $_GET['id']!==''){
            $getData=mysqli_fetch_assoc($res);
            if($id==$getData['id']){

            }else{
                $msg="category already exists"; 
            }
        }else{
         $msg="category already exists";
        }
    }
    if(($_FILES['image']['type']!='') && ($_FILES['image']['type']!='image/png')&& ($_FILES['image']['type']!='image/jpg')&&($_FILES['image']['type']!='image/jpeg')){
        $msg= "please select only png,jpg ang jpeg format";  
      }
    
    if($msg==''){
        if(isset($_GET['id']) && $_GET['id']!=='' ){
           
            if($_FILES['image']['name']!=''){
                $result=mysqli_query($con,"SELECT img FROM category WHERE id='$id'") or die(mysql_error());
                $row=mysqli_fetch_assoc($result) or die(mysql_error());
                $oldimage=$row['img'];
                unlink(CATEGORY_IMAGE_SERVER_PATH.$oldimage);
                $new_image_name=rand(111111111,999999999).'_'.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],CATEGORY_IMAGE_SERVER_PATH.$new_image_name);
                $update_sql="update category set categories='$categories', img='$new_image_name'  where id='$id'";
            }else{
                $update_sql="update products set category_id='$category_id'where id='$id'";
            }
            mysqli_query($con,$update_sql); 
        } else{
            $new_image_name=rand(111111111,999999999).'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],CATEGORY_IMAGE_SERVER_PATH.$new_image_name);
             mysqli_query($con,"insert into category(categories,img,status) values ('$categories','$new_image_name','1')");
             }    
             header('location:categories.php');
            die();
         
        
}
   
}
?>
<section class="home_content" >
 <div class="container">
<form  method="post" enctype="multipart/form-data">
      <h3>Add Category</h3>
       <div class="col-sm-12">
    <label for="validationDefault01" class="form-label">Category Name</label>
    <input type="text" name="categories" class="form-control" id="validationDefault01" value="<?php echo $categories ?>"  required>
  </div>
       <div class="col-sm-12">
    <label for="validationDefault02" class="form-label">Select Image</label>
    <input type="file" name="image" class="form-control" id="validationDefault02"  <?php echo $image_required?>> 
  </div>
  
  <div class="col-12 my-4">
    <button class="btn btn-primary" type="submit" name="submit">Add</button>
  </div>
</form>
<div class="field-error"><?php echo $msg; ?></div>
</div>
 
</section>
  
<?php require "footer.inc.php"; ?>