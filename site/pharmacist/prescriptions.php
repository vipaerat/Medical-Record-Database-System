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
	

	if(isset($_POST['email'])&&isset($_POST['num_row']))
	{
		include '../config.php';

		$db = pg_connect("$host $port $dbname $user $password");

		if(!$db){
		echo pg_last_error();
		} 
		else {

		$id_pha = $_POST['email'];
		$numr = $_POST['num_row'];

		$search_query= $_POST['query'];

		// echo "Opened database successfully\n\n\n";
		if(strcmp($search_query,"")==0)
			$query = "SELECT * FROM temp_prescription ORDER BY status,time_stamp DESC;";
		else
			$query = "SELECT * FROM temp_prescription WHERE id_pat LIKE '%$search_query%' OR id_doc LIKE '%$search_query%' ORDER BY status,time_stamp DESC;";
		
		$result = pg_query($db,$query);
		// echo "Opened database successfully\n\n\n";
		$arr = pg_fetch_all($result);
		$num_rows = pg_num_rows($result);
		$body = "<div class=\"panel panel-default\">
				   <div class=\"panel-heading\" role=\"tab\" id=\"heading%d\">
				      <h4 class=\"panel-title\">
				         <a %s style='text-decoration:none' data-toggle=\"collapse\"  href=\"#collapse%d\" aria-expanded=\"%s\" aria-controls=\"collapse%d\">
				         Prescription #%d
				         </a>
				      </h4>
				   </div>
				   <div id=\"collapse%d\" class=\"panel-collapse %s\" role=\"tabpanel\" aria-labelledby=\"heading%d\">
				    <div class=\"panel-body\">
				    <div class='row'>
				    	<div class='col-md-8'>
				    		<table class='table text-left table-striped'>
							<tr><td class='col-md-4'><b>Patient:</b></td>
								<td class='col-md-4'>%s</td></tr>
							<tr><td class='col-md-4'><b>Doctor:</b></td>
								<td class='col-md-4'>%s</td></tr>
							<tr><td class='col-md-4'><b>Date:</b></td>
								<td class='col-md-4'>%s</td></tr>
							<tr><td class='col-md-4'><b>Description:</b></td>
								<td class='col-md-4'>%s</td></tr>
							<tr><td class='col-md-4'><b>Suggested Medicine:</b></td>
							<td><ul>%s</ul></td></tr>
							</table>
						</div>
						<div class='col-md-4'>
							<div class='row'>
								<button  type=\"button\" value=\"%s;%s;%s;%s;%s;%s;%s\" onclick=\"return confirm_patient(this.value);\" class=\"%s\">%s</button>
							</div>
						</div>
					</div>
				    </div>
				   </div>
				</div>";

		$text="";
		$format = 'd-m-Y';

		for($row=0;$row<$numr&&$row<$num_rows;$row++)
		{
			$id_pat = $arr[$row]['id_pat'];
			$id_doc = $arr[$row]['id_doc'];
			$status = intval($arr[$row]['status']);

			$query = "SELECT name FROM Patient WHERE id_pat = '$id_pat'";
	  		$res = pg_query($db,$query);
	  		$res = pg_fetch_row($res);
	  		$username = $res[0];

	  		$query = "SELECT name FROM Doctor WHERE id_doc = '$id_doc'";
	  		$res = pg_query($db,$query);
	  		$res = pg_fetch_row($res);
	  		$doc = $res[0];

	  		$timestamp = $arr[$row]['time_stamp'];
	  		$description = $arr[$row]['description'];

	  		$query = "SELECT name,dose,quantity FROM temp_suggested_med WHERE id_doc = '$id_doc' AND id_pat = '$id_pat' AND time_stamp='$timestamp'";
			//echo $query;
	  		$res = pg_query($db,$query);
	  		$numrows = pg_num_rows($res);
	  		$res = pg_fetch_all($res);

	  		$med_text="";
	  		$suggmed="";

			if($numrows==0)
	  		{
	  			$med_text="None";
	  			$suggmed = "None";
	  		}

			for($i=0;$i<$numrows;$i++)
			{
				$suggmed = $suggmed.$res[$i]['name']."-".$res[$i]['dose']."-".$res[$i]['quantity'].",";
				$med_text=$med_text."<li>".$res[$i]['name']." (".$res[$i]['dose'].") - ".$res[$i]['quantity']."</li>";
			}

			// if($row==0)
			// {
		  		

		  		if($status==0)
		  		{
		  			$text = $text.sprintf($body,$row+1,'class="btn-block"',$row+1,'true',$row+1,$row+1,$row+1,'in',$row+1,
		  			$username,$doc,date($format, strtotime($timestamp)),$description,$med_text,
		  			$id_doc,$id_pha,$id_pat,$timestamp,$description,"pending",$suggmed,"btn btn-primary","Deliver");
		  		}
		  		else
		  		{
		  			$text = $text.sprintf($body,$row+1,'class="btn-block"',$row+1,'true',$row+1,$row+1,$row+1,'in',$row+1,
		  			$username,$doc,date($format, strtotime($timestamp)),$description,$med_text,
		  			$id_doc,$id_pha,$id_pat,$timestamp,$description,"delivered",$suggmed,"btn btn-success","Delivered");
		  		}
		  	// }
		 //  	else
		 //  	{
		  		
		 //  		if($status==0)
		 //  		{
		 //  			$text = $text.sprintf($body,$row+1,'class="collapsed"',$row+1,'false',$row+1,$row+1,$row+1,'',$row+1,
		 //  			$username,$doc,date($format, strtotime($arr[$row]['time_stamp'])),$arr[$row]['description'],
		 //  			$id_doc,$id_pha,$id_pat,$arr[$row]['time_stamp'],$arr[$row]['description'],"pending","btn btn-primary","Deliver");
		 //  		}
		 //  		else
		 //  		{
		 //  			$text = $text.sprintf($body,$row+1,'class="collapsed"',$row+1,'false',$row+1,$row+1,$row+1,'',$row+1,
		 //  			$username,$doc,date($format, strtotime($arr[$row]['time_stamp'])),$arr[$row]['description'],
		 //  			$id_doc,$id_pha,$id_pat,$arr[$row]['time_stamp'],$arr[$row]['description'],"delivered","btn btn-success","Delivered");
		 //  		}
			// }
		}

		echo $text;
		}

		pg_close($db);
	}
	else
	{
		echo "email not set";
		// function to Reset Session variable 
		header('Location: index.php');
	}
?>
