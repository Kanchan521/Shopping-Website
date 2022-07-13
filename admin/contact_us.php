
<?php require "top.inc.php";

if(isset($_GET['type']) && $_GET['type']!=''){
    $type=get_safe_value($con,$_GET['type']);
    
    if($type=="delete"){
        $id=get_safe_value($con,$_GET['id']);
          $delete_sql="delete from contact_us  where id='$id'";
        mysqli_query($con,$delete_sql);
   }
}
$sql ="select * from contact_us order by id desc";
$res = mysqli_query($con,$sql);
?>
     <section class="home_content ">
       
        <div class="row">
      	
      		<h2>Contact Us</h2>
      	
       </div>
</section>
      <section class="tb-responsive">
         <div class="responsiveness">
        <table class="table table-bordered table-sm">
          <thead>
          <tr>
                      <th class="serial bg-info">#</th>
                      <th class="bg-info">ID</th>
                      <th class="bg-info">Name</th>
                      <th class="bg-info">Email</th>
                      <th class="bg-info">Mobile</th>
                      <th class="bg-info">sub</th>
                      <th class="bg-info">msg</th>
                      <th class="bg-info">Date</th>
                      <th class="bg-info"></th>
                      
                   </tr>
          </thead>
          <tbody>
                  <?php
                   $i=0;
                   while($row=mysqli_fetch_assoc($res)){
                      $i++;
                    ?>
                    <tr>
                   <td class="serial"><?php echo $i; ?></td>
                   <td><?php echo '#'.$row['id'];?></td>
                   <td><?php echo $row['name'];?></td>
                   <th><?php echo $row['email'];?></th>
                   <td><?php echo $row['mobile'];?></td>
                   <th><?php echo $row['subject'];?></th>
                   <th><?php echo $row['msg'];?></th>
                   <th><?php echo $row['added_on'];?></th>
                   <td>
                   <?php 
                  echo " <a class='btn btn-danger btn-sm'href ='?type=delete&id=" .$row['id']."'>Delete</a>";
                 
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
               <?php include "footer.inc.php";?>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script src="js/ds.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script>
       $(document).ready(function(){
          var table = $('#table').DataTable({
              ajax:"data.json"
          });
          setInterval(() => {
             table.ajax.reload(null,false);
          }, 1000);

       });

 
 
