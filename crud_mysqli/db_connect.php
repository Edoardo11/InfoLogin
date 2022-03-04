<?php
//set connection variables
$host = "localhost";
$db_name = "my_db";
$username = "root";
$password = "";

//connect to mysql server
$conn = new mysqli($host, $username, $password, $db_name);

//check if any connection error was encountered
if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.";
    exit;
}
