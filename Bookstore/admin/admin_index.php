<?php
session_start();
include "../db.php";

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== "admin") {
    header("Location: ../login_admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <h1>Admin Dashboard</h1>
</header>

<nav>
    <a href="../index.php">Home</a>
    <a href="user_list.php">User List</a>
    <a href="order_list.php">Order List</a>
    <a href="order_list.php">Inventory</a>
    <a href="../logout.php">Logout</a>
</nav>

<div class="container">
    <div class="order-card">
        <h2>Welcome, Admin <?= htmlspecialchars($_SESSION['user_id']) ?></h2>
        <p>Please choose an option:</p>

        <div style="margin-top:15px;">
            <a href="user_list.php" class="btn">View User List</a>
            <a href="order_list.php" class="btn">View Order List</a>
	    <a href="inventory.php" class="btn">View Inventory</a>
            <a href="../logout.php" class="btn">Logout</a>
        </div>
    </div>
</div>
</body>
</html>
