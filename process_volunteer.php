<?php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $role = $conn->real_escape_string($_POST['role']);
    $availability = $conn->real_escape_string($_POST['availability']);
    $reason = $conn->real_escape_string($_POST['reason']);
    
    $sql = "INSERT INTO volunteers (full_name, email, phone, preferred_role, availability, reason) 
            VALUES ('$name', '$email', '$phone', '$role', '$availability', '$reason')";
    

}

$conn->close();
?>