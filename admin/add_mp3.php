<?php
    //Start session
    session_start();
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
        if (isset($_FILES['fileimgadd'])
            &&isset($_POST['mp3name_add'])&&isset($_FILES['filemp3add'])
            &&!empty($_FILES['fileimgadd'])&&!empty($_POST['mp3name_add'])
            &&!empty($_FILES['filemp3add'])){

                                $mp3name=$_POST['mp3name_add'];
                                $mp3name = strip_tags($mp3name);
                                $mp3name = mysql_real_escape_string($mp3name);
                                $mp3name = htmlspecialchars($mp3name);

                                $imgadd="";
                                $mp3add="";
                                        //upload img 
                                if($_FILES['fileimgadd']['error'] == 0)  {
                                    $target_dir_db = "./img/mp3/";
                                    $target_dir = "../img/mp3/";
                                    $target_file = $target_dir . basename($_FILES["fileimgadd"]["name"]);
                                    $uploadOk = 1;
                                    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                                    $newid = RandomString();
                                    $newname = $newid . ".jpg";
                                    // Check if image file is a actual image or fake image
                                    $check = getimagesize($_FILES["fileimgadd"]["tmp_name"]);
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
                                    if ($_FILES["fileimgadd"]["size"] > 500000) {
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
                                            if (move_uploaded_file($_FILES["fileimgadd"]["tmp_name"], $newpath)) {
                                                $reponse_img="The file ". basename( $_FILES["fileimgadd"]["name"]). " has been uploaded.";                                                
                                                $imgadd=$target_dir_db . $newname; }
                                            else $reponse_img="Sorry, there was an error uploading your file.";
                                        
                                            }
                                }
                                //end upload img //

                                //upload mp3 //
                                if($_FILES['filemp3add']['error'] == 0){
                                    $target_dir_db = "./resources/";
                                    $target_dir = "../resources/";
                                    $target_file = $target_dir . basename($_FILES["filemp3add"]["name"]);
                                    $uploadOk = 1;
                                    $mp3FileType = pathinfo($target_file,PATHINFO_EXTENSION);
                                    $newid = RandomString();
                                    $newname = $newid . ".mp3";
                                // Check if image file is a actual image or fake image

                                 /*   $check = getimagesize($_FILES["filemp3add"]["tmp_name"]);
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
                            /*      if ($_FILES["filemp3add"]["size"] > 20971520) {
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
                                            if (move_uploaded_file($_FILES["filemp3add"]["tmp_name"], $newpath)) {
                                                $reponse_mp3="The file ". basename( $_FILES["filemp3add"]["name"]). " has been uploaded.";
                                                $mp3add=$target_dir_db . $newname;;
                                            }else {
                                                    $reponse_mp3="Sorry, there was an error uploading your file.";
                                                }
                                          }
                                 }
                                //end upload mp3 //
                            
                ////update//
                if($mp3name!=""&&$imgadd!=""&&$mp3add!=""){
                    $date = date('Y-m-d');
                    $time = date('H:i:s');
                    $tm = (int) time();
                    $insert=mysql_query(" INSERT INTO mp3
                    (name,image,nb_like,nb_share,nb_comment,time,mp3_date,mp3_time,resource) 
                    VALUES ('$mp3name','$imgadd',0,0,0,$tm,'$date','$time','$mp3add')");
                    $reponse="Emissions add";
                }
                else $reponse="erreur";


                    ///////////////////
        }
    }
                    $array['reponse_mp3'] = $reponse_mp3;
                    $array['reponse_img'] = $reponse_img;   
                    $array['resource'] = $resource;
                    $array['mp3name'] = $mp3name;
                    $array['img'] = $img;
                    $array['reponse'] = $reponse;
                    echo json_encode($array); 
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