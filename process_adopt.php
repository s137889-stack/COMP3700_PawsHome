<?php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $petname = $conn->real_escape_string($_POST['petname']);
    $had_pet = $conn->real_escape_string($_POST['ownedPet']);
    $reason = $conn->real_escape_string($_POST['reason']);
    
    // Handle other pets checkboxes
    $other_pets = '';
    if(isset($_POST['otherPets'])) {
        $other_pets = implode(', ', $_POST['otherPets']);
    }
    
    $home_size = intval($_POST['home-size']);
    $activity_level = intval($_POST['activity']);
    
    $sql = "INSERT INTO adoption_applications (adopter_name, email, phone, pet_name, had_pet_before, 
            reason, other_pets, home_size, activity_level) 
            VALUES ('$fullname', '$email', '$phone', '$petname', '$had_pet', '$reason', 
            '$other_pets', $home_size, $activity_level)";
    
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Adoption Application - PawsHome</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body class='bg-light'>
        <div class='container mt-5'>
            <div class='card shadow-lg'>
                <div class='card-header bg-primary text-white'>
                    <h3 class='mb-0'>Adoption Application Received</h3>
                </div>
                <div class='card-body'>";
    
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>
                <h4><i class='fas fa-paw me-2'></i>Application Submitted Successfully!</h4>
                <p>Your application ID: <strong>PAWS-" . $conn->insert_id . "</strong></p>
                <p>We will review your application and contact you within 3 business days.</p>
              </div>
              
              <h5>Application Summary:</h5>
              <table class='table table-bordered'>
                <tr><th>Adopter Name</th><td>$fullname</td></tr>
                <tr><th>Email</th><td>$email</td></tr>
                <tr><th>Phone</th><td>$phone</td></tr>
                <tr><th>Pet to Adopt</th><td>$petname</td></tr>
                <tr><th>Previous Pet Experience</th><td>" . ucfirst($had_pet) . "</td></tr>
                <tr><th>Home Size</th><td>$home_size m²</td></tr>
                <tr><th>Activity Level</th><td>$activity_level/10</td></tr>
              </table>";
    } else {
        echo "<div class='alert alert-danger'>
                <h4>Error Processing Application</h4>
                <p>Error: " . $conn->error . "</p>
              </div>";
    }
    
    echo "<div class='mt-4'>
            <a href='adopt.html' class='btn btn-primary'>Submit Another Application</a>
            <a href='index.html' class='btn btn-outline-secondary ms-2'>Return to Home</a>
          </div>
        </div></div></div>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>
    </body>
    </html>";
}

$conn->close();
?>