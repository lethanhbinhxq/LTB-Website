<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/db/db_connection.php';
include 'backend_validation.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = $_POST['fullName'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userRole = $_POST['userRole'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $commune = $_POST['commune'];
    $streetAddress = $_POST['streetAddress'];

    // Validate input
    if (!validateFullName($fullName) || !validateEmail($email) || !validatePassword($password) || !validateStreetAddress($streetAddress)) {
        $_SESSION['error'] = 'Invalid input format!';
        header('Location: ../index.php?page=signup');
        exit;
    }

    try {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $emailExists = $stmt->fetchColumn();

        if ($emailExists) {
            $_SESSION['error'] = 'Email is already registered!';
            header('Location: ../index.php?page=signup');
            exit;
        }

        // Prepare user data
        $user = [
            [
                'full_name' => $fullName,
                'gender' => $gender,
                'email' => $email,
                'password_' => $password,
                'user_role' => $userRole,
                'province' => $province,
                'district' => $district,
                'commune' => $commune,
                'street_address' => $streetAddress
            ]
        ];

        // Insert new user
        $newUser = insertUsers($pdo, $user)[0];
        unset($_SESSION['error']);
        $_SESSION['user_id'] = $newUser['id'];
        $_SESSION['email'] = $newUser['email'];
        $_SESSION['fullname'] = $newUser['full_name'];
        setcookie('user_logged_in', 'true', time() + 3600, '/'); // 1-hour expiry
        header('Location: ../index.php'); // Redirect to homepage or dashboard
        exit;

    } catch (Exception $e) {
        $_SESSION['error'] = 'Sign up failed!';
        header('Location: ../index.php?page=signup');
        exit;
    }
} else {
    header('Location: ../index.php?page=signup');
    exit;
}
