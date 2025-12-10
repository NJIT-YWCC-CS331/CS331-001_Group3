<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $adminId = trim($_POST['admin_id']);
    $pass    = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM STORE_ADMIN WHERE Admin_ID=?");
    $stmt->bind_param("s", $adminId);
    $stmt->execute();
    $admin = $stmt->get_result()->fetch_assoc();

    if ($admin && $pass === $admin['Log_cred']) {
        session_regenerate_id(true);
        $_SESSION['user_id']   = $admin['Admin_ID'];
        $_SESSION['user_role'] = "admin";
        header("Location: admin/admin_index.php");
        exit;
    }

    $error = "Invalid Admin ID or password!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .login-card {
            max-width: 400px;
            margin: 60px auto;
            padding: 30px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .login-card h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-card label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        .login-card input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-card button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background-color: #1abc9c;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .login-card button:hover {
            background-color: #16a085;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<header>
    <h1>Bookstore Admin</h1>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="login_admin.php">Admin Login</a>
    <a href="customer_login.php">Customer Login</a>
</nav>

<div class="login-card">
    <h2>Admin Login</h2>
    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="admin_id">Admin ID:</label>
        <input type="text" id="admin_id" name="admin_id" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</div>
</body>
</html>
