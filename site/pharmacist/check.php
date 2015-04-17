<?php

if(isset($_POST['email']))
{
	include '../config.php';

	$res = pg_query($db,"SELECT * FROM temp_prescription");

	echo pg_num_rows($res);
}
?>

<?php 
          include '../config.php';
          
          function checkPending()
          {
            $res = pg_query($db,"SELECT * FROM temp_prescription");
            echo pg_num_rows($res);
          }
          ?>