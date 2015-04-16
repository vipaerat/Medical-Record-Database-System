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

?>
<!DOCTYPE html>
<html lang="en">
<?php 
include('../config.php');
$query=pg_query($db,"SELECT * FROM doctor natural join schedule");
$docinfo=pg_fetch_all($query);

//print_r($docinfo);
$num_row=pg_num_rows($query);
?>

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
                    <li>
                        <a href="profile.php">Profile</a>
                    </li>
                    <li  class="active">
                        <a href="schedule.php">Schedule</a>
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
                <h1 class="page-header">Schedule
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">Schedule</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Intro Content -->
        <!--<div class="row">
            <div class="col-md-6">-->
        <div id="divCategoryDetails">
                <table  class="table" cellspacing="0" cellpadding="0" class="docTb1" width="100%" style="margin-top:5px;">
                    <tbody>
                        <tr>
                            <th width="27%">Doctor Name</th>
                            <th width="11%">Field</th>
                            <th width="10%">Monday</th>
                            <th width="11%">Tuesday</th>
                            <th width="10%">Wednesday</th>
                            <th width="11%">Thursday</th>
                            <th width="10%">Friday</th>
                            <th width="10%">Saturday</th>
                        </tr>
                        <?php
                            $arr = array();
                            $k=0;
                            for ($i=0; $i<$num_row ; $i++) {
                                // echo $docinfo[$i]['name'];
                               if(!(in_array($docinfo[$i]['name'],$arr)))
                               {
                                
                                $name=$docinfo[$i]['name'];
                                // array_push($arr,$name);
                                // echo $name;
                                $arr[$k]=$name;
                                $k=$k+1;

                                // print_r($arr);
                                $mon="-";$tue="-";$wed="-";$thu="-";$fri="-";$sat="-";$sun="-";$mon1="-";$tue1="-";$wed1="-";$thu1="-";$fri1="-";$sat1="-";$sun1="-";
                                for ($j=0; $j <$num_row; $j++) { 
                                    // echo $name;
                                    // echo strcmp($name,$docinfo[$j]['name']);
                                    // echo $name;
                                    if(strcmp($name,$docinfo[$j]['name'])==0)
                                    {
                                    if($docinfo[$j]['schedule_day']=='Monday')
                                    {
                                            $mon1='-'.$docinfo[$j]['end_time'];
                                            $mon=$docinfo[$j]['start_time'];
                                            // echo $mon;
                                    }
                                    if($docinfo[$j]['schedule_day']=='Tuesday')
                                    {
                                        $tue=$docinfo[$j]['start_time'];
                                        // echo $tue;
                                        $tue1='-'.$docinfo[$j]['end_time'];
                                    }
                                    if($docinfo[$j]['schedule_day']=='Wednesday')
                                    {
                                        $wed=$docinfo[$j]['start_time'];
                                        // echo $wed;
                                        $wed1='-'.$docinfo[$j]['end_time'];
                                    }
                                    if($docinfo[$j]['schedule_day']=='Thursday')
                                    {
                                        $thu=$docinfo[$j]['start_time'];
                                        $thu1='-'.$docinfo[$j]['end_time'];
                                        //echo $name.$thu;
                                    }
                                    if($docinfo[$j]['schedule_day']=='Friday')
                                    {
                                        $fri=$docinfo[$j]['start_time'];
                                        $fri1='-'.$docinfo[$j]['end_time'];
                                    }
                                    if($docinfo[$j]['schedule_day']=='Saturday')
                                    {
                                        $sat=$docinfo[$j]['start_time'];
                                        $sat1='-'.$docinfo[$j]['end_time'];
                                    }
                                    if($docinfo[$j]['schedule_day']=='Sunday')
                                    {
                                        $sun=$docinfo[$j]['start_time'];
                                        $sun1='-'.$docinfo[$j]['end_time'];
                                       } 
                                   }
                                       // echo $docinfo[$i]['name'].$mon."-".$tue."-".$wed."\n";                                                                         
                                }

                             echo "<tr>";
                            echo   "<td width=27%>".$docinfo[$i]['name']."</td>";
                            echo   "<td width=11%>".$docinfo[$i]['field']."</td>";
                            echo   "<td width=10%>".$mon.$mon1."</td>";
                            echo   "<td width=11%>".$tue.$tue1."</td>";
                            echo   "<td width=10%>".$wed.$wed1."</td>";
                            echo   "<td width=11%>".$thu.$thu1."</td>";
                            echo   "<td width=10%>".$fri.$fri1."</td>";
                            echo   "<td width=10%>".$sat.$sat1."</td>";
                            echo   "<td width=10%>".$sun.$sun1."</td>";
                              echo  "</tr>";
                          }
                    }

                    // print_r($array);

                         ?>
                    </tbody>
                </table>
         </div>

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

</body>

</html>
