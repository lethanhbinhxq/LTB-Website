<?php
include $_SERVER['DOCUMENT_ROOT'] . '/components/product_card.php';
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

if (!empty($products)) {
    foreach ($products as $product) {
        renderProductCard($product); // Render each product card
    }
} else {
    // Optionally return a message if no products are found
    echo "<h4>No more products found.</h4>";
}