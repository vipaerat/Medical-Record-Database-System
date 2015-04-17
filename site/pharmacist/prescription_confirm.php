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
		$suggmed = $_POST['suggmed'];
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
			$query1="INSERT INTO prescription(id_doc,id_pat,id_pha,time_stamp,description) values 
							('$id_doc','$id_pat','$id_pha','$timestamp','$description')";
			
			// echo $query;
			$flag=true;
			pg_query("BEGIN") or die ("Could not start transaction\n");
		
			pg_send_query($db,$query);
			$res = pg_get_result($db);
			
			pg_send_query($db,$query1);
			$res1 = pg_get_result($db);

			if(strcmp($suggmed, "None")!=0)
			{
				$suggmed = explode(",",$suggmed);
				$len = count($suggmed);
				for($i=0;$i<$len-1;$i++)
				{
					$med = explode("-", $suggmed[$i]);
					$query2 = "SELECT sum(quantity) FROM stock WHERE name='$med[0]' and dose='$med[1]';";

					$check_quantity = pg_fetch_row(pg_query($db,$query2));

					if($check_quantity[0]>$med[2])
					{	
						$query2 = "SELECT * FROM stock WHERE name='$med[0]' and dose='$med[1]' order by expiry_date;";

						$res = pg_fetch_all(pg_query($db,$query2));

						$temp = 0;

						for($j=0;$temp<$med[2];$j++)
						{
							$exp = $res[$j]['expiry_date'];

							if($res[$j]['quantity']>$med[2]-$temp)
							{
								$query3 = "UPDATE stock SET quantity = quantity-($med[2]-$temp) WHERE name='$med[0]' and dose='$med[1]' 
												and expiry_date = '$exp';";
								pg_query($db,$query3);
								break;
							}
							else
							{
								$query3 = "DELETE FROM stock WHERE name='$med[0]' and dose='$med[1]' and expiry_date = '$exp';";
								pg_query($db,$query3);
								$temp = $temp+$res[$j]['quantity'];
							}

						}

						
						$query3 = "INSERT INTO suggested_med values ('$id_doc','$id_pat','$id_pha','$med[0]','$med[1]','$med[2]','$timestamp')";
						pg_query($db,$query3);
					}
					else
					{
						$flag = false;
						echo "Not enough ".$med[0]." - ".$med[1]." in stock .\n";
						pg_query("ROLLBACK") or die("Transaction ROLLBACK failed\n");
					}
				}
			}
			else
			{
				$flag=false;
			}

			if(pg_result_error($res)==0 && pg_result_error($res1)==0 && pg_last_error()==null && $flag)
			{
				pg_query("COMMIT") or die("Transaction commit failed\n");
				echo "SUCCESS";
			}
			else
			{
				// echo pg_last_error();
				//echo pg_result_error($res1);
				// echo "Password correct, but database error has occurred.\n";
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
