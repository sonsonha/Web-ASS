<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zerostress-Gamestore - Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/../assets/css/store.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

</head>

<body class="set-bg-color">
    <?php include(__DIR__ . '/../layouts/header.php'); ?>

    <main class="container my-5 bg-main-color">

        <div class="container text-center">
            <div class="row g-2">
                <!-- Carousel Section -->
                <div class="col-9 bg-dark d-none d-lg-block">
                    <div class="swiper-container" id="gameSwiper">
                        <div class="swiper-wrapper" id="swiperWrapper">
                            <!-- Slides will be dynamically populated -->
                        </div>
                        <!-- Navigation Buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <!-- Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <!-- Thumbnails Section -->
                <div class="col-lg-3 col-12">
                    <div id="thumbnails" class="d-flex flex-column gap-2 overflow-auto" style="height: 100%;"></div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <h2 class="text text-white">Category</h2>
            <div class="card-carousel">
                <!-- Cards Wrapper -->
                <div class="row flex-nowrap overflow-auto" id="carouselWrapper">
                    <!-- Cards will be dynamically rendered here -->
                </div>

                <!-- Controls (Hidden on Small Screens) -->
                <div class="d-flex justify-content-between mt-3 d-none d-md-flex">
                    <button id="prevButton" class="btn btn-primary">&lt; Prev</button>
                    <button id="nextButton" class="btn btn-primary">Next &gt;</button>
                </div>
            </div>
        </div>


        <div class="container mt-5">
            <h2 class="text text-white">Trending Games</h2>
            <div class="card-carousel">
                <div class="row flex-nowrap overflow-auto" id="trendingGamesWrapper">
                    <!-- Trending games cards will be dynamically rendered here -->
                </div>

                <!-- Controls -->
                <div class="d-flex justify-content-between mt-3 d-none d-md-flex">
                    <button id="trendingPrevButton" class="btn btn-primary">&lt; Prev</button>
                    <button id="trendingNextButton" class="btn btn-primary">Next &gt;</button>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <h2 class="text text-white">New Releases</h2>
            <div class="card-carousel">
                <div class="row flex-nowrap overflow-auto" id="newReleasesWrapper">
                    <!-- New releases cards will be dynamically rendered here -->
                </div>

                <!-- Controls -->
                <div class="d-flex justify-content-between mt-3 d-none d-md-flex">
                    <button id="newPrevButton" class="btn btn-primary">&lt; Prev</button>
                    <button id="newNextButton" class="btn btn-primary">Next &gt;</button>
                </div>
            </div>
        </div>


        <div class="container mt-5">
            <h2 class="text text-white">Top Rate</h2>
            <div class="card-carousel">
                <div class="row flex-nowrap overflow-auto" id="topRateWrapper">
                    <!-- Top rate games cards will be dynamically rendered here -->
                </div>

                <!-- Controls -->
                <div class="d-flex justify-content-between mt-3 d-none d-md-flex">
                    <button id="topRatePrevButton" class="btn btn-primary">&lt; Prev</button>
                    <button id="topRateNextButton" class="btn btn-primary">Next &gt;</button>
                </div>
            </div>
        </div>

    </main>

    <?php include __DIR__ . '/../layouts/footer.php'; ?> <!-- Updated -->

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/../assets/js/store.js"></script>
</body>

</html>