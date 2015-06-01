    <?php
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // check connection
    if ($mysqli->connect_errno){
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
    }
     
    $query = 'SELECT name FROM mp3';
     
    if(isset($_POST['query'])){
        $mot = stripslashes($_POST['query']);
        $mot = strip_tags($mot);
        $mot = mysql_real_escape_string($mot);
        $mot = htmlspecialchars($mot);
    // Add validation and sanitization on $_POST['query'] here
     
    // Now set the WHERE clause with LIKE query
    $query .= ' WHERE name LIKE "%'.$mot.'%"';
    }
     
    $return = array();
     
    if($result = $mysqli->query($query)){
    // fetch object array
    while($obj = $result->fetch_object()) {
    $return[] = $obj->name;
    }
    // free result set
    $result->close();
    }
     
    // close connection
    $mysqli->close();
     
    $json = json_encode($return);
    print_r($json);