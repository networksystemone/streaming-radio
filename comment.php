<?php
 
    //Start session
    session_start();
    $nb=0;
    $id=0;
    $reponse="";
if (!isset($_SESSION['SESS_USERNAME']))
{
$reponse="login";}
else{ 
	$id_user=$_SESSION['SESS_MEMBER_ID'];
	require_once('./config/connection.php');
	if (isset($_POST['idmp3'])){
	$id_mp3=stripslashes($_POST['idmp3']);
	$id_mp3 = strip_tags($id_mp3);
	$id_mp3 = mysql_real_escape_string($id_mp3);
	$id_mp3 = htmlspecialchars($id_mp3);
	$result = mysql_query("SELECT * FROM `comment` where id_mp3='$id_mp3' order by time desc" );
	if (mysql_num_rows($result)==0) {
		$reponse="no_comment";
	}else{
		while ($result_row = mysql_fetch_assoc($result)){
			$text		     =$result_row['text'];
			$id_member       =$result_row['id_member'];
			$user   = mysql_query("SELECT * FROM member  where id='$id_member'" );
			while ($user_row = mysql_fetch_assoc($user))  {
				$img=$user_row['img'];
				$username=$user_row['username'];
				$userid=$user_row['id'];}
				$comment_date=$result_row['comment_date'];
				$comment_time=$result_row['comment_time'];
				$d=new DateTime($comment_date.' '.$comment_time);
				$time_string=date_format($d, 'g:ia \o\n jS F Y');
				$reponse=$reponse.'<li>
								   <div class="commenterImage">
								   <img src="'.$img.'" height="50" width="50" href="http://127.0.0.1/www/layoutit/profile.php?id='.$userid.'" />
								   </div>
								   <a class="" href="http://127.0.0.1/www/layoutit/profile.php?id='.$userid.'">'.$username.'</a	> 
								   <div class="commentText">
								   <p class="" >'.$text.'</a	> 
								   <span class="date sub-text">on '.$time_string.'</span>
								   </div> 
							  </li>';
			}
	} 
  }
  else if (isset($_POST['id'])&&isset($_POST['text'])){
		$id_mp3=stripslashes($_POST['id']) ;
		$id_mp3 = strip_tags($id_mp3);
		$id_mp3 = mysql_real_escape_string($id_mp3);
		$id_mp3 = htmlspecialchars($id_mp3);
	
		$text=stripslashes($_POST['text']) ;
		$text = strip_tags($text);
		$text = mysql_real_escape_string($text);
		$text = htmlspecialchars($text);
	
		$date = date('Y-m-d');
		$time = date('H:i:s');
		$tm = (int) time();
		$insert = mysql_query("INSERT INTO comment(id_mp3,id_member,text,time,comment_date,comment_time) VALUES ('$id_mp3','$id_user','$text','$tm','$date','$time')");
		$r = mysql_query("SELECT * FROM `comment` where id_mp3='$id_mp3' order by time desc" );
		while ($r_row = mysql_fetch_assoc($r)){
			$text		     =$r_row['text'];
			$id_member       =$r_row['id_member'];
			$user= mysql_query("SELECT * FROM member  where id='$id_member'" );
			while ($user_row = mysql_fetch_assoc($user)){  
			$img=$user_row['img'];
			$username=$user_row['username'];
			$userid=$user_row['id'];}
			$comment_date=$r_row['comment_date'];
			$comment_time=$r_row['comment_time'];
			$d=new DateTime($comment_date.' '.$comment_time);
			$time_string=date_format($d, 'g:ia \o\n jS F Y');
			$reponse=$reponse.'<li>
								   <div class="commenterImage">
								   <img src="'.$img.'" height="50" width="50" href="http://127.0.0.1/www/layoutit/profile.php?id='.$userid.'" />
								   </div>
								   <a class="" href="http://127.0.0.1/www/layoutit/profile.php?id='.$userid.'">'.$username.'</a	> 
								   <div class="commentText">
								   <p class="" >'.$text.'</a	> 
								   <span class="date sub-text">on '.$time_string.'</span>
								   </div> 
							  </li>';
			}mysql_free_result($r);
			// update user nb_comment
			$nb=mysql_query("SELECT * FROM member where id='$id_user'" );
			while ($nb_row = mysql_fetch_assoc($nb)){
			$nb_c=$nb_row['nb_comment'];}mysql_free_result($nb);
			$nb_c=$nb_c+1;
			$update=mysql_query(" UPDATE member SET nb_comment='$nb_c' where id='$id_user' ");
			//update mp3 nb_comment
			$nbcomment=mysql_query("SELECT * FROM mp3 where id='$id_mp3'" );
			while ($nbcomment_row = mysql_fetch_assoc($nbcomment)){
			$nb_comment=$nbcomment_row['nb_comment'];}mysql_free_result($nbcomment);
			$nb_comment=$nb_comment+1;
			$update=mysql_query(" UPDATE mp3 SET nb_comment='$nb_comment' where id='$id_mp3' ");
			$nb=$nb_comment;			
			$id=$id_mp3;
	}
}

			$array['nb'] = $nb;
			$array['id'] = $id;
			$array['reponse'] = $reponse;
			echo json_encode($array);
 
?>
