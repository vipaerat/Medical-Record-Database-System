<?php
session_start();
include('../config.php');

$email = $_SESSION['email'];

$patientInfoQuery =<<<EOF
SELECT name,gender,date_of_birth
FROM patient
WHERE id_pat = '$email'
EOF;


$res = pg_query($db, $patientInfoQuery);
$row = pg_fetch_row($res);

$name = $row[0];
$gender = $row[1];
$date_of_birth = $row[2];



?>

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
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li class="active">
                        <a href="profile.html">Profile</a>
                    </li>
                    <li>
                        <a href="schedule.html">Schedule</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $email; ?> <b class="caret"></b></a>
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
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Profile
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a>
                    </li>
                    <li class="active">Profile</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <div class="row">
            <div class="col-md-8">
                <form class="form-horizontal" name="profile" id="profileForm" novalidate>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Name:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="name" value= "<?php echo $name; ?>" >
                            </div>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Gender:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" style="width:100px;" id="age" value= <?php echo $gender; ?>>
                            </div>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Age:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" style="width:100px;" id="age" value="">
                            </div>
                        </div>
                    </div>
                    <!-- required data-validation-required-message="Please enter your phone number." -->
                    <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Phone Number:</label>
                            <div class="col-md-9">
                                <input type="tel" class="form-control" style="width:300px;" id="phone" placeholder="Phone" value="">
                            </div>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Email Address:</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" id="email" placeholder="Email" readonly value= <?php echo $email; ?>>
                            </div>
                        </div>
                    </div>
                    <div id="extras"></div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Address:</label>
                            <div class="col-md-9">
                                <textarea rows="10" cols="50" class="form-control" id="address" maxlength="999" style="resize:none"></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <div class="btn-grp" style="float:right; margin-top:20px;">
                    <button class="btn btn-primary">Edit</button>
                    <button type="submit" class="btn btn-success" disabled>Save</button>
                </div>
                </form>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <img src="../images/pic.gif" class="img-thumbnail pic" width="150" height="180" alt="Thumbnail Image"><br>
                    <h4>Username</h4>
                </div>
            </div>
        </div>
        <!-- /.row -->

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
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

</body>

</html>
