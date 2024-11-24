<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="modalProductName" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <h5 class="modal-title fw-bold text-main-pink mb-3" id="modalProductName"></h5>

                <div class="row mb-3">
                    <div class="col-sm-6">
                        <div class="bg-purple" style="aspect-ratio: 1;"></div>
                    </div>

                    <div class="col-sm-6 text-start">
                        <p>
                            <span class="fw-bold">Price: </span>
                            <span id="modalProductPrice"></span>
                        </p>

                        <p>
                            <span class="fw-bold">Category: </span>
                            <span id="modalProductCategory"></span>
                        </p>

                        <p>
                            <span class="fw-bold">Description: </span>
                            <span id="modalProductDescription"></span>
                        </p>



                        <p>
                            <span class="fw-bold">Quantity: </span>
                            <span id="modalProductQuantity"></span>
                    </div>

                </div>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="d-flex flex-row justify-content-around">
                    <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal"
                        data-bs-target="#editProductModal" onclick="initEditModal()">
                        Edit product
                    </button>

                    <button type="button" class="btn btn-danger my-3" data-bs-toggle="modal"
                        data-bs-target="#removeProductModal" onclick="initRemoveModal()">
                        Remove product
                    </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/components/edit_product.php'; ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/components/remove_product.php'; ?>

<script>
    function initEditModal() {
        const productModalElement = document.getElementById('productModal');
        const productModal = bootstrap.Modal.getInstance(productModalElement);

        // product id
        const productId = productModalElement.getAttribute('data-product-id');
        const editProductId = document.getElementById('editProductId');
        editProductId.value = productId;

        // old product name
        const productName = document.getElementById('modalProductName');
        const editProductName = document.getElementById('editProductName');
        editProductName.value = productName.textContent;

        // old description
        const description = document.getElementById('modalProductDescription');
        const editDescription = document.getElementById('editDescription');
        editDescription.value = description.textContent;

        // old category
        const category = document.getElementById('modalProductCategory');
        const editCategory = document.getElementById('editCategory');
        editCategory.value = category.textContent;

        // old price
        const priceString = document.getElementById('modalProductPrice').textContent;
        const editPrice = document.getElementById('editPrice');
        editPrice.value = parseFloat(priceString.replace("$", ""));

        // old quantity
        const quantityString = document.getElementById('modalProductQuantity').textContent;
        const editQuantity = document.getElementById('editQuantity');
        editQuantity.value = parseInt(quantityString, 10);

        productModal.hide();
    }
</script>

<script>
    function initRemoveModal() {
        const productModalElement = document.getElementById('productModal');
        const productModal = bootstrap.Modal.getInstance(productModalElement);

        const productId = productModalElement.getAttribute('data-product-id');
        const removeProductId = document.getElementById('removeProductId');
        removeProductId.value = productId;

        productModal.hide();
    }
</script>