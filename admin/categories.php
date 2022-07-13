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
        $update_status_sql = "update category set status ='$status' where id='$id'";
        mysqli_query($con,$update_status_sql);
    }
    if($type=="delete"){
        $id=get_safe_value($con,$_GET['id']);
        $delete_sql="delete from category  where id='$id'";
        mysqli_query($con,$delete_sql);
}
}
$sql ="select * from category order by categories asc";
$res = mysqli_query($con,$sql);

?>
 <section class="home_content " >
       
        <div class="row" >
      	<div class="col-6">
      		<h2>Manage Category</h2>
      	</div>
      	<div class="col-4">
      		<a href="add_categories.php" class="btn btn-warning btn-sm" id="category">Add Product Category</a>
      	</div>
     
    <div class="col-12" style="margin-top:24px;">
       
   <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for categories and products..">
   </div>
</div>
   

</section>

  
  <section class="tbl-responsive" >
    <div class="responsiveness">
   
        <table class="table table-bordered table-sm">
          <thead>
          <tr>
                      <th class="text-center bg-info">#</th>
                      <th class="text-center bg-info">ID</th>
                      <th class="text-center bg-info">Category</th>
                      <th class="text-center bg-info">img</th>
                      <th class="text-center bg-info"></th>
                      
                   </tr>
          </thead>
          <tbody  id="myTable">
                   <?php
                   $i=0;
                   while($row=mysqli_fetch_assoc($res)){
                       $i++;
                    ?>
                    <tr>
                   <td class="serial text-center"><?php echo $i; ?></td>
                   <td class="text-center "><?php echo $row['id'];?></td>
                   <td class="text-center"><?php echo $row['categories'];?></td>
                   <td class="text-center"> <img src="<?php echo CATEGORY_IMAGE_SITE_PATH.$row['img']; ?>" alt="no img" height="50px" width=60px></td>
                   <th><?php 
                    echo "&nbsp <a class='btn btn-primary btn-sm'href ='add_categories.php?id=" .$row['id']."'>Edit</a>";
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
   
    if (td ) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      }
      
      else {
        tr[i].style.display = "none";
      }
    }
  }
}

</script>
<?php include "footer.inc.php"
?>