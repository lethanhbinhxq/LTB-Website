<div class="d-flex justify-content-end">
    <?php if (isset($_SESSION['user_id'])): ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
            Add new product
        </button>

        <form id="addProductForm" method="post" action="../server/insert_product.php">
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductModalLabel">Create Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="productName" class="form-label">Product name</label>
                                <input type="text" class="form-control" id="productName" name="productName"
                                    placeholder="Enter product name" maxlength="255" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="5"
                                    placeholder="Enter description"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" id="category" name="category" required>
                                    <option value="" disabled selected>Select category</option>
                                    <option value="Elegant">Elegant</option>
                                    <option value="Sweet">Sweet</option>
                                    <option value="Cool">Cool</option>
                                    <option value="Sexy">Sexy</option>
                                    <option value="Fresh">Fresh</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" min="0"
                                    step="0.1">
                            </div>

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity" min="0"
                                    step="1" pattern="\d+">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('addProductForm');
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
                                const modalElement = document.getElementById('addProductModal');
                                const modal = bootstrap.Modal.getInstance(modalElement);
                                modal.hide();  // Hide the modal
                                alert("Add product successfully!");
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

    <?php endif; ?>
</div>