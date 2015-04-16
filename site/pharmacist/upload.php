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

	if(isset($_POST['id_doc'])){
		
	include '../config.php';

	$db = pg_connect("$host $port $dbname $user $password");

	if(!$db){
	echo pg_last_error();
	}
	else
	{
		$id_doc = $_POST['id_doc'];
		$id_pat = $_POST['id_pat'];
		$id_pha = $_POST['id_pha'];
		$timestamp = $_POST['timestamp'];
		

		if($_FILES['file']['error'] > 0){
    			echo "<span class='btn-warning'>File upload error<span>";
    			Redirect('index.php',false);
		}

		$file = $_FILES['file']['tmp_name'];

		if(!move_uploaded_file($file, '../tmp/file.jpg')){
    				echo "failed";
    				// Redirect('index.php', false);
		}
		else
		{
			// echo "Success";

			$data = file_get_contents( '../tmp/file.jpg' );

			$escaped = pg_escape_bytea($data);;

			$query = "UPDATE Prescription SET medical_cert='{$escaped}' WHERE id_pha='$id_pha' and 
													id_pat='$id_pat' and id_doc='$id_doc' and time_stamp='$timestamp'";

			// echo $query;

			pg_query("BEGIN") or die ("Could not start transaction\n");
		
			pg_send_query($db,$query);
			$res = pg_get_result($db);
			
			if(pg_result_error($res)==0)
			{
				// echo "Commiting transaction\n";
				pg_query("COMMIT") or die("Transaction commit failed\n");

				// $query = "SELECT medical_cert FROM Prescription WHERE id_pha='$id_pha' and 
				// 										id_pat='$id_pat' and id_doc='$id_doc' and time_stamp='$timestamp'";
				// // echo $query;
				// // Get the bytea data
				// $res = pg_query($query);  
				// $raw = pg_fetch_result($res, 'medical_cert');

				// // Convert to binary and send to the browser
				// header('Content-type: image/jpeg');
				
				// echo pg_unescape_bytea($raw);
			}
			else
			{
				echo pg_result_error($res);
				//echo "Rolling back transaction\n";
				pg_query("ROLLBACK") or die("Transaction ROLLBACK failed\n");
			}
			Redirect('index.php', false);
			pg_close($db);
		}

	}
	}
	else{
	  	Redirect('index.php', false);
	}

	function Redirect($url, $permanent = false)
	{
	    if (headers_sent() === false)
	    {
	    	header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
	    }

	    exit();
	}

?>
