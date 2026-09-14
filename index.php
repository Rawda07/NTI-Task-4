<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Glassify</title>
    <!-- Bootstrap 4 Framework -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- External CSS File -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- Navbar with dynamic Logout -->
    <nav class="navbar">
        <div class="logo">Glassify</div>
        <ul class="nav-links">
            <li><a href="index.php" style="color: #c59b52;">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="account.php">Account</a></li>
            <?php if(isset($_SESSION['logged_in'])): ?>
                <li><a href="logout.php" style="color: #d9534f;">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Hero Section with Background Image -->
    <div class="header-hero">
        <div class="hero-content">
            <h1>Welcome to My Store</h1>
            <p>Explore our latest collection of premium products.</p>
        </div>
    </div>

</body>
</html>