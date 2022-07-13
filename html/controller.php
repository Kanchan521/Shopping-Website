<?php

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;

class Controller
{

      function send_otp($number,$user)
	{
		
        $apiKey = urlencode('MzM2NzQ3NzU1YTY3NzYzNjVhMzY2MTZkNjk3NDcxN2E=');
	     $mobile_number='91'.$number;
        $numbers = array($mobile_number);
        $sender = urlencode('TXTLCL');
        $otp=rand(100000,999999);
      //  $_SESSION['session_otp']=$otp;
        $msg="your one time password is".$otp;
        $message = rawurlencode($msg);
     
        $numbers = implode(',', $numbers);
     
        // Prepare data for POST request
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
     
        // Send the POST request with cURL
        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
	}

	function verify_otp($otp){
       if($otp==$_SESSION['session_otp'])
       {
         unset($_SESSION['session_otp']);
           return 'yes';
       }else{
           return "error";
       }
    }



    function user_session_private()
	{
		if(!isset($_SESSION['user_id']))
		{
			header("location :index.php");
		}
	}

	function user_session_public()
	{
		if(isset($_SESSION['user_id']))
		{
			header("location:index.php");
		}
	}


    function send_email($receiver_email, $subject, $body)
	{
		$mail = new PHPMailer();
		
         $mail->isSMTP();

		$mail->Host = 'smtp.gmail.com';

		$mail->SMTPSecure = "ssl";

		$mail->Port = '465';

		$mail->SMTPAuth = true;

		$mail->Username = 'Enter your gmail id';

		$mail->Password = 'enter gmail password';

		$mail->FromName = 'Milk-Island';

		$mail->From = 'gmail id';

		$mail->setFrom('Milk-Island');

		$mail->addAddress($receiver_email);

		$mail->isHTML(true);

		$mail->Subject = $subject;

		$mail->Body = $body;
		
		if($mail->Send()){
			$msg="email sent successfully";
			$status=true;
		}else{
			$msg="email not sent successfully";
			$status=false;
		}
		
	 return json_encode(array("msg"=>$msg,"status"=>$status));
}

function addProduct($pid,$qty){

   $_SESSION['cart'][$pid]['qty']=$qty;
  

}
function updateProduct($pid,$qty){
 
   if(isset( $_SESSION['cart'][$pid])){
    $_SESSION['cart'][$pid]['qty']=$qty;
   }
  
}
function removeProduct($pid){

  if(isset( $_SESSION['cart'][$pid])){
    unset($_SESSION['cart'][$pid]);
  }

}
function emptyProduct(){
 
  unset($_SESSION['cart']);
  
}


function totalProduct(){

  if(isset( $_SESSION['cart'])){
  return count($_SESSION['cart']);
  }else{
    return 0;
  
}
}
function getProduct($con,$id)
{
  
  if($id!='')
  {
  $sql="select * from products where status='1' AND id='$id'";
  $query=mysqli_query($con,$sql);
 $data=array();
  while($row=mysqli_fetch_assoc($query)){
    $data[]=$row;
  }
  return $data;
  
  }
}

function clean($string) {

  return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
}
?>