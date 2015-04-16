<?php
include('../config.php');
	if(isset($email) && isset($type) ){
	if(!$db){
	echo "Error : Unable to open database\n";
	} 
	else
	{
		
		if(strcmp($type, "user")==0)
		  {
		  	$query = "SELECT name from Patient WHERE id_pat = '$email' ";
		  }
		  elseif (strcmp($type,"doctor")==0) {
			$query = "SELECT name from Doctor WHERE id_doc = '$email' "; 
		  }
		  elseif (strcmp($type,"pharmacist")==0) {
			$query = "SELECT name from Pharmacist WHERE id_pha = '$email' "; 
		  }
		
		// echo $query;
		// pg_send_query($db, $query);
		
  //   	$result = pg_get_result($db);
		  $result = pg_query($db, $query);


		if(pg_result_error($result))
			echo pg_result_error($result);
		else
		{
			if(pg_num_rows($result)==0)
				$res=0;
			else
				$res=pg_fetch_row($result);
		}
	// echo "Opened database successfully\n";
	}

	pg_close($db);
	}
	else{
	  	header('Location: index.php');
	}
?>
