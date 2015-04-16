<?php
session_start();

require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_Oauth2Service.php';

function login()
{
	$_SESSION['type'] = $_POST['type'];	
	$client = new Google_Client();
	$client->setApplicationName("Medical Database System");
	/* if($type=="user")
	{
	$client->setClientId('275140125527-03o3lpg0oqt92u3fldhmn49e2n9ep405.apps.googleusercontent.com');
	$client->setClientSecret('H6E40w5spjajikEWILeTlVp4');
	$client->setRedirectUri('http://localhost/site/user/index.php');
		
	}
	elseif ($type=="doctor") {
	$client->setClientId('275140125527-l0j65v1gkcv578geesjskha9iqknttkv.apps.googleusercontent.com');
	$client->setClientSecret('rWmfX92dIRQ9pHBHjyR0jrQR');
	$client->setRedirectUri('http://localhost/site/doctor/index.php');
		
	}
	else { */
	$client->setClientId('275140125527-2munkft3bsq3o34mbkid1tjq9nsqnrln.apps.googleusercontent.com');
	$client->setClientSecret('OpJtSMJNaTX0bj7g6CJ3A2Ac');
	$client->setRedirectUri('http://localhost/site/auth.php');
		
	//}
	$client->setDeveloperKey('AIzaSyAJ5678gq3qE3Ox_snp3wfCZ9IozjaRvYA');
							 
	$oauth2 = new Google_Oauth2Service($client);
	$authUrl = $client->createAuthUrl();
	echo $authUrl;						 
	
   
}

if(isset($_POST['type'])) 
{
	login();
}
else if(isset($_SESSION['type']))
{
	
	$type = $_SESSION['type'];
	$client = new Google_Client();
	$client->setApplicationName("Medical Database System");
	$client->setClientId('275140125527-2munkft3bsq3o34mbkid1tjq9nsqnrln.apps.googleusercontent.com');
	$client->setClientSecret('OpJtSMJNaTX0bj7g6CJ3A2Ac');
	$client->setRedirectUri('http://localhost/site/auth.php');
	$client->setDeveloperKey('AIzaSyAJ5678gq3qE3Ox_snp3wfCZ9IozjaRvYA');
							 
	$oauth2 = new Google_Oauth2Service($client);
	if (isset($_GET['code'])) {
		
		  $client->authenticate($_GET['code']);
		  $_SESSION['token'] = $client->getAccessToken();
		  $authUrl = $client->createAuthUrl();
		$user = $oauth2->userinfo->get();
		$name = filter_var($user['name'], FILTER_SANITIZE_EMAIL);
		$email=$user['email'];
		$_SESSION['name']=$name;
		$_SESSION['token'] = $client->getAccessToken();
		$_SESSION['email']=$email;
		  if(strcmp($type, "user")==0)
		  {
		  	$redirect = 'http://localhost/site/user/index.php';
		  }
		  elseif (strcmp($type,"doctor")==0) {
			$redirect = 'http://localhost/site/doctor/index.php';  
		  }
		  elseif (strcmp($type,"pharmacist")==0) {
			$redirect = 'http://localhost/site/pharmacist/index.php';  
		  }
		  
		  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
		  return;
	}
										 
	if (isset($_SESSION['token'])) {
		 $client->setAccessToken($_SESSION['token']);
	}
										 
	// if (isset($_REQUEST['logout'])) {
	// 	  unset($_SESSION['token']);
	// 	  unset($_SESSION['email']);
	// 	  unset($_SESSION['type']);
	// 	  $client->revokeToken();
	// }
										 
	// if ($client->getAccessToken()) {
	// 	$user = $oauth2->userinfo->get();
	// 	$name = filter_var($user['name'], FILTER_SANITIZE_EMAIL);
	// 	$email=$user['email'];
	// 	$_SESSION['name']=$name;
	// 	$_SESSION['token'] = $client->getAccessToken();
	// 	$_SESSION['email']=$email;
	// } 
	// else {
	// 	$authUrl = $client->createAuthUrl();
	// 	$user = $oauth2->userinfo->get();
	// 	$name = filter_var($user['name'], FILTER_SANITIZE_EMAIL);
	// 	$email=$user['email'];
	// 	$_SESSION['name']=$name;
	// 	$_SESSION['token'] = $client->getAccessToken();
	// 	$_SESSION['email']=$email;
	// }
}
else {
	header('Location: index.php');
}
	
?> 
