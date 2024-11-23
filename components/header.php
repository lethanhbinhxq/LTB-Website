<?php
session_start();

$isLoggedIn = isset($_SESSION['user_id']) ? 'true' : 'false';

$fullName = ($isLoggedIn && isset($_SESSION['fullname'])) ? $_SESSION['fullname'] : '';
?>

<script>
    var userLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
    var userFullName = <?php echo json_encode($fullName); ?>;

    function isLoggedIn() {
        return userLoggedIn === 'true';
    }

    function handleProfileClick() {
        if (!isLoggedIn()) {
            window.location.href = 'index.php?page=login';
        } else {
            document.getElementById('profileDropdown').style.display =
                document.getElementById('profileDropdown').style.display === 'block' ? 'none' : 'block';
            document.getElementById('usernameDisplay').innerHTML = userFullName;
        }
    }

    function logout() {
        // Clear the session cookie
        document.cookie = 'user_logged_in=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';

        fetch('server/logout.php')
            .then(() => {
                window.location.href = 'index.php?page=login';
            });
    }
</script>

<script src="../scripts/search_by.js"></script>
<script src="../scripts/search_AJAX.js"></script>

<!-- Header -->
<div class="container-fluid d-flex justify-content-around bg-dark text-center align-items-center">
    <a href="index.php" class="text-decoration-none">
        <div>
            <img src="assets\logo.png" class="rounded-circle" alt="Logo" width="80">
            <span class="fs-3 text-secondary-pink">LTB</span>
        </div>
    </a>

    <!-- Search bar -->
    <div>
        <form class="d-flex ms-auto" role="search" action="index.php" method="get">
            <div class="dropdown me-2">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Search by
                </button>
                <ul class="dropdown-menu dropdown-menu-purple" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" onclick="setSearchCriteria('Name')">Name</a></li>
                    <li><a class="dropdown-item" onclick="setSearchCriteria('Category')">Category</a></li>
                    <li><a class="dropdown-item" onclick="setSearchCriteria('Description')">Description</a>
                    </li>
                    <li><a class="dropdown-item" onclick="setSearchCriteria('Price')">Price</a></li>
                    <li><a class="dropdown-item" onclick="setSearchCriteria('Quantity')">Quantity</a></li>
                </ul>
            </div>

            <input type="hidden" name="search_criteria" id="searchCriteria" value="Name">

            <div>
                <input class="form-control me-2 custom-search" name="keyword" type="search" placeholder="Search"
                    aria-label="Search" id="searchByText" autocomplete="off">

                <div id="autocomplete-list" class="dropdown-menu dropdown-menu-purple" style="display: none;"></div>
            </div>

            <div id="searchByNumber">
                <input type="number" class="form-control me-2 custom-search-number" name="min_value"
                    placeholder="Min Value" min="0" step="1">
                <input type="number" class="form-control me-2 custom-search-number" name="max_value"
                    placeholder="Max Value" min="0" step="1">
            </div>

            <button class="btn btn-outline-secondary" type="submit" aria-label="Search">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>

    <div>
        <button class="btn btn-outline-secondary rounded-circle me-3" type="submit" aria-label="Search">
            <i class="bi bi-cart4" style="font-size: larger;"></i>
        </button>

        <button class="btn btn-outline-secondary rounded-circle" id="profileButton" onclick="handleProfileClick()">
            <i class="bi bi-person-fill" style="font-size: larger;"></i>
        </button>

        <div id="profileDropdown" class="dropdown-menu dropdown-menu-purple text-center" style="display: none;">
            <span id="usernameDisplay">User name</span>
            <a href="#" class="dropdown-item" onclick="logout()">Logout</a>
        </div>
    </div>

</div>