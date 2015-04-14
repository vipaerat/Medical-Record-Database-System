<?php
	session_start();
	$email = $_SESSION['email'];
	$name = $_SESSION['name'];  //Google profile name of user
	$type = $_SESSION['type'];

	if(isset($email) && isset($name) && isset($type) && strcmp($type,"user")==0)
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

		$email = $_POST['email'];
		$numr = $_POST['num_row'];

		// echo "Opened database successfully\n\n\n";
		$result = pg_query($db,"SELECT * FROM Prescription WHERE id_pat = '$email';");

		$arr = pg_fetch_all($result);
		$num_rows = pg_num_rows($result);

		$body = "<div class=\"panel panel-default\">
				   <div class=\"panel-heading\" role=\"tab\" id=\"heading%d\">
				      <h4 class=\"panel-title\">
				         <a %s data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse%d\" aria-expanded=\"%s\" aria-controls=\"collapse%d\">
				         Prescription #%d
				         </a>
				      </h4>
				   </div>
				   <div id=\"collapse%d\" class=\"panel-collapse collapse %s\" role=\"tabpanel\" aria-labelledby=\"heading%d\">
				    <div class=\"panel-body\">
				    <div class='row'>
				    	<div class='col-md-8'>
				    		<table class='table'>
							<tr><td><b>Patient:</b></td>
								<td>%s</td></tr>
							<tr><td><b>Doctor:</b></td>
								<td>%s</td></tr>
							<tr><td><b>Pharmacist:</b></td>
								<td>%s</td></tr>
							<tr><td><b>Date:</b></td>
								<td>%s</td></tr>
							<tr><td><b>Description:</b></td>
								<td>%s</td></tr>
							<tr><td><b>Certificate:</b></td>
							<td>%s</td></tr>
							</table>
						</div>
						<div class='col-md-4'>
						<form action='upload.php' method='post' enctype='multipart/form-data'>
							<div class='row'>
								<input type='hidden' name='id_doc' value='%s'/>
								<input type='hidden' name='id_pha' value='%s'/>
								<input type='hidden' name='id_pat' value='%s'/>
								<input type='hidden' name='timestamp' value='%s'/>
								<span class='btn btn-default btn-file'>Browse
									<input type='file' name='file' id='file'/>
									<br>
								</span>
								<span id='filelabel'></span>
							</div>
							<br>
							<div class='row'>
								<button type='submit' id='upload' class='btn btn-primary'>Upload</button>
							</div>
						</form>
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
			$id_pha = $arr[$row]['id_pha'];

			$query = "SELECT name FROM Patient WHERE id_pat = '$id_pat'";
	  		$res = pg_query($db,$query);
	  		$res = pg_fetch_row($res);
	  		$username = $res[0];

	  		$query = "SELECT name FROM Doctor WHERE id_doc = '$id_doc'";
	  		$res = pg_query($db,$query);
	  		$res = pg_fetch_row($res);
	  		$doc = $res[0];

	  		$query = "SELECT name FROM Pharmacist WHERE id_pha = '$id_pha'";
	  		$res = pg_query($db,$query);
	  		$res = pg_fetch_row($res);
	  		$pha = $res[0];

			if($arr[$row]['medical_cert']!=null)
				{
					$base64 = 'data:image/jpeg;base64,' . base64_encode(pg_unescape_bytea($arr[$row]['medical_cert']));
					$base64="<img id='medcert' src=$base64 width='30' height='40'></img>";
				}
			else
				$base64="None";

			if($row==0)
			{
		  		$text = $text.sprintf($body,$row+1,'',$row+1,'true',$row+1,$row+1,$row+1,'in',$row+1,
		  			$username,$doc,$pha,date($format, strtotime($arr[$row]['time_stamp'])),$arr[$row]['description'],
		  			$base64,$id_doc,$id_pha,$id_pat,$arr[$row]['time_stamp']);
		  	}
		  	else
		  	{
		  		$text = $text.sprintf($body,$row+1,'class="collapsed"',$row+1,'false',$row+1,$row+1,$row+1,'',$row+1,
		  			$username,$doc,$pha,date($format, strtotime($arr[$row]['time_stamp'])),$arr[$row]['description'],
		  			$base64,$id_doc,$id_pha,$id_pat,$arr[$row]['time_stamp']);
			}
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
