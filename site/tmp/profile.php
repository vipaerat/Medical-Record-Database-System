<?php
session_start();
$email = $_SESSION['email'];
$name = $_SESSION['name'];  //Google profile name of user
$type = $_SESSION['type'];

if(isset($email) && isset($name) && isset($type) && strcmp($type,"doctor")==0)
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
$docInfoQuery =<<<EOF
SELECT *
FROM doctor
WHERE id_doc = '$email'
EOF;



$res = pg_query($db, $docInfoQuery);
$row = pg_fetch_row($res);
$name = $row[1];
$qualification= $row[2];
$field= $row[3];
$house_no= $row[4];
$city= $row[5];
$state= $row[6];
$pin_code= $row[7];
$joining_date= $row[8];

$phone_number="";

$docPhoneQuery =<<<EOF
SELECT phone_no 
FROM doc_phone
WHERE id_doc= '$email'
EOF;

$res = pg_query($db, $docPhoneQuery);
$row = pg_fetch_row($res);
$phone_no= $row[0];
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
                        <a href="profile.php">Profile</a>
                    </li>
                    <li>
                        <a href="prescribe.php">Prescribe</a>
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
        <!-- /.row -->
        <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <div class="row">
			<div class="col-md-8">
				<div class="container" id="initial">
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
					<div class="row">
					<div class="col-md-2"><span><b>Field:</b></span></div>
					<div class="col-md-8"><span><?php echo $field; ?></span></div>
					</div>
					<br>
					<div class="row">
					<div class="col-md-2"><span><b>Phone Number:</b></span></div>
					<div class="col-md-8"><span><?php echo $phone_no; ?></span></div>
					</div>
					<br>
					<div class="row">
					<div class="col-md-2"><span><b>Email:</b></span></div>
					<div class="col-md-8"><span><?php echo $email; ?></span></div>
					</div>
					<br>
					<div class="row">
					<div class="col-md-2"><span><b>House Number:</b></span></div>
					<div class="col-md-8"><span><?php echo $house_no; ?></span></div>
					</div>
					<br>
					<div class="row">
					<div class="col-md-2"><span><b>City:</b></span></div>
					<div class="col-md-8"><span><?php echo $city; ?></span></div>
					</div>
					<br>
					<div class="row">
					<div class="col-md-2"><span><b>State:</b></span></div>
					<div class="col-md-8"><span><?php echo $state; ?></span></div>
					</div>
					<br>
					<div class="row">
					<div class="col-md-2"><span><b>Pin Code:</b></span></div>
					<div class="col-md-8"><span><?php echo $pin_code; ?></span></div>
					</div>
					<br>
					<div class="row">
					<div class="col-md-2"><span><b>Joining Date:</b></span></div>
					<div class="col-md-6"><span><p><?php echo date("d-m-Y", strtotime($joining_date)); ?></p></span></div>
			         </div>
		        </div>
                <form class="form-horizontal" id="profileForm" novalidate>
					<fieldset id="editForm" style="display:none">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Name:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="name" placeholder="Username" value="<?php echo $name; ?>">
                            </div>
                            <p class="help-block"></p>
                        </div>
                    </div>
                     <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Qualification:</label>
                            <div class="col-md-9">
                                <input type="tel" class="form-control" style="width:300px;" id="qualification" placeholder="Qualification" value="<?php echo $qualification;?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Field</label>
                            <div class="col-md-9">
                                <input type="tel" class="form-control" style="width:300px;" id="field" placeholder="Field" value="<?php echo $field;?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                        <label class="control-label col-md-3">Phone Number:</label>
                        <div class="col-md-9" id="addnum">
                        <!-- <button class="btn btn-primary" onclick="return addmed();">Add Medicine</button> -->
                            <div class="form-group num-group">
                               <div class="col-xs-7">
                                <input type="text" class="form-control" name="option[]" value="<?php echo $phone_no; ?>"/>
                               </div>
                            </div>
                            <div class="form-group num-group hide" id="optionTemplate">
                               <div class="col-xs-7">
                                <input class="form-control" type="text" name="option[]" />
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
                    <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Email Address:</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" id="email" placeholder="Email" value="<?php echo $email; ?>">
                            </div>
                        </div>
                    </div>
                    <div id="extras"></div>
                   <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Address:</label>
                         </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">House No:</label>
                            <div class="col-md-9">
                                <input type="tel" class="form-control" style="width:300px;" id="house_no" placeholder="House_no" value="<?php echo $house_no;?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group form-group">
						<div class="controls">
                            <label class="control-label col-md-3">City:</label>
                            <div class="col-md-9">
                                <input type="tel" class="form-control" style="width:300px;" id="city" placeholder="City" value="<?php echo $city;?>">
                            </div>
                         </div>
                    </div>
                    <div class="control-group form-group">
						<div class="controls">
                            <label class="control-label col-md-3">State:</label>
                            <div class="col-md-9">
                                <input type="tel" class="form-control" style="width:300px;" id="state" placeholder="State" value="<?php echo $state;?>">
                            </div>
                        </div>
                     </div>
                     <div class="control-group form-group">
						<div class="controls">
                            <label class="control-label col-md-3">Pin Code</label>
                            <div class="col-md-9">
                                <input type="tel" class="form-control" style="width:300px;" id="pin_code" placeholder="Pin_code" value="<?php echo $pin_code;?>">
                            </div>
                         </div>
                      </div> 
                      
                      <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Joining Date:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="joining_date" placeholder="Joining_Date" value="<?php echo date("d-m-Y", strtotime($joining_date));?>">
                            </div>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div id="success"></div>
                    </fieldset>
                    <!-- For success/fail messages -->
                    <div class="btn-grp" style="float:right; margin-top:20px;">
                    <button class="btn btn-primary" id="edit" onclick="editFrm(); return false;">Edit</button>
                    <button type="submit" class="btn btn-success" id="save" disabled>Save</button>
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
    </div>
    <!-- /.container -->
    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
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
    <script type="text/javascript">
    function editFrm(){
       document.getElementById("initial").style.display="none";
       document.getElementById("editForm").removeAttribute("style");
       document.getElementById("save").removeAttribute("disabled");
       document.getElementById("edit").setAttribute("disabled","disabled");
    }
    </script>


    <!-- Contact Form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <!-- <script src="js/jqBootstrapValidation.js"></script>
    // <script src="js/contact_me.js"></script>-->

</body>

</html>
