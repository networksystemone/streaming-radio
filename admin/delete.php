<?php
 
    //Start session
    session_start();
    $reponse="";
if (!isset($_SESSION['SESS_ADMIN_ID']))
{
$reponse="login";}
else{ 
	if (isset($_POST['id'])){
		require_once('../config/connection.php');
		$id_mp3 =stripslashes($_POST['id']);
		$id_mp3 = strip_tags($id_mp3);
		$id_mp3 = mysql_real_escape_string($id_mp3);
		$id_mp3 = htmlspecialchars($id_mp3);
		$result = mysql_query("SELECT * FROM mp3 where id='$id_mp3'" );
		if (mysql_num_rows($result)==0){
			$reponse="0";}
		else {
				//delete share//
			$result_share= mysql_query("SELECT * FROM share where id_mp3='$id_mp3'" );
			if (mysql_num_rows($result_share)==0){
				$reponse="1";}
			else {
					while ($share_row = mysql_fetch_assoc($result_share)){
						$id_member=$share_row['id_member'];
						$nb=mysql_query("SELECT * FROM member where id='$id_member'" );
						while ($nb_row = mysql_fetch_assoc($nb)){
								$nb_share=$nb_row['nb_share'];}mysql_free_result($nb);
						$nb_share=$nb_share-1;
						$update=mysql_query(" UPDATE member SET nb_share='$nb_share' where id='$id_member' ");
					}
			}
			$delete_share=mysql_query("DELETE FROM share where id_mp3='$id_mp3' " );

				//delete comment//
			$result_comment= mysql_query("SELECT * FROM comment where id_mp3='$id_mp3'" );
			if (mysql_num_rows($result_comment)==0){
				$reponse="2";}
			else {
					while ($comment_row = mysql_fetch_assoc($result_comment)){
						$id_member=$comment_row['id_member'];
						$nb=mysql_query("SELECT * FROM member where id='$id_member'" );
						while ($nb_row = mysql_fetch_assoc($nb)){
								$nb_comment=$nb_row['nb_comment'];}mysql_free_result($nb);
						$nb_comment=$nb_comment-1;
						$update=mysql_query(" UPDATE member SET nb_comment='$nb_comment' where id='$id_member' ");
					}
			}
			$delete_comment=mysql_query("DELETE FROM comment where id_mp3='$id_mp3' " );

				//delete Like//
			$result_like= mysql_query("SELECT * FROM `like` where id_mp3='$id_mp3'" );
			if (mysql_num_rows($result_like)==0){
				$reponse="3";}
			else {
					while ($like_row = mysql_fetch_assoc($result_like)){
						$id_member=$like_row['id_member'];
						$nb=mysql_query("SELECT * FROM member where id='$id_member'" );
						while ($nb_row = mysql_fetch_assoc($nb)){
								$nb_like=$nb_row['nb_like'];}mysql_free_result($nb);
						$nb_like=$nb_like-1;
						$update=mysql_query(" UPDATE member SET nb_like='$nb_like' where id='$id_member' ");
					}
			}
			$delete_comment=mysql_query("DELETE FROM `like` where id_mp3='$id_mp3' " );

			//Delte mp3 //
			$delete_mp3=mysql_query("DELETE FROM mp3 where id='$id_mp3' " );
		}
	}
}
echo json_encode($reponse);  
?>
