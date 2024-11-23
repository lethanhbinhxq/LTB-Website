<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/db/db_connection.php';
include 'backend_validation.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!validateEmail($email)) {
        $_SESSION['error'] = 'Invalid email address format!';
        $_SESSION['submitted_email'] = $email;
        header('Location: ../index.php?page=login'); // Redirect back to login page with error
        exit;
    }

    // Store the submitted email in the session to keep the value on the login form
    $_SESSION['submitted_email'] = $email;

    // Database lookup for user
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_'])) {
        // Clear any previously stored email and error messages upon successful login
        unset($_SESSION['submitted_email']);
        unset($_SESSION['error']);

        // Set session and cookie to indicate login
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['fullname'] = $user['full_name'];
        setcookie('user_logged_in', 'true', time() + 3600, '/'); // 1-hour expiry
        header('Location: ../index.php'); // Redirect to homepage or dashboard
        exit;
    } else {
        // Login failed: set error message in session
        $_SESSION['error'] = 'Email or password is incorrect.';
        header('Location: ../index.php?page=login'); // Redirect back to login page
        exit;
    }
} else {
    header('Location: ../index.php?page=login');
    exit;
}
