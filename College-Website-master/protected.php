<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>

<h1>Welcome, <?php echo $_SESSION["user_name"]; ?>!</h1>
<a href="logout.php">Logout</a>

<!-- OVDJE UBACI COD I HTML OD admission.html -->
