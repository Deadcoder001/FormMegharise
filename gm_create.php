<?php
require_once 'functions.php';
redirect_if_not_admin();

// Fetch districts
$districts = $mysqli->query("SELECT * FROM districts")->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $district_id = intval($_POST['district_id']);

    // Generate GM code
    $district = $mysqli->query("SELECT gm_code_prefix FROM districts WHERE id=$district_id")->fetch_assoc();
    $prefix = $district['gm_code_prefix'];
    $count = $mysqli->query("SELECT COUNT(*) as total FROM users WHERE role='gm' AND district_id=$district_id")->fetch_assoc()['total'] + 1;
    $gm_code = $prefix . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);

    $stmt = $mysqli->prepare("INSERT INTO users (username, password, role, district_id, gm_id_code) VALUES (?, ?, 'gm', ?, ?)");
    $stmt->bind_param('ssis', $username, $password, $district_id, $gm_code);
    if ($stmt->execute()) {
        $success = "GM created successfully!";
    } else {
        $error = "Failed: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create GM</title>
</head>
<body>

<h2>Create GM</h2>
<form method="post">
    <input type="text" name="username" required placeholder="GM Username"><br>
    <input type="password" name="password" required placeholder="Password"><br>
    <select name="district_id" required>
        <option value="">Select District</option>
        <?php foreach ($districts as $district): ?>
            <option value="<?= $district['id'] ?>"><?= htmlspecialchars($district['name']) ?></option>
        <?php endforeach; ?>
    </select><br>
    <button type="submit">Create GM</button>
</form>
<?php if (!empty($success)) echo "<p style='color:green;'>$success</p>"; ?>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>