<?php
include $_SERVER['DOCUMENT_ROOT'] . '/components/product_card.php';
include $_SERVER['DOCUMENT_ROOT'] . '/components/product_modal.php';
include $_SERVER['DOCUMENT_ROOT'] . '/db/db_connection.php';

$searchTerm = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$searchCriteria = $_GET['search_criteria'] ?? 'Name';
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 8; // Number of products per page
$offset = ($page - 1) * $limit;

$column = 'product_name';
switch ($searchCriteria) {
    case 'Description':
        $column = 'description_';
        break;
    case 'Category':
        $column = 'category';
        break;
    case 'Price':
        $column = 'price';
        break;
    case 'Quantity':
        $column = 'quantity';
        break;
}

$query = "SELECT * FROM products";

if ($searchTerm) {
    $query .= " WHERE $column LIKE :searchTerm";
}

$query .= " LIMIT :limit OFFSET :offset";

$stmt = $pdo->prepare($query);
if ($searchTerm) {
    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
}
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if it's the first page and there are no results
if ($page === 1 && empty($products)) {
    // For the first page, we return a "No products found" message
    echo "<h4>No products found.</h4>";
} elseif (empty($products)) {
    // If it's any page other than the first and no results are found, just return an empty response
    echo "";
} else {
    // If products are found, render each product card
    foreach ($products as $product) {
        renderProductCard($product); // Render each product card
    }
}