<?php
session_start();
include "../db.php";

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== "admin") {
    header("Location: ../login_admin.php");
    exit;
}

$sql = $conn->query("
    SELECT O.Ord_ID, O.Ord_date, O.Tot_amount, O.Ship_Status, C.Cust_name
    FROM STORE_ORDER O
    LEFT JOIN CUSTOMER C ON O.Placer_ID = C.Cust_ID
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order List</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #1abc9c;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
<header>
    <h1>All Orders</h1>
</header>

<nav>
    <a href="../index.php">Home</a>
    <a href="admin_index.php">Dashboard</a>
    <a href="../logout.php">Logout</a>
</nav>

<div class="container">
    <div class="order-card">
        <table>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Total</th>
                <th>Status</th>
                <th>Customer</th>
            </tr>
            <?php while ($o = $sql->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($o['Ord_ID']) ?></td>
                <td><?= htmlspecialchars($o['Ord_date']) ?></td>
                <td>$ <?= htmlspecialchars($o['Tot_amount']) ?></td>
                <td><?= htmlspecialchars($o['Ship_Status']) ?></td>
                <td><?= htmlspecialchars($o['Cust_name']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>

        <div style="margin-top:20px;">
            <a href="admin_index.php" class="btn">Back to Dashboard</a>
        </div>
    </div>
</div>
</body>
</html>
