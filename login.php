<?php
session_start();

// Sample users data (In production, this should come from a database)
$users = [
    'user1' => 'password1',
    'user2' => 'password2'
];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rememberMe = isset($_POST['rememberme']) ? true : false;

    // Validate the user
    if (isset($users[$username]) && $users[$username] === $password) {
        // Correct login, start session
        $_SESSION['username'] = $username;

        // If "Remember Me" is checked, set a cookie
        if ($rememberMe) {
            $cookieName = 'rememberme';
            $cookieValue = $username . ':' . md5($password);  // Use md5 or hash for security
            $cookieExpire = time() + (86400 * 30);  // 30 days
            setcookie($cookieName, $cookieValue, $cookieExpire, "/");
        }

        echo 'Logged in successfully!';
        // Redirect to another page (home, dashboard, etc.)
        header("Location: home.php");
        exit();
    } else {
        echo 'Invalid username or password.';
    }
}
