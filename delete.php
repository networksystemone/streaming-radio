<?php
 
    //Start session
    session_start();
    $reponse="";
if (!isset($_SESSION['SESS_USERNAME']))
{
$reponse="login";}
else{ 
	$id_member=$_SESSION['SESS_MEMBER_ID'];
	if (isset($_POST['idshare'])){
	require_once('./config/connection.php');
	
	$id_share =stripslashes($_POST['idshare']);
	$id_share = strip_tags($id_share);
	$id_share = mysql_real_escape_string($id_share);
	$id_share = htmlspecialchars($id_share);
	
	$result = mysql_query("SELECT * FROM share where id='$id_share' AND id_member=$id_member" );
	if (mysql_num_rows($result)==0){
		$reponse="0";}
	else {
	$r = mysql_query("SELECT * FROM share where id='$id_share'" );
	while ($r_row = mysql_fetch_assoc($r)){
	$id_mp3=$r_row ['id_mp3'];}
		// update user nb_share --
	$nb=mysql_query("SELECT * FROM member where id='$id_member'" );
	while ($nb_row = mysql_fetch_assoc($nb)){
	$nb_c=$nb_row['nb_share'];}mysql_free_result($nb);
	$nb_c=$nb_c-1;
	$update=mysql_query(" UPDATE member SET nb_share='$nb_c' where id='$id_member' ");
	//update mp3 nb_share --
	$delete=mysql_query("DELETE FROM share where id='$id_share' " );
		$delshare=mysql_query("SELECT * FROM mp3 where id='$id_mp3'" );
	while ($delshare_row = mysql_fetch_assoc($delshare)){
	$nb_share=$delshare_row['nb_share'];}
	$nb_share=$nb_share-1;
	$update=mysql_query(" UPDATE mp3 SET nb_share='$nb_share' where id='$id_mp3' ");
	$reponse="1";
		}
	}
}
echo json_encode($reponse);  
?>
