<?php
session_start();
include "../db.php";

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== "admin") {
    header("Location: ../login_admin.php");
    exit;
}

$sql = $conn->query("SELECT Cust_ID, Cust_name, Cust_phone_no FROM CUSTOMER");
?>
<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
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
    <h1>Registered Users</h1>
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
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
            </tr>
            <?php while ($row = $sql->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['Cust_ID']) ?></td>
                <td><?= htmlspecialchars($row['Cust_name']) ?></td>
                <td><?= htmlspecialchars($row['Cust_phone_no']) ?></td>
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
