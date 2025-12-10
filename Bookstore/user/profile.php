<?php
session_start();
include "../db.php";

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== "customer") {
    header("Location: ../login.php");
    exit;
}

$userId = $_SESSION['user_id']; 

$sql = $conn->prepare("SELECT Cust_ID, User_ID, Cust_name, Cust_address, Cust_phone_no, Reg_Date 
                       FROM CUSTOMER WHERE User_ID=?");
$sql->bind_param("s", $userId);
$sql->execute();
$user = $sql->get_result()->fetch_assoc();

if (!$user) {
    die("No profile found for this user.");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <h1>My Profile</h1>
</header>

<nav>
    <a href="../index.php">Home</a>
    <a href="search.php">Browse Books</a>
    <a href="my_orders.php">My Orders</a>
    <a href="../logout.php">Logout</a>
</nav>

<div class="container">
    <div class="order-card">
        <h2><?= htmlspecialchars($user['Cust_name']) ?></h2>
        <p><strong>Customer ID:</strong> <?= htmlspecialchars($user['Cust_ID']) ?></p>
        <p><strong>User ID:</strong> <?= htmlspecialchars($user['User_ID']) ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($user['Cust_address']) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($user['Cust_phone_no']) ?></p>
        <p><strong>Registered:</strong> <?= htmlspecialchars($user['Reg_Date']) ?></p>

        <div style="margin-top:15px;">
            <a href="my_orders.php" class="btn">View My Orders</a>
	    <a href="search.php" class="btn">Browse Books</a>
            <a href="../index.php" class="btn">Back to Home</a>
            <a href="../logout.php" class="btn">Logout</a>
        </div>
    </div>
</div>
</body>
</html>
