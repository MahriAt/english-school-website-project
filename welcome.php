<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: signin.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Welcome</title></head>
<body>
    <h1>Welcome, <?= htmlspecialchars($_SESSION["username"]) ?>!</h1>
    <p>You are successfully logged in.</p>
</body>
</html>