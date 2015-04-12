<html>
<body>
	<?php 
		$c=1;
		error_reporting(E_ALL);
		if (isset($_POST["email"]) && isset($_POST["password"])) {
			// echo "true";
			$email=$_POST["email"];
			$pass=$_POST["password"];
			$conn_string = "host=localhost port=5432 dbname=test user=postgres password=postgres";
			$dbconn = pg_connect($conn_string) or die ("Could not connect".pg_last_error());
			$sql1="select id_std,password from student";
			//$sql2="select password from student";
			$result1=pg_query($dbconn,$sql1);
			//$result2=pg_query($dbconn,$sql2);
			$arr1=pg_fetch_all($result1);
			//$arr2=pg_fetch_all($result2);
			//print_r($arr1);
			for ($i=0; $i< sizeof($arr1); $i++) { 
				if ($arr1[$i]["password"]==$pass && $arr1[$i]["id_std"]==$email) {
					$c=0;
				}

			}
		
			if ($c==1) {
				echo "No such password combination found";
				header("Location:verify.html");
				exit();
			} else {
				echo "Verified";
			}
			


		}	

	?>
</body>
</html>
