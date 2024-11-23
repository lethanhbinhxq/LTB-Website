document.addEventListener('DOMContentLoaded', function () {
    let page = 1; // Start from page 1
    const searchKeyword = document.getElementById('searchKeyword').value;
    const searchCriteria = document.getElementById('searchCriteria').value;
    const productContainer = document.getElementById('product-container');
    const loadingSpinner = document.getElementById('loading-spinner');

    window.addEventListener('scroll', function () {
        // Check if we are at the bottom of the page
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100) {
            loadMoreProducts();
        }
    });

    function loadMoreProducts() {
        loadingSpinner.style.display = 'block'; // Show loading spinner

        // Fetch more products
        fetch(`/components/product_search.php?keyword=${searchKeyword}&search_criteria=${searchCriteria}&page=${page}`)
            .then(response => response.text())
            .then(data => {
                if (data.trim()) {
                    productContainer.innerHTML += data; // Append new products
                    page++; // Increment page for the next load
                } else {
                    window.removeEventListener('scroll', loadMoreProducts); // No more products
                }
            })
            .catch(error => console.error('Error loading products:', error))
            .finally(() => {
                loadingSpinner.style.display = 'none'; // Hide loading spinner
            });
    }

    // Load the first page of products
    loadMoreProducts();
});
