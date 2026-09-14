<?php
session_start();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // --- Scenario 1: Simple Login (Email & Password) ---
    if (isset($_POST['login_action'])) {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        // Email validation
        if (empty($email)) {
            $errors['login_email'] = "Email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['login_email'] = "Invalid email format.";
        }

        // Password validation
        if (empty($password)) {
            $errors['login_password'] = "Password is required.";
        } elseif (strlen($password) < 6) {
            $errors['login_password'] = "Password must be at least 6 characters.";
        }

        // If no errors, store in session and redirect to products page
        if (empty($errors)) {
            $_SESSION['user_email'] = $email;
            $_SESSION['logged_in'] = true;
            header("Location: products.php");
            exit();
        }
    }

    // --- Scenario 2: Detailed Profile Registration (7 Fields) ---
    if (isset($_POST['profile_action'])) {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $facebook = trim($_POST['facebook'] ?? '');
        $twitter = trim($_POST['twitter'] ?? '');
        $instagram = trim($_POST['instagram'] ?? '');

        // 1. Username validation
        if (empty($username)) {
            $errors['username'] = "Username is required.";
        }

        // 2. Password validation
        if (empty($password)) {
            $errors['password'] = "Password is required.";
        } elseif (strlen($password) < 6) {
            $errors['password'] = "Password must be at least 6 characters.";
        }

        // 3. Email validation
        if (empty($email)) {
            $errors['email'] = "Email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email address.";
        }

        // 4. Phone number validation
        if (empty($phone)) {
            $errors['phone'] = "Phone number is required.";
        } elseif (!preg_match('/^[0-9+\s()-]{8,15}$/', $phone)) {
            $errors['phone'] = "Invalid phone number format.";
        }

        // 5. Facebook URL validation
        if (!empty($facebook) && !filter_var($facebook, FILTER_VALIDATE_URL)) {
            $errors['facebook'] = "Invalid Facebook URL.";
        }

        // 6. Twitter URL validation
        if (!empty($twitter) && !filter_var($twitter, FILTER_VALIDATE_URL)) {
            $errors['twitter'] = "Invalid Twitter URL.";
        }

        // 7. Instagram URL validation
        if (!empty($instagram) && !filter_var($instagram, FILTER_VALIDATE_URL)) {
            $errors['instagram'] = "Invalid Instagram URL.";
        }

        // If no errors, store all fields in session and redirect to home page
        if (empty($errors)) {
            $_SESSION['username'] = $username;
            $_SESSION['user_email'] = $email;
            $_SESSION['phone'] = $phone;
            $_SESSION['facebook'] = $facebook;
            $_SESSION['twitter'] = $twitter;
            $_SESSION['instagram'] = $instagram;
            $_SESSION['logged_in'] = true;

            header("Location: index.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Store - Account</title>
    <!-- Bootstrap 4 Framework -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- External CSS File -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- Navbar with dynamic Logout link if logged in -->
    <nav class="navbar">
        <div class="logo">Glassify</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="account.php" class="active-link">Account</a></li>
            <?php if(isset($_SESSION['logged_in'])): ?>
                <li><a href="logout.php" style="color: #d9534f;">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            
            <!-- Scenario 1: Login Form (If not registered) -->
            <div class="col-md-6 mb-5">
                <div class="card shadow-sm p-4">
                    <h3 class="mb-4 products-title">Login (If not registered)</h3>
                    <form action="account.php" method="POST">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                            <small class="text-danger"><?php echo $errors['login_email'] ?? ''; ?></small>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                            <small class="text-danger"><?php echo $errors['login_password'] ?? ''; ?></small>
                        </div>
                        <button type="submit" name="login_action" class="btn btn-dark btn-block" style="background-color: #2b221e;">Login</button>
                    </form>
                </div>
            </div>

            <!-- Scenario 2: Detailed Profile Form (7 Fields) -->
            <div class="col-md-8">
                <div class="card shadow-sm p-4">
                    <h3 class="mb-4 products-title">Complete / Update Profile Data</h3>
                    <form action="account.php" method="POST">
                        <div class="form-group">
                            <label>1. Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
                            <small class="text-danger"><?php echo $errors['username'] ?? ''; ?></small>
                        </div>
                        <div class="form-group">
                            <label>2. Password</label>
                            <input type="password" name="password" class="form-control">
                            <small class="text-danger"><?php echo $errors['password'] ?? ''; ?></small>
                        </div>
                        <div class="form-group">
                            <label>3. Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                            <small class="text-danger"><?php echo $errors['email'] ?? ''; ?></small>
                        </div>
                        <div class="form-group">
                            <label>4. Phone Number</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                            <small class="text-danger"><?php echo $errors['phone'] ?? ''; ?></small>
                        </div>
                        <div class="form-group">
                            <label>5. Facebook Account URL</label>
                            <input type="url" name="facebook" class="form-control" value="<?php echo htmlspecialchars($_POST['facebook'] ?? ''); ?>">
                            <small class="text-danger"><?php echo $errors['facebook'] ?? ''; ?></small>
                        </div>
                        <div class="form-group">
                            <label>6. Twitter Account URL</label>
                            <input type="url" name="twitter" class="form-control" value="<?php echo htmlspecialchars($_POST['twitter'] ?? ''); ?>">
                            <small class="text-danger"><?php echo $errors['twitter'] ?? ''; ?></small>
                        </div>
                        <div class="form-group">
                            <label>7. Instagram Account URL</label>
                            <input type="url" name="instagram" class="form-control" value="<?php echo htmlspecialchars($_POST['instagram'] ?? ''); ?>">
                            <small class="text-danger"><?php echo $errors['instagram'] ?? ''; ?></small>
                        </div>
                        <button type="submit" name="profile_action" class="btn btn-block" style="background-color: #c59b52; color: white;">Save Profile</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</body>
</html>