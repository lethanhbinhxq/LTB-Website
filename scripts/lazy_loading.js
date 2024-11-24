document.addEventListener('DOMContentLoaded', function () {
    let page = 1; // Start from page 1
    const searchKeyword = document.getElementById('searchKeyword').value;
    const searchCriteria = document.getElementById('searchCriteria').value;
    const productContainer = document.getElementById('product-container');

    let isAllLoaded = false; // Flag to track if all products are loaded
    let isLoading = false;  // Flag to track if a request is currently in progress

    // Debounced scroll listener
    let scrollTimeout;
    window.addEventListener('scroll', function () {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
            // Check if we are at the bottom of the page and not already loading
            if (!isAllLoaded && !isLoading && window.innerHeight + window.scrollY >= document.body.offsetHeight - 100) {
                loadMoreProducts();
            }
        }, 200); // Adjust the timeout delay (200ms here) as needed
    });

    function loadMoreProducts() {
        if (isAllLoaded || isLoading) return; // Prevent fetching if already loading or all products are loaded

        isLoading = true; // Set loading flag to true
        // Fetch more products
        fetch(`/server/product_search.php?keyword=${searchKeyword}&search_criteria=${searchCriteria}&page=${page}`)
            .then(response => response.text())
            .then(data => {
                const trimmedData = data.trim();

                if (trimmedData === '<h4>No products found.</h4>') {
                    productContainer.innerHTML += trimmedData; // Append 'No products' message
                    isAllLoaded = true; // Stop further loading
                    window.removeEventListener('scroll', loadMoreProducts); // Stop listening for scroll
                } else if (trimmedData) {
                    productContainer.innerHTML += trimmedData; // Append new products
                    page++;
                    createProductModal();
                } else {
                    isAllLoaded = true;
                    window.removeEventListener('scroll', loadMoreProducts);
                }
            })
            .catch(error => console.error('Error loading products:', error))
            .finally(() => {
                isLoading = false;
            });
    }

    loadMoreProducts();
});
