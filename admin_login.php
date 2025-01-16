<?php


/* Start the session at the beginnning */
session_start();

// If already logged in, redirect to dashboard php file
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: admin_dashboard.php');
    exit();
}

$error = '';
// Checking if form submitted via POST method
// Get form values, empty string if not provided
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';  // Not username
    $password = $_POST['password'] ?? '';
    //Admin login details
    $admin_email = '';
    $admin_password = ''; 
    // Check if  match admin credentials
    // Redirect to dashboard if successful
    if ($email === $admin_email && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin_dashboard.php');
        exit();
    } else {
    // Error message if not matching
        $error = 'Invalid email or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Chesterfield Connect</title>
    <!-- External stylesheet links -->
        <!-- In incluudes already so direct it css folder -->
     <link href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poor+Story" rel="stylesheet">
    <link rel="stylesheet" href="../css/timelinegrid.css">
    <link rel="stylesheet" href="../css/popupptl.css"> 
    <link rel="stylesheet" href="../css/navbar.css">  
    <link rel="stylesheet" href="../css/polaroid.css">  
    <link rel="stylesheet" href="../css/welcome.css">  
    <link rel="stylesheet" href="../css/accesibility.css">
 <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <!-- Main header section with Accessibility Controls -->
    <header class="header">
        <h1>Chesterfield Connect</h1>
    </header>
    
    <nav class="topnav" id="myTopnav">
        <div class="nav-links">
            <a href="https://chesconnect.co.uk/">Home</a>
            <a href="email_updates.html">Email updates</a>  
            <a href="https://www.chesterfield.gov.uk/">Chesterfield Council</a>
            <a href="https://www.derbyshiretimes.co.uk/news">Chesterfield News</a>
            <a href="admin_login.php">Admin</a>        
        </div>
        
        <div class="accessibility-controls">
            <button class="accessibility-btn" onclick="toggleHighContrast()">
                <span class="icon"></span>
                High Contrast
            </button>
            <div class="text-size-controls">
                <button class="accessibility-btn" onclick="decreaseText()">
                    <span class="icon">A-</span>
                </button>
                <button class="accessibility-btn" onclick="increaseText()">
                    <span class="icon">A+</span>
                </button>
            </div>
        </div>
    </nav>
    <div class="welcome-section">
        <div class="login-container">
            <h2 class="login-title">Admin Login</h2>
            
            <?php if ($error): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <form method="POST" action="" class="login-form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="login-button">Log In</button>
            </form>
        </div>
    </div>
    <!---Javascript includes but it's already in includes so no need fpr /includes -->
    <script src="accesibility.js"></script>
</body>
</html>
