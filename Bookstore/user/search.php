<?php
include "../db.php";

$q = isset($_GET['q']) ? "%" . $_GET['q'] . "%" : "%%";

$sql = $conn->prepare("
    SELECT B.ISBN, B.Title, B.Price, B.Stk_Quant, B.Cover_Image, A.Auth_name
    FROM BOOK B
    JOIN WRITES W ON B.ISBN = W.Work_ID
    JOIN AUTHOR A ON W.Writer_ID = A.Auth_ID
    WHERE B.Title LIKE ? OR A.Auth_name LIKE ?
");
$sql->bind_param("ss", $q, $q);
$sql->execute();
$result = $sql->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Search Books</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <h1>Online Bookstore</h1>
</header>
<nav>
    <a href="../index.php">Home</a>
    <a href="search.php">Search</a>
    <a href="my_orders.php">My Orders</a>
    <a href="profile.php">Profile</a>
    <a href="../logout.php">Logout</a>
</nav>

<div class="container">
    <h2>Search Books</h2>
    <form method="get">
        <input type="text" name="q" placeholder="Title or author">
        <button type="submit">Search</button>
    </form>

    <div class="book-grid">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="card">
            <img src="<?= htmlspecialchars($row['Cover_Image']) ?>" 
                 alt="<?= htmlspecialchars($row['Title']) ?>" 
                 class="book-cover">
            <h3><?= htmlspecialchars($row['Title']) ?></h3>
            <p>by <?= htmlspecialchars($row['Auth_name']) ?></p>
            <p>$ <?= htmlspecialchars($row['Price']) ?></p>
            <a href="order.php?isbn=<?= urlencode($row['ISBN']) ?>" class="btn">Buy</a>
	    <a href="description.php?isbn=<?= urlencode($row['ISBN']) ?>" class="btn">Description</a>

        </div>
    <?php endwhile; ?>
    </div>
</div>
</body>
</html>
