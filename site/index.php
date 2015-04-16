<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script src="./files/jquery.js" type="text/javascript"></script>
    <title>Medical Record Managment System</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                <a href="index.php" class="navbar-brand"><p class="brand">MEDICAL RECORDS</p></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right" >
                    <li class="active">
                        <a href="index.php">Home</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="page-header">
                    <b>Medical Database Management System </b>
                </h1>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-user"></i> Login </h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                        <div class="col-md-3">
                        <div class="container">
                        <div class="btn-margin"><button class="btn btn-default" onclick="userlogin()">User</button></div>
                        <div class="btn-margin"><button class="btn btn-default" onclick="doctorlogin()">Doctor</button></div>
                        <div class="btn-margin"><button class="btn btn-default" onclick="phalogin()">Pharmacist</button></div>
                        </div>
                        </div>
                        <div class="col-md-5" style="margin-left:60px">
                            <div class="container">
                        <div class="btn-margin" style="margin-top:50px;">
                            <a href="#"><button class="btn btn-default">Not Registered?</button></a>
                        </div>
                        <!-- container -->
                        </div>
                        <!-- col-md -->
                        </div>
                        <!-- row -->
                    </div>
                    <!-- panel-body -->
                    </div>
                    <!-- col-md-4 -->
                </div>
            </div>
        </div>

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Medical Database Management System 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
	function userlogin()
	{
		$.post("auth.php",
			{
				type : "user",
			}
	).done(function (data) {
		//alert(data);
	  	window.location = data;
	});
	}
	
	function doctorlogin()
	{
		$.post("auth.php",
			{
				type : "doctor",
			}
		).done(function (data) {
		//alert(data);
	  	window.location = data;
	});
	}
	
	function phalogin()
	{
		$.post("auth.php",
			{
				type : "pharmacist",
			}
		).done(function (data) {
		//alert(data);
	  	window.location = data;
	});
	}
	
</script>

</body>



</html>
