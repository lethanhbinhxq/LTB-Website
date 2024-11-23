<?php
include $_SERVER['DOCUMENT_ROOT'] . '/db/db_connection.php';

$query = $_GET['query'] ?? '';
$criteria = $_GET['criteria'] ?? 'Name';
$response = [];

if ($query && $criteria) {
    $sql = "SELECT product_name FROM products";
    $conditions = [];

    switch ($criteria) {
        case 'Name':
            $conditions[] = "product_name LIKE :query";
            break;
        case 'Category':
            $conditions[] = "category LIKE :query";
            break;
        case 'Description':
            $conditions[] = "description LIKE :query";
            break;
        case 'Price':
        case 'Quantity':
            $min = $_GET['min_value'] ?? 0;
            $max = $_GET['max_value'] ?? PHP_INT_MAX;
            $conditions[] = "$criteria BETWEEN :min_value AND :max_value";
            break;
    }

    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
        $stmt = $pdo->prepare($sql);

        if ($criteria === 'Price' || $criteria === 'Quantity') {
            $stmt->execute(['min_value' => $min, 'max_value' => $max]);
        } else {
            $stmt->execute(['query' => $query . '%']);
        }

        $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

header('Content-Type: application/json');
echo json_encode($response);