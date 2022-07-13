<?php

//verify_email.php

include("controller.php");
include 'connection.inc.php';
include 'function.inc.php';

$object = new Controller();

if(isset($_GET['type'], $_GET['code']))
{
	if($_GET['type'] == 'user')
	{
		$email_verified="yes";
        $code=get_safe_value($con,$_GET['code']);
       mysqli_query($con,"update user_table 
		SET email_verification = '$email_verified'
		WHERE user_verification_code = '$code'");

       header('location:login.php?verified=success');
    }


}


?>