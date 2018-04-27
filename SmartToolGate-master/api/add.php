<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Creating Array for JSON response
$response = array();
 
// Check if we got the field from the user
if (isset($_GET['tag']) && isset($_GET['price'])) {
 
    $tag = $_GET['tag'];
    $amt = $_GET['price'];
 
    // Include data base connect class
    $filepath = realpath (dirname(__FILE__));
	require_once($filepath."/db_connect.php");

 
    // Connecting to database 
    $db = new DB_CONNECT();

    $result = mysql_query("SELECT Balance FROM SmartTollGate WHERE Rtag = '$tag'") or die(mysql_error());
    $row = mysql_fetch_array($result);
    $bal = $row["Balance"];
    $bal = $bal + $amt;
    $result = mysql_query("UPDATE SmartTollGate SET Balance = '$bal' WHERE Rtag = '$tag'");
 
    // Check for succesfull execution of query
    if ($result) {
        // successfully inserted 
        $response["success"] = "amount successfully added.";
 
        // Show JSON response
        echo json_encode($response);
    } else {
        // Failed to insert data in database
        $response["success"] = "Something went wrong";
 
        // Show JSON response
        echo json_encode($response);
    }
} else {
    // If required parameter is missing
    $response["success"] = "Please fill all the required fields.";
 
    // Show JSON response
    echo json_encode($response);
}
?>