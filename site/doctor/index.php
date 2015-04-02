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
               <a href="../index.php" class="navbar-brand">
                  <p class="brand">MEDICAL RECORDS</p>
               </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <ul class="nav navbar-nav navbar-right">
                  <li class="active">
                     <a href="index.php">Home</a>
                  </li>
                  <li>
                     <a href="profile.html">Profile</a>
                  </li>
                  <li>
                     <a href="prescribe.html">Prescribe</a>
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
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Home
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="container col-md-9 col-md-offset-1 prescription">
                <div class="panel panel-primary">
                   <div class="panel-heading">
                      <h4 class="text-center"><i class="fa fa-book fa-fw"></i>&nbsp;Recent Prescriptions</h4>
                   </div>
                   <div class="row">
                      <div class="col-md-6 col-md-offset-3 searchbox">
                         <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                            </span>
                         </div>
                         <!-- /input-group -->
                      </div>
                   </div>
                   <div class="row">
                      <div class="panel-body">
                         <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                               <div class="panel-heading" role="tab" id="headingOne">
                                  <h4 class="panel-title">
                                     <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                     Prescription #1
                                     </a>
                                  </h4>
                               </div>
                               <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                  <div class="panel-body">
                                     Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                  </div>
                               </div>
                            </div>
                            <div class="panel panel-default">
                               <div class="panel-heading" role="tab" id="headingTwo">
                                  <h4 class="panel-title">
                                     <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                     Prescription #2
                                     </a>
                                  </h4>
                               </div>
                               <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                  <div class="panel-body">
                                     Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                  </div>
                               </div>
                            </div>
                            <div class="panel panel-default">
                               <div class="panel-heading" role="tab" id="headingThree">
                                  <h4 class="panel-title">
                                     <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                     Prescription #3
                                     </a>
                                  </h4>
                               </div>
                               <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                  <div class="panel-body">
                                     Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                  </div>
                               </div>
                            </div>
                            <div class="panel panel-default">
                               <div class="panel-heading" role="tab" id="headingFour">
                                  <h4 class="panel-title">
                                     <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                     Prescription #4
                                     </a>
                                  </h4>
                               </div>
                               <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                  <div class="panel-body">
                                     Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                  </div>
                               </div>
                            </div>
                            <div class="panel panel-default">
                               <div class="panel-heading" role="tab" id="headingFive">
                                  <h4 class="panel-title">
                                     <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                     Prescription #5
                                     </a>
                                  </h4>
                               </div>
                               <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                  <div class="panel-body">
                                     Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                      <div class="row">
                         <button class="btn btn-default col-md-offset-6" style="margin-bottom:1em">Older</button>
                      </div>
                   </div>
                </div>
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
      <!-- /.container -->
      <!-- jQuery -->
      <script src="../js/jquery.js"></script>
      <!-- Bootstrap Core JavaScript -->
      <script src="../js/bootstrap.min.js"></script>
      <!-- Script to Activate the Carousel -->
   </body>
</html>