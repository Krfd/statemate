<?php
session_start();

// Check if session exists
if (isset($_SESSION['username'])) {
    echo "Welcome back, " . $_SESSION['username'];
} else {
    // Check "Remember Me" cookie
    if (isset($_COOKIE['rememberme'])) {
        $cookieValue = $_COOKIE['rememberme'];
        list($username, $passwordHash) = explode(':', $cookieValue);

        // Sample users data (should be replaced with a real check from the database)
        $users = [
            'user1' => 'password1',
            'user2' => 'password2'
        ];

        // Check if user exists and password hash matches
        if (isset($users[$username]) && md5($users[$username]) === $passwordHash) {
            $_SESSION['username'] = $username;  // Set session
            echo "Welcome back, " . $username;
        } else {
            echo "Invalid session or cookie.";
        }
    } else {
        echo "Please log in.";
    }
}
