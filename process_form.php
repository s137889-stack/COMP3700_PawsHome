<?php
require_once 'db_connection.php';

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['phone']);
    
    // Basic validation
    if (empty($name) || empty($email)) {
        echo "Please fill in all required fields.";
        exit;
    }
    
    // Insert into database
    $sql = "INSERT INTO users (name, email, phone) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $phone);
    
    if ($stmt->execute()) {
        echo "<h2>Form Submitted Successfully!</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Field</th><th>Value</th></tr>";
        echo "<tr><td>Name</td><td>$name</td></tr>";
        echo "<tr><td>Email</td><td>$email</td></tr>";
        echo "<tr><td>Phone</td><td>$phone</td></tr>";
        echo "</table>";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}
$conn->close();
?>