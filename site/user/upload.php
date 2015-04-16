<?php
	if(isset($_POST['id_doc'])&&isset($_POST['id_pat'])&&isset($_POST['id_pha'])){
		
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
			$error = $_FILES['file']['error'];
			echo "<span class='btn-warning'>File upload error $error<span>";
    		Redirect('index.php',false);
		}

		$file = $_FILES['file']['tmp_name'];
		$file_name = $_FILES['file']['name'];

		if(!move_uploaded_file($file, '../tmp/'.$file_name)){
    				echo "failed";
    				Redirect('index.php', false);
		}
		else
		{
			// echo "Success";
			
			$data = file_get_contents( '../tmp/'.$file_name );

			$escaped = pg_escape_bytea($data);
			
			$query = "INSERT INTO Test_result(id_doc,id_pat,id_pha,time_stamp,test_result) VALUES ('$id_doc','$id_pat','$id_pha','$timestamp','$escaped')";
			// echo $query;

			pg_query("BEGIN") or die ("Could not start transaction\n");
		
			pg_send_query($db,$query);
			$res = pg_get_result($db);
			
			if(pg_result_error($res)==0)
			{
				// echo pg_last_error();
				// echo "Commiting transaction\n";
				pg_query("COMMIT") or die("Transaction commit failed\n");
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