<?php require "top.inc.php";
if(isset($_GET['type']) && $_GET['type']!=''){
    $type=get_safe_value($con,$_GET['type']);
    if($type=='status'){
        $operation=get_safe_value($con,$_GET['operation']);
        $id=get_safe_value($con,$_GET['id']);
        if($operation=='active'){
            $status='1';
        }else{
            $status='0';
        }
        $update_status_sql = "update products set status ='$status' where id='$id'";
        mysqli_query($con,$update_status_sql);
    }
    if($type=="delete"){
        $id=get_safe_value($con,$_GET['id']);
        $delete_sql="delete from products  where id='$id'";
        mysqli_query($con,$delete_sql);
   }


}
$sql ="select products.*,category.categories from products, category where products.category_id=category.id order by products.id desc";
$res = mysqli_query($con,$sql);
?>
<section class="home_content ">
       
        <div class="row">
      	<div class="col-8">
      		<h2>Products</h2>
      	</div>
      	<div class="col-4">
      		<a href="manage_product.php" class="btn btn-warning btn-sm" id="category">Add Product</a>
      	</div>

       <div class="col-12">
          <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for categories and products..">
      </div>
</div>
</section>
      <section class="table-responsive">
        <div class="responsiveness">
        <table class="table table-bordered table-sm">
          <thead>
          <tr>
                      <th class="text-center bg-info" >#</th>
                      <th class="text-center bg-info " >ID</th>
                      <th class="text-center bg-info" >Category</th>                      
                      <th class="text-center bg-info" >Name</th>                      
                      <th class="text-center bg-info" >img</th>                      
                      <th class="text-center bg-info" >qty</th>                      
                      <th class="text-center bg-info" >Mrp</th>                      
                      <th class="text-center bg-info" >Price</th>
                      <th class="text-center bg-info "></th>
                      
                   </tr>
                  
          </thead>

       
          <tbody  id="myTable">
         
      
                    <?php
                   $i=0;
                   while($row=mysqli_fetch_assoc($res)){
                     $i++;
                    ?>
                    <tr>
                   <td class="serial text-center py-4"><?php echo $i; ?></td>
                   <td class="text-center py-4"><?php echo $row['id'];?></td>
                   <td class="text-center py-4"><?php echo $row['categories'];?></td>
                   <td class="text-center py-4"><?php echo $row['name'];?></td>
                  <td class="text-center py-4"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'];?>" alt="" height="50px" width=60pxs> </td>
                  <td class="text-center py-4"><?php echo $row['qty'];?></td>
                   <td class="text-center py-4"><?php echo $row['mrp'];?></td>
                   <td class="text-center py-4"><?php echo $row['selling_price'];?></td>
                   <!-- <td> <img src="images/<?php echo $row['img']; ?>" alt="no img" height="50px" width=50px></td> -->
                   <th class="text-center py-4"><?php 
                       echo " <a class='btn btn-primary btn-sm'href ='manage_product.php?id=" .$row['id']."'>Edit</a>&nbsp;";
                      echo " <a class='btn btn-danger btn-sm'href ='?type=delete&id=" .$row['id']."'>Delete</a>";
                  
                   if($row['status']==1)
                   {
                       echo "<a  class='btn btn-success btn-sm ' href = '?type=status&operation=deactive&id=". $row['id'] . "'>Active</a>&nbsp";
                   }else{
                    echo "<a class='btn btn-secondary btn-sm' href = '?type=status&operation=active&id=". $row['id'] . "'>Deactive</a>&nbsp";
                   }
                 
                   ?>
                   </th>
                 </tr>
                 <?php
                 } 
                
                 ?>

                </tbody>
            
                </table>
                         
                  </div>
                  
                </section>
        

<!-- 
<script src="categories.js"></script> -->
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    ts=tr[i].getElementsByTagName("td")[3]
    if (td ) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else if(ts)
      {
        txtValue =  ts.textContent || ts.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = ""; 
      }
      
      else {
        tr[i].style.display = "none";
      }
    }
  }
}
}
</script>
 
 
<?php require "footer.inc.php"; ?>