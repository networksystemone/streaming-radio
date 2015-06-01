	<?php

//Start session	
	 session_start();
if (isset($_SESSION['SESS_USERNAME']))
{
require_once('./config/connection.php');
$id_member=$_SESSION['SESS_MEMBER_ID'];
$user   = mysql_query("SELECT * FROM member  where id='$id_member'" );
while ($user_row = mysql_fetch_assoc($user))  $img=$user_row['img'];}

if(isset($_POST['query'])){
				    // Add validation and sanitization on $_POST['query'] here
				     $mot = stripslashes($_POST['query']);
					 $mot = strip_tags($mot);
					 $mot = mysql_real_escape_string($mot);
					 $mot = htmlspecialchars($mot);
				    // Now set the WHERE clause with LIKE query
}
?>
   
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Search</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link rel="icon" type="image/png" href="favicon.png">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/manager.js"></script>
<!-- google recaptcha -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>


		<!-- player-->
		<script language="javascript" type="text/javascript" src="js/modernizr.js"></script>
	    <script type="text/javascript"> 
        var id =0;
        var query=<?php 
        if(isset($_POST['query']))
        	echo "\"".$mot."\";";
        else
        	echo "\"\";" ?>
        var page="search";
         </script>
		<script language="javascript" type="text/javascript" src="js/player.js"></script>
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
					<form class="navbar-form navbar-left" action="" method="post">
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
			<br><br><br>

		</div>
	</div>
</div>

<?php
if (!isset($_SESSION['SESS_USERNAME'])){
echo '<!--SIGNUP dialog-->			
			<div class="modal fade" id="modal-container-signup" role="dialog" aria-labelledby="signup" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							 <h4 class="modal-title" id="signupLabel">
								Sign Up
							</h4>
						</div>
						<div class="modal-body">
								<div class="row">
                       		    <div class="col-md-8 col-sm-8 col-xs-12 login-box">
                               		 <form  id="signup" action="signup_json.php" method="post" >
                            			<div class="input-group">
                               			  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                			 <input type="text" class="form-control" placeholder="Username" name="username" required autofocus />
                            			</div>
                            			<div class="input-group">
                                			<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                			<input type="password" class="form-control" placeholder="Password" name="npassword" required />
                            			</div>
                            			<div class="input-group">
                                			<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                			<input type="password" class="form-control" placeholder="Confirm Password" name="cpassword" required />
                            			</div>
                            			<div class="input-group">
                                			<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                			<input type="text" class="form-control" placeholder="Email" name="email" required />
                            			</div>
                            			<br>
                            			<div class="row">
							 				<div class="col-xs-6 col-sm-6 col-md-6">
											<div class="g-recaptcha" data-sitekey="6LdEhgITAAAAAGigEVKR5jrozGcVwVr0gva8EzmT"></div>
											</div>
										</div><br>
										<div class="col-xs-6 col-sm-6 col-md-6">
       									 	<button class="btn btn-labeled btn-success" id="signup-button">Sign Up</button>
       								 	</div>
                            		</form>
                            				<br><br><div id="div_signup_response" class="alert alert-info alert-dismissable" style="display: none;" >
											<a class="panel-close close" data-dismiss="alert">×</a> 
											<i id="signup_response" class="fa fa-coffee"></i>
											</div><br>
                       		    </div>
                   			</div>
						</div>
					</div>
				</div>
			</div>
<!--Login dialog-->			
			<div class="modal fade" id="modal-container-login" role="dialog" aria-labelledby="login" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							 <h4 class="modal-title" id="loginLabel">
								Login
							</h4>
						</div>
						<div class="modal-body">
							<div class="row">
                       		    <div class="col-md-8 col-sm-8 col-xs-12 login-box">
                               		 <form id="login" action="login_json.php" method="post" >
                            			<div class="input-group">
                               			  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                			 <input type="text" class="form-control" placeholder="Username" name="username" required autofocus />
                            			</div>
                            			<div class="input-group">
                                			<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                			<input type="password" class="form-control" placeholder="Password" name="password" required />
                            			</div>
                            			<div class="checkbox">
                               			 <label>
                                   			 <input type="checkbox" value="Remember">
                                   			 Remember me
                                		</label>
                           			   </div>
                            			
                               			 <a href="init.php" >Find Your Account?</a>
                               			 <br>
									<div class="col-xs-6 col-sm-6 col-md-6">
       									<button class="btn btn-labeled btn-success" id="login-button">LogIn</button>
       							 	</div>
                            		</form>
                            				<br><br><div id="div_login_response" class="alert alert-info alert-dismissable" style="display: none;" >
											<a class="panel-close close" data-dismiss="alert">×</a> 
											<i id="login_response" class="fa fa-coffee"></i>
											</div><br>
                       		    </div>
                   			</div>
						</div>
					</div>
				</div>
			</div>';}
			else echo '
<!-- share dialog -->
			<div class="modal fade" id="share" role="dialog" aria-labelledby="signup" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							 <h4 class="modal-title" id="signupLabel">
								Share
							</h4>
						</div>
						<div class="modal-body">
                               		 <div >
                        				<button  value="Submit" >
                        				<img  id="imgshare" src="img/mp3/1.jpg" height="300" width="500">
                        				</button>
                        				<h1 align="center" >music 3</h1>
                       		    	</div>
                   			<button id=\'btnshare\' onclick="" class="btn btn-large btn-primary" type="button">Share</button>
                   			<br>
                   			<br><div id="div_share_response" class="alert alert-info alert-dismissable" style="display: none;" >
								<a class="panel-close close" data-dismiss="alert">×</a> 
								<i id="share_response" class="fa fa-coffee"></i>
								</div>
						</div>
					</div>
				</div>
			</div>
<!-- comment dialog -->
			<div class="modal fade" id="comment" role="dialog" aria-labelledby="signup" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							 <h4 class="modal-title" id="signupLabel">
								comment
							</h4>
						</div>
						<div class="modal-body">

    <div class="actionBox">
    <form class="form-inline" id="form_comment" action="comment.php" method="post">
            <div class="form-group">
                <input name="text" id="inputcomment" class="form-control" value="" type="text" placeholder="Your comments" />
                <input name="id" id="mp3_id" class="form-control" value="O" type="hidden"  />
            </div>
            <div class="form-group">
            <button  class="btn btn-default" id="btncomment">comment </button>
            </div>
        </form>
        <ul class="commentList" id="comentmp3">
          
        </ul>
        
    </div>
</div>
</div>
</div>
</div>'
			;
?>

<br><br>
<div class="container" >
	<div class="row clearfix" >
		<div class="col-sm-12" contenteditable="false" align="center">
    		<div class="panel panel-default target" align="center">
				<div class="row">
				<?php
					 include './config/config.php';
					if (isset($_SESSION['SESS_USERNAME'])) $id_member=$_SESSION['SESS_MEMBER_ID'];
					/////////
						$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
						     
						    // check connection
						    if ($mysqli->connect_errno){
						    printf("Connect failed: %s\n", $mysqli->connect_error);
						    exit();
						    }

						    $query = 'SELECT * FROM mp3';
						     
						    if(isset($_POST['query'])){
						    $query .= ' WHERE name LIKE "%'.$mot.'%"';
						    }
						    $query .= ' order by mp3_date desc ,mp3_time desc';
						    if($result = $mysqli->query($query)){
						    // fetch object array
						    $size=0;
						    while($obj = $result->fetch_object()) {
						    	$mp3_id[]= $obj->id;
		        				$mp3_name[]= $obj->name;
		        				$mp3_image[]= $obj->image;
		        				$mp3_nb_like[]= $obj->nb_like;
		        				$mp3_nb_share[]= $obj->nb_share;
		        				$mp3_nb_comment[]= $obj->nb_comment;
		        				$mp3_date= $obj->mp3_date;
		        				$mp3_time= $obj->mp3_time;
		        				$d=new DateTime($mp3_date.' '.$mp3_time);
		        				$time_string[]=date_format($d, 'g:ia \o\n jS F Y');
		        				$size++;

							    $name= $obj->name;
							    $image= $obj->image;
								$id_mp3= $obj->id;
								$file = $obj->resource;
						    }
						    // free result set
						    $result->close();
						    }


					///////////

					
    				if($size!=0){
     					for($i=0;$i<$size;$i++){
     					if (isset($_SESSION['SESS_USERNAME'])) {
     						$r = mysql_query("SELECT * FROM `like` where id_mp3='$mp3_id[$i]' AND id_member='$id_member'" );
							if (mysql_num_rows($r)==0)  $like="Like";
							else $like="Dislike";}
						else $like="Like";
						echo   '<div class="col-md-4 " style="width:250px;margin-left: 10px;margin-top: 10px;margin-right: 20px">
									<p><strong class="">Shared by admin: </strong><br>'.$time_string[$i].' </p>
									<button  value="Submit" onclick="PlayPause('.($i+1).')">
										<img  src="'.$mp3_image[$i].'" height="150" width="250">
  										<span id="playItem'.$i.'" style="top:50%" class="glyphicon glyphicon-play"></span>   
									</button>
									<strong class="">'.$mp3_name[$i].'</strong>
									<div>
										<a style="color:#0080FF" onclick="openshare('.$mp3_id[$i].'	)" href="#share" role="button"  data-toggle="modal" ><span>Share</span><span id="nb_share'.$mp3_id[$i].'">('.$mp3_nb_share[$i].')</span></a>
										<a style="color:#0080FF" onclick="like('.$mp3_id[$i].')"  role="button" ><span id="likeid'.$mp3_id[$i].'">'.$like.'</span><span id="nb_like'.$mp3_id[$i].'">('.$mp3_nb_like[$i].')</span></a>
										<a style="color:#0080FF" onclick="opencomment('.$mp3_id[$i].')" href="#comment" role="button" " data-toggle="modal"><span>Comment</span><span id="nb_comment'.$mp3_id[$i].'">('.$mp3_nb_comment[$i].')</span></a>
									</div>
								</div>';
						if (($i % 4) ==3) echo '</div><div class="row">';
						}
					}
					else echo "no result found for your ".$mot." query. please try again";
				?>
		 			</div>
		 			<br>
				</div>
			</div>
		</div>
</div>	
<br><br>	
<!--<div class="container"  style="visibility:hidden;position:absolute;" -->
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
						</li >
						<li  style="margin-left:5px;">
							<a id="btnPlayPause" role="button"  class="btn btn-primary btn-circle btn-xl"><i id="playItem" class="glyphicon glyphicon-play"></i></a>
						</li>
						<li  style="margin-left:5px;">
							<a id="btnForward" role="button"  class="btn btn-primary btn-circle btn-xl"><i class="glyphicon glyphicon-forward"></i></a>
						</li>
						<li style="margin-left:10px;">
							<a id="volumeoff" role="button"  class="btn btn-default btn-circle glyphicon glyphicon-volume-off"></a>
						</li >
						<li style="margin-left:5px;">
							<a >
								<input type="range" id="volume" value="50" min="0" max="100" step="1">
							</a>
						</li>
						<li style="margin-left:5px;">
							<a id="volumemax" role="button"  class="btn btn-default btn-circle glyphicon glyphicon-volume-up"></a>
						</li>
						<li style="margin-left:10px;">
							<a id="currentTime" style="color:#ffffff;">0:00</a>
						</li>
						<li style="margin-left:5px;">
						<a>
							<input style="width: 350px" type="range" id="avancement"  value="0" onchange="rangevalue.value=value"/>
						</a>
						</li>
						<li style="margin-left:5px;">
							<a id="totalTime" style="color:#ffffff;">0:00</a>
						</li>
						<li style="margin-left:10px;">
							<a><strong id="song" style="color:#ffffff;">01 - Unknown Track</strong></a>
						</li>
					</ul>
				</div>
				
			</nav>
		</div>
	</div>
	<div>
</div>
</body>
</html>
