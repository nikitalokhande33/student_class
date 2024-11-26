<?php
// Database connection settings
$host = 'localhost';
$dbname = 'student_db'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $course = htmlspecialchars($_POST['course']);
    $dob = htmlspecialchars($_POST['dob']);

    // Insert data into the database
    $sql = "INSERT INTO students (name, email, phone, course, dob) VALUES (:name, :email, :phone, :course, :dob)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':course' => $course,
            ':dob' => $dob,
        ]);
        echo "Student registered successfully!";
    } catch (Exception $e) {
        echo "Failed to register student: " . $e->getMessage();
    }
}
?>
