<?php
require_once 'db_connection.php';

// Define Pet class
class Pet {
    public $pet_id;
    public $name;
    public $age;
    public $gender;
    
    public function __construct($pet_id, $name, $age, $gender) {
        $this->pet_id = $pet_id;
        $this->name = $name;
        $this->age = $age;
        $this->gender = $gender;
    }
    
    public function displayRow() {
        $ageText = $this->age == 1 ? "1 year" : "$this->age years";
        $genderIcon = $this->gender == 'Male' ? '♂' : '♀';
        
        return "<tr>
            <td>$this->pet_id</td>
            <td><strong>$this->name</strong></td>
            <td>$ageText</td>
            <td>$genderIcon $this->gender</td>
        </tr>";
    }
}

// Function to display array of objects as HTML table
function displayPetsTable($petsArray) {
    echo "<div class='table-responsive'>
            <table class='table table-striped table-bordered'>
                <thead class='table-dark'>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                    </tr>
                </thead>
                <tbody>";
    
    foreach ($petsArray as $pet) {
        echo $pet->displayRow();
    }
    
    echo "</tbody></table></div>";
}

// Retrieve data from database
$sql = "SELECT * FROM pets";
$result = $conn->query($sql);

// Create array of Pet objects
$pets = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $pet = new Pet(
            $row['pet_id'],
            $row['name'],
            $row['age'],
            $row['gender']
        );
        array_push($pets, $pet);
    }
}

// Display the page
echo "<!DOCTYPE html>
<html>
<head>
    <title>Available Pets - PawsHome</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    <style>
        .pet-header { background: linear-gradient(135deg, #87C38F 0%, #4CAF50 100%); }
    </style>
</head>
<body class='bg-light'>
    <div class='container mt-5'>
        <div class='card shadow-lg'>
            <div class='card-header pet-header text-white'>
                <h2 class='mb-0'><i class='fas fa-paw me-2'></i>Available Pets for Adoption</h2>
            </div>
            <div class='card-body'>";
            
            if (count($pets) > 0) {
                displayPetsTable($pets);
                echo "<p class='mt-3'>Total pets available: <strong>" . count($pets) . "</strong></p>";
            } else {
                echo "<div class='alert alert-info'>
                        <h4>No Pets Available</h4>
                        <p>All our pets have found loving homes! Check back soon.</p>
                      </div>";
            }
            
echo "      </div>
            <div class='card-footer'>
                <a href='adopt.html' class='btn btn-success'>Adopt a Pet</a>
                <a href='index.html' class='btn btn-outline-secondary ms-2'>Return to Home</a>
            </div>
        </div>
    </div>
    
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js'></script>
</body>
</html>";

$conn->close();
?>