<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="divya" >

    <title>Medical Record Management System</title>

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
                    <li>
                        <a href="profile.html">Profile</a>
                    </li>
                    <li  >
                        <a href="schedule.html">Schedule</a>
                    </li>
                    <li  class="active">
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
    
    
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
            <div class="row">
			
			
            <div class="col-lg-12">
                <h1 class="page-header">Add Medicines
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">Add_Medicines</li>
                </ol>
            </div>
           </div>
        
        <div class="row">
            <div class="col-md-8">
				
				<!-- form action is not mentioned.. Complete it-->
                <form class="form-horizontal" name="add_medicine" id="AddMedicineForm" novalidate>
        
             
                     <div class="control-group form-group">
						 <div class="controls">
					
                         <div class="radio">
                            <label><input type="radio" name="optradio">New</label>
                         </div>
                         <div class="radio">
                            <label><input type="radio" name="optradio">Existing</label>
                            
                         </div>
                         
                         <div class="col-md-9">
                                <input type="text" class="form-control" id="medicinename" placeholder="Medicine_name" value="">
                         </div>
                         
                         
                         </div>
                     </div>
                     
                     <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Medicine Name: </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="medicinename" placeholder="Medicine_name" value="">
                            </div>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    
                    <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Dose:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="dose" placeholder="Dose" value="">
                            </div>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    
                    <div class="control-group form-group">
                        <div class="controls">
                        <label class="control-label col-md-3">Salt:</label>
                        <div class="col-md-9" id="addmed">
                        <!-- <button class="btn btn-primary" onclick="return addmed();">Add Medicine</button> -->
                            <div class="form-group med-group">
                               <div class="col-xs-7">
                                <input type="text" class="form-control" name="option[]" />
                               </div>
                               <div class="col-xs-4">
                                  <button type="button" class="btn btn-default removeButton">
                                    <i class="fa fa-minus"></i>
                                  </button>
                                </div>
                            </div>
                            <div class="form-group med-group hide" id="optionTemplate">
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
                                    <i class="fa fa-plus"></i>&nbsp;Add Salt
                                </button>
                            </div>
                       </div>
                      </div><!--controls-->
                    </div><!---control-group-->
                    <script src="../js/jquery.js"></script>
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
    
                         <div class="control-group form-group">
                        <div class="controls">
                            <label class="control-label col-md-3">Quantity: </label>
                            <div class="col-md-9">
                                <div id="incdec">
                                <input type="text" value="1" />
                                <img src="up_arrow.jpg" id="up" />
                               <img src="down_arrow.jpg" id="down" />
                               </div>
                           </div>
                            <p class="help-block"></p>
                        </div>
                    </div>
                               
    
    
            
                 
            
     
    <script src="../js/jquery.js"></script>
    <script type="text/JavaScript">
       
    $(document).ready(function(){
    $("#up").on('click',function(){
        $("#incdec input").val(parseInt($("#incdec input").val())+1);
    });

    $("#down").on('click',function(){
       
        
         var value = (parseInt($("#incdec input").val() , 10));
         $("#incdec input").val((value-1) < 1 ? 1 :(value -1));
        
        
    });
        
    });    
    </script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    
            
            
             <div class="btn-grp" style="float:right; margin-top:20px;">
                  
                    
                    <button type="submit" class="btn btn-success" disabled>Update</button>
             </div>
          
                    
                    
                  </form>
               
             
     
     
     
     
          </div>
         </div>
         
        
        
        
    </div>
    
   </body>
   
</html>

