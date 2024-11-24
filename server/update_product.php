<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/db/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize user input
    $productId = $_POST['productId'];
    $productName = $_POST['productName'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Validation
    if (!$productId || !$productName || !$category || !$price || !$quantity) {
        echo 'Invalid input. Please check your form.';
        exit;
    }

    // Prepare product data
    $products = [
        [
            'id'           => $productId,
            'product_name' => $productName,
            'description'  => $description,
            'category'     => $category,
            'price'        => $price,
            'quantity'     => $quantity
        ]
    ];

    try {
        // Insert products into the database
        updateProducts($pdo, $products);
        echo 'success'; // Return success response to AJAX
    } catch (Exception $e) {
        echo 'Failed to add product: ' . $e->getMessage(); // Return error message to AJAX
    }
} else {
    // Handle non-POST requests
    echo 'Invalid request method.';
}
