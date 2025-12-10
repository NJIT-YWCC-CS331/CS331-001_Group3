<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bookstore Homepage</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <h1>Welcome to the Online Bookstore</h1>
</header>

<nav>
    <?php if (!isset($_SESSION['user_role'])): ?>
        <a href="login_customer.php">Customer Login</a>
        <a href="login_admin.php">Admin Login</a>
        <a href="register.php">Register</a>
    <?php elseif ($_SESSION['user_role'] === 'customer'): ?>
        <a href="user/profile.php">My Profile</a>
        <a href="user/my_orders.php">My Orders</a>
        <a href="user/search.php">Browse Books</a>
        <a href="logout.php">Logout</a>
    <?php elseif ($_SESSION['user_role'] === 'admin'): ?>
        <a href="admin/index.php">Admin Dashboard</a>
        <a href="admin/user_list.php">User List</a>
        <a href="admin/order_list.php">Order List</a>
        <a href="logout.php">Logout</a>
    <?php endif; ?>
</nav>

<div class="container">
    <?php if (!isset($_SESSION['user_role'])): ?>
        <!-- Guest view -->
        <p>Please login or register to continue.</p>
        <a href="login_customer.php" class="btn">Customer Login</a>
        <a href="login_admin.php" class="btn">Admin Login</a>
        <a href="register.php" class="btn">Register</a>

    <?php elseif ($_SESSION['user_role'] === 'customer'): ?>
        <p>You’re logged in as <strong><?= htmlspecialchars($_SESSION['user_id']) ?></strong>.</p>
        <a href="user/profile.php" class="btn">My Profile</a>
        <a href="user/my_orders.php" class="btn">My Orders</a>
        <a href="user/search.php" class="btn">Browse Books</a>
        <a href="logout.php" class="btn">Logout</a>

    <?php elseif ($_SESSION['user_role'] === 'admin'): ?>
        <p>Admin: <strong><?= htmlspecialchars($_SESSION['user_id']) ?></strong></p>
        <a href="admin/index.php" class="btn">Admin Dashboard</a>
        <a href="admin/user_list.php" class="btn">User List</a>
        <a href="admin/order_list.php" class="btn">Order List</a>
        <a href="logout.php" class="btn">Logout</a>
    <?php endif; ?>
</div>
</body>
</html>
