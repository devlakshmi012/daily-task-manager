<?php
$host = "localhost";
$db_username = "root";
$password = "";
$dbname = "task_manager";
// Create connection 
$conn = new mysqli($host, $db_username, $password, $dbname);

// Check connection 
if ($conn->connect_errno) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // echo "connection Sucssesful!";
}
// Always close connection when done
// $conn->close(); 


// Check connection 
// if (!$conn->connect_errno) {
//     echo "connection Sucssesful!";
// } else {
//     die("Connection failed: " . $conn->connect_error);
// }

