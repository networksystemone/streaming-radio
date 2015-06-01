<?php
    //Start session
    session_start();
    $nb=0;
    $reponse="";
    $img="";
    $mp3name="";
    $resource="";
    $reponse_img="";
    $reponse_mp3="";
	if (!isset($_SESSION['SESS_ADMIN_ID'])) {
		$session=0 ;
		$reponse="login";}
	else{ 
		require_once('../config/connection.php');
		//Get information of mp3
		if (isset($_POST['idmp3'])){
			$idmp3=stripslashes($_POST['idmp3']);
			$idmp3 = strip_tags($idmp3);
			$idmp3 = mysql_real_escape_string($idmp3);
			$idmp3 = htmlspecialchars($idmp3);
			$result = mysql_query("SELECT * FROM mp3 WHERE id='$idmp3'");
			if (mysql_num_rows($result)==0) $reponse="No such song";
			else {
				while ($re_row = mysql_fetch_assoc($result)){
						$img=$re_row['image'];
						$mp3name=$re_row['name'];
						$resource=$re_row['resource'];}mysql_free_result($result);
					}

		} 
		else  if (isset($_POST['mp3_id'])&&isset($_POST['mp3name'])){
						$mp3_id=$_POST['mp3_id'];
			     		$mp3_id = strip_tags($mp3_id);
			     		$mp3_id = mysql_real_escape_string($mp3_id);
			     		$mp3_id = htmlspecialchars($mp3_id);

						$mp3name=$_POST['mp3name'];
		     			$mp3name = strip_tags($mp3name);
		     			$mp3name = mysql_real_escape_string($mp3name);
		     			$mp3name = htmlspecialchars($mp3name);

     					$imgupdate="";
     					$mp3update="";

     					$result = mysql_query("SELECT * FROM mp3 WHERE id='$mp3_id'");
						if (mysql_num_rows($result)==0) $reponse="a fatal error has been detected try again";
						else {
								while ($re_row = mysql_fetch_assoc($result)){
								$img_db=$re_row['image'];
								$resource_db=$re_row['resource'];}mysql_free_result($result);

										//upload img 
								if($_FILES['fileimgupdate']['error'] == 0)	{
									$target_dir_db = "./img/mp3/";
									$target_dir = "../img/mp3/";
									$target_file = $target_dir . basename($_FILES["fileimgupdate"]["name"]);
									$uploadOk = 1;
									$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
									$newid = RandomString();
									$newname = $newid . ".jpg";
									// Check if image file is a actual image or fake image
								    $check = getimagesize($_FILES["fileimgupdate"]["tmp_name"]);
								    if($check !== false) {
								        $reponse="File is an image - " . $check["mime"] . ".";
								        $uploadOk = 1; } 
								    else {
								        $reponse="File is not an image.";
								        $uploadOk = 0; }

									// Check if file already exists
									if (file_exists($target_file)) {
								    $reponse_img="Sorry, file already exists.";
								    $uploadOk = 0; }
									// Check file size
									if ($_FILES["fileimgupdate"]["size"] > 500000) {
								    	$reponse_img="Sorry, your file is too large.";
								    	$uploadOk = 0; }
								   // Allow certain file formats
									if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
										&& $imageFileType != "gif" ) {
								    	$reponse_img="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
								    	$uploadOk = 0; }
									// Check if $uploadOk is set to 0 by an error
									if ($uploadOk == 0) {
									    $reponse_img="Sorry, your file was not uploaded.";
									// if everything is ok, try to upload file
									} else {
								    		$newpath= $target_dir . $newname;
								    		if (move_uploaded_file($_FILES["fileimgupdate"]["tmp_name"], $newpath)) {
								        		$reponse_img="The file ". basename( $_FILES["fileimgupdate"]["name"]). " has been uploaded.";								         		 
								         		$imgupdate=$target_dir_db . $newname; }
								         	else $reponse_img="Sorry, there was an error uploading your file.";
								    	
											}
								}
								//end upload img //
								//upload mp3 //
								if($_FILES['filemp3update']['error'] == 0){
									$target_dir_db = "./resources/";
									$target_dir = "../resources/";
									$target_file = $target_dir . basename($_FILES["filemp3update"]["name"]);
									$uploadOk = 1;
									$mp3FileType = pathinfo($target_file,PATHINFO_EXTENSION);
									$newid = RandomString();
									$newname = $newid . ".mp3";
								// Check if image file is a actual image or fake image

								 /*   $check = getimagesize($_FILES["filemp3update"]["tmp_name"]);
								    if($check !== false) {
								        $reponse="File is an mp3 - " . $check["mime"] . ".";
								        $uploadOk = 1;
								    } else {
								        $reponse="File is not an mp3.";
								        $uploadOk = 0;
								    }*/

									// Check if file already exists
									if (file_exists($target_file)) {
								    	$reponse_mp3="Sorry, file already exists.";
								    	$uploadOk = 0;
									}
									// Check file size
							/*		if ($_FILES["filemp3update"]["size"] > 20971520) {
								    	$reponse_mp3_type="Sorry, your file is too large.";
								    $uploadOk = 0;
									}*/
									// Allow certain file formats
									if($mp3FileType !="mp3") {
								    	$reponse_mp3="Sorry, only mp3 files are allowed.";
								   	 $uploadOk = 0;
									}
									// Check if $uploadOk is set to 0 by an error
									if ($uploadOk == 0) {
									    $reponse_mp3="Sorry, your file was not uploaded.";
									// if everything is ok, try to upload file
									} else {
									    	$newpath= $target_dir . $newname;
									    	if (move_uploaded_file($_FILES["filemp3update"]["tmp_name"], $newpath)) {
									        	$reponse_mp3="The file ". basename( $_FILES["filemp3update"]["name"]). " has been uploaded.";
									         	$mp3update=$target_dir_db . $newname;;
									    	}else {
									        		$reponse_mp3="Sorry, there was an error uploading your file.";
									    	    }
										  }
								 }
								//end upload mp3 //
							
				////update//
				if($mp3name!=""){
					$update=mysql_query(" UPDATE mp3 SET name='$mp3name' where id='$mp3_id' ");
					$reponse="Emissions updated";
				}
				if($imgupdate!=""){
					$update=mysql_query(" UPDATE mp3 SET image='$imgupdate' where id='$mp3_id'");
					$reponse="Emissions updated";
					unlink ("../".$img_db);
				}
				if($mp3update	!=""){
					$update=mysql_query(" UPDATE mp3 SET resource='$mp3update' where id='$mp3_id'");
					$reponse="Emissions updated";
					unlink ("../".$resource_db);
				}


					///////////////////
		}
	}
}
					$array['reponse_mp3'] = $reponse_mp3;
					$array['reponse_img'] = $reponse_img;	
					$array['resource'] = $resource;
					$array['mp3name'] = $mp3name;
					$array['img'] = $img;
					$array['nb'] = $nb;
					$array['reponse'] = $reponse;
					
					if (isset($_POST['idmp3']))
						echo json_encode($array); 
					else 
					 	header("location: index.php");

					function RandomString()
					{
					    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
					    $randstring = "";
					    for ($i = 0; $i < 7; $i++) {
					        $randstring .= $characters[rand(0, strlen($characters)-1)];
					    }
					    return $randstring;
} 
?>