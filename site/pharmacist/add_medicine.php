<?php
session_start();
ob_start();
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


include('../config.php');

/* If the save button was clicked, add a new medicine */

if(isset($_POST['update']))
{
    //Adding a new medicine

    $name = $_POST['medicine_name'];
    $dose = $_POST['dose'];
    $salt = $_POST['salt'];
    $expiry_date = $_POST['expiry_date'];
    $quantity = $_POST['quantity'];

    $medicineInsertQuery = "INSERT INTO medicine(name,dose) VALUES('$name',$dose);";

    $saltInsertQuery = "";

    for($i = 0;$i < count($salt) - 1; $i++)
    {
        $salt_name = $salt[$i];
        $saltInsertQuery = $saltInsertQuery . "INSERT INTO med_salts(name,dose,salt) VALUES('$name',$dose,'$salt_name');";
    }

    $stockInsertQuery = "INSERT INTO stock(name,dose,expiry_date,quantity)  VALUES('$name',$dose,'$expiry_date',$quantity);";

    //$currentDate = date("Y-m-d");

    $currentDate = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));

    $currentDate = $currentDate->format('Y-m-d H:i:s');

    $updatePharmacistQuery = "INSERT INTO updates(id_pha,name,dose,expiry_date,time_stamp,add_quantity) VALUES('$email','$name',$dose,'$expiry_date','$currentDate',$quantity);";

    $query = $medicineInsertQuery . $saltInsertQuery . $stockInsertQuery . $updatePharmacistQuery;

    $res = pg_query($db,$query);

    if(!$res)
    {
        $_SESSION['result'] = "ERROR : " . pg_last_error();
    }
    else
    {
        $_SESSION['result'] = "Medicine was successfully added";
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

    <title>Medical Record Management System</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    
  

    <!-- Custom CSS -->
    <link href="../css/custom.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <script src="../js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>   
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    
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
                    <li class="active">
                        <a href="add_medicine.php">Add Medicines</a>
                    </li>
                    <li>
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
                <h1 class="page-header">Add Medicines
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">Add Medicines</li>
                </ol>
            </div>

           </div>
        
        <div class="row">
            <div class="col-md-8">
				
				<!-- form action is not mentioned.. Complete it-->
                <form class="form-horizontal" method="post" action="" name="add_medicine" id="AddMedicineForm" novalidate>
                    
                    
                    
   
      <div class="control-group form-group">
          <div class="controls">   
       
            
			  <div class="col-md-3">
            <div class="btn-group" data-toggle="buttons">
				
                <label class="btn btn-default">
                    <input type="radio" id="q156" name="optradio" value="New" /> New
                </label> 
             
              
                <label class="btn btn-default">
                    <input type="radio" id="q156" name="optradio" value="Existing" /> Existing
                </label> 
            </div> 
           </div> 
                              
           <div class="col-md-5">     
                <input type="text" class="form-control" id="medicinename" placeholder="Medicine_name" value=""/>
           </div>     
            
           <p class="help-block"></p>
           
        </div>
           
      </div>
    <!---control-group-->   
                    
            
           <!-- Adding a new medicine -->
                    
             
                     
                     <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Medicine Name: </label>
                            <div class="col-md-9">
                                <input type="text" name="medicine_name" class="form-control" id="medicinename" placeholder="Medicine_name" value=""/>
                            </div>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    
                    <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Dose:</label>
                            <div class="col-md-9">
                                <input type="text" name="dose" class="form-control" id="dose" placeholder="Dose" value="">
                            </div>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    
                    <div class="control-group form-group">
                        <div class="controls">
                        <label class="control-label col-md-3">Salt:</label>
                        <div class="col-md-9" id="addmed">
                        <!-- <button class="btn btn-primary" onclick="return addmed();">Add Medicine</button> -->
                                                       
                            
                            
                            <div style="margin-up:3px">
                            <div class="form-group med-group hide" id="optionTemplate">
                               <div class="col-xs-7">
                                <input class="form-control" type="text" name="salt[]" />
                               </div>
                               <div class="col-xs-4">
                                <button type="button" class="btn btn-default removeButton">
                                    <i class="fa fa-minus"></i>
                                </button>
                               </div>
                            </div>
                            </div>
                            
                            <div class="row" style="margin-left:2px;">
                                <button type="button" class="btn btn-default addButton">
                                    <i class="fa fa-plus"></i>&nbsp;Add Salt
                                </button>
                            </div>
                            
                       </div>
                      </div><!--controls-->
                    </div><!---control-group-->
                    
   
   
    
    
    
                   <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Expiry Date:</label>
                            <div class="col-md-4">
                              
                            <input  type="date" name="expiry_date" class="form-control" placeholder="ExpiryDate">
                           
                            </div>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    
                   <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Quantity: </label>
                            <div class="col-md-4">
                             <div class="input-group">
                                <input type="text" name="quantity" class="form-control"  id="quantity" value="1" />
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
                           
                            <p class="help-block"></p>
                        </div>
                    </div>
                             
    
            
            
             <div class="btn-grp" style="float:right; margin-top:20px;">
                  
                    
                    <input type="submit" name="update" value="Update" class="btn btn-success">
             </div>
          
                    
                    
           </form>
               
             <?php

            if(isset($_SESSION['result']) && strlen($_SESSION['result']) > 0)
            {
                echo $_SESSION['result'];
                $_SESSION['result'] = "";
                unset($_SESSION['result']);
            }


             ?>
   
          </div>
         </div>
         <div class="row">
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
     <script type="text/JavaScript">
      $('.datepicker').datepicker();
    </script>
    
    
   </body>
   
</html>

