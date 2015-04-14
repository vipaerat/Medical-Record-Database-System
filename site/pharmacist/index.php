<!DOCTYPE html>
<html lang="en">


  

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Medical Record Managment System</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/custom.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="../index.php" class="navbar-brand"><p class="brand">MEDICAL RECORDS</p></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active">
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="profile.html">Profile</a>
                    </li>
                    <li>
                        <a href="schedule.html">Schedule</a>
                    </li>
                    <li>
                        <a href="add_medicine.php">Add Medicines</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Username<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="profile.html"><i class="fa fa-fw fa-user"></i>Profile</a>
                            </li>
                            <li>
                                <a href="../index.php"><i class="fa fa-fw fa-sign-out"></i>Signout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>-->
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
   <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
    
    
            <div class="col-lg-12">
                <h1 class="page-header">Medicine Inventory
                </h1>
                
            </div>
    
        </div>
    
        <div class="row">
                      <div class="col-md-6 col-md-offset-3 searchbox">
                         <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                            </span>
                         </div>
                         <!-- /input-group -->
                      </div>
        </div>
        
   
   

        
 <?php  
     $host        = "host=localhost";
    $port        = "port=5432";
     $dbname      = "dbname=medicaldb";
     $credentials = "user=new_user password=divya";

     $db = pg_connect( "$host $port $dbname $credentials"  );
        
       
        
    //Some rough php code to connect to db and returns the Stock table 
     
  /*  
   $sql =
      "SELECT * from stock;";

   $ret = pg_query($sql);
        
  
   $i=0;
    echo $field;
    echo ' <div class="table-responsive">          
      <table class="table">
        <thead>
          <tr>';
            
         
   
   while($i<pg_num_fields($ret))
   {
	$field=pg_field_name($ret,$i);
	
		 
        echo '<th>',$field ,'</th>';
      
      
	//$field;
	$i=$i+1;
   }
   
  
   echo '</tr> </thead> <tbody>';
 $k=0;
   while($row = pg_fetch_row($ret)){
	   $j=0;
	   echo '<tr>';
			while($j<pg_num_fields($ret))
			{
				 echo '<td>',$row[$j] ,'</td>';
				 $j=$j+1;
			}
			
			
	   echo '</tr>';
	  $k=$k+1; 
   }
 
	
	
	echo '</tbody></table> </div>';
	
	*/
   pg_close($db);
?>

  

 <script language="JavaScript">
   function setVisibility(id) {
    if(document.getElementById('v').value=='H'){
      document.getElementById('v').value = 'S';
      document.getElementById(id).style.display = 'none';
    }else{
      document.getElementById('v').value = 'H';
      
      document.getElementById(id).style.display = 'inline';
    }
 } 
</script>
        
     
         
     <input type=button name=type id='v' value='S' onclick="setVisibility('dd');";> 

     <div id="dd" style="display:none">Message</div>   
        
        
        
        
        
        
        
        
        
        
        
        
    </div> <!-- container -->
    
    
    
    
    
    
    
    
    
    
</body>

</html>
