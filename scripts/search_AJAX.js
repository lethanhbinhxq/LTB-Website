document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchByText");
    const searchCriteria = document.getElementById("searchCriteria");
    const autocompleteList = document.getElementById("autocomplete-list");

    searchInput.addEventListener("input", function () {
        const query = this.value.trim();
        const criteria = searchCriteria.value;
        if (!query) {
            autocompleteList.style.display = "none";
            return;
        }

        const xhr = new XMLHttpRequest();
        xhr.open(
            "GET",
            `../server/fetch_AJAX.php?query=${encodeURIComponent(query)}&criteria=${encodeURIComponent(criteria)}`,
            true
        );

        xhr.onload = function () {
            if (xhr.status === 200) {
                const products = JSON.parse(xhr.responseText);
                autocompleteList.innerHTML = "";
                if (products.length > 0) {
                    products.forEach((product) => {
                        const item = document.createElement("div");
                        item.classList.add("dropdown-item");
                        item.textContent = product.product_name;
                        item.addEventListener("click", function () {
                            searchInput.value = product.product_name;
                            document.querySelector("form[role='search']").submit();
                        });
                        autocompleteList.appendChild(item);
                    });
                    autocompleteList.style.display = "block";
                } else {
                    autocompleteList.style.display = "none";
                }
            }
        };

        xhr.send();
    });

    // Hide dropdown if clicked outside
    document.addEventListener("click", function (e) {
        if (!searchInput.contains(e.target) && !autocompleteList.contains(e.target)) {
            autocompleteList.style.display = "none";
        }
    });
});
