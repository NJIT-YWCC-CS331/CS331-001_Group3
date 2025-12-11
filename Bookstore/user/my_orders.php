<?php
session_start();
include "../db.php";

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== "customer") {
    header("Location: ../login_customer.php");
    exit;
}

$stmt = $conn->prepare("SELECT Cust_ID FROM CUSTOMER WHERE User_ID=?");
$stmt->bind_param("s", $_SESSION['user_id']);
$stmt->execute();
$cust = $stmt->get_result()->fetch_assoc();
if (!$cust) die("Customer not found.");
$placerId = $cust['Cust_ID'];

$sql = $conn->prepare("
    SELECT O.Ord_ID, O.Ord_date, O.Tot_amount, O.Ship_Status, P.pay_Method
    FROM STORE_ORDER O
    LEFT JOIN PAYMENT_METHOD P ON O.Pay_ID = P.M_payID
    WHERE O.Placer_ID=?
    ORDER BY O.Ord_date DESC
");
$sql->bind_param("s", $placerId);
$sql->execute();
$orders = $sql->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <h1>My Orders</h1>
</header>

<nav>
    <a href="../index.php">Home</a>
    <a href="my_orders.php">My Orders</a>
</nav>

<div class="container">
    <h2>My Orders</h2>

    <?php if ($orders->num_rows === 0): ?>
        <p>You currently have no orders.</p>
    <?php else: ?>
        <?php while ($order = $orders->fetch_assoc()): ?>
            <div class="order-card">
                <p><strong>Order ID:</strong> <?= htmlspecialchars($order['Ord_ID']) ?></p>
                <p><strong>Date:</strong> <?= htmlspecialchars($order['Ord_date']) ?></p>
                <p><strong>Total:</strong> $ <?= htmlspecialchars($order['Tot_amount']) ?></p>

                <?php
                $statusClass = '';
                switch ($order['Ship_Status']) {
                    case 'Processing': $statusClass = 'status-processing'; break;
                    case 'Shipped': $statusClass = 'status-shipped'; break;
                    case 'Delivered': $statusClass = 'status-delivered'; break;
                    case 'Cancelled': $statusClass = 'status-cancelled'; break;
                }
                ?>
                <p><strong>Status:</strong>
                    <span class="status-badge <?= $statusClass ?>">
                        <?= htmlspecialchars($order['Ship_Status']) ?>
                    </span>
                </p>

                <p><strong>Payment Method:</strong> <?= htmlspecialchars($order['pay_Method'] ?? 'Not selected') ?></p>

                <h4>Items:</h4>
                <ul class="order-items">
                <?php
                $oi = $conn->prepare("
                    SELECT B.Title, B.Price
                    FROM ORDER_ITEM I
                    JOIN BOOK B ON I.Item_ID = B.ISBN
                    WHERE I.Item_ordID=?
                ");
                $oi->bind_param("s", $order['Ord_ID']);
                $oi->execute();
                $items = $oi->get_result();
                while ($item = $items->fetch_assoc()):
                ?>
                    <li><?= htmlspecialchars($item['Title']) ?> - $ <?= htmlspecialchars($item['Price']) ?></li>
                <?php endwhile; ?>
                </ul>

                <?php if ($order['Ship_Status'] === 'Processing'): ?>
                    <a class="btn" href="cancel_order.php?order_id=<?= urlencode($order['Ord_ID']) ?>">Cancel Order</a>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>

    <p><a class="btn" href="../index.php">Back to Home</a></p>
</div>

</body>
</html>
