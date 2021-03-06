<?php
session_start();
ob_start();
ini_set("display_errors",1);

if(isset($_SESSION['email']) && isset($_SESSION['name']) && isset($_SESSION['type']) && strcmp($_SESSION['type'],"pharmacist")==0 )
{
  $email = $_SESSION['email'];
  $name = $_SESSION['name'];
  $type = $_SESSION['type'];
  
  include('../verify.php');

  if($res==0)
  {
    session_destroy();
    header('Location: ../index.php');
  }
  else
    $username = $res[0];
}
else
{
  session_destroy();
  header('Location: ../index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">



<script type="text/javascript">
function fetchPres()
      {
        $.post("show_inventory.php",
          {
              query : document.getElementById('query').value
          }).done(function(data){
              $("#accordion").empty().append(data);
              $('[data-toggle="popover"]').popover({
                  placement : 'right'
                  });
          });
      }
      window.onload = fetchPres;
      </script> 
<title>Medical Record Managment System</title>



<link href="../css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="../css/custom.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('[data-toggle="popover"]').popover({
placement : 'right'
});
});
</script>

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
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="profile.php">Profile</a>
                    </li>
                    <li>
                        <a href="add_medicine.php">Add Medicines</a>
                    </li>
                    <li class="active">
                        <a href="inventory.php">Inventory</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $username; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="profile.php"><i class="fa fa-fw fa-user"></i>Profile</a>
                            </li>
                            <li>
                                <a href="logout.php"><i class="fa fa-fw fa-sign-out"></i>Signout</a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
            </div>
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
<input type="text" id="query" onkeyup="fetchPres()" class="form-control" placeholder="Search for...">
<span class="input-group-btn">
<button class="btn btn-default" name="search" onclick="fetchPres()" type="button"><i class="fa fa-search"></i></button>
</span>
</div>
<!-- /input-group -->
</div>
</div>

<div id="accordion">
</div>



</div>



</body>
</html>