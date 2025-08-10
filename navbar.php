<?php
require_once 'functions.php';
?>
<nav>
    <a href="dashboard.php">Dashboard</a> |
    <a href="gm_create.php">Create GM</a> |
    <a href="vendor_form.php">Vendor Entry</a> |
    <span style="color:red;">Vendor Notifications: <?php echo vendor_notifications($mysqli); ?></span>
    <a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a> |

</nav>
<hr>