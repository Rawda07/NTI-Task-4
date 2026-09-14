<?php
session_start();

$products = [
    'Classic Black Square' => [
        'price' => '620',
        'img' => '1.jpeg',
        'desc' => 'Bold black frame sunglasses with dark square lenses.'
    ],
    'Grey Aviator Browline' => [
        'price' => '6500',
        'img' => '2.jpeg',
        'desc' => 'Transparent grey aviator design with a gold top bar and brown lenses.'
    ],
    'Golden Wire Gradient' => [
        'price' => '1200',
        'img' => '3.jpeg',
        'desc' => 'Slim gold metal frame glasses featuring gradient green tinted lenses.'
    ],
    'Silver Double-Bridge' => [
        'price' => '1100',
        'img' => '4.jpeg',
        'desc' => 'Sleek silver wireframes featuring a modern double-bridge structure.'
    ],
    'Chic Cat-Eye' => [
        'price' => '1300',
        'img' => '5.jpeg',
        'desc' => 'Sharp and stylish black frames with a distinct cat-eye silhouette.'
    ],
    'Tortoiseshell Navigator' => [
        'price' => '990',
        'img' => '6.jpeg',
        'desc' => 'Navigator sunglasses styled in a classic tortoiseshell patterned frame.'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- Navbar with dynamic Logout -->
    <nav class="navbar">
        <div class="logo">Glassify</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php" class="active-link">Products</a></li>
            <li><a href="account.php">Account</a></li>
            <?php if(isset($_SESSION['logged_in'])): ?>
                <li><a href="logout.php" style="color: #d9534f;">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="container my-5">
        <h2 class="text-center mb-5 products-title">Our Collection</h2>
        <div class="row">
            <?php foreach($products as $product => $values): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm product-card">
                        <img src="images/<?php echo $values['img']; ?>" class="card-img-top product-img" alt="<?php echo $product; ?>">
                        <div class="card-body d-flex flex-column text-center">
                            <h5 class="card-title font-weight-bold product-name"><?php echo $product; ?></h5>
                            <p class="card-text text-muted small flex-grow-1"><?php echo $values['desc']; ?></p>
                            <p class="font-weight-bold price-tag">Price: <?php echo $values['price']; ?> EGP</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>
</html>