<?php
session_start();
if(isset($_SESSION['email']) && isset($_SESSION['name']) && isset($_SESSION['type']) && strcmp($_SESSION['type'],"doctor")==0 )
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
                    <li>
                        <a href="profile.php">Profile</a>
                    </li>
                    <li  class="active">
                        <a href="prescribe.php">Prescribe</a>
                    </li>
                    <li>
                     <a href="inventory.php">Inventory</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $username?><b class="caret"></b></a>
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
                <h1 class="page-header">Prescribe
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">Prescribe</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Intro Content -->
        <div class="row">
            <div class="col-md-8">
                <form class="form-horizontal" name="profile" id="profileForm" method="post" action="temp_prescription.php?doctorid=vipina82@gmail.com">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Patient ID:</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" name="userid" placeholder="UserID" value="">
                            </div>
                            <p class="help-block"></p>
                        </div>
                    </div>
                                     
                    <div id="extras"></div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Description:</label>
                            <div class="col-md-9">
                                <textarea rows="10" cols="50" class="form-control" name="description" maxlength="999" style="resize:none" ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                        <label class="control-label col-md-3">Medicine:</label>
                        <div class="col-md-9" id="addmed">
                        <!-- <button class="btn btn-primary" onclick="return addmed();">Add Medicine</button> -->
                            <div class="form-group med-group">
                            <div class="col-xs-5">
                                <label class="control-label">Name:</label>
                                <input type="text" class="form-control" name="name[]" />
                            </div>
							<div class="col-xs-3">
                                <label class="control-label">Dose:</label>
                                <input type="text" class="form-control" name="dose[]" />
                            </div>
                            <div class="col-xs-3">
                               <div id="incdec">
                                <label class="control-label">Amt:</label>
                                <div class="input-group">
                                <input type="text" class="form-control" name="amount[]" value="1" />
                                <span class="input-group-btn">
                                    <button type="button" onclick="up(this); return false;" class="btn btn-default">
                                            <i class="fa fa-plus"></i>
                                    </button>
                                    <button type="button" onclick="down(this); return false;" class="btn btn-default">
                                            <i class="fa fa-minus"></i>
                                    </button>
                                </span>
                                </div>
                               </div>
                            </div>
                             <!-- <div class="col-xs-1">
                               <div id="incdec">
                                <i class="fa fa-fw fa-plus" id="up"></i>
                                <i class="fa fa-fw fa-minus" id="down"></i>
                               </div>
                            </div> -->
                            <!-- <div class="col-xs-3" style="margin-top:25px">
                                <button type="button" class="btn btn-default removeButton">
                                    Remove
                                </button>
                            </div> -->
                            </div>
                            <div class="form-group med-group hide" id="optionTemplate">
                            <div class="col-xs-5">
                                <label class="control-label">Name:</label>
                                <input class="form-control" type="text" name="name[]" />
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label">Dose:</label>
                                <input class="form-control" type="text" name="dose[]" />
                            </div>
							
                            <div class="col-xs-3">
                               <div id="incdec">
                                <label class="control-label">Amt:</label>
                                <div class="input-group">
                                <input type="text" class="form-control" name="amount[]" value="1" />
                                <span class="input-group-btn">
                                    <button type="button" onclick="up(this); return false;" class="btn btn-default">
                                            <i class="fa fa-plus"></i>
                                    </button>
                                    <button type="button" onclick="down(this); return false;" class="btn btn-default">
                                            <i class="fa fa-minus"></i>
                                    </button>
                                </span>
                                </div>
                               </div>
                            </div>

                             <!-- <div class="col-xs-1">
                               <div id="incdec">
                                <i class="fa fa-fw fa-plus" id="up"></i>
                                <i class="fa fa-fw fa-minus" id="down"></i>
                               </div>
                            </div> -->
                            <div class="col-xs-3" style="margin-top:25px">
                                <button type="button" class="btn btn-default removeButton">
                                    Remove
                                </button>
                            </div>
                            </div>
                            <div class="row" style="margin-left:2px;">
                                <button type="button" class="btn btn-default addButton">
                                    <i class="fa fa-plus"></i>&nbsp;Add Med
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- For success/fail messages -->
                    <div class="btn-grp" style="float:right; margin-top:20px;">
                        <input type="submit" class="btn btn-primary" name="submit" value="Advise" > 
                    </div>
                </form>
            </div>
        </div>
        <div class="row col-md-offset-1" id="success"><br>
            <?php 
            if(isset($_GET['error']))
            {
                $error=$_GET['error'];

                echo strcmp($error,"")==0?"<p class=\"text-primary\">Prescribed Successfully.</p>":"<p class=\"text-danger\">$error</p>";
            }
            ?></div>
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
    <script type="text/JavaScript">
    
    function up(elem)
    {
        var input = elem.parentNode.parentNode;
        var val = parseInt(input.childNodes[1].value);
        input.childNodes[1].value = val+1;   
    }

    function down(elem)
    {
        var input = elem.parentNode.parentNode;
        var val = parseInt(input.childNodes[1].value);
        input.childNodes[1].value = (val-1) < 1 ? 1: (val-1);
         // var value = (parseInt($("#incdec input").val() , 10));
         // $("#incdec input").val((value-1) < 1 ? 1 :(value -1));
    } 
    </script>
                
    <script type="text/JavaScript">
        $("#addmed").on('click', '.addButton', function() {
            var $template = $('#optionTemplate'),
                $clone    = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .insertBefore($template);
        })

        // Remove button click handler
        .on('click', '.removeButton', function() {
            var $row    = $(this).parents('.med-group');

            // Remove element containing the option
            $row.remove();
        });
    </script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>
