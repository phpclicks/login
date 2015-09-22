<?php
	include_once('db-config.php');
	$error  = array();
	$res    = array();
	$success = "";

		if(empty($_POST['email']))
		{
			$error[] = "Email field is required";	
		}
	
		if(empty($_POST['password']))
		{
			$error[] = "Password field is required";	
		}
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false && $_POST['email']!= "" ) {
     
        } else {
          $error[] = "Enter Valid Email address";
         }

		if(count($error)>0)
		{
			$resp['msg']    = $error;
			$resp['status'] = false;	
			echo json_encode($resp);
			exit;
		}
	    $statement = $db_con->prepare("select * from users where email = :email AND password = :password" );
        $statement->execute(array(':email' => $_POST['email'],'password'=> md5($_POST['password'])));
		$row = $statement->fetchAll(PDO::FETCH_ASSOC);
		if(count($row)>0)
		{
		  session_start();
		  $_SESSION['user_id'] = $row[0]['user_id'];
		  $resp['redirect']    = "dashboard.php";
		  $resp['status']      = true;	
		  echo json_encode($resp);
		  exit;	
		}
		else
		{
		   $error[] = "Email and password does not match";
		  $resp['msg']    = $error;
		  $resp['status']      = false;	
		  echo json_encode($resp);
		  exit;	
		} 


?>