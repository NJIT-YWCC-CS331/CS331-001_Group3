<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userId  = trim($_POST['user_id']);
    $name    = trim($_POST['name']);
    $address = trim($_POST['address']);
    $phone   = trim($_POST['phone']);
    $pass    = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT User_ID FROM CUSTOMER WHERE User_ID=?");
    $check->bind_param("s", $userId);
    $check->execute();
    if ($check->get_result()->fetch_assoc()) {
        $error = "This User ID is already taken. Please choose another.";
    } else {
        $result = $conn->query("SELECT Cust_ID FROM CUSTOMER ORDER BY Cust_ID DESC LIMIT 1");
        $row = $result->fetch_assoc();
        $lastId = $row ? $row['Cust_ID'] : "CUST000";
        $num = intval(substr($lastId, 4)) + 1;
        $newCustId = "CUST" . str_pad($num, 3, "0", STR_PAD_LEFT);

        $sql = "INSERT INTO CUSTOMER (Cust_ID, User_ID, Cust_name, Cust_address, Reg_Date, Cust_phone_no, Cust_pass)
                VALUES (?, ?, ?, ?, CURDATE(), ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $newCustId, $userId, $name, $address, $phone, $pass);

        if ($stmt->execute()) {
            $success = "Registration successful! Your Customer ID is " . htmlspecialchars($newCustId) . ".";
        } else {
            $error = "Error registering user: " . $stmt->error;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .register-card {
            max-width: 500px;
            margin: 60px auto;
            padding: 30px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .register-card h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .register-card label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        .register-card input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .register-card button {
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
        .register-card button:hover {
            background-color: #16a085;
        }
        .success {
            color: green;
            text-align: center;
            margin-bottom: 15px;
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
    <h1>Bookstore</h1>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="login_customer.php">Login</a>
    <a href="register.php">Register</a>
</nav>

<div class="register-card">
    <h2>Create Your Account</h2>

    <?php if (!empty($success)): ?>
        <p class="success"><?= $success ?></p>
        <p style="text-align:center;"><a href="login_customer.php">Click here to login</a></p>
    <?php elseif (!empty($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="user_id">Choose User ID:</label>
        <input type="text" id="user_id" name="user_id" required>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address">

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Register</button>
    </form>
	<p style="text-align:center;">
        <a href="index.php" class="btn">Back to Home</a>
    </p>
</div>
</body>
</html>
