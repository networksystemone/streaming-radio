<?php
 
    //Start session
    session_start();
    $reponse="";
if (!isset($_SESSION['SESS_ADMIN_ID']))
{
$reponse="login";}
else{ 
	if (isset($_POST['id_delet'])){
		require_once('../config/connection.php');
		$id_delet =stripslashes($_POST['id_delet']);
		$id_delet = strip_tags($id_delet);
		$id_delet = mysql_real_escape_string($id_delet);
		$id_delet = htmlspecialchars($id_delet);
		$result = mysql_query("SELECT * FROM member where id='$id_delet'" );
		if (mysql_num_rows($result)==0){
			$reponse="0";}
		else {
				//delete share//
			$result_share= mysql_query("SELECT * FROM share where id_member='$id_delet'" );
			if (mysql_num_rows($result_share)==0){
				$reponse="1";}
			else {
					while ($share_row = mysql_fetch_assoc($result_share)){
						$id_mp3=$share_row['id_mp3'];
						$nb=mysql_query("SELECT * FROM mp3 where id='$id_mp3'" );
						while ($nb_row = mysql_fetch_assoc($nb)){
								$nb_share=$nb_row['nb_share'];}mysql_free_result($nb);
						$nb_share=$nb_share-1;
						$update=mysql_query(" UPDATE mp3 SET nb_share='$nb_share' where id='$id_mp3' ");
					}
			}
			$delete_user_share=mysql_query("DELETE FROM share where id_member='$id_delet'" );

				//delete comment//
			$result_comment= mysql_query("SELECT * FROM comment where id_member='$id_delet'" );
			if (mysql_num_rows($result_comment)==0){
				$reponse="2";}
			else {
					while ($comment_row = mysql_fetch_assoc($result_comment)){
						$id_mp3=$comment_row['id_mp3'];
						$nb=mysql_query("SELECT * FROM mp3 where id='$id_mp3'" );
						while ($nb_row = mysql_fetch_assoc($nb)){
								$nb_comment=$nb_row['nb_comment'];}mysql_free_result($nb);
						$nb_comment=$nb_comment-1;
						$update=mysql_query(" UPDATE mp3 SET nb_comment='$nb_comment' where id='$id_mp3' ");
					}
			}
			$delete_comment=mysql_query("DELETE FROM comment where id_member='$id_delet'" );

				//delete Like//
			$result_like= mysql_query("SELECT * FROM `like` where id_member='$id_delet'" );
			if (mysql_num_rows($result_like)==0){
				$reponse="3";}
			else {
					while ($like_row = mysql_fetch_assoc($result_like)){
						$id_mp3=$like_row['id_mp3'];
						$nb=mysql_query("SELECT * FROM mp3 where id='$id_mp3'" );
						while ($nb_row = mysql_fetch_assoc($nb)){
								$nb_like=$nb_row['nb_like'];}mysql_free_result($nb);
						$nb_like=$nb_like-1;
						$update=mysql_query(" UPDATE mp3 SET nb_like='$nb_like' where id_mp3='$id_mp3'");
					}
			}
			$delete_comment=mysql_query("DELETE FROM `like` where id_member='$id_delet'" );

			//Delte user //
			$delete_user=mysql_query("DELETE FROM member where id='$id_delet'" );
			if($delete_user) $reponse="4";
			else $reponse="5";
		}
	}
}
echo json_encode($reponse);  
?>
