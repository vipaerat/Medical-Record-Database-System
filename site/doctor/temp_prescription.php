<?php
if (isset($_POST['submit'])&& isset($_POST['userid']) && isset($_POST['name']) && isset($_POST['dose']) && isset($_POST['amount']) && isset($_GET['doctorid']))
{
	include '../config.php';

	$userid = $_POST['userid'];
	$description = $_POST['description'];
	$med_name = $_POST['name'];
	$med_dose = $_POST['dose'];
	$med_amount = $_POST['amount'];
	$doctorid = $_GET['doctorid'];
	
	
	$t= time();
	$timestamp= date("Y-m-d H:i:s",$t);

	$query =  "INSERT INTO Temp_Prescription(id_doc,id_pat,time_stamp,description, status)
					 VALUES ( '$doctorid','$userid','$timestamp','$description' , 0 );";
	//echo $query;

	pg_query("BEGIN") or die ("Could not start transaction\n");
		
	$res = pg_query($db,$query);

	$flag = checkerror();

	for($i=0;$i<(count($med_dose)-1) && !$flag;$i++)
	{
		$query= "INSERT INTO Temp_Suggested_med VALUES ( '$doctorid','$userid','$med_name[$i]','$med_dose[$i]','$med_amount[$i]','$timestamp');";
	//echo $query;
		$res=pg_query($db,$query);
		echo $i;
		$flag = checkerror();
	}

	if(!$flag)
	{
		pg_query("COMMIT") or die("Transaction commit failed\n");
		echo "SUCCESS";
		pg_close($db);

		header("Location: prescribe.php?error=");
	}
	else
	{
		// echo pg_result_error($res);
		// echo pg_result_error($res1);
		$message = pg_last_error();
		echo $message;
		pg_query("ROLLBACK") or die("Transaction ROLLBACK failed\n");
		$escape = array("\\", "\"", " ","\n");
		$location = "Location: prescribe.php?error="."An error occured. Please check the input.";
		// echo $location;
		pg_close($db);
		header($location);
	}
}
else
{
	header("Location: prescribe.php");
}

function checkerror()
{
	$f = false;
	if(pg_last_error()!=null)
	{
		$f = true;
	}

	return $f;
	
}
?>