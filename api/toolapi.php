<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Creating Array for JSON response
$response = array();
 
// Check if we got the field from the user
if (isset($_GET['tag'])) {
 
    $tag = $_GET['tag'];
}
    // Include data base connect class
    $filepath = realpath (dirname(__FILE__));
	require_once($filepath."/db_connect.php");

 
    // Connecting to database 
    $db = new DB_CONNECT();
 
    

     // Fire SQL query to get all data from weather
$result = mysql_query("SELECT Balance FROM SmartTollGate WHERE Rtag = '$tag'") or die(mysql_error());

// Check for succesfull execution of query and no results found
$row = mysql_fetch_array($result);
$bal = $row["Balance"];
if($bal >= 100)
{
    $bal = $bal - 100 ;

    $result = mysql_query("UPDATE SmartTollGate SET Balance = '$bal' WHERE Rtag = '$tag'");
    if ($result) {
        $mo = 1;
    }else{
    $mo = 0;
    }
}
else{
    $mo = 2;
}
$response = $mo;
echo $response;


?>