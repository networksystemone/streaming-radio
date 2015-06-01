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
  <title>Users</title>
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
        <!-- /col-3 -->
        <div class="col-sm-9">
            <!-- column 2 -->
            <a href="" class=""><strong><i class="glyphicon glyphicon-dashboard"></i> USERS   </strong></a> 
            <hr class="">
                <div class="row">
                    <!-- center left-->
                    <div class="col-sm-9" contenteditable="false" style="">
                        <hr class="">
                <br><br>
                <div class="row" align="center">
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>First name</th>
                <th>Last_name</th>
                <th>Username</th>
                <th>email</th>
                <th>Etat</th>
                <th>Nb like</th>
                <th>Nb share</th>
                <th>Nb comment</th>
                <th>Signup date</th>
                <th>Delete</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>First name</th>
                <th>Last_name</th>
                <th>Username</th>
                <th>email</th>
                <th>Etat</th>
                <th>Nb like</th>
                <th>Nb share</th>
                <th>Nb comment</th>
                <th>Signup date</th>
                <th>Delete</th>
            </tr>
        </tfoot>
 
        <tbody>
                <?php
                $size=0;
                require_once('../config/connection.php');
                $result = mysql_query("SELECT * FROM member " );
                while ($row_result = mysql_fetch_assoc($result)) {
                $id[]=$row_result['id'];
                $first_name[]=$row_result['first_name'];
                $last_name[]=$row_result['last_name'];
                $username[]=$row_result['username'];
                $email[]=$row_result['email'];
                $img[]=$row_result['img'];
                $active[]=$row_result['active'];
                $nb_like[]=$row_result['nb_like'];
                $nb_share[]=$row_result['nb_share'];
                $nb_comment[]=$row_result['nb_comment'];
                $signup_date=$row_result['signup_date'];
                $signup_time=$row_result['signup_time'];
                $d=new DateTime($signup_date.' '.$signup_time);
                $time_string[]=date_format($d, 'g:ia \o\n jS F Y');
                $size++;
                }
                 mysql_free_result($result);
                
                if($size!=0){   
                for($i=0;$i<$size;$i++){
                   echo '<span id="deleteuser'.$id[$i].'" >
                <tr >
                <td>'.$first_name[$i].'</td>
                <td>'.$last_name[$i].'</td>
                <td>'.$username[$i].'</td>  
                <td>'.$email[$i].'</td>
                <td>'.$active[$i].'</td>
                <td>'.$nb_like[$i].'</td>
                <td>'.$nb_share[$i].'</td>
                <td>'.$nb_comment[$i].'</td>
                <td>'.$time_string[$i].'</td>
                <td><button id="user_delete_button" onclick="del_user('.$id[$i].')" class="btn btn-danger" >Delete</button>
                          </tr></span>';
                    
                }
            }
                ?>
            
            
        </tbody>
    </table>
                </div>
                <br><br>
        </div>
</div>

</body>
</html>