<?php
require_once 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Submitted - PawsHome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-header {
            background: linear-gradient(135deg, #8B4513 0%, #43291F 100%);
        }
        .bg-brown { background-color: #8B4513 !important; }
    </style>
</head>
<body class="bg-success bg-opacity-25">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="bg-light rounded-3 shadow-lg overflow-hidden">
                    <div class="form-header text-white text-center py-4">
                        <h2 class="mb-3"><i class="fas fa-comment-dots me-2"></i>Feedback Submission Confirmation</h2>
                    </div>
                    
                    <div class="p-4 p-md-5">
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            // Get and sanitize form data
                            $full_name = $conn->real_escape_string($_POST['fullName']);
                            $email = $conn->real_escape_string($_POST['email']);
                            $phone = isset($_POST['phone']) ? $conn->real_escape_string($_POST['phone']) : '';
                            
                            // Handle checkboxes (services)
                            $services_used = '';
                            if(isset($_POST['services'])) {
                                $services_used = implode(',', $_POST['services']);
                            }
                            
                            $satisfaction = isset($_POST['satisfaction']) ? $conn->real_escape_string($_POST['satisfaction']) : '';
                            $recommendation = isset($_POST['recommendation']) ? intval($_POST['recommendation']) : 0;
                            $comments = isset($_POST['comments']) ? $conn->real_escape_string($_POST['comments']) : '';
                            $pet_reference = isset($_POST['petReference']) ? $conn->real_escape_string($_POST['petReference']) : '';
                            $contact_permission = isset($_POST['contactPermission']) ? 1 : 0;
                            
                            // Insert into database
                            $sql = "INSERT INTO feedback (full_name, email, phone, services_used, satisfaction_level, 
                                    recommendation_score, comments, pet_reference, contact_permission) 
                                    VALUES ('$full_name', '$email', '$phone', '$services_used', '$satisfaction', 
                                    $recommendation, '$comments', '$pet_reference', $contact_permission)";
                            
                            if ($conn->query($sql) === TRUE) {
                                echo "<div class='alert alert-success'>";
                                echo "<h4><i class='fas fa-check-circle me-2'></i>Thank You for Your Feedback!</h4>";
                                echo "<p>Your feedback has been successfully submitted and recorded.</p>";
                                echo "</div>";
                                
                                echo "<h5 class='mt-4'>Submission Details:</h5>";
                                echo "<table class='table table-bordered'>";
                                echo "<tr><th>Field</th><th>Value</th></tr>";
                                echo "<tr><td>Full Name</td><td>$full_name</td></tr>";
                                echo "<tr><td>Email</td><td>$email</td></tr>";
                                echo "<tr><td>Phone</td><td>" . ($phone ?: 'Not provided') . "</td></tr>";
                                echo "<tr><td>Services Used</td><td>" . ($services_used ?: 'None selected') . "</td></tr>";
                                echo "<tr><td>Satisfaction Level</td><td>$satisfaction</td></tr>";
                                echo "<tr><td>Recommendation Score</td><td>$recommendation/10</td></tr>";
                                echo "</table>";
                            } else {
                                echo "<div class='alert alert-danger'>";
                                echo "<h4>Error!</h4>";
                                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
                                echo "</div>";
                            }
                        } else {
                            echo "<div class='alert alert-warning'>";
                            echo "<h4>No Data Submitted</h4>";
                            echo "<p>Please submit the feedback form first.</p>";
                            echo "</div>";
                        }
                        ?>
                        
                        <div class="mt-4">
                            <a href="questionnaire.html" class="btn btn-brown text-white">
                                <i class="fas fa-arrow-left me-2"></i>Back to Feedback Form
                            </a>
                            <a href="index.html" class="btn btn-outline-secondary ms-2">
                                <i class="fas fa-home me-2"></i>Return to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>