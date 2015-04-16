<?php
session_start();
ob_start();
$email = $_SESSION['email'];
$name = $_SESSION['name'];  //Google profile name of user
$type = $_SESSION['type'];

/*
    If the user is not logged in, redirect him to the home page,
    so that this page cannot be accessed
*/

if(isset($email) && isset($name) && isset($type) && strcmp($type,"pharmacist")==0)
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

include('../config.php');

/*
    if save button was clicked
*/

if(isset($_POST['save']))
{
    $qualification = $_POST['qualification'];
    $house_no = $_POST['house_no'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pin_code = $_POST['pin_code'];

    $pharmacistInfoUpdateQuery = <<<EOF
        UPDATE pharmacist
        SET qualification='$qualification',
        house_no='$house_no',
        city='$city',
        state='$state',
        pin_code=$pin_code
        WHERE id_pha='$email';
EOF;

    $res1 = pg_query($db,$pharmacistInfoUpdateQuery);

    if(!$res1)
    {
        $error1 = pg_last_error();
    }
    else
    {
        $error1 = "";
    }

    //updating phone

    $phone = $_POST['phone'];

    $query = "DELETE FROM pha_phone WHERE id_pha='$email';";

    for($i = 0;$i < count($phone) - 1; $i++)
    {
        $phone_no = $phone[$i];
        if(strlen($phone_no) > 0)
        {
            $query = $query . "INSERT INTO pha_phone(id_pha,phone_no) values('$email','$phone_no');";
        }
    }

    $res2 = pg_query($db,$query);

    if(!$res2)
    {
        $error2 = pg_last_error();
    }
    else
    {
        $error2 = "";
    }
    
    if(strlen($error1) == 0 && strlen($error) == 0)
    {
        $_SESSION['result'] = "Successfully Updated";
    }
    else
    {
        $_SESSION['result'] = "ERROR while updating : " . $error1 . "<br/>" . $error2;
    }

}


/*
    Saving code ends here
*/


$pharmacistInfoQuery =<<<EOF
SELECT name,qualification,house_no,city,state,pin_code,joining_date 
FROM pharmacist
WHERE id_pha = '$email'
EOF;

$res = pg_query($db, $pharmacistInfoQuery);
$row = pg_fetch_row($res);

$name = $row[0];
$qualification = $row[1];
$house_no = $row[2];
$city = $row[3];
$state = $row[4];
$pin_code = $row[5];
$joining_date = $row[6];

$pharmacistPhoneQuery = <<<EOF
    SELECT phone_no 
    FROM pha_phone
    WHERE id_pha = '$email'
EOF;

$res = pg_query($db, $pharmacistPhoneQuery);

$i = 0;
while($phone_no = pg_fetch_row($res))
{
    $phone_number[$i] = $phone_no[0];
    $i = $i + 1;
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
                    <li><a href="index.php">Home</a>
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
                    <div class="col-md-2"><span><b>Qualification:</b></span></div>
                    <div class="col-md-8"><span><?php echo $qualification; ?></span></div>
                    </div>
                    <br>
                    <!-- required data-validation-required-message="Please enter your phone number." -->
                   <!-- <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Phone Number:</label>
                            <div class="col-md-9">
                                <input type="tel" class="form-control" style="width:300px;" id="phone" placeholder="Phone" value="">
                            </div>
                        </div>
                    </div>
                    -->
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
                    <div class="col-md-2"><span><b>Email Address:</b></span></div>
                    <div class="col-md-8"><span><?php echo $email; ?></span></div>
                    </div>
                    <br>
                       
                    
                   <div class="row">
                    <div class="col-md-2"><span><b>Address:</b></span></div>
                    </div>  
                    <br/>
                    <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-2"><span><b>House No.:</b></span></div>
                    <div class="col-md-8"><span><?php echo $house_no; ?></span></div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-2"><span><b>City:</b></span></div>
                    <div class="col-md-8"><span><?php echo $city; ?></span></div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-2"><span><b>State:</b></span></div>
                    <div class="col-md-8"><span><?php echo $state; ?></span></div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-2"><span><b>Pincode:</b></span></div>
                    <div class="col-md-8"><span><?php echo $pin_code; ?></span></div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-2"><span><b>Joining Date:</b></span></div>
                    <div class="col-md-8"><span><?php echo $joining_date; ?></span></div>
                    </div>
                    <br>
            </div>
 
        <!-- Profile display ends here -->


<!-- Profile edit begins here -->


        <form action="" method="post" class="form-horizontal" name="profile" id="profileForm" novalidate>
                    <fieldset id="editForm" style="display:none;">
                        <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Name:</label>
                            <div class="col-md-9">
                                <input type="text" disabled="" name="name" class="form-control" id="name" value= "<?php echo $name; ?>" >
                            </div>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Qualification:</label>
                            <div class="col-md-9">
                                <input type="text" name="qualification" class="form-control" style="width:100px;" id="gender" value= "<?php echo $qualification; ?>">
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
                                <input type="text" value="<?php echo $phone_number[$i]; ?>" class="form-control" name="phone[]" />
                               </div>
                               <div class="col-xs-4">
                                  <button type="button" class="btn btn-default removeButton">
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
                                <button type="button" class="btn btn-default removeButton">
                                    <i class="fa fa-minus"></i>
                                </button>
                               </div>
                            </div>
                            <div class="row" style="margin-left:2px;">
                                <button type="button" class="btn btn-default addButton">
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
                                <input type="email" disabled="" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo $email; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Address:</label>
                         </div>
                    </div>
                            
                    <div class="control-group form-group">
                        <div class="controls">
                            <div class="col-md-1"></div>
                            <label class="control-label col-md-3">House_no:</label>
                            <div class="col-md-7">
                                <input type="text" name="house_no" class="form-control" style="width:300px;" id="house_no" placeholder="House_no" value="<?php echo $house_no; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                        <div class="col-md-1"></div>
                            <label class="control-label col-md-3">City:</label>
                            <div class="col-md-7">
                                <input type="text" name="city" class="form-control" style="width:300px;" id="city" placeholder="City" value="<?php echo $city; ?>">
                            </div>
                         </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                        <div class="col-md-1"></div>
                            <label class="control-label col-md-3">State:</label>
                            <div class="col-md-7">
                                <input type="text" name="state" class="form-control" style="width:300px;" id="state" placeholder="State" value="<?php echo $state; ?>">
                            </div>
                        </div>
                     </div>
                     <div class="control-group form-group">
                        <div class="controls">
                        <div class="col-md-1"></div>
                            <label class="control-label col-md-3">Pincode:</label>
                            <div class="col-md-7">
                                <input type="tel" name="pin_code" class="form-control" style="width:300px;" id="pin_code" placeholder="Pin_code" value="<?php echo $pin_code; ?>">
                            </div>
                         </div>
                      </div> 
                      <br/>
                      <div class="control-group form-group">
                        <div class="controls">
                        <div class="col-md-1"></div>
                            <label class="control-label col-md-3">Joining Date:</label>
                            <div class="col-md-7">
                                <input type="text" name="joining_date" class="form-control" style="width:300px;" id="joining_date" disabled="" placeholder="joining_date" value="<?php echo $joining_date; ?>">
                            </div>
                         </div>
                      </div> 
                </fieldset>
                    <!-- For success/fail messages -->
                    <div class="btn-grp" style="float:right; margin-top:20px;">
                    <button class="btn btn-primary" id="edit" onclick="editFrm(); return false;">Edit</button>
                    <button type="submit" class="btn btn-success" id="save" name="save" disabled>Save</button>
                    </div>
                </form>

<!-- Profile edit ends here -->
    </div>
    <div class="col-md-4">
                <div class="text-center">
                    <img src="../images/pic.gif" class="img-thumbnail pic" width="150" height="180" alt="Thumbnail Image"><br>
                    <h4><?php echo $name; ?></h4>
                </div>
            </div>
        </div>
        <?php 
        if(isset($_SESSION['result']) && strlen($_SESSION['result']) > 0)
        {
            echo $_SESSION['result'];
            $_SESSION['result'] = "";
            unset($_SESSION['result']);
        }
        ?>

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

    <!-- Contact Form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

</body>

</html>
