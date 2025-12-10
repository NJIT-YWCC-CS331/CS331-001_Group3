<?php
session_start();
include "../db.php";

$isbn = $_GET['isbn'] ?? null;
if (!$isbn) {
    die("No book selected.");
}

$stmt = $conn->prepare("
    SELECT B.ISBN, B.Title, B.Price, B.Stk_Quant, B.Cover_Image,
           A.Auth_name, A.Nationality, A.Biography
    FROM BOOK B
    JOIN WRITES W ON B.ISBN = W.Work_ID
    JOIN AUTHOR A ON W.Writer_ID = A.Auth_ID
    WHERE B.ISBN=?
");
$stmt->bind_param("s", $isbn);
$stmt->execute();
$book = $stmt->get_result()->fetch_assoc();
if (!$book) die("Book not found.");

$rev = $conn->prepare("
    SELECT R.Rating, R.Commentary, C.User_ID
    FROM REVIEW R
    JOIN CUSTOMER C ON R.ReviewerID = C.Cust_ID
    WHERE R.ReviewedID=?
");
$rev->bind_param("s", $isbn);
$rev->execute();
$reviews = $rev->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($book['Title']) ?> - Description</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <h1>Book Details</h1>
</header>

<nav>
    <a href="../index.php">Home</a>
    <a href="search.php">Search</a>
    <a href="my_orders.php">My Orders</a>
    <a href="profile.php">Profile</a>
    <a href="../logout.php">Logout</a>
</nav>

<div class="container">
    <div class="order-card">
        <img src="<?= htmlspecialchars($book['Cover_Image']) ?>" 
             alt="<?= htmlspecialchars($book['Title']) ?>" 
             class="book-cover">
        <h2><?= htmlspecialchars($book['Title']) ?></h2>
        <p><strong>Author:</strong> <?= htmlspecialchars($book['Auth_name']) ?></p>
        <?php if (!empty($book['Nationality'])): ?>
            <p><strong>Nationality:</strong> <?= htmlspecialchars($book['Nationality']) ?></p>
        <?php endif; ?>
        <?php if (!empty($book['Biography'])): ?>
            <p><strong>Biography:</strong> <?= htmlspecialchars($book['Biography']) ?></p>
        <?php endif; ?>
        <p><strong>Price:</strong> $<?= htmlspecialchars($book['Price']) ?></p>
        <p><strong>Stock:</strong> <?= htmlspecialchars($book['Stk_Quant']) ?></p>

        <a href="order.php?isbn=<?= urlencode($book['ISBN']) ?>" class="btn">Buy</a>
    </div>

    <h3>Reviews</h3>
    <?php if ($reviews->num_rows > 0): ?>
        <ul class="order-items">
        <?php while ($r = $reviews->fetch_assoc()): ?>
            <li>
                ⭐ <?= htmlspecialchars($r['Rating']) ?>/5  
                <br><?= htmlspecialchars($r['Commentary']) ?>  
            </li>
        <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No reviews yet.</p>
    <?php endif; ?>

    <div style="margin-top:20px;">
        <a href="search.php" class="btn">Back to Search</a>
    </div>
</div>
</body>
</html>
