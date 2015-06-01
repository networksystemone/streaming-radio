<?php
 
    //Start session
    session_start();
    $nb=0;
    $reponse="";
if (!isset($_SESSION['SESS_USERNAME']))
{
$reponse="login";}
else{ 
	$id_member=$_SESSION['SESS_MEMBER_ID'];
	if (isset($_POST['idmp3'])){
	require_once('./config/connection.php');
	$id_mp3=stripslashes($_POST['idmp3']);
	$id_mp3 = strip_tags($id_mp3);
	$id_mp3 = mysql_real_escape_string($id_mp3);
	$id_mp3 = htmlspecialchars($id_mp3);
	
	$result = mysql_query("SELECT * FROM `like` where id_mp3='$id_mp3' AND id_member='$id_member'" );
	if (mysql_num_rows($result)==0) {
	$insert = mysql_query("INSERT INTO `like` (id_mp3,id_member) VALUES ('$id_mp3','$id_member')");
		// update user nb_like ++
	$nb=mysql_query("SELECT * FROM member where id='$id_member'" );
	while ($nb_row = mysql_fetch_assoc($nb)){
			$nb_c=$nb_row['nb_like'];}mysql_free_result($nb);
	$nb_c=$nb_c+1;
	$update=mysql_query(" UPDATE member SET nb_like='$nb_c' where id='$id_member' ");
	//update mp3 nb_like ++
	$nb = mysql_query("SELECT * FROM mp3 where id='$id_mp3' " );
	while ($nb_row = mysql_fetch_assoc($nb)){
	$nb_like=$nb_row['nb_like'];
	}
	$nb_like++;
	$update = mysql_query("UPDATE mp3 SET nb_like='$nb_like' where id='$id_mp3'");
	$reponse="1";
	$nb=$nb_like;}
	else {
	$delete=mysql_query("DELETE FROM `like` where id_mp3='$id_mp3' and id_member='$id_member'" );
			// update user nb_like --
	$nb=mysql_query("SELECT * FROM member where id='$id_member'" );
	while ($nb_row = mysql_fetch_assoc($nb)){
			$nb_c=$nb_row['nb_like'];}mysql_free_result($nb);
	$nb_c=$nb_c-1;
	$update=mysql_query("UPDATE member SET nb_like='$nb_c' where id='$id_member' ");
	//update mp3 nb_like --
	$nb = mysql_query("SELECT * FROM mp3 where id='$id_mp3' " );
	while ($nb_row = mysql_fetch_assoc($nb)){
	$nb_like=$nb_row['nb_like'];
	}
	$nb_like--;
    $update = mysql_query("UPDATE mp3 SET nb_like='$nb_like' where id='$id_mp3'");
    $reponse="0";
    $nb=$nb_like;}
	}
}
$array['nb'] = $nb;
$array['reponse'] = $reponse;
echo json_encode($array);  
?>
