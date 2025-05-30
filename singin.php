<?php
session_start();
$loginError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "english_school", 8111);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';

    $stmt = $conn->prepare("SELECT password FROM students WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["username"] = $username;
            header("Location: welcome.php");
            exit;
        } else {
            $loginError = "Invalid password.";
        }
    } else {
        $loginError = "Username not found.";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head><title>Sign In</title></head>
<body>
    <h2>Student Login</h2>
    <?php if ($loginError): ?>
        <p style="color:red;"><?= $loginError ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Sign In</button>
    </form>
</body>
</html>