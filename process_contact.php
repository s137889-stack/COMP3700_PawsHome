<?php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $subject = $conn->real_escape_string($_POST['Subject']);
    $message = $conn->real_escape_string($_POST['message']);
    
    $sql = "INSERT INTO contacts (full_name, email, subject, message) 
            VALUES ('$name', '$email', '$subject', '$message')";
    

}

$conn->close();
?>