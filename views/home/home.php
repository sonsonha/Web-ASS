<?php include(__DIR__ . '/../templates/header.php'); ?>

<!-- Main Content with Sidebar Layout -->
<div class="container-fluid mt-3">
    <div class="row">
        <!-- Left Sidebar for Game List -->
        <aside class="col-md-2" style="background-color: #f8f9fa;">
            <h5>Popular Games</h5>
            <ul class="list-group">
                <!-- List of 20 game names -->
                <li class="list-group-item">Game 1</li>
                <li class="list-group-item">Game 2</li>
                <li class="list-group-item">Game 3</li>
                <li class="list-group-item">Game 4</li>
                <!-- Add more list items to reach 20 games -->
            </ul>
        </aside>

        <!-- Main Content Area -->
        <main class="col-md-7">
            <!-- Featured Game Carousel -->
            <div id="carouselExampleIndicators" class="carousel slide mb-3" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../Model/img/home/2004_1.jpg" class="d-block w-100" alt="Slide 1">
                    </div>
                    <div class="carousel-item">
                        <img src="../Model/img/home/freefire.jpg" class="d-block w-100" alt="Slide 2">
                    </div>
                    <div class="carousel-item">
                        <img src="../Model/img/home/game-wall.jpg" class="d-block w-100" alt="Slide 3">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <!-- Featured & Discounted Games -->
            <h2>Featured & Discounted Games</h2>
            <div class="row">
                <!-- Add cards for featured games, as in your original layout -->
                <div class="col-md-4">
                    <div class="card">
                        <img src="../Model/img/dogmaster.jpg" class="card-img-top" alt="Game 1">
                        <div class="card-body">
                            <h5 class="card-title">Game Title</h5>
                            <p class="card-text">Game description here.</p>
                            <a href="#" class="btn btn-dark">Buy Now</a>
                        </div>
                    </div>
                </div>
                <!-- Additional game cards go here -->
            </div>
        </main>

        <!-- Right Sidebar for Advertisements -->
        <aside class="col-md-3" style="background-color: #f8f9fa;">
            <h5>Advertisements</h5>
            <img src="../Model/img/ad/ad1.jpg" class="img-fluid mb-3" alt="Ad 1">
            <img src="../Model/img/ad/ad2.jpg" class="img-fluid mb-3" alt="Ad 2">
            <!-- Add more advertisement images as needed -->
        </aside>
    </div>
</div>
<?php include(__DIR__ . '/../templates/footer.php'); ?>