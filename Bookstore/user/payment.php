<?php
session_start();
include "../db.php";

$isbn      = $_POST['isbn'] ?? null;
$price     = $_POST['price'] ?? null;
$placerId  = $_POST['placer_id'] ?? null;
$pay_id    = $_POST['pay_id'] ?? null;

if (!$isbn || !$price || !$placerId || !$pay_id) {
    die("Missing order details.");
}

$res = $conn->query("SELECT MAX(Ord_ID) AS last_id FROM STORE_ORDER");
$row = $res->fetch_assoc();
$lastId = $row['last_id'] ?? 'ORD000';
$num = (int)substr($lastId, 3);
$order_id = 'ORD' . str_pad($num + 1, 3, '0', STR_PAD_LEFT);

$sql = $conn->prepare("
    INSERT INTO STORE_ORDER (Ord_ID, Ord_date, Tot_amount, Ship_Status, Placer_ID, Pay_ID)
    VALUES (?, CURDATE(), ?, 'Processing', ?, ?)
");
$sql->bind_param("sdss", $order_id, $price, $placerId, $pay_id);
$sql->execute();

$oi = $conn->prepare("INSERT INTO ORDER_ITEM (Item_ordID, Item_ID) VALUES (?, ?)");
$oi->bind_param("ss", $order_id, $isbn);
$oi->execute();

$stmt = $conn->prepare("SELECT pay_Method FROM PAYMENT_METHOD WHERE M_payID=?");
$stmt->bind_param("s", $pay_id);
$stmt->execute();
$result = $stmt->get_result();
$method = $result->fetch_assoc();
$methodName = $method['pay_Method'] ?? 'Unknown';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Payment Confirmation</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header><h1>Bookstore</h1></header>
<nav>
    <a href="../index.php">Home</a>
    <a href="my_orders.php">My Orders</a>
    <a href="../logout.php">Logout</a>
</nav>

<div class="payment-card">
    <h3>Order <?= htmlspecialchars($order_id) ?> placed successfully!</h3>
    <p>Payment method: <strong><?= htmlspecialchars($methodName) ?></strong></p>
    <p>Total: $ <?= htmlspecialchars($price) ?></p>

    <a href="my_orders.php" class="btn">View My Orders</a>
    <a href="../index.php" class="btn">Back to Home</a>
</div>
</body>
</html>
