<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userId = trim($_POST['user_id']);
    $pass   = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM CUSTOMER WHERE User_ID=?");
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $customer = $stmt->get_result()->fetch_assoc();

    if ($customer && password_verify($pass, $customer['Cust_pass'])) {
        session_regenerate_id(true);
        $_SESSION['user_id']   = $customer['User_ID'];
        $_SESSION['cust_id']   = $customer['Cust_ID'];
        $_SESSION['user_role'] = "customer";
        header("Location: user/profile.php");
        exit;
    }

    $error = "Invalid User ID or password!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer Login</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .login-card {
            max-width: 400px;
            margin: 60px auto;
            padding: 30px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .login-card h2 {
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
        .login-card .register-link {
            margin-top: 15px;
            display: block;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<header>
    <h1>Bookstore</h1>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="login_customer.php">Login</a>
    <a href="register.php">Register</a>
</nav>

<div class="login-card">
    <h2>Customer Login</h2>
    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="user_id">User ID:</label>
        <input type="text" id="user_id" name="user_id" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <a href="register.php" class="register-link">Don’t have an account? Register here</a>
</div>
</body>
</html>
