<?php
session_start();
$email = $_SESSION['email'];
$name = $_SESSION['name'];
$type = $_SESSION['type'];
if(isset($email) && isset($name) && isset($type) && strcmp($type,"user")==0 )
{
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
      <!-- jQuery -->
      <script src="../js/jquery.js"></script>
      <!-- Bootstrap Core JavaScript -->
      <script src="../js/bootstrap.min.js"></script>
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

      <style>
        .btn-file {
            position: relative;
            overflow: hidden;
        }
        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }
    </style>
    <script type="text/javascript">
      $(document).on('change', '.btn-file :file', function() {
      var input = $(this),
          numFiles = input.get(0).files ? input.get(0).files.length : 1,
          label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
      input.trigger('fileselect', [numFiles, label]);
      });
    </script>
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
                     <a href="profile.php">Profile</a>
                  </li>
                  
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" id="username" data-toggle="dropdown"><?php echo $username; ?> <b class="caret"></b></a>
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
                         </div>
                      </div>
                      <div class="row">
                         <button id="older" class="btn btn-default col-md-offset-5" style="margin-bottom:1em">Older</button>
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
      <script type="text/javascript">
      // Fetch prescriptions from database
      window.onload=function(){
          window.count = 4;
          window.email = <?php echo "'$email'"?>;
          fetchPres(window.email,window.count);
      }

      function fetchPres(id,num)
      {
        $.post("prescriptions.php",
          {
              email : id,
              num_row: num  // num of rows to show
          }).done(function(data){
              if(data.indexOf("ERROR")!=-1)
              {
                  alert(data);
              }
              else{
              $("#accordion").empty().append(data);
              document.getElementById("upload").onclick = function()
              {
                document.getElementById('filelabel').innerHTML = 'gotit';
              }

              $('.btn-file :file').on('fileselect', function(event, numFiles, label) {

                var div = this.parentNode.parentNode;

                for(var i =0;i<div.childNodes.length;i++)
                  {
                    type = typeof div.childNodes[i].id;

                    if(type!="undefined"&&div.childNodes[i].id=="filelabel")
                      div.childNodes[i].innerHTML=label;
                  }
                });
              }
          });
      }

      document.getElementById("older").onclick = function()
      {
        window.count=window.count+2;
        fetchPres(window.email,window.count);
      }

      </script>
      <!-- Script to Activate the Carousel -->
   </body>
</html>