<div class="container mb-5 mt-4">
    <h1 class="text-center text-uppercase fw-bold text-main-pink">Products</h1>

    <div class='d-flex align-items-center' id="categoryHolder" style="display: none !important;">
        <hr class='short-divider'>
        <h2 class='text-center fw-bold text-secondary-pink' id="categoryText"></h2>
        <hr class='short-divider'>
    </div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/components/add_product.php';
    ?>

    <div class="row justify-content-center text-center">

        <?php include $_SERVER['DOCUMENT_ROOT'] . '/db/db_connection.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/components/product_card.php';
        displayProducts($pdo);
        ?>

    </div>
</div>