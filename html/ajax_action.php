<?php

require '../class/PHPMailer.php';
require '../class/SMTP.php';
require '../class/Exception.php';

include 'connection.inc.php';
include 'function.inc.php';

include 'controller.php';
$msg = new Controller();
if(isset($_POST['page']))
{
	if($_POST['page'] == 'register')
	{
		if($_POST['action'] == 'check_email')
		{

            $email=get_safe_value($con,$_POST['email']);
		 	
            $sql="select * FROM user_table WHERE user_email_address = '".$email."'";
            $query=mysqli_query($con,$sql);
			$row=mysqli_num_rows($query);
             if($row == 0)
			{
				$output = array(
					'success'	=>	true,
                    
				);

				echo json_encode($output);
			}
		}

    if($_POST['action'] == 'register')
		{
			
      $user_verification_code = rand(000000,999999);
  
		$username=get_safe_value($con,$_POST['user_name']);
        $email =get_safe_value($con,$_POST['user_email_address']);
        $contact =get_safe_value($con,$_POST['user_contact']);
        $Password = password_hash(get_safe_value($con,$_POST['user_password']),PASSWORD_DEFAULT);
        $email_verified='no';
        mysqli_query($con,"insert into user_table(username,mobile,user_email_address,password,user_verification_code,email_verification) values ('$username','$contact','$email','$Password','$user_verification_code','$email_verified')");
       
        $subject = 'Milk Island user Registration';

        $body = '
        <p>Thank you for registering.</p>
        <p>This is a verification mail,otp for registering is '.$user_verification_code.'.Please do not share your otp</p>
        <p>In case if you have any difficulty please mail us.</p>
        <p>Thank you,</p>
        <p>Milk Island Team</p>
        ';

        $msg->send_email($email, $subject, $body);

          


        $output=array("status"=>true);
               echo json_encode($output);

         }
         if($_POST['action'] == 'otp')
         {
            $email_verified="yes";
            $code=get_safe_value($con,$_POST['user_name']);
            $c= mysqli_query($con,"Select * from user_table where user_verification_code = '$code'");
            $count=mysqli_num_rows($c);
         if($count==1)
         {
            
            mysqli_query($con,"update user_table 
           SET email_verification = '$email_verified'
             WHERE user_verification_code = '$code'");
             $status=true;
         }else{
             $status=false;
         }
        $output=array("status"=>$status,
        'error'=>'invalid otp');
        echo json_encode($output);
         }
        }
    
if($_POST['page'] == 'login')
{
    if($_POST['action'] == 'login')
    {
        $data=get_safe_value($con,$_POST['username']);
       
     $sql="select * from user_table where user_email_address = '{$data}'";
     $res=mysqli_query($con,$sql);
     $count=mysqli_num_rows($res);
       if($count>0)
       {
          
           while($row=mysqli_fetch_assoc($res))
           {
               if($row['email_verification'] == 'yes')
               {
                if(password_verify($_POST['password'], $row['password']))
                {
                   $_SESSION['user_login']='yes';
                    $_SESSION['user_id'] = $row['user_id'];
                    $output = array(
                        'success'	=>	true,
                        'id'  =>$_SESSION["user_id"]
                    );
                }
                else
                {
                    $output = array(
                        'error'	=>	'Wrong Password'
                    );
                }
        }
            else
            {
                $output = array(
                    'error'		=>	'email not verified'
                );
            }
        }
 } else
    {
        $output = array(
            'error'		=>	'Wrong email'
            
        );
    }
    echo json_encode($output);
               }

           }

           if($_POST['page']=='forgot_password')
           {
               if($_POST['action']=='forgot_password')
               {

                sleep(2);
		     	$error = '';
               
                 
                   $email=get_safe_value($con,$_POST['email']);
                   $sql=mysqli_query($con,"select * from user_table where user_email_address = '{$email}'");
                   $count=mysqli_num_rows($sql);
                   if($count>=1)
                   {
                   while($row=mysqli_fetch_assoc($sql))
                   {
                       if($row['email_verification'] == 'yes')
                      

                        $subject = 'Change Password';

                        $body = '
                        <p>Hello '.$row["username"].'.</p>
                        <p>To Change Your Password Please Click on the given link. <a href="'.SITE_PATH1.'change_password.php?code='.$row['user_verification_code'].'" target="_blank"><b>Change Password</b></a></a></p>
                        
                        <p>In case if you have any difficulty please email us.</p>
                        <p>Thank you,</p>
                        <p>Milk Island Team</p>
                        ';

                        $msg->send_email($email, $subject, $body);

                        $error = '<div class="alert alert-success">To change password please check your mail.</div>';
                    }
                }else{
                    $error = '<div class="alert alert-success">Invalid email</div>';
                }
                   
               
            
        

        $output = array(
            'error'		=>	$error
        );


        echo json_encode($output);
    }
     if($_POST['action']=='change_password')
               {
                   
                   $success="true";
                   $Password = password_hash(get_safe_value($con,$_POST['user_password']),PASSWORD_DEFAULT);
                  
                  $code=get_safe_value($con,$_POST['code']);
                  $sql=mysqli_query($con,"update user_table set password='$Password'where user_verification_code='$code'");
                  echo $success;
               }
               

            }
           
 if($_POST['page'] == 'cart')
{
  
    if($_POST['action']=='add')
    {
        
        $pid=get_safe_value($con,$_POST['pid']);
        $qty=get_safe_value($con,$_POST['qty']);
      
        if($qty>=1){
       $msg->addProduct($pid,$qty);
       
    }
}

if($_POST['action']=='update')
    {
        
        $pid=get_safe_value($con,$_POST['pid']);
        $qty=get_safe_value($con,$_POST['qty']);
         if($qty>=1)
         {
               $msg->updateProduct($pid,$qty);
              
           
            
        }
    }
              
    if($_POST['action']=='remove')
    {
        $pid=get_safe_value($con,$_POST['pid']);
       
               $msg->removeProduct($pid);
              
     }
              
         echo $msg->totalProduct();
        
            
    }
    
     
    
    
        if($_POST['page']=='checkout')
        {
            if($_POST['action']=='checkout')
            {
                $cart_total=0;
        
                foreach($_SESSION['cart'] as $key=>$value)
                  {
                    $productArr=$msg->getProduct($con,$key);
                    
                      $price=$productArr[0]['selling_price'];
                     
                      $qty=$value['qty'];
                      
                      $cart_total=$cart_total+($price*$qty);
                
                  }


                $address=get_safe_value($con,$_POST['address']);
                $city=get_safe_value($con,$_POST['city']);
                $state=get_safe_value($con,$_POST['state']);
                $zip=get_safe_value($con,$_POST['zip']);
                $payment_type=get_safe_value($con,$_POST['payment_type']);
                $user_id=$_SESSION['user_id'];
                $total_price=$cart_total;
                $order_status = '1';
                $added_on=date('y-m-d h:i:s' );
                $sql="insert into order_table (user_id,address,city,pin_code,payment_type,total_price,order_status,added_on) values('$user_id','$address','$city','$zip','$payment_type','$total_price','$order_status','$added_on')";
                $query=mysqli_query($con,$sql);

                $order_id=mysqli_insert_id($con);
                foreach($_SESSION['cart'] as $key=>$value)
                {
                  $productArr=$msg->getProduct($con,$key);
                  
                    $price=$productArr[0]['selling_price'];
                   
                    $qty=$value['qty'];
                    
                    
                      

                    $sql="insert into order_details (order_id,product_id,quantity,price) values('$order_id','$key','$qty','$price')";
                    $query=mysqli_query($con,$sql);
              
                }

              
            }
            sendInvoice($con,$order_id);
            $output=array('success'=>true);
            unset($_SESSION['cart']);
         
            echo json_encode($output);
        }
        
}  
if($_POST['page']=='search')
{
    if($_POST['action']=='search')
    {
       $search_term = get_safe_value($con,$_POST['search']);
       $query=mysqli_query($con,"select name from products where name like '%{$search_term}%'");
       $output = "<ul>";
       if(mysqli_num_rows($query)>0)
       {
          while($row = mysqli_fetch_assoc($query)){
              $output .="<li>{$row['name']}</li>";
          }

       }else{
        $output .="<li>Product not found</li>";
       }
       $output.="</ul>";
    }
    echo $output;
}
    
if($_POST['page']=='contact')
{
    if($_POST['action']=='contact')
    {
        $name=get_safe_value($con,$_POST['name']);
        $email=get_safe_value($con,$_POST['email']);
        $contact=get_safe_value($con,$_POST['contact']);
        $sub=get_safe_value($con,$_POST['sub']);
        $msg=get_safe_value($con,$_POST['msg']);
        $added_on=date('y-m-d h:i:s' );
        mysqli_query($con,"insert into contact_us(name,email,mobile,subject,msg,added_on)values('$name','$email','$contact','$sub','$msg','$added_on') ");
    }
    $output = array('success'=>true);
    echo json_encode($output);
}
if($_POST['page']=='order'){
    if($_POST['action']=='status'){
       $id=$_POST['id'];
       mysqli_query($con,"update order_table set order_status=4 where order_id=".$id);
    
    $sql=mysqli_query($con,"select  user_table.* from user_table, order_table where order_table.order_id='".$id."' and order_table.user_id=user_table.user_id");
    $count=mysqli_num_rows($sql);
                   if($count>=1)
                   {
                   while($row=mysqli_fetch_assoc($sql))
                   {
      $email=$row['user_email_address'];
      $subject = 'Order Cancellation';

      $body = '
      <p>Hello '.$row["username"].'.</p>
      <p>your order with order id #'.$id.'  has been cancelled. To view this order detail <a href="'.SITE_PATH1.'order_cancel.php?id='.$id.'">click here</a> 
      
      <p>In case if you have any difficulty please email us.</p>
      <p>Thank you,</p>
      <p>Milk Island Team</p>
      ';

      $msg->send_email($email, $subject, $body);
      $output = array('success'=>true);
    echo json_encode($output);

    }
}

}
}
?>