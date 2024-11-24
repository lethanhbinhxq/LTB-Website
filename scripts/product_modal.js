// Function to initialize modal functionality for product cards
function createProductModal() {
    const productCards = document.querySelectorAll('.product-card');

    productCards.forEach(card => {
        card.addEventListener('click', function () {
            const productId = card.getAttribute('data-product-id');
            const productName = card.getAttribute('data-product-name');
            const productCategory = card.getAttribute('data-product-category');
            const productDescription = card.getAttribute('data-product-description');
            const productPrice = card.getAttribute('data-product-price');
            const productQuantity = card.getAttribute('data-product-quantity');

            const modal = document.getElementById('productModal');
            const modalName = document.getElementById('modalProductName');
            const modalCategory = document.getElementById('modalProductCategory');
            const modalDescription = document.getElementById('modalProductDescription');
            const modalPrice = document.getElementById('modalProductPrice');
            const modalQuantity = document.getElementById('modalProductQuantity');

            if (modal && modalName && modalCategory && modalDescription && modalPrice && modalQuantity) {
                // Populate the modal with product details
                modal.setAttribute('data-product-id', productId);
                modalName.textContent = productName;
                modalCategory.textContent = productCategory;
                modalDescription.textContent = productDescription;
                modalPrice.textContent = `$${productPrice}`;
                modalQuantity.textContent = `${productQuantity}`;

                // Show the modal
                const bootstrapModal = new bootstrap.Modal(modal); // Pass the correct modal element
                bootstrapModal.show();
            } else {
                console.error('Modal elements not found!');
            }
        });
    });
}

document.addEventListener('DOMContentLoaded', function () {
    createProductModal();
});