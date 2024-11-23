<script src="../scripts/product_modal.js"></script>
<script src="../scripts/lazy_loading.js"></script>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/components/product_modal.php';

function renderProductCard($product)
{
    $name = htmlspecialchars($product['product_name']);
    $category = htmlspecialchars($product['category']);
    $price = htmlspecialchars($product['price']);
    $description = htmlspecialchars($product['description_'] ?? '');
    $quantity = htmlspecialchars($product['quantity'] ?? '');

    echo "
    <div class='col-sm-3'>
        <div class='card product-card' data-product-id='" . htmlspecialchars($product['id']) . "'
             data-product-name='$name' data-product-category='$category' data-product-description='$description' 
             data-product-price='$price' data-product-quantity='$quantity'>
            <div class='container-fluid p-5 bg-purple' style='height: 100%;'></div>
            <div class='card-body'>
                <h5 class='card-title'>$name</h5>
                <p class='price'>\$$price</p>
            </div>
        </div>
    </div>";
}

function displayProducts($pdo, $limit = 8)
{
    $category = $_GET['category'] ?? null;
    $currentPage = isset($_GET['paging']) ? (int) $_GET['paging'] : 1;

    $offset = max(0, ($currentPage - 1) * $limit);
    $query = 'SELECT * FROM products';

    if ($category) {
        $query .= " WHERE category = :category";
    }

    $query .= " LIMIT $limit OFFSET $offset";
    $stmt = $pdo->prepare($query);

    if ($category) {
        $stmt->bindValue(':category', $category, PDO::PARAM_STR);
    }

    $stmt->execute();

    if ($category) {
        echo "
        <div class='d-flex align-items-center'>
            <hr class='short-divider'>
            <h2 class='text-center fw-bold text-secondary-pink'>$category</h2>
            <hr class='short-divider'>
        </div>";
    }

    echo "<div class='my-3'></div>";
    echo "<div class='row'>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        renderProductCard($row);
    }
    echo "</div>";

    addPagination($pdo, $limit, $category, $currentPage);
}

function addPagination($pdo, $limit, $category, $currentPage)
{
    $query = 'SELECT COUNT(*) FROM products';
    if ($category) {
        $query .= " WHERE category = :category";
    }

    $stmt = $pdo->prepare($query);

    if ($category) {
        $stmt->bindValue(':category', $category, PDO::PARAM_STR);
    }

    $stmt->execute();
    $totalProducts = $stmt->fetchColumn();
    $totalPages = ceil($totalProducts / $limit);

    echo "<nav aria-label='Pagination'>";
    echo "<ul class='pagination justify-content-center'>";

    if ($currentPage > 1) {
        echo "<li class='page-item'>
                <a class='page-link custom-page-link' href='?page=products&category=$category&paging=" . ($currentPage - 1) . "' aria-label='Previous'>
                    <span aria-hidden='true'>&laquo;</span>
                </a>
              </li>";
    } else {
        echo "<li class='page-item disabled'>
                <span class='page-link custom-page-link' aria-label='Previous'>
                    <span aria-hidden='true'>&laquo;</span>
                </span>
              </li>";
    }

    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<li class='page-item " . ($i == $currentPage ? 'active' : '') . "'>
                <a class='page-link custom-page-link' href='?page=products&category=$category&paging=$i'>$i</a>
              </li>";
    }

    if ($currentPage < $totalPages) {
        echo "<li class='page-item'>
                <a class='page-link custom-page-link' href='?page=products&category=$category&paging=" . ($currentPage + 1) . "' aria-label='Next'>
                    <span aria-hidden='true'>&raquo;</span>
                </a>
              </li>";
    } else {
        echo "<li class='page-item disabled'>
                <span class='page-link custom-page-link' aria-label='Next'>
                    <span aria-hidden='true'>&raquo;</span>
                </span>
              </li>";
    }

    echo "</ul>";
    echo "</nav>";
}
?>