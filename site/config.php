<?php
   $host = "host=localhost";
   $port = "port=5432";
   $dbname = "dbname=meddb";
   $user = "user=meddb";
   $password = "password=meddb";

   $db = pg_connect( "$host $port $dbname $user $password"  );
   if(!$db){
      echo "Error : Unable to open database\n";
   } else {
      // echo "Opened database successfully\n";
   }
?>
