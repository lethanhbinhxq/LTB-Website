<!-- Carousel Banner -->
<div class="container mt-5">

    <div id="carouseBanner" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouseBanner" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouseBanner" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouseBanner" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <!-- <img src="..." class="d-block w-100" alt="..."> -->

                <div class="container-fluid p-5 bg-purple text-center">
                    <p>Banner 1</p>
                </div>
            </div>
            <div class="carousel-item">
                <!-- <img src="..." class="d-block w-100" alt="..."> -->

                <div class="container-fluid p-5 bg-purple text-center">
                    <p>Banner 2</p>
                </div>
            </div>
            <div class="carousel-item">
                <!-- <img src="..." class="d-block w-100" alt="..."> -->

                <div class="container-fluid p-5 bg-purple text-center">
                    <p>Banner 3</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouseBanner" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouseBanner" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="mt-5">
        <p class="text-center px-5 mx-5">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus volutpat augue vel erat consectetur, id
            porttitor risus convallis. Sed a fermentum odio. Aenean ultrices facilisis rutrum. Nullam posuere diam
            laoreet hendrerit tempor. Duis sagittis, odio et consequat fringilla, mauris eros porttitor eros, sit
            amet eleifend libero sem sit amet erat. Aliquam dignissim ex nulla, at ullamcorper turpis porta at.
            Mauris quis sem est. Cras mollis justo nec metus elementum, et convallis eros fermentum. Nunc in iaculis
            orci.
        </p>
    </div>
</div>

<!-- About Us Section -->
<div class="container my-5">
    <hr class="border border-4 rounded-pill border-primary opacity-75">

    <h1 class="mt-5 text-center text-uppercase fw-bold text-main-pink">About Us</h1>

    <div class="row my-5">
        <div class="col-sm-6">
            <div class="bg-purple" style="height: 300px;"></div>
        </div>

        <div class="col-sm-6 d-flex justify-content-between align-items-center">
            <p class="text-center">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque posuere dapibus augue, quis euismod
                nulla laoreet ultrices. Suspendisse nisl elit, eleifend nec efficitur eget, vehicula eu velit.
                Nullam interdum ut mauris eget accumsan. Quisque eleifend posuere quam, eu eleifend dui varius sed.
                Phasellus ultricies non justo ac semper. Vestibulum ultricies ante dui, sed interdum mi cursus
                congue. Donec porta sit amet sapien vitae cursus. Curabitur ullamcorper maximus leo, id cursus quam
                ullamcorper quis. Mauris maximus fringilla vestibulum. Nam finibus gravida tempus. Aliquam erat
                volutpat. Fusce congue gravida magna, non placerat elit feugiat ut.
            </p>
        </div>
    </div>

    <hr class="short-divider">

    <div class="row my-5">
        <div class="col-sm-6 d-flex justify-content-between align-items-center">
            <p class="text-center">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque posuere dapibus augue, quis euismod
                nulla laoreet ultrices. Suspendisse nisl elit, eleifend nec efficitur eget, vehicula eu velit.
                Nullam interdum ut mauris eget accumsan. Quisque eleifend posuere quam, eu eleifend dui varius sed.
                Phasellus ultricies non justo ac semper. Vestibulum ultricies ante dui, sed interdum mi cursus
                congue. Donec porta sit amet sapien vitae cursus. Curabitur ullamcorper maximus leo, id cursus quam
                ullamcorper quis. Mauris maximus fringilla vestibulum. Nam finibus gravida tempus. Aliquam erat
                volutpat. Fusce congue gravida magna, non placerat elit feugiat ut.
            </p>
        </div>

        <div class="col-sm-6">
            <div class="bg-purple" style="height: 300px;"></div>
        </div>
    </div>

    <hr class="short-divider">

    <div class="row mt-5">
        <div class="col-sm-6">
            <div class="bg-purple" style="height: 300px;"></div>
        </div>

        <div class="col-sm-6 d-flex justify-content-between align-items-center">
            <p class="text-center">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque posuere dapibus augue, quis euismod
                nulla laoreet ultrices. Suspendisse nisl elit, eleifend nec efficitur eget, vehicula eu velit.
                Nullam interdum ut mauris eget accumsan. Quisque eleifend posuere quam, eu eleifend dui varius sed.
                Phasellus ultricies non justo ac semper. Vestibulum ultricies ante dui, sed interdum mi cursus
                congue. Donec porta sit amet sapien vitae cursus. Curabitur ullamcorper maximus leo, id cursus quam
                ullamcorper quis. Mauris maximus fringilla vestibulum. Nam finibus gravida tempus. Aliquam erat
                volutpat. Fusce congue gravida magna, non placerat elit feugiat ut.
            </p>
        </div>
    </div>

</div>

<!-- New Products Section -->
<div class="container mt-5">
    <hr class="border border-4 rounded-pill border-primary opacity-75">

    <h1 class="my-5 text-center text-uppercase fw-bold text-main-pink">New Products</h1>

    <div class="row justify-content-center text-center">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/db/db_connection.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/components/product_card.php';
        displayProducts($pdo, 7);
        ?>
    </div>

    <div class="d-flex justify-content-center"><button type="button" class="btn btn-primary"
            onclick="window.location.href='index.php?page=products'">View more
            products</button></div>
</div>

<!-- New Posts Section -->
<div class="container mt-5">
    <hr class="border border-4 rounded-pill border-primary opacity-75">

    <h1 class="my-5 text-center text-uppercase fw-bold text-main-pink">New Posts</h1>

    <div id="newPostsCarousel" class="carousel slide" data-bs-ride="carousel" style="max-width: 760px; margin: 0 auto;">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="bg-purple m-3" style="height: 300px;"></div>
                        <h5 class="card-title mt-2">Post Title 1</h5>
                        <p class="card-text">This is a brief description of the new post.</p>
                        <button type="button" class="btn btn-primary">Read More</button>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="bg-purple m-3" style="height: 300px;"></div>
                        <h5 class="card-title mt-2">Post Title 2</h5>
                        <p class="card-text">This is a brief description of the new post.</p>
                        <button type="button" class="btn btn-primary">Read More</button>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="bg-purple m-3" style="height: 300px;"></div>
                        <h5 class="card-title mt-2">Post Title 3</h5>
                        <p class="card-text">This is a brief description of the new post.</p>
                        <button type="button" class="btn btn-primary">Read More</button>
                    </div>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#newPostsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-main-pink" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#newPostsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-main-pink" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

</div>