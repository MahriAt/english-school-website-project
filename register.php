<?php
$username = "root";
$password = "";
$database = "english_school"; 
$servername = "127.0.0.1";
$port = 8111;


$conn = new mysqli($servername, $username, $password, $database, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "<p style='color: blue;'>Form submitted.</p>";
    $course_type = $_POST["course_type"] ?? '';
    $name        = $_POST["name"] ?? '';
    $surname     = $_POST["surname"] ?? '';
    $birthdate   = $_POST["birthdate"] ?? '';
    $phone       = $_POST["phone"] ?? '';
    $email       = $_POST["email"] ?? '';
    $username    = $_POST["username"] ?? '';
    $passwordRaw = $_POST["password"] ?? '';
    $level       = $_POST["level"] ?? '';

    if ($name && $surname && $birthdate && $phone && $email && $username && $passwordRaw && $level && $course_type) {
        $password = password_hash($passwordRaw, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO students (name, surname, birthdate, phone, email, username, password, level, course_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $name, $surname, $birthdate, $phone, $email, $username, $password, $level, $course_type);

        if ($stmt->execute()) {
            $message = "<p style='color: green;'>Registration successful!</p>";
        } else {
            $message = "<p style='color: red;'>Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        $message = "<p style='color: red;'>Please fill in all required fields.</p>";
    }
}

$conn->close();
?>
