<?php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $amount = floatval($_POST['amount']);
    $payment_method = $conn->real_escape_string($_POST['payment']);
    $message = isset($_POST['message']) ? $conn->real_escape_string($_POST['message']) : '';
    
    $sql = "INSERT INTO donations (full_name, email, amount, payment_method, message) 
            VALUES ('$name', '$email', $amount, '$payment_method', '$message')";
    
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Donation Confirmation - PawsHome</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body class='bg-light'>
        <div class='container mt-5'>
            <div class='card shadow-lg'>
                <div class='card-header bg-success text-white'>
                    <h3 class='mb-0'>Donation Confirmation</h3>
                </div>
                <div class='card-body'>";
    
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>
                <h4><i class='fas fa-heart me-2'></i>Thank You for Your Donation!</h4>
                <p>Your generous donation has been received.</p>
              </div>
              
              <h5>Donation Details:</h5>
              <table class='table table-bordered'>
                <tr><th>Name</th><td>$name</td></tr>
                <tr><th>Email</th><td>$email</td></tr>
                <tr><th>Amount</th><td>\$$amount</td></tr>
                <tr><th>Payment Method</th><td>$payment_method</td></tr>
                <tr><th>Transaction ID</th><td>PH-" . rand(1000, 9999) . "-" . $conn->insert_id . "</td></tr>
              </table>";
    } else {
        echo "<div class='alert alert-danger'>
                <h4>Error Processing Donation</h4>
                <p>Error: " . $conn->error . "</p>
              </div>";
    }
    
    echo "<div class='mt-4'>
            <a href='donate.html' class='btn btn-success'>Make Another Donation</a>
            <a href='index.html' class='btn btn-outline-secondary ms-2'>Return to Home</a>
          </div>
        </div></div></div>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>
    </body>
    </html>";
}

$conn->close();
?>