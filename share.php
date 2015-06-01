<?php
 
    //Start session
    session_start();
    $nb=0;
    $reponse="";
    $img="";
if (!isset($_SESSION['SESS_USERNAME']))
{
$session=0 ;
$reponse="login";}
else{ 
	require_once('./config/connection.php');
	if (isset($_POST['idmp3'])){
	$idmp3=stripslashes($_POST['idmp3']);
	$idmp3 = strip_tags($idmp3);
	$idmp3 = mysql_real_escape_string($idmp3);
	$idmp3 = htmlspecialchars($idmp3);
	$result = mysql_query("SELECT * FROM mp3 WHERE id='$idmp3'");
	if (mysql_num_rows($result)==0)
		$reponse="No such song";
	else {
	while ($re_row = mysql_fetch_assoc($result)){
	$img=$re_row['image'];}mysql_free_result($result);
		}
	}
	else  if (isset($_POST['id'])){
	
	$id_mp3=stripslashes($_POST['id']);
	$id_mp3 = strip_tags($id_mp3);
	$id_mp3 = mysql_real_escape_string($id_mp3);
	$id_mp3 = htmlspecialchars($id_mp3);
	$result = mysql_query("SELECT * FROM mp3 where id='$id_mp3'");
	if (mysql_num_rows($result)==0)
		$reponse="No such song";
	else {
	$date = date('Y-m-d');
	$time = date('H:i:s');
	$tm = (int) time();
	$id_member = $_SESSION['SESS_MEMBER_ID'];
	$share = mysql_query("INSERT INTO share (id_mp3,id_member,time,share_date,share_time) VALUES ('$id_mp3','$id_member','$tm','$date','$time')");
	// update user nb_share ++
	$nb=mysql_query("SELECT * FROM member where id='$id_member'" );
	while ($nb_row = mysql_fetch_assoc($nb)){
			$nb_c=$nb_row['nb_share'];}mysql_free_result($nb);
	$nb_c=$nb_c+1;
	$update=mysql_query(" UPDATE member SET nb_share='$nb_c' where id='$id_member' ");
	//update mp3 nb_share ++
	$nbshare=mysql_query("SELECT * FROM mp3 where id='$id_mp3'" );
	while ($nbshare_row = mysql_fetch_assoc($nbshare)){
	$nb_share=$nbshare_row['nb_share'];}
	$nb_share=$nb_share+1;
	$update=mysql_query(" UPDATE mp3 SET nb_share='$nb_share' where id='$id_mp3' ");
	$reponse="successfully shared";
	$nb=$nb_share;}
	}
	else{ $reponse="erreur !";}
}
$array['img'] = $img;
$array['nb'] = $nb;
$array['reponse'] = $reponse;
echo json_encode($array);  
?>
