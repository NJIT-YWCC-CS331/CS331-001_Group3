<?php
session_start();
include "../db.php";

$order_id = $_GET['order_id'] ?? null;
if (!$order_id) {
    die("No order ID provided.");
}

$stmt = $conn->prepare("
    SELECT O.Ord_ID 
    FROM STORE_ORDER O
    JOIN CUSTOMER C ON O.Placer_ID = C.Cust_ID
    WHERE O.Ord_ID=? AND C.User_ID=?
");
$stmt->bind_param("ss", $order_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
if (!$result->fetch_assoc()) {
    die("Order not found or not yours.");
}

$sql = $conn->prepare("UPDATE STORE_ORDER SET Ship_Status='Cancelled' WHERE Ord_ID=?");
$sql->bind_param("s", $order_id);
$sql->execute();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cancel Order</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <h1>Cancel Order</h1>
</header>

<nav>
    <a href="../index.php">Home</a>
    <a href="my_orders.php">My Orders</a>
</nav>

<div class="container">
    <div class="order-card">
        <p><strong>Order ID:</strong> <?= htmlspecialchars($order_id) ?></p>
        <p>
            <span class="status-badge status-cancelled">
                Cancelled
            </span>
        </p>
        <p>Your order has been cancelled successfully.</p>
        <a class="btn" href="my_orders.php">Back to My Orders</a>
    </div>
</div>
</body>
</html>
