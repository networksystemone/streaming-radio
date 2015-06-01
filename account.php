<?php
 session_start();
if(isset($_POST["submit"])) {
$id=$_SESSION['SESS_MEMBER_ID'];
require_once('./config/connection.php');
$result = mysql_query("SELECT * FROM member where id='$id'" );
 while ($result_row = mysql_fetch_assoc($result)){
  $img_db= $result_row['img'];
  }
function RandomString()
{
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $randstring = "";
    for ($i = 0; $i < 7; $i++) {
        $randstring .= $characters[rand(0, strlen($characters)-1)];
    }
    return $randstring;
}
if($_FILES['fileToUpload']['error'] == 0){
$target_dir = "./img/user/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$newid = RandomString();
$newname = $newid . ".jpg";
// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $reponse="File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $reponse="File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
if (file_exists($target_file)) {
    $reponse="Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $reponse="Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $reponse="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $reponse="Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    $newpath= $target_dir . $newname;
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newpath)) {
        $reponse="The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        $update=mysql_query(" UPDATE member SET img='$newpath' where  id='$id'");
        if($img_db!="./img/user/0.jpg")
        unlink ($img_db); 
    } else {
        $reponse="Sorry, there was an error uploading your file.";
    }
}
}
}
?> 

<?php

if (!isset($_SESSION['SESS_USERNAME']))
{
header("location: index.php");
exit();
}
require_once('./config/connection.php');
$user=$_SESSION['SESS_USERNAME'];
$result = mysql_query("SELECT * FROM member WHERE username='$user'");
 while ($result_row = mysql_fetch_assoc($result)){
  $first_name=$result_row['first_name'];
  $last_name=$result_row['last_name'];
  $email= $result_row['email'];
  $username= $result_row['username'];
  $img=$result_row['img'];

  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Account</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">


  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link rel="icon" type="image/png" href="favicon.png">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

  
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/editprofile.js"></script>

<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>


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
</div>
<!--Profile-->
<div class="container" style="padding-top: 60px;">
  <div class="row">
    <div class="col-xs-12 personal-info">

      <div id="div_edit_response" class="alert alert-info alert-dismissable" style="display: none;" >
          <a class="panel-close close" data-dismiss="alert">×</a> 
            <i id="login_response" class="fa fa-coffee"></i>
      </div>

      
      <h3>Edit Profile</h3>
      <img src="<?php echo $img ?>" height="200" width="200" class="avatar img-circle img-thumbnail" alt="avatar">
         <form action="" method="post" enctype="multipart/form-data">
         <div class="form-group">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload" data-filename-placement="inside" >
    <input class="btn btn-labeled btn-success" type="submit" value="Upload Image" name="submit">
          </div>
        </form>
      <form enctype="multipart/form-data" id="edit_profile" class="form-horizontal" action="edit_profile.php" method="POST" role="form">

        <div class="form-group">
          <label class="col-lg-3 control-label">First name:</label>
          <div class="col-lg-8">
            <input name ="first_name" class="form-control" value="<?php echo $first_name ?>" type="text">
        </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Last name:</label>
          <div class="col-lg-8">
            <input name ="last_name" class="form-control" value="<?php echo $last_name ?>" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Email:</label>
          <div class="col-lg-8">
            <input name ="email" class="form-control" value="<?php echo $email ?>" type="text" DISABLED>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Username:</label>
          <div class="col-md-8">
            <input name ="username" class="form-control" value="<?php echo $username ?>" type="text" DISABLED>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Password:</label>
          <div class="col-md-8">
            <input name ="password" class="form-control" value="" type="password">
          </div>
        </div>
        <div class="form-group">
          <label  class="col-md-3 control-label">Confirm password:</label>
          <div class="col-md-8">
            <input name ="cpassword" class="form-control" value="" type="password">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label"></label>
          <div class="col-xs-6 col-sm-6 col-md-6">
            <button class="btn btn-labeled btn-success" id="edit_button">Save Changes</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>
