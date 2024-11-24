<form id="removeProductForm" class="text-start" method="post" action="../server/delete_product.php">
    <div class="modal fade" id="removeProductModal" tabindex="-1" aria-labelledby="removeProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeProductModalLabel">Remove Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="removeProductId" name="productId">

                    Are you sure to remove this product?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('removeProductForm');
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
                        const modalElement = document.getElementById('removeProductModal');
                        const modal = bootstrap.Modal.getInstance(modalElement);
                        modal.hide();  // Hide the modal
                        alert("Delete product successfully!");
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