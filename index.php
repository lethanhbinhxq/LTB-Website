<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LTB Website</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="styles/style.css">
</head>

<body>

    <?php include 'components/header.php'; ?>

    <?php include 'components/navbar.php'; ?>

    <div class="alert-container position-relative">
        <div class="d-flex justify-content-end mb-3">
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show position-absolute" role="alert" id="errorAlert">
                    <?php echo $_SESSION['error']; ?>
                    <?php unset($_SESSION['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>

        <script src="scripts/remove_alert.js"></script>

        <div>
            <?php
            // Get the 'page' parameter from the URL, default to 'home' if not set
            $page = $_GET['page'] ?? 'home';

            $page = isset($_GET['keyword']) ? 'search' : $page;

            // Include the corresponding page content
            $pageFile = "pages/{$page}.php";

            // 404 Not found page
            $notFoundFile = "pages/not_found.php";

            // Check if the file exists before including
            if (file_exists($pageFile)) {
                include $pageFile;
            } else {
                // If the file doesn't exist, show a 404 page
                include $notFoundFile;
            }
            ?>
        </div>
    </div>

    <?php include 'components/footer.php'; ?>
</body>

</html>