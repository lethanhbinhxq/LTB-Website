<script src="../scripts/lazy_loading.js"></script>
<script src="../scripts/product_modal.js"></script>

<div class="container my-5">
    <input type="hidden" id="searchKeyword" value="<?php echo htmlspecialchars($_GET['keyword'] ?? ''); ?>">
    <input type="hidden" id="searchCriteria"
        value="<?php echo htmlspecialchars($_GET['search_criteria'] ?? 'Name'); ?>">

    <h1 class="my-5 text-center text-uppercase fw-bold text-main-pink">Search result</h1>

    <input type="hidden" name="" id="searchCriteria" value="Name">

    <div class="row justify-content-center text-center" id="product-container">
        <!-- product card goes here -->
    </div>
</div>