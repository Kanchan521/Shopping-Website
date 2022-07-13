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
$sql ="select order_table.*,order_status.name as order_status_str from order_table,order_status where order_status.id=order_table.order_status";
$res = mysqli_query($con,$sql);



?>

    
    <section class="home_content">
        
        <div class="row">
      	
      		<h2>Orders</h2>
      
     
 
      <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for categories and products..">
      </div>
</section>
      <section class="tbl-order">
        <div class="responsiveness">
        <table class="table table-bordered table-sm">
          <thead>
          <tr>
                      <th class="text-center bg-info">#</th>
                      <th class="text-center bg-info ">Order Id</th>
                      <th class="text-center bg-info">order date</th>                      
                      <th class="text-center bg-info">Payment type</th>                      
                      <th class="text-center bg-info">order status</th>                      
           </tr>
          </thead>
        <tbody  id="myTable">
         <?php
         $i=0;
         $res=mysqli_query($con,"select order_table.*,order_status.name as order_status_str from order_table,order_status where  order_status.id=order_table.order_status order by order_id desc");
         while($row=mysqli_fetch_assoc($res))
         {
             $i++;
         ?>
           <tr>
             <td class="text-center py-4"><?php echo $i;?></td>
              <td class="text-center py-4"><a href="order_detail.php?id=<?php echo $row['order_id'];?>" class="btn btn-dark btn-sm">#<?php echo $row['order_id'];?></a> </td>
              <td class="text-center py-4"><?php echo $row['added_on'];?> </td>
              <td class="text-center py-4"><?php echo $row['payment_type'];?> </td>
              <td class="text-center py-4"><?php echo $row['order_status_str'];?></td>
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
    td = tr[i].getElementsByTagName("td")[1];
    ts=tr[i].getElementsByTagName("td")[4]
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