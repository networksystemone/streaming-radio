<?php
    //Start session
session_start();

if (isset($_GET['page'])){
	$page =stripslashes($_GET['page']);
	$page = strip_tags($page);
	$page = mysql_real_escape_string($page);
	$page = htmlspecialchars($page);
$array = array(); 
require_once('./config/connection.php');
if($page=="home"){
$result = mysql_query("SELECT * FROM mp3 order by mp3_date desc,mp3_time desc" );
$id=1;
while ($row = mysql_fetch_assoc($result)) {
        $name=$row['name'];
        $image=$row['image'];
        $id_mp3=$row['id'];
        $file = $row['resource'];
        $array[] = array('img' => "$image",'track' => "$id" ,'name' => "$name" ,'file' => "$file");
        $id++;
}mysql_free_result($result);
  echo json_encode($array);}
  
  else  if($page=="search"){
  	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
     
    // check connection
    if ($mysqli->connect_errno){
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
    }

    $query = 'SELECT * FROM mp3';
     
    if(isset($_GET['query'])){
	$mot = stripslashes($_GET['query']);
	$mot = strip_tags($mot);
	$mot = mysql_real_escape_string($mot);
	$mot = htmlspecialchars($mot);
    $query .= ' WHERE name LIKE "%'.$mot.'%"';
    }
    $query .= ' order by mp3_date desc ,mp3_time desc';
    $return = array();
    if($result = $mysqli->query($query)){
    // fetch object array
    $id=1;
    while($obj = $result->fetch_object()) {
    $name= $obj->name;
    $image= $obj->image;
	$id_mp3= $obj->id;
	$file = $obj->resource;
	$return[] = array('img' => "$image",'track' => "$id" ,'name' => "$name" ,'file' => "$file");
	$id++;
    }
    // free result set
    $result->close();
    }  
    $json = json_encode($return);
    print_r($json);}
	else if($page=="profile") {
					if(isset($_GET['id'])){
						if (!isset($_SESSION['SESS_USERNAME'])){
							$rep=1;
							echo json_encode($rep);}
						else{
							$id_member =stripslashes($_GET['id']);
							$id_member = strip_tags($id_member);
							$id_member = mysql_real_escape_string($id_member);
							$id_member = htmlspecialchars($id_member);
							
							$profile = mysql_query("SELECT * FROM share where id_member=$id_member order by time desc " );
							if (mysql_num_rows($profile)==0){
							$rep=2;
							echo json_encode($rep);}
							else{
							$key=1;
							while ($row_profile = mysql_fetch_assoc($profile)) {
									$share_time = $row_profile['share_time'];
									$time = $row_profile['time'];
									$id_mp3 = $row_profile['id_mp3'];
									$result = mysql_query("SELECT * FROM mp3 where id =$id_mp3" );
									while ($row_result = mysql_fetch_assoc($result)) {
									$name=$row_result['name'];
									$image=$row_result['image'];
									$file = $row_result['resource'];
									$array[] = array('img' => "$image",'track' => "$key" ,'name' => "$name" ,'file' => "$file");	
									$key++; }
							
								} echo json_encode($array);
							}
		  }
	  }else{$rep=3; echo json_encode($rep);}
  }else{$rep=4; echo json_encode($rep);}
		 
}else {$rep=5; echo json_encode($rep);}
	


?>
