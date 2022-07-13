<?php
require('connection.inc.php');
require('function.inc.php');
  if($_POST['page']=='status')
  {
      if($_POST['action']=='status')
      {
          $order_id =get_safe_value($con,$_POST['order_id']);
           $status=get_safe_value($con,$_POST['order_status']);
          $sql="update order_table set order_status='$status' where order_id='$order_id'";
          $query=mysqli_query($con,$sql);

         
      $output=array('success'=>true,
                      'msg'=> 'status changed succesfully'
                    );
     
   
      echo json_encode($output);
  }
  
}   
?>