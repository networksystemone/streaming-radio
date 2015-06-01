<?php

require_once('./config/connection.php');
$r = mysql_query("SELECT * FROM mp3" );
while ($row = mysql_fetch_assoc($r)) {
$results[]=$row['name'];
}mysql_free_result($r);
echo json_encode($results);

?>
