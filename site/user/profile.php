<?php
session_start();
include('../config.php');

$email = $_SESSION['email'];

$patientInfoQuery =<<<EOF
SELECT name,gender,age(current_date,date_of_birth)
FROM patient
WHERE id_pat = '$email'
EOF;


$res = pg_query($db, $patientInfoQuery);
$row = pg_fetch_row($res);

$name = $row[0];
$gender = $row[1];
$date_of_birth = $row[2];

$phone_number="";
$address="";

$patientTypeQuery =<<<EOF
SELECT (CASE 
WHEN (exists (select * from student where id_std = '$email' )) THEN 'student'
WHEN (exists (select * from employee where id_emp = '$email' )) THEN 'employee'
WHEN (exists (select * from dependent where id_dep = '$email' )) THEN 'dependant'
ELSE 'none'
END)
EOF;

$res = pg_query($db, $patientTypeQuery);
$row = pg_fetch_row($res);

$patientType = $row[0];
//echo $patientType;

if ($patientType=='student'){
        $studentQuery = <<<EOF
        SELECT room_no,hostel_name 
        FROM student
        WHERE id_std = '$email'
EOF;

        $res = pg_query($db, $studentQuery);
        $row = pg_fetch_row($res);

        $address = "Room No. ".$row[0].", ".$row[1]." Hostel, Indian Institute of Technology Ropar, Nangal Road, Rupnagar, Punjab, INDIA 140001";


        $phoneQuery = <<<EOF
        SELECT phone_no 
        FROM std_phone
        WHERE id_std = '$email'
EOF;
        
        $res = pg_query($db, $phoneQuery);
        $row = pg_fetch_row($res);

        $phone_number = $row[0];

}

else if ($patientType=='employee'){
        $employeeQuery = <<<EOF
        SELECT house_no,  city,  state,  pin_code
        FROM employee
        WHERE id_emp = '$email'
EOF;

        $res = pg_query($db, $employeeQuery);
        $row = pg_fetch_row($res);

        $address = "House No. ".$row[0].", ".$row[1].", ".$row[2].", Pincode: ".$row[3];

        

        $phoneQuery = <<<EOF
        SELECT phone_no 
        FROM emp_phone
        WHERE id_emp = '$email'
EOF;
        
        $res = pg_query($db, $phoneQuery);
        $row = pg_fetch_row($res);

        $phone_number = $row[0];
        
}

else if ($patientType=='dependant'){
        $dependantQuery = <<<EOF
        SELECT house_no,  city,  state,  pin_code
        FROM employee
        WHERE id_emp = (SELECT id_fac FROM depends_on WHERE id_dep = '$email')
EOF;

        $res = pg_query($db, $dependantQuery);
        $row = pg_fetch_row($res);

        $address = "House No. ".$row[0].", ".$row[1].", ".$row[2].", Pincode: ".$row[3];

        $phoneQuery = <<<EOF
        SELECT phone_no 
        FROM emp_phone
        WHERE id_emp = (SELECT id_fac FROM depends_on WHERE id_dep = '$email')
EOF;
        
        $res = pg_query($db, $phoneQuery);
        $row = pg_fetch_row($res);

        $phone_number = $row[0];
        
}


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
                <div class="container" id="initial" >
                    <div class="row">
                    <div class="col-md-2"><span>Name:</span></div>
                    <div class="col-md-8"><span><?php echo $name; ?></span></div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-2"><span>Gender:</span></div>
                    <div class="col-md-8"><span><?php echo $gender; ?></span></div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-2"><span>Age:</span></div>
                    <div class="col-md-8"><span><?php echo $date_of_birth; ?></span></div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-2"><span>Phone Number:</span></div>
                    <div class="col-md-8"><span><?php echo $phone_number; ?></span></div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-2"><span>Email:</span></div>
                    <div class="col-md-8"><span><?php echo $email; ?></span></div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-2"><span>Address:</span></div>
                    <div class="col-md-6"><span><p><?php echo $address; ?></p></span></div>
                    </div>
                </div>

                <form class="form-horizontal" name="profile" id="profileForm" novalidate>
                    <fieldset id="editForm" style="display:none;">
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
                                <input type="text" class="form-control" style="width:100px;" id="age" value= <?php echo $date_of_birth; ?> >
                            </div>
                        </div>
                    </div>
                    <!-- required data-validation-required-message="Please enter your phone number." -->
                    <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Phone Number:</label>
                            <div class="col-md-9">
                                <input type="tel" class="form-control" style="width:300px;" id="phone" placeholder="Phone" value=<?php echo $phone_number; ?>>
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
                                <textarea rows="10" cols="50" class="form-control" id="address" maxlength="999" style="resize:none"><?php echo $address; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="success"></div>
                    </fieldset>
                    <!-- For success/fail messages -->
                    <div class="btn-grp" style="float:left; margin-top:20px;">
                    <button class="btn btn-primary" id="edit" onclick="editFormFucntion(); return false;">Edit</button>
                    <button type="submit" class="btn btn-success" id="save" disabled>Save</button>
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
    <script type="text/javascript">
    function editFormFucntion(){
       
       document.getElementById("initial").style.display="none";
       document.getElementById("editForm").removeAttribute("style");
       document.getElementById("save").removeAttribute("disabled");
       document.getElementById("edit").setAttribute("disabled","disabled");
       // document.getElementById("editForm").style.display="true";
    //document.getElementById("edit").setAttribute("disabled","disabled");
    // document.getElementById("edit").removeAttr("disabled");
    }
    </script>
    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>
