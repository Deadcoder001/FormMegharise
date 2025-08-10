<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $mysqli->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'admin')");
    $stmt->bind_param('ss', $username, $password);
    if ($stmt->execute()) {
        header("Location: login.php?register=success");
        exit;
    } else {
        $error = "Registration failed: " . $stmt->error;
    }
}
?>

<!-- HTML Admin register form -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin Registration</title>
</head>
<body>
<h2>Admin Register</h2>
<form method="post">
    <input type="text" name="username" required placeholder="Username"><br>
    <input type="password" name="password" required placeholder="Password"><br>
    <button type="submit">Register</button>
</form>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
<p>Already have an account? <a href="login.php">Login</a></p>
</body>
</html>