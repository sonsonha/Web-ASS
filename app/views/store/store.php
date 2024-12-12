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

        <!-- Modal for Editing Game -->
        <div id="editGameModal" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #1b2838; padding: 20px; border-radius: 10px; z-index: 1000; width: 80%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <h3 style="color: #fff; text-align: center;">Edit Game</h3>
            <form id="editGameForm" style="color: #fff;">
                <label for="gameName">Game Name:</label>
                <input type="text" id="gameName" required>

                <label for="publisher">Publisher:</label>
                <input type="text" id="publisher" required>

                <label for="genre">Genre:</label>
                <input type="text" id="genre">

                <label for="price">Price:</label>
                <input type="number" id="price">

                <label for="discount">Discount:</label>
                <input type="number" id="discount">

                <label for="downloads">Downloads:</label>
                <input type="number" id="downloads">

                <label for="releaseDate">Release Date:</label>
                <input type="date" id="releaseDate">

                <label for="description">Description:</label>
                <textarea id="description"></textarea>

                <label for="avt">Avatar URL:</label>
                <input type="text" id="avt">

                <label for="background">Background URL:</label>
                <input type="text" id="background">

                <label for="introduction">Introduction:</label>
                <textarea id="introduction"></textarea>

                <label for="rating">Rating:</label>
                <input type="number" id="rating">

                <label for="downloadLink">Download Link:</label>
                <input type="text" id="downloadLink">

                <label for="recOS">Recommended OS:</label>
                <input type="text" id="recOS">

                <label for="recProcessor">Recommended Processor:</label>
                <input type="text" id="recProcessor">

                <label for="recMemory">Recommended Memory:</label>
                <input type="text" id="recMemory">

                <label for="recGraphics">Recommended Graphics:</label>
                <input type="text" id="recGraphics">

                <label for="recDirectX">Recommended DirectX:</label>
                <input type="text" id="recDirectX">

                <label for="recStorage">Recommended Storage:</label>
                <input type="text" id="recStorage">

                <label for="minOS">Minimum OS:</label>
                <input type="text" id="minOS">

                <label for="minProcessor">Minimum Processor:</label>
                <input type="text" id="minProcessor">

                <label for="minMemory">Minimum Memory:</label>
                <input type="text" id="minMemory">

                <label for="minGraphics">Minimum Graphics:</label>
                <input type="text" id="minGraphics">

                <label for="minDirectX">Minimum DirectX:</label>
                <input type="text" id="minDirectX">

                <label for="minStorage">Minimum Storage:</label>
                <input type="text" id="minStorage">

                <div class="mt-3" style="text-align: center;">
                    <button type="button" class="btn btn-success" onclick="updateGame()">Save Changes</button>
                    <button type="button" class="btn btn-secondary" onclick="closeEditGameModal()">Cancel</button>
                </div>
            </form>
        </div>
        <div id="modalBackdrop" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 999;"></div>

    </main>

    <?php include __DIR__ . '/../layouts/footer.php'; ?> <!-- Updated -->

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/../assets/js/store.js"></script>
</body>

</html>

<style>
    /* Modal Styling */
    #editGameModal {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #2c3e50; /* Darker background for a sleek look */
        padding: 30px;
        border-radius: 12px;
        z-index: 1000;
        width: 80%;
        max-width: 600px; /* Limit max width for better readability */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* Enhanced shadow */
        overflow-y: auto;
        max-height: 90vh; /* Prevents modal from overflowing */
    }

    #editGameModal h3 {
        color: #ecf0f1; /* Light text color for contrast */
        text-align: center;
        margin-bottom: 20px;
    }

    /* Form Styling */
    #editGameForm label {
        display: block;
        margin-bottom: 5px;
        color: #bdc3c7;
    }

    #editGameForm input[type="text"],
    #editGameForm input[type="number"],
    #editGameForm input[type="date"],
    #editGameForm textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #34495e;
        border-radius: 4px;
        background: #34495e;
        color: #ecf0f1;
        font-size: 14px;
    }

    #editGameForm textarea {
        resize: vertical; /* Allows only vertical resizing */
    }

    /* Button Styling */
    #editGameForm button {
        width: 48%;
        margin: 5px 1%;
        padding: 10px;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }

    /* Specific Button Colors */
    .btn-success {
        background-color: #27ae60;
        color: #fff;
        transition: background-color 0.3s;
    }

    .btn-success:hover {
        background-color: #2ecc71;
    }

    .btn-secondary {
        background-color: #7f8c8d;
        color: #fff;
        transition: background-color 0.3s;
    }

    .btn-secondary:hover {
        background-color: #95a5a6;
    }

    /* Backdrop Styling */
    #modalBackdrop {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7); /* Darker backdrop */
        z-index: 999;
    }
</style>