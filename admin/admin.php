<?php
     session_start();
if (!isset($_SESSION['SESS_ADMIN_ID']))
header("location: index.php");
else{
    require_once('../config/connection.php');
    $users   = mysql_query("SELECT * FROM member" );
    $mp3   = mysql_query("SELECT * FROM mp3" );
    $blog   = mysql_query("SELECT * FROM posts" );
    $number_users=mysql_num_rows($users);
    $number_mp3=mysql_num_rows($mp3);
    $number_blog=mysql_num_rows($blog);}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">


    <link rel="icon" type="image/png" href="../favicon.png">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">


    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/manager.js"></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>

       <script type="text/javascript"> 
        var id =0;
        var page="home";
         </script>
    <script language="javascript" type="text/javascript" src="js/player.js"></script>
</head>

<body style="background:#f2f2f2;">
<!-- Header -->
<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="icon-bar"></span>
 <span class="icon-bar"></span>
 <span class="icon-bar"></span>

            </button> <a class="navbar-brand droppedHover" href="admin.php">Admin</a>

        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">    
            <li><a href="signout.php" class=""><i class="glyphicon glyphicon-lock"></i> Logout</a>

            </li>
            </ul>
        </div>
    </div>
    <!-- /container -->
</div>
<!-- /Header -->
<!-- Main -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3">
            <!-- Left column --> <a href="#" class=""><strong><i class="glyphicon glyphicon-wrench"></i> Tools</strong></a> 
            <hr class="">
                <ul class="list-unstyled">
                    <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#userMenu" class="">
          <h5 class="">Settings <i class="glyphicon glyphicon-chevron-down"></i></h5>
          </a>
                        <ul class="list-unstyled collapse in" id="userMenu">
                            <li > <a href="admin.php" class=""><i class="glyphicon glyphicon-home"></i> Emissions 
                            <span class="badge badge-info"><?php echo $number_mp3; ?></span></a>
                            </li>
                            <li class="active"><a href="users.php" class=""><i class="glyphicon glyphicon-user"></i> Users 
                            <span class="badge badge-info"><?php echo $number_users; ?></span></a>
                            </li>
                            <li class="active"><a href="blog.php" class=""><i class="glyphicon glyphicon-user"></i> Blog 
                            <span class="badge badge-info"><?php echo $number_blog; ?></span></a>
                            </li>
                            <li class="active"><a href="add_post.php" class=""><i class="glyphicon glyphicon-user"></i> Add Posts</a>
                            </li>
                             <li class="active"><a href="add_category.php" class=""><i class="glyphicon glyphicon-user"></i> Add Gategory</a>
                            </li>
                        </ul>
                    </li>
                </ul>
        </div>
         <?php
if (isset($_SESSION['SESS_ADMIN_ID']))
echo '<!--Add émission dialog-->          
                        <div class="modal fade" id="modal-addémission" role="dialog" aria-labelledby="signup" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                             <h4 class="modal-title" id="signupLabel">
                                Add Emission
                            </h4>
                        </div>
                        <div class="modal-body">
                                <div class="row">
                                <div class="col-md-8 col-sm-8 col-xs-12 login-box">
                                    <form   action="add_mp3.php" method="post" enctype="multipart/form-data">
                                        <div class="input-group">
                                          <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                             <input type="text" class="form-control" placeholder="Emission name" name="mp3name_add" id="mp3username_add" />
                                        </div>

                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-picture"></span></span>
                                            <input id="fileimgadd" name="fileimgadd" type="file" style="display:none" >
                                            <input id="imgadd"   type="text" class="form-control" disabled placeholder="Add Image">
                                                <span class="input-group-btn">
                                                <a class="browse_jpg btn btn-primary" onclick="$(\'input[id=fileimgadd]\').click();">
                                                <i class="glyphicon glyphicon-search"></i>  Browse</a>
                                                </span>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-music"></span></span>
                                            <input id="filemp3add" name="filemp3add" type="file" style="display:none" >
                                            <input id="mp3add"  type="text" class="form-control" disabled placeholder="Add Emissions ">
                                                <span class="input-group-btn">
                                                <a class="browse_jpg btn btn-primary" onclick="$(\'input[id=filemp3add]\').click();">
                                                <i class="glyphicon glyphicon-search"></i>  Browse</a>
                                                </span>
                                        </div>
                                        <br>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <button class="btn btn-labeled btn-success" name="submit" type="submit" id="add_button">Add</button>
                                        </div>
                                        </form>
                                            <br><br><div id="div_add_response" class="alert alert-info alert-dismissable" style="display: none;" >
                                            <a class="panel-close close" data-dismiss="alert">×</a> 
                                            <i id="add_response" class="fa fa-coffee"></i>
                                            </div><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

 <!--update dialog-->          
            <div class="modal fade" id="modal-update" role="dialog" aria-labelledby="signup" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                             <h4 class="modal-title" id="signupLabel">
                                Update Emission
                            </h4>
                        </div>
                        <div class="modal-body">
                                <div class="row">
                                <div class="col-md-8 col-sm-8 col-xs-12 login-box">
                                    <form   action="update_mp3.php" method="post" enctype="multipart/form-data">
                                        <input  type="hidden"   name="mp3_id" id="mp3_id" />
                                        <div class="input-group">
                                          <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                             <input type="text" class="form-control" placeholder="émission name" name="mp3name" id="mp3username" />
                                        </div>

                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-picture"></span></span>
                                            <input id="fileimgupdate" name="fileimgupdate" type="file" style="display:none" >
                                            <input id="imgupdate"   type="text" class="form-control" disabled placeholder="Upload Image">
                                                <span class="input-group-btn">
                                                <a class="browse_jpg btn btn-primary" onclick="$(\'input[id=fileimgupdate]\').click();">
                                                <i class="glyphicon glyphicon-search"></i>  Browse</a>
                                                </span>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-music"></span></span>
                                            <input id="filemp3update" name="filemp3update" type="file" style="display:none" >
                                            <input id="mp3update"  type="text" class="form-control" disabled placeholder="Upload Emissions ">
                                                <span class="input-group-btn">
                                                <a class="browse_jpg btn btn-primary" onclick="$(\'input[id=filemp3update]\').click();">
                                                <i class="glyphicon glyphicon-search"></i>  Browse</a>
                                                </span>
                                        </div>
                                        <br>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <button class="btn btn-labeled btn-success" name="submit" type="submit" id="update_button">Update</button>
                                        </div>
                                        </form>
                                            <br><br><div id="div_update_response" class="alert alert-info alert-dismissable" style="display: none;" >
                                            <a class="panel-close close" data-dismiss="alert">×</a> 
                                            <i id="update_response" class="fa fa-coffee"></i>
                                            </div><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
    ?>
        <!-- /col-3 -->
        <div class="col-sm-9">
            <!-- column 2 -->
            <a href="" class=""><strong><i class="glyphicon glyphicon-dashboard"></i> My Emissions  </strong></a> 
            <hr class="">
                <div class="row">
                    <!-- center left-->
                    <div class="col-sm-9" contenteditable="false" style="">
                        <hr class="">
                        <div class="btn-group btn-group-justified"> 
                <a href="#modal-addémission" class="btn btn-primary col-sm-3" role="button" data-toggle="modal">
                  <i class="glyphicon glyphicon-plus"></i><br class="">
                  Add Emission
                </a></div>
                <div class="row" align="center">

                <?php
                $size=0;
                require_once('../config/connection.php');
                $result = mysql_query("SELECT * FROM mp3 order by mp3_date desc ,mp3_time desc" );
                while ($row_result = mysql_fetch_assoc($result)) {
                $mp3_id[]=$row_result['id'];
                $mp3_name[]=$row_result['name'];
                $mp3_image[]=$row_result['image'];
                $mp3_nb_like[]=$row_result['nb_like'];
                $mp3_nb_share[]=$row_result['nb_share'];
                $mp3_nb_comment[]=$row_result['nb_comment'];
                $mp3_date=$row_result['mp3_date'];
                $mp3_time=$row_result['mp3_time'];
                $d=new DateTime($mp3_date.' '.$mp3_time);
                $time_string[]=date_format($d, 'g:ia \o\n jS F Y');
                $size++;
                }
                 mysql_free_result($result);
                
                if($size!=0){   
                for($i=0;$i<$size;$i++){
                    echo'<span id="deleteid'.$mp3_id[$i].'" >
                        <div class="col-md-4 " style="width:300px;margin-left: 20px;margin-top: 20px;margin-right: 20px">
                        <p><strong class=""> Shared</strong><br> '.$time_string[$i].' </p>
                        <button  value="Submit" onclick="PlayPause('.($i+1).')">
                        <img  src="../'.$mp3_image[$i].'" height="150" width="300">
                        <span id="playItem'.$i.'" style="top:50%" class="glyphicon glyphicon-play"></span>   
                        </button>
                         <p >'.$mp3_name[$i].'</p>
                        <button value="Submit"  onclick="del('.$mp3_id[$i].')" type="button" class="btn btn-danger">Delete</button>
                        <a href="#modal-update" class="btn btn-warning" onclick="openupdate('.$mp3_id[$i].')" role="button" data-toggle="modal">Update</a>

                        </div>
                        </span>';
                if (($i % 2) ==1){
                    echo '</div><div class="row" align="center">';
                        }
                    
                }
            }
                ?>
                </div>
                <audio id="audioPlayer" controls preload="none"  style="visibility:hidden;position:absolute;">
                  <source id="mpegSource" src="resources/1.mp3" type="audio/mpeg; codecs='mp3'"/>
                </audio>
                <br><br>
        </div>
</div>

</body>
</html>