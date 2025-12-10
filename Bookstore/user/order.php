<?php
session_start();
include "../db.php";

$isbn = $_GET['isbn'] ?? null;
if (!$isbn) die("No ISBN provided.");

$b = $conn->prepare("SELECT ISBN, Title, Price FROM BOOK WHERE ISBN=?");
$b->bind_param("s", $isbn);
$b->execute();
$book = $b->get_result()->fetch_assoc();
if (!$book) die("Book not found.");

$price = $book['Price'];
$title = $book['Title'];

$stmt = $conn->prepare("SELECT Cust_ID FROM CUSTOMER WHERE User_ID=?");
$stmt->bind_param("s", $_SESSION['user_id']);
$stmt->execute();
$cust = $stmt->get_result()->fetch_assoc();
if (!$cust) die("Customer not found.");
$placerId = $cust['Cust_ID'];

$pm = $conn->query("SELECT M_payID, pay_Method FROM PAYMENT_METHOD");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Select Payment</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header><h1>Bookstore</h1></header>
<nav>
    <a href="../index.php">Home</a>
    <a href="my_orders.php">My Orders</a>
    <a href="../logout.php">Logout</a>
</nav>

<div class="order-card">
    <h3>You are ordering: <?= htmlspecialchars($title) ?> ($ <?= htmlspecialchars($price) ?>)</h3>
    <p>Please choose a payment method to confirm your order:</p>

    <form method="post" action="payment.php">
        <input type="hidden" name="isbn" value="<?= htmlspecialchars($isbn) ?>">
        <input type="hidden" name="price" value="<?= htmlspecialchars($price) ?>">
        <input type="hidden" name="placer_id" value="<?= htmlspecialchars($placerId) ?>">
        <select name="pay_id" required>
            <?php while ($row = $pm->fetch_assoc()): ?>
                <option value="<?= htmlspecialchars($row['M_payID']) ?>">
                    <?= htmlspecialchars($row['pay_Method']) ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Confirm Payment</button>
    </form>
</div>
</body>
</html>
