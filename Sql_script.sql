CREATE DATABASE IF NOT EXISTS Data_pets;


USE Data_pets;

create table pets (
    pet_id INT auto_increment PRIMARY KEY,
    name varchar(100)  NOT NULL,
    age INT NOT NULL,
    gender ENUM('Male','Female') NOT NULL
);

INSERT INTO pets (name,age,gender) VALUES
('Thomas', 1, 'Male'),
('Belly', 3, 'Male'),
('Garfield', 6, 'Female'),
('Sir Willam', 9, 'Male'),
('Carrot', 1, 'Female'),
('Sebastian', 1,'Male'),
('Sam', 4, 'Female'),
('Roshi', 3, 'Male');

create table donations (
    donation_id INT auto_increment PRIMARY KEY,
    full_name varchar(200) NOT NULL,
    email varchar(200) NOT NULL,
    amount decimal (10, 2) NOT NULL,
    payment_method ENUM('credit-card', 'paypal', 'bank transfer') Not null
);

INSERT INTO donations (full_name, email, amount, payment_method) VALUES 
('Diddy kong', 'KongNumba2@gmail.com', 50.00, 'credit-card'),
('Bob Allen', 'SlimBob@gmail.com', 200.00, 'paypal'),
('David green', 'greenGuy@gmail.com', 30.00, 'paypal'),
('Emma Jhonson', 'emma123@gmail.com', 80.20, 'bank transfer'),
('King K Roll', 'KingOfkings@gmail.com', 500.50, 'credit-card');

create table adoptoin_applications (
    application_id INT auto_increment PRIMARY KEY,
    pet_id INT,
    adopter_name varchar(100) NOT NULL,
    adoption_date DATE NOT NULL,
    status ENUM('pending', 'approved', 'denied') NOT NULL DEFAULT 'pending',
    FOREIGN KEY (pet_id) REFERENCES pets(pet_id)
);

INSERT INTO adoptoin_applications (pet_id,adopter_name,adoption_date,status) VALUES
(1, 'Jhonny Philip','2025-12-01', 'pending'),
(3, 'Alice Jhonson', '2025-11-02', 'approved'),
(5, 'King K Roll', '2025-12-03', 'denied'),
(2, 'Knight Night', '2025-12-05', 'pending'),
(4, 'Bob Williams', '2025-12-04', 'pending');

CREATE TABLE IF NOT EXISTS feedback (
    feedback_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(200) NOT NULL,
    email VARCHAR(200) NOT NULL,
    phone VARCHAR(20),
    services_used VARCHAR(255),
    satisfaction_level VARCHAR(50),
    recommendation_score INT,
    comments TEXT,
    pet_reference VARCHAR(50),
    contact_permission BOOLEAN DEFAULT 0,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO feedback (full_name, email, services_used, satisfaction_level, recommendation_score, comments) VALUES
('Sarah Miller', 'sarah@email.com', 'adoption,donation', 'very-satisfied', 9, 'Great service!'),
('Mike Johnson', 'mike@email.com', 'volunteer', 'satisfied', 8, 'Very rewarding experience');


CREATE TABLE IF NOT EXISTS volunteers (
    volunteer_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(200) NOT NULL,
    email VARCHAR(200) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    preferred_role VARCHAR(100) NOT NULL,
    availability VARCHAR(50) NOT NULL,
    reason TEXT NOT NULL,
    application_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS contacts (
    contact_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(200) NOT NULL,
    email VARCHAR(200) NOT NULL,
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);