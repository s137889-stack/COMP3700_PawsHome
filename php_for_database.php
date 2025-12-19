<?php 
    $servername = "localhost";  
    $username = "root";         
    $password = "";             
    $dbname = "Data_pets";

    $conn = new mysqli($servername, $username, $password);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database '$dbname' created successfully or already exists.<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

    $conn->select_db($dbname);
    $sql = file_get_contents('Sql_script.sql');
    if ($conn->multi_query($sql)) {
        echo "SQL script executed successfully.";
    } else {
        echo "Error executing script: " . $conn->error;
        }
        
    $conn->close();

?>