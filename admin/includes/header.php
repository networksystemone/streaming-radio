<?php 
       include 'libraries/Database.php'; 
       include 'helpers/format_helper.php'; ?>
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>
    <link rel="icon" type="image/png" href="../favicon.png">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">



    <script type="text/javascript" src="./js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./ckeditor/ckeditor.js"></script>

  </head>
  
  <body style="background:#f2f2f2;">

<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                </button> 
                <a class="navbar-brand droppedHover" href="./admin.php">Admin</a>

        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">    
            <li><a href="./signout.php" class=""><i class="glyphicon glyphicon-lock"></i> Logout</a>

            </li>
            </ul>
        </div>
    </div>
    <!-- /container -->
</div>
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
                      </ul>
        </div>
<div class="col-sm-9">
			<h2>Blog Setting</h2>		
		<?php if(isset($_GET['msg'])){ ?>
			<div class="alert alert-success">
				<?php echo "<h3>" . $_GET['msg'] . "</h3>"; ?>
			</div>
		<?php } else {/*$msg=""; */}?>


        
