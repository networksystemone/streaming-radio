<?php
  session_start();
    $reponse="";
if (!isset($_SESSION['SESS_USERNAME']))
{
$reponse="login";}
else{
     require_once('./config/connection.php');
     $id=$_SESSION['SESS_MEMBER_ID'];
     $first_name="";
     $last_name="";
     $password="";
     $cpassword="";
  if(isset($_POST["first_name"])){
     $first_name=$_POST['first_name'];
     $first_name = strip_tags($first_name);
     $first_name = mysql_real_escape_string($first_name);
     $first_name = htmlspecialchars($first_name);}

  if(isset($_POST["last_name"])){
     $last_name=$_POST['last_name'] ;
     $last_name = strip_tags($last_name);
     $last_name = mysql_real_escape_string($last_name);
     $last_name = htmlspecialchars($last_name);} 

  if(isset($_POST["password"]))  {
     $password=$_POST['password'];
     $password = strip_tags($password);
     $password = mysql_real_escape_string($password);
     $password = htmlspecialchars($password);}

  if(isset($_POST["cpassword"])){ 
     $cpassword=$_POST['cpassword'];
     $cpassword = strip_tags($cpassword);
     $cpassword = mysql_real_escape_string($cpassword);
     $cpassword = htmlspecialchars($cpassword);}
  
 $result = mysql_query("SELECT * FROM member where id='$id'" );
 while ($result_row = mysql_fetch_assoc($result)){
  $first_name_db=$result_row['first_name'];
  $last_name_db=$result_row['last_name'];
  $password_db= $result_row['password'];
  $img_db= $result_row['img'];
  }
if(($first_name_db!=$first_name)&&($first_name!="")){
  $update=mysql_query("UPDATE member SET first_name='$first_name' WHERE id='$id' ");
  $reponse="All changes saved";}

  if(($last_name_db!=$last_name)&&($last_name!="")){
  $update = mysql_query("UPDATE member SET last_name='$last_name' WHERE id='$id' ");
  $reponse="All changes saved";}

if(($password!="")&&($cpassword!="")){
  if($password!=$cpassword){
      $reponse=" Passwords do not match";}
  else{
        if($password_db!=$password){
         $pass = md5($password);
         $update = mysql_query("UPDATE member SET password='$pass' WHERE id='$id' ");
         $reponse="All changes saved"; }
        }
     }
 }
echo json_encode($reponse);

?>