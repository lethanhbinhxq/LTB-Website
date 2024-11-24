<form id="editProductForm" class="text-start" method="post" action="../server/update_product.php">
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="editProductId" name="productId">

                    <div class="mb-3">
                        <label for="editProductName" class="form-label">Product name</label>
                        <input type="text" class="form-control" id="editProductName" name="productName"
                            placeholder="Enter product name" maxlength="255" required>
                    </div>

                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editDescription" name="description" rows="5"
                            placeholder="Enter description"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="editCategory" class="form-label">Category</label>
                        <select class="form-select" id="editCategory" name="category" required>
                            <option value="" disabled selected>Select category</option>
                            <option value="Elegant">Elegant</option>
                            <option value="Sweet">Sweet</option>
                            <option value="Cool">Cool</option>
                            <option value="Sexy">Sexy</option>
                            <option value="Fresh">Sexy</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="editPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="editPrice" name="price" placeholder="Enter price"
                            min="0" step="0.1">
                    </div>

                    <div class="mb-3">
                        <label for="editQuantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="editQuantity" name="quantity"
                            placeholder="Enter quantity" min="0" step="1" pattern="\d+">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('editProductForm');
        form.addEventListener('submit', function (e) {
            e.preventDefault();  // Prevent default form submission

            // Create a new FormData object from the form
            const formData = new FormData(form);

            // Send the form data via Fetch API
            fetch(form.action, {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    if (data === 'success') {
                        // If the response indicates success, close the modal
                        const modalElement = document.getElementById('editProductModal');
                        const modal = bootstrap.Modal.getInstance(modalElement);
                        modal.hide();  // Hide the modal
                        alert("Update product successfully!");
                        location.reload();
                    } else {
                        alert('Error: ' + data);  // Display error message
                    }
                })
                .catch(() => {
                    alert('An error occurred. Please try again.');
                });
        });
    });
</script>