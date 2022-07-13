<?php require "top.inc.php";
// if(isset($_GET['type']) && $_GET['type']!=''){
//     $type=get_safe_value($con,$_GET['type']);
    
//     if($type=="delete"){
//         $id=get_safe_value($con,$_GET['id']);
//         $delete_sql="delete from users  where id='$id'";
//         mysqli_query($con,$delete_sql);
//    }


// }
$sql ="select * from user_table order by user_id desc";
$res = mysqli_query($con,$sql);
?>
 <section class="home_content ">
 
        <div class="row">
      	<div class="col-sm-12">
      		<h2>Our Customer</h2>
      	</div>
</div>
</section>
<section class="tbl-users-responsive">
  <div class="responsiveness">
        <table class="table table-bordered table-sm">
          <thead>
          <tr>
                      <th class="serial bg-info">#</th>
                      <th class="bg-info">ID</th>
                      <th class="bg-info">Name</th>
                      <th class="bg-info">Email</th>
                      <th class="bg-info">Mobile</th>
                      <th class="bg-info">Password</th>
                    
                      <th class="bg-info"></th>
                      
                   </tr>
          </thead>
          <tbody id="category_list">
                  <?php
                   $i=1;
                   while($row=mysqli_fetch_assoc($res)){
                    ?>
                    <tr>
                   <td class="serial"><?php echo $i; ?></td>
                   <td><?php echo $row['user_id'];?></td>
                   <td><?php echo $row['username'];?></td>
                   <th><?php echo $row['user_email_address'];?></th>
                   <td><?php echo $row['mobile'];?></td>
                   <th><?php echo $row['password'];?></th>
                  
                   <td>
                   <?php 
                  echo " <a class='btn btn-danger btn-sm'href ='?type=delete&id=" .$row['user_id']."'>Delete</a>";
                 
                   ?>
                   </td>
                   
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
 
 
<?php require "footer.inc.php"; ?>  