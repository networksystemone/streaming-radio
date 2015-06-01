<?php

//Start session	
	 session_start();
if (isset($_SESSION['SESS_USERNAME']))
{
header("location: index.php");
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link rel="icon" type="image/png" href="favicon.png">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/comment.css" rel="stylesheet">

  

	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/manager.js"></script>

<body style="background:#f2f2f2;">

<div class="container" >

	<div class="row clearfix">
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
						<li>
							<a href="index.php"><span class="glyphicon glyphicon-home">Home</span></a>
						</li>
						
					</ul>
					<form class="navbar-form navbar-left" action="search.php" method="post">
						<div class="form-group">
							<input name="query" id="query" type="text" class="form-control" placeholder="Search">
						</div> 
						<button type="submit" class="btn btn-default">search</button>
					</form>
				</div>
				
			</nav>
			

		</div>
	</div>
</div><br><br><br><br>
<div class="row clearfix">
		<div class="col-md-4 column">
		</div>
		<div class="col-md-4 column">
		<?php
		if($_SERVER['REQUEST_METHOD'] == 'GET') 
			if (isset($_GET['code'])) {
				$code=$_GET['code'];
				$code = strip_tags($code);
		 		$code = htmlspecialchars($code);
				echo '<h3>
				Active Your Account
				</h3>
                               		 <form id="activate" action="activate_json.php" method="get" >
                            			<div class="input-group">
                                			<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                			<input type="text" value="'.$code.'" class="form-control" placeholder="code" name="code" required />
                            			</div>
                            		 <br>
									<div class="col-xs-6 col-sm-6 col-md-6">
       									<button id="activate_button"  class="btn btn-labeled btn-success">Activate</button>
       							 	</div>
       							 	<br><br>
											<div id="div_activate_response" class="alert alert-info alert-dismissable" style="display: none;">
											<a class="panel-close close" data-dismiss="alert">×</a> 
											<i id="activate_response" class="fa fa-coffee"></i>
											</div>
                            		</form>';}
         	else header("location: index.php");
		else header("location: index.php");
		
		?>
			
		</div>
		<div class="col-md-4 column">
		</div>
	</div>
</div>
</body>
</html>
