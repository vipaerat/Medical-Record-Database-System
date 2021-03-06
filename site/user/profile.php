<?php
session_start();

if(isset($_SESSION['email']) && isset($_SESSION['name']) && isset($_SESSION['type']) && strcmp($_SESSION['type'],"user")==0 )
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

include('../config.php');

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


if (isset($_POST['save']))
   {

        $post_name = $_POST['name'];
        $post_gender =$_POST['gender'];
        $post_dob = $_POST['dob'];
        $post_phone_number = $_POST['phone'];

        $UpdatePatientInfoQuery = "UPDATE patient
        SET name = '$post_name', gender = '$post_gender', date_of_birth = '$post_dob'
        WHERE id_pat = '$email';";

        $UpdatePhoneQuery = "";
        $UpdateAddressQuery = "";

        if ($patientType=='student'){
        
            $post_room_no = $_POST['room_no'];
            $post_hostel_name = $_POST['hostel_name'];
           
            $UpdateAddressQuery = "UPDATE student
            SET room_no = '$post_room_no', hostel_name = '$post_hostel_name'
            WHERE id_std = '$email';";



            $phone = $_POST['phone'];

            $query = "DELETE FROM std_phone WHERE id_std='$email';";

            for($i = 0;$i < count($phone) - 1; $i++)
            {
                $phone_no = $phone[$i];
                if(strlen($phone_no) > 0)
                {
                    $query = $query . "INSERT INTO std_phone(id_std,phone_no) values('$email','$phone_no');";
                }
            }

            $UpdatePhoneQuery = $query;
            //echo $UpdateAddressQuery;
            //$res = pg_query($db, $UpdateAddressQuery);

        }

        else if ($patientType=='employee'){

            $post_house_no = $_POST['house_no'];
            $post_city = $_POST['city'];
            $post_state = $_POST['state'];
            $post_pin_code = $_POST['pin_code'];

            $UpdateAddressQuery = "UPDATE employee
            SET house_no = '$post_house_no',  city = '$post_city',  state = '$post_state',  pin_code = '$post_pin_code'
            WHERE id_emp = '$email';";

            //$res = pg_query($db, $UpdateAddressQuery);

            $phone = $_POST['phone'];

            $query = "DELETE FROM emp_phone WHERE id_emp='$email';";

            for($i = 0;$i < count($phone) - 1; $i++)
            {
                $phone_no = $phone[$i];
                if(strlen($phone_no) > 0)
                {
                    $query = $query . "INSERT INTO emp_phone(id_emp,phone_no) values('$email','$phone_no');";
                }
            }

            $UpdatePhoneQuery = $query;
                               
        }

        $UpdatePatientInfoQuery = $UpdatePatientInfoQuery.$UpdateAddressQuery.$UpdatePhoneQuery;
        // echo $UpdatePatientInfoQuery;

        $res = pg_query($db, $UpdatePatientInfoQuery);

    
   } 


// Extracting Patient Information from database to display

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

$age = (new DateTime($date_of_birth))->diff(new DateTime('today'))->y;

$phone_number="";
$address="";


// echo $patientType;

if ($patientType=='student'){
        $studentQuery = <<<EOF
        SELECT room_no,hostel_name 
        FROM student
        WHERE id_std = '$email'
EOF;

        $res = pg_query($db, $studentQuery);
        $row = pg_fetch_row($res);

        $room_no = $row[0];
        $hostel_name = $row[1];

        $address = "Room No. ".$room_no.", ".$hostel_name." Hostel, Indian Institute of Technology Ropar, Nangal Road, Rupnagar, Punjab, INDIA 140001";


        $phoneQuery = <<<EOF
            SELECT phone_no 
            FROM std_phone
            WHERE id_std = '$email'
EOF;

        $res = pg_query($db, $phoneQuery);

        $i = 0;
        
        while($phone_no = pg_fetch_row($res))
            {
                $phone_number[$i] = $phone_no[0];
                $i = $i + 1;
            }


}

else if ($patientType=='employee'){
        $employeeQuery = <<<EOF
        SELECT house_no,  city,  state,  pin_code
        FROM employee
        WHERE id_emp = '$email'
EOF;

        $res = pg_query($db, $employeeQuery);
        $row = pg_fetch_row($res);


        $house_no = $row[0];
        $city = $row[1];
        $state = $row[2];
        $pin_code = $row[3];

        $address = "House No. ".$house_no.", ".$city.", ".$state.", Pincode: ".$pin_code;


         $phoneQuery = <<<EOF
            SELECT phone_no 
            FROM emp_phone
            WHERE id_emp = '$email'
EOF;

        $res = pg_query($db, $phoneQuery);

        $i = 0;
        
        while($phone_no = pg_fetch_row($res))
            {
                $phone_number[$i] = $phone_no[0];
                $i = $i + 1;
            }
        
}

else if ($patientType=='dependant'){
        $dependantQuery = <<<EOF
        SELECT house_no,  city,  state,  pin_code
        FROM employee
        WHERE id_emp = (SELECT id_fac FROM depends_on WHERE id_dep = '$email')
EOF;

        $res = pg_query($db, $dependantQuery);
        $row = pg_fetch_row($res);

        $house_no = $row[0];
        $city = $row[1];
        $state = $row[2];
        $pin_code = $row[3];

        $address = "House No. ".$house_no.", ".$city.", ".$state.", Pincode: ".$pin_code;

    
        $phoneQuery = <<<EOF
            SELECT phone_no 
            FROM emp_phone
            WHERE id_emp = (SELECT id_fac FROM depends_on WHERE id_dep = '$email')
EOF;

        $res = pg_query($db, $phoneQuery);

        $i = 0;
        
        while($phone_no = pg_fetch_row($res))
            {
                $phone_number[$i] = $phone_no[0];
                $i = $i + 1;
            }
        
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
                <a href="logout.php" class="navbar-brand"><p class="brand">MEDICAL RECORDS</p></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li class="active">
                        <a href="profile.php">Profile</a>
                    </li>
                    <li>
                        <a href="schedule.php">Schedule</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $username; ?><b class="caret"></b></a>
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
       
        <!-- The Profile details are displayed here -->
        <div class="row">
            <div class="col-md-8"> 
                <div class="container" id="initial" >
                    <div class="row">
                    <div class="col-md-2"><span><b>Name:</b></span></div>
                    <div class="col-md-8"><span><?php echo $name; ?></span></div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-2"><span><b>Gender:</b></span></div>
                    <div class="col-md-8"><span><?php echo $gender; ?></span></div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-2"><span><b>Age:</b></span></div>
                    <div class="col-md-8"><span><?php echo $age; ?></span></div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-2"><span><b>Phone Number:</b></span></div>
                    <div class="col-md-8"><span><?php
                     for($i = 0;$i < count($phone_number) ;$i++)
                     {
                        echo $phone_number[$i] . "<br/><br/>"; 
                     }
                     ?></span></div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-2"><span><b>Email:</b></span></div>
                    <div class="col-md-8"><span><?php echo $email; ?></span></div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-2"><span><b>Address:</b></span></div>
                    <div class="col-md-6"><span><p><?php echo $address; ?></p></span></div>
                    </div>
                </div>

            <!-- Profile Edit form -->

                <form class="form-horizontal" name="profile" id="profileForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method= "POST">
                    <fieldset id="editForm" style="display:none;">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Name:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="name" value= "<?php echo $name; ?>" >
                            </div>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Gender:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" style="width:100px;" name="gender" value= "<?php echo $gender; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Date of Birth:</label>
                            <div class="col-md-9">
                                <input type="date" class="form-control"  style="width:200px;" name="dob" value="<?php echo $date_of_birth; ?>" >
                            </div>
                        </div>
                    </div>

                           <div class="control-group form-group">
                        <div class="controls">
                        <label class="control-label col-md-3">Phone Number:</label>
                        <div class="col-md-9" id="addnum">
                        <!-- <button class="btn btn-primary" onclick="return addmed();">Add Medicine</button> -->
                        <?php
                            for($i = 0;$i < count($phone_number) ;$i++)
                            {
                        ?>
                            <div class="form-group num-group">
                               <div class="col-xs-7">
                                <input type="text" <?php if ($patientType=='dependant') echo 'readonly' ?> value="<?php echo $phone_number[$i]; ?>" class="form-control" name="phone[]" />
                               </div>
                               <div class="col-xs-4">
                                  <button type="button" class="btn btn-default removeButton" 
                                  <?php if ($patientType=='dependant') echo 'style="display: none;"' ?> >
                                    <i class="fa fa-minus"></i>
                                  </button>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="form-group num-group hide" id="optionTemplate">
                               <div class="col-xs-7">
                                <input class="form-control" type="text" name="phone[]" />
                               </div>
                               <div class="col-xs-4">
                                <button type="button" class="btn btn-default removeButton"
                                <?php if ($patientType=='dependant') echo 'style="display: none;"' ?> >
                                    <i class="fa fa-minus"></i>
                                </button>
                               </div>
                            </div>
                            <div class="row" style="margin-left:2px;">
                                <button type="button" class="btn btn-default addButton"
                                <?php if ($patientType=='dependant') echo 'style="display: none;"' ?> >
                                    <i class="fa fa-plus"></i>&nbsp;Add Phone Number
                                </button>
                            </div>
                       </div>
                      </div><!--controls-->
                    </div><!---control-group-->
                     <!-- jQuery -->
    <script src="../js/jquery.js"></script>
    <script type="text/JavaScript">
        $("#addnum").on('click', '.addButton', function() {
            var $template = $('#optionTemplate'),
                $clone    = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .insertBefore($template);
        })

        // Remove button click handler
        .on('click', '.removeButton', function() {
            var $row    = $(this).parents('.num-group');

            // Remove element containing the option
            $row.remove();
        });
    </script>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Email Address:</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" name="email" placeholder="Email" readonly value= "<?php echo $email; ?>">
                            </div>
                        </div>
                    </div>

                    <?php  

                    if ($patientType=='student'){

                       // room_no,hostel_name

                        echo '<div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Room Number:</label>
                            <div class="col-md-9">
                                <input type="tel" class="form-control" style="width:300px;" name="room_no" value="'.$room_no.'">
                            </div>
                        </div>
                        </div>';

                        echo '<div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Hostel Name:</label>
                            <div class="col-md-9">
                                <input type="tel" class="form-control" style="width:300px;" name="hostel_name" value="'.$hostel_name.'">
                            </div>
                        </div>
                        </div>';
                           
                    }

                    else if ($patientType=='employee'){
                        //$house_no, $city, $state, $pin_code
                        echo '<div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">House Number:</label>
                            <div class="col-md-9">
                                <input type="tel" class="form-control" style="width:300px;" name="house_no" value="'.$house_no.'">
                            </div>
                        </div>
                        </div>';

                        echo '<div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">City:</label>
                            <div class="col-md-9">
                                <input type="tel" class="form-control" style="width:300px;" name="city" value="'.$city.'">
                            </div>
                        </div>
                        </div>';

                        echo '<div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">State:</label>
                            <div class="col-md-9">
                                <input type="tel" class="form-control" style="width:300px;" name="state" value="'.$state.'">
                            </div>
                        </div>
                        </div>';  

                        echo '<div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Pincode:</label>
                            <div class="col-md-9">
                                <input type="tel" class="form-control" style="width:300px;" name="pin_code" value="'.$pin_code.'">
                            </div>
                        </div>
                        </div>';       
                    }

                    else if ($patientType=='dependant'){
                           
                        echo '<div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">House Number:</label>
                            <div class="col-md-9">
                                <input type="tel" class="form-control" style="width:300px;" name="house_no" readonly value="'.$house_no.'">
                            </div>
                        </div>
                        </div>';

                        echo '<div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">City:</label>
                            <div class="col-md-9">
                                <input type="tel" class="form-control" style="width:300px;" name="city" readonly value="'.$city.'">
                            </div>
                        </div>
                        </div>';

                        echo '<div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">State:</label>
                            <div class="col-md-9">
                                <input type="tel" class="form-control" style="width:300px;" name="state" readonly value="'.$state.'">
                            </div>
                        </div>
                        </div>';  

                        echo '<div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Pincode:</label>
                            <div class="col-md-9">
                                <input type="tel" class="form-control" style="width:300px;" name="pin_code" readonly value="'.$pin_code.'">
                            </div>
                        </div>
                        </div>';
                    }

                   
                    ?>
                
                    <!-- <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Address:</label>
                            <div class="col-md-9">
                                <textarea rows="10" cols="50" class="form-control" id="address" maxlength="999" style="resize:none"><?php echo $address; ?></textarea>
                            </div>
                        </div>
                    </div> -->
                    
                    </fieldset>
                    <!-- For success/fail messages -->
                    <div class="btn-grp" style="float:right; margin-top:20px;">
                    <button class="btn btn-primary" id="edit" onclick="editFrm(); return false;">Edit</button>
                    <button type="submit" class="btn btn-success" id="save" name="save" value="save" disabled>Save</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <img src="../images/pic.gif" class="img-thumbnail pic" width="150" height="180" alt="Thumbnail Image"><br>
                    <h4><?php echo $username; ?></h4>
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
    function editFrm(){
       document.getElementById("initial").style.display="none";
       document.getElementById("editForm").removeAttribute("style");
       document.getElementById("save").removeAttribute("disabled");
       document.getElementById("edit").setAttribute("disabled","disabled");
    }
    </script>
    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>
