<?php
	session_start();
	$email = $_SESSION['email'];
	$name = $_SESSION['name'];  //Google profile name of user
	$type = $_SESSION['type'];

	if(isset($email) && isset($name) && isset($type) && strcmp($type,"pharmacist")==0)
	{
	  include('../verify.php');
	  if($res==0)
	  {
	    session_destroy();
	    header('Location: ../index.php');
	  }
	  else
	    $username = $res[0]; //Database name of user
	}
	else
	{
	  session_destroy();
	  header('Location: ../index.php');
	}

	if(isset($_POST['id_doc']) && isset($_POST['id_pha']) && isset($_POST['id_pat']) && isset($_POST['timestamp']) && isset($_POST['description']) && isset($_POST['pwd'])){
		
	include '../config.php';

	$db = pg_connect("$host $port $dbname $user $password");

	if(!$db){
	echo "Database connection failed";
	}
	else
	{
		$id_doc = $_POST['id_doc'];
		$id_pat = $_POST['id_pat'];
		$id_pha = $_POST['id_pha'];
		$timestamp = $_POST['timestamp'];
		$description=$_POST['description'];
		$pwd = $_POST['pwd'];

		$pwdcheck_query = "SELECT * FROM pat_password WHERE id_pat='$id_pat' and password='$pwd'";

		$result = pg_query($pwdcheck_query);
		$numrows = pg_num_rows($result);

		if($numrows==0)
		{
			echo "Entered password is incorrect.";
		}
		else
		{
			$query = "UPDATE temp_prescription SET status=1 where id_doc='$id_doc' and id_pat='$id_pat' and time_stamp=
			'$timestamp' and description='$description'";
			$query1="INSERT INTO prescription values ('$id_doc','$id_pat','$id_pha','$timestamp','$description','NULL')";
			// echo $query;

			pg_query("BEGIN") or die ("Could not start transaction\n");
		
			pg_send_query($db,$query);
			$res = pg_get_result($db);
			
			pg_send_query($db,$query1);
			$res1 = pg_get_result($db);
									
			if(pg_result_error($res)==0 && pg_result_error($res1)==0 )
			{
				pg_query("COMMIT") or die("Transaction commit failed\n");
				echo "SUCCESS";
			}
			else
			{
				//echo pg_result_error($res);
				//echo pg_result_error($res1);
				echo "Password correct, but database error has occurred.\n";
				pg_query("ROLLBACK") or die("Transaction ROLLBACK failed\n");
			}
			pg_close($db);
		}

	}
	}
	else{
	  	header('Location: index.php');
	}

?>
