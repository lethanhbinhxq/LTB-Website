<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/db/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize user input
    $productId = $_POST['productId'];

    // Validation
    if (!$productId) {
        echo 'Cannot retrieve product ID';
        exit;
    }

    // Prepare product data
    $products = [
        [
            'id' => $productId,
        ]
    ];

    try {
        // Insert products into the database
        deleteProducts($pdo, $products);
        echo 'success'; // Return success response to AJAX
    } catch (Exception $e) {
        echo 'Failed to add product: ' . $e->getMessage(); // Return error message to AJAX
    }
} else {
    // Handle non-POST requests
    echo 'Invalid request method.';
}
