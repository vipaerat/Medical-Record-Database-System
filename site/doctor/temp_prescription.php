<?php
if (isset($_POST['submit'])&& isset($_POST['userid']) && isset($_POST['name']) && isset($_POST['dose']) && isset($_POST['amount']) && isset($_GET['doctorid']))
{
	$userid = $_POST['userid'];
	$description = $_POST['description'];
	$med_name = $_POST['name'];
	$med_dose = $_POST['dose'];
	$med_amount = $_POST['amount'];
	$doctorid = $_GET['doctorid'];
	
	
	$t= time();
	$timestamp= date("Y-m-d H:i:s",$t);

	$query =  "INSERT INTO Temp_Prescription VALUES ( '$doctorid','$userid','$timestamp','$description' , null );";
	//echo $query;
}



	
	$connect = pg_connect("host=localhost user=meddb port=5432 dbname=meddb password=meddb") 
	or die("Could not connect " . pg_last_error());
	
	
		
		
$result = pg_query($query); 
if (!$result) { 
    printf ("ERROR"); 
    $errormessage = pg_errormessage($connect); 
    echo $errormessage; 	
	}

	for($i=0;$i<count($med_dose)-1;$i++)
	{
		$query= "INSERT INTO Temp_Suggested_med VALUES ( '$doctorid','$userid','$med_name[$i]','$med_dose[$i]','$med_amount[$i]','$timestamp');";
	//echo $query;
	
	$result = pg_query($query); 
if (!$result) { 
    printf ("ERROR"); 
    $errormessage = pg_errormessage($connect); 
    echo $errormessage; 	
	}
	}
	
	header("Location: prescribe.php");
?>