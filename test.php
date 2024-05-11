<?php
// Initialize session
session_start();

// Dummy user data for demonstration
$users = [
    ['username' => 'user1', 'password' => 'password1'],
    ['username' => 'user2', 'password' => 'password2']
];

// Function to validate login
function validateLogin($username, $password, $users) {
    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            return true;
        }
    }
    return false;
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (validateLogin($username, $password, $users)) {
        $_SESSION['username'] = $username;
        header('Location: dashboard.php'); // Redirect to dashboard on successful login
        exit;
    } else {
        $loginError = "Invalid username or password";
    }
}

// Handle registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    // Dummy registration logic for demonstration
    // In a real application, you would validate user input and store it securely
    $username = $_POST['username'];
    $password = $_POST['password'];
    // You might also want to add additional validation steps, such as checking if the username already exists
    // If registration is successful, you can redirect the user to a login page or dashboard
    // For simplicity, let's just print a success message here
    $registrationSuccess = "Registration successful! You can now login.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .login-container {
            max-width: 400px;
            margin: auto;
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <h2 class="text-center mb-4">Login</h2>
        <?php if (isset($loginError)): ?>
            <div class="alert alert-danger"><?php echo $loginError; ?></div>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary" name="login">Login</button>
        </form>

        <hr>

        <h2 class="text-center mb-4">Register</h2>
        <?php if (isset($registrationSuccess)): ?>
            <div class="alert alert-success"><?php echo $registrationSuccess; ?></div>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="new-username" class="form-label">Username</label>
                <input type="text" class="form-control" id="new-username" name="username" placeholder="Enter username">
            </div>
            <div class="mb-3">
                <label for="new-password" class="form-label">Password</label>
                <input type="password" class="form-control" id="new-password" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary" name="register">Register</button>
        </form>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>