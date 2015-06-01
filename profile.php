<?php

//Start session	
	 session_start();
if (!isset($_SESSION['SESS_USERNAME']))
header("location: index.php");
else{
    require_once('./config/connection.php');
    $id=$_SESSION['SESS_MEMBER_ID'];
    $user   = mysql_query("SELECT * FROM member  where id='$id'" );
    while ($user_row = mysql_fetch_assoc($user))  $imguser=$user_row['img'];
    if(isset($_GET['id'])){
        $id_member = stripslashes($_GET['id']);
        $id_member = strip_tags($id_member);
        $id_member = mysql_real_escape_string($id_member);
        $id_member = htmlspecialchars($id_member);
        $user   = mysql_query("SELECT * FROM member  where id='$id_member'" );
        if (mysql_num_rows($user)==0)  header("location: index.php");
        else {
            while ($user_row = mysql_fetch_assoc($user)) {
            $img=$user_row['img'];
            $username=$user_row['username'];
            $first_name=$user_row['first_name'];
            $last_name=$user_row['last_name'];
            $nb_comment= $user_row['nb_comment'];
            $nb_like= $user_row['nb_like'];
            $nb_share= $user_row['nb_share'];
            $email= $user_row['email'];
            $signup_date= $user_row['signup_date'];
            }mysql_free_result($user);}
    }
    else{
  
        $user   = mysql_query("SELECT * FROM member  where  id='$id'" );
           while ($user_row = mysql_fetch_assoc($user)) {
            $img=$user_row['img'];
            $username = $user_row['username'];
            $id_member = $user_row['id'];
            $first_name=$user_row['first_name'];
            $last_name=$user_row['last_name'];
            $nb_comment= $user_row['nb_comment'];
            $nb_like= $user_row['nb_like'];
            $nb_share= $user_row['nb_share'];
            $email= $user_row['email'];
            $signup_date= $user_row['signup_date'];
           }mysql_free_result($user);
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php  echo $username;?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">


    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link rel="icon" type="image/png" href="favicon.png">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/profile.js"></script>
<!-- player-->
		<meta charset="utf-8" />
		<script language="javascript" type="text/javascript" src="js/modernizr.js"></script>
        <script type="text/javascript"> 
        var id =<?php echo $id_member;?>;
        var page="profile";
        var query="";
         </script>
		<script language="javascript"  type="text/javascript" src="js/player.js"></script>
</head>

<body style="background:#f2f2f2;">

<div class="container" >
	<div class="row clearfix">
		<div class="col-md-12 column">
			 <div class="col-md-12 column">
            <nav  class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> 
           <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span>
           <span class="icon-bar"></span><span class="icon-bar"></span></button>
            <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-fire">Radio</span></a>
        </div>
        
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li >
              <a href="index.php"><span class="glyphicon glyphicon-home">Home</span></a>
            </li>
            <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="glyphicon glyphicon-book">Blog<strong class="caret"></strong></a>
                      <ul class="dropdown-menu">
                        <li>
                            <a href="blog/index.php">Home</a>
                        </li>
                        <li>
                            <a href="blog/posts.php">All Posts</a>
                        </li>
                     </ul>
                  </li>               
          </ul>
          <form class="navbar-form navbar-left" action="search.php" method="post">
            <div class="form-group">
              <input name="query" id="query" type="text" class="form-control" placeholder="Search">
            </div> 
            <button type="submit" class="btn btn-default">search</button>
          </form>
          <ul class="nav navbar-nav navbar-right">
          <?php

                
            if (isset($_SESSION['SESS_USERNAME']))
            {
            $name=$_SESSION['SESS_USERNAME'];
            echo '
            <li class="dropdown">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 <img src="'.$img.'" height="20" width="20" class="profile-image img-circle"> '.$name.' <b class="caret"></b></a>
                 <ul  class="dropdown-menu">
                   <li><a href="profile.php"><i class="fa fa-square"></i> Profile</a></li>
                   <li class="divider"></li>
                   <li><a href="account.php"><i class="fa fa-cog"></i> Account</a></li>
                   <li class="divider"></li>
                   <li><a href="signout.php"><i class="fa fa-sign-out"></i> Sign-out</a></li>
                 </ul>
                 </li>
                 <li margin-left:20px;>/<li>';  
          }
            else
              echo '<li margin-left:10px;>
                 <a id="modal-signup" href="#modal-container-signup" role="button" class="btn" data-toggle="modal">SIGN UP</a>
                 </li>
                 <li margin-right:20px;>
                 <a id="modal-login" href="#modal-container-login" role="button" class="btn" data-toggle="modal">LOGIN</a>
                 </li>
                 <li>/<li>';
                ?>
          </ul>
        </div>
        
      </nav>
		</div>
	</div>
</div><br>
<hr class="">
<div class="container target">
    <div class="row">
        <div class="col-sm-10">
         <br>
        </div>
      <div class="col-sm-2"><a  class="pull-right"><img title="profile image" class="img-circle img-responsive" src="<?php echo $img ; ?>" height="200" width="200" ></a>

        </div>
    </div>
  <br>
    <div class="row">
        <div class="col-sm-3">
            <!--left col-->
            <ul class="list-group">
                <li class="list-group-item text-muted" contenteditable="false">Profile</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Joined</strong></span><?php echo $signup_date?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Real name</strong></span> <?php echo $first_name." ".$last_name?></li>
            </ul>

            <ul class="list-group">
                <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i>

                </li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Shares</strong></span> <?php echo $nb_share; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Likes</strong></span> <?php echo $nb_like; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Comments</strong></span> <?php echo $nb_comment; ?></li>

            </ul>

        </div>
        <!--/col-3-->
        <div class="col-sm-8" contenteditable="false" style="">
            <div class="panel panel-default target">
                <div align="center" class="panel-heading" contenteditable="false"><strong class=""><?php echo $username."'s timeline"?></strong></div>
                <div class="row" align="center">
                <?php
                $size=0;
                require_once('./config/connection.php');
                $profile = mysql_query("SELECT * FROM share where id_member='$id_member' order by time desc " );
                if (mysql_num_rows($profile)>=1){
                while ($row_profile = mysql_fetch_assoc($profile)) {
                $share_date = $row_profile['share_date'];
                $share_time = $row_profile['share_time'];
                $time = $row_profile['time'];
                $id_mp3 = $row_profile['id_mp3'];
                $result = mysql_query("SELECT * FROM mp3 where id =$id_mp3" );
                while ($row_result = mysql_fetch_assoc($result)) {
                $share_id[] = $row_profile['id'];
                $mp3_id[]=$row_result['id'];
                $mp3_name[]=$row_result['name'];
                $mp3_image[]=$row_result['image'];
                $mp3_nb_like[]=$row_result['nb_like'];
                $mp3_nb_share[]=$row_result['nb_share'];
                $mp3_nb_comment[]=$row_result['nb_comment'];
                $mp3_date=$row_profile['share_date'];
                $mp3_time=$row_profile['share_time'];
                $d=new DateTime($mp3_date.' '.$mp3_time);
                $time_string[]=date_format($d, 'g:ia \o\n jS F Y');
                $size++;
                }
                 mysql_free_result($result);

                }  mysql_free_result($profile);
                }
                if($size!=0){ ;
                for($i=0;$i<$size;$i++){
                if($id==$id_member) echo' <span id="deleteid'.$share_id[$i].'" >';
                echo' <div class="col-md-4 " style="width:300px;margin-left: 38px;margin-top: 20px;margin-right: 20px">
                        <p><strong class=""> Shared</strong><br> '.$time_string[$i].' </p>
                        <button  value="Submit" onclick="PlayPause('.($i+1).')">
                        <img  src="'.$mp3_image[$i].'" height="150" width="300">
                        <span id="playItem'.$i.'" style="top:50%" class="glyphicon glyphicon-play"></span>   
                        </button>';
                if($id==$id_member) echo   '<button value="Submit"  onclick="del('.$share_id[$i].')" type="button" class="btn btn-danger">Delete</button>';
                echo   '<br><strong class="">'.$mp3_name[$i].'</strong></div> 

                        </span>';
                if (($i % 2) ==2){
                    echo '</div><div class="row" align="center">';
                        }
                    
                }
            }
                ?>
                         
            </div>
                 
        </div>
              
    </div>
</div>
  
</div>
<br><br><br><br>  
<!--<div class="container"  style="visibility:hidden;position:absolute;" >-->
<div class="container">
    <audio id="audioPlayer" controls preload="none"  style="visibility:hidden;position:absolute;">
        <source id="mpegSource" src="resources/1.mp3" type="audio/mpeg; codecs='mp3'"/>
    </audio>
            <nav class="navbar navbar-default navbar-fixed-bottom navbar-inverse" role="navigation">
                <div class="navbar-header" >
                     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2"> 
                     <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span>
                     <span class="icon-bar"></span><span class="icon-bar"></span></button>
                      <img id="imgsong" src="./img/mp3/loading.gif" height="50" width="50"/>
                </div>
                
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav">
                        <li style="margin-left:10px;" >
                            <a id="btnReverse" role="button"  class="btn btn-primary btn-circle btn-xl"><i class="glyphicon glyphicon-backward"></i></a>
                        </li>
                        <li>
                            <a id="btnPlayPause" role="button"  class="btn btn-primary btn-circle btn-xl"><i id="playItem" class="glyphicon glyphicon-play"></i></a>
                        </li>
                        <li>
                            <a id="btnForward" role="button"  class="btn btn-primary btn-circle btn-xl"><i class="glyphicon glyphicon-forward"></i></a>
                        </li>
                        <li style="margin-left:10px;">
                            <a id="volumeoff" role="button"  class="btn btn-default btn-circle glyphicon glyphicon-volume-off"></a>
                        </li>
                        <li>
                            <a >
                                <input type="range" id="volume" value="50" min="0" max="100" step="1">
                            </a>
                        </li>
                        <li>
                            <a id="volumemax" role="button"  class="btn btn-default btn-circle glyphicon glyphicon-volume-up"></a>
                        </li>
                        <li style="margin-left:10px;">
                            <a id="currentTime" style="color:#ffffff;">0:00</a>
                        </li>
                        <li>
                        <a>
                            <input style="width: 400px" type="range" id="avancement"  value="0" onchange="rangevalue.value=value"/>
                        </a>
                        </li>
                        <li>
                            <a id="totalTime" style="color:#ffffff;">0:00</a>
                        </li>
                        <li>
                            <a><strong id="song" style="color:#ffffff;">01 - Unknown Track</strong></a>
                        </li>
                    </ul>
                </div>
                
            </nav>
        </div>
    </div>
</div>
</body>
</html>
