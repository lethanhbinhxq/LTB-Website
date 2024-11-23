<?php

function validateEmail($email) {
    $emailPattern = '/^[a-zA-Z0-9]+([._-]?[a-zA-Z0-9]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z]{2,})+$/';
    return preg_match($emailPattern, $email) && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) <= 254;
}

function validatePassword($password) {
    $hasLower = preg_match('/[a-z]/', $password);
    $hasUpper = preg_match('/[A-Z]/', $password);
    $hasNumber = preg_match('/[0-9]/', $password);
    $hasSpecial = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password);
    $minLength = strlen($password) >= 8;

    return $hasLower && $hasUpper && $hasNumber && $hasSpecial && $minLength;
}

function validateFullName($fullName) {
    return preg_match('/^[A-Za-z\s]+$/', $fullName) && strlen($fullName) >= 2 && strlen($fullName) <= 100;
}

function validateStreetAddress($address) {
    return preg_match('/^[a-zA-Z0-9\s,.\'-]{5,150}$/', $address);
}