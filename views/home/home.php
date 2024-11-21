<?php include(__DIR__ . '/../templates/header.php'); ?>

<!-- Main Content with Sidebar Layout -->
<div class="container-fluid mt-5">
    <div class="row">
        <!-- Main Content Area -->
        <main class="col-lg-9 col-md-8 col-sm-12 mt-0">
            <!-- Featured Game Carousel -->
            <div id="carouselExampleIndicators" class="carousel slide mb-3" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>

                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/img/home/2004_1.jpg" class="d-block w-100" style="height: 600px; object-fit: cover;" alt="Slide 1">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/home/freefire.jpg" class="d-block w-100" style="height: 600px; object-fit: cover;" alt="Slide 2">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/home/game-wall.jpg" class="d-block w-100" style="height: 600px; object-fit: cover;" alt="Slide 3">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/home/gta-5-.jpg" class="d-block w-100" style="height: 600px; object-fit: cover;" alt="Slide 4">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/home/lol.jpg" class="d-block w-100" style="height: 600px; object-fit: cover;" alt="Slide 5">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/home/valorant.jpg" class="d-block w-100" style="height: 600px; object-fit: cover;" alt="Slide 6">
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

            <div class="row">
                <!-- Add cards for featured games, as in your original layout -->
                <div class="col-md-4 col-lg-4 mb-3">
                    <div class="card">
                        <img src="assets/img/images.jpg" class="card-img-top w-100" style="height: 400px; object-fit: cover;" alt="Game 1">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Today's Offer</h5>
                                <div class="discount-amount font-weight-bold text-danger display-4">
                                    -20%
                                </div>
                            </div>
                            <div class="container d-flex align-items-center p-2">
                                <div class="price-container p-2 d-flex align-items-center">
                                    <span class="original-price text-danger mr-2" style="text-decoration: line-through;">180.000₫</span>
                                    <i class="fas fa-arrow-right mx-2" style="font-size: 1.5rem; color: #FF5733;"></i>
                                    <span class="sale-price font-weight-bold" style="color: #28a745;">144.000₫</span>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 mb-3">
                    <div class="card">
                        <img src="assets/img/icarus-2.jpg" class="card-img-top w-100" style="height: 400px; object-fit: cover;" alt="Game 1">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Today's Offer</h5>
                                <div class="discount-amount font-weight-bold text-danger display-4">
                                    -50%
                                </div>
                            </div>

                            <div class="container d-flex align-items-center p-2">
                                <div class="price-container p-2 d-flex align-items-center">
                                    <span class="original-price text-danger mr-2" style="text-decoration: line-through;">445.000₫</span>
                                    <i class="fas fa-arrow-right mx-2" style="font-size: 1.5rem; color: #FF5733;"></i>
                                    <span class="sale-price font-weight-bold" style="color: #28a745;">222.500₫</span>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 mb-3">
                    <div class="card">
                        <img src="assets/img/aow.jpg" class="card-img-top w-100" style="height: 400px; object-fit: cover;" alt="Game 1">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Today's Offer</h5>
                                <div class="discount-amount font-weight-bold text-danger display-4">
                                    -35%
                                </div>
                            </div>
                            <div class="container d-flex align-items-center p-2">
                                <div class="price-container p-2 d-flex align-items-center">
                                    <span class="original-price text-danger mr-2" style="text-decoration: line-through;">830.000₫</span>
                                    <i class="fas fa-arrow-right mx-2" style="font-size: 1.5rem; color: #FF5733;"></i>
                                    <span class="sale-price font-weight-bold" style="color: #28a745;">539.500₫</span>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <!-- Additional game cards go here -->
            </div>
        </main>

        <!-- Right Sidebar for Advertisements -->

        <div class="col-md-3 d-none d-md-block">


            <!-- Phần hiển thị quảng cáo -->
            <aside class="mb-3" style="background-color: #f8f9fa; padding: 10px;">

                <img src="assets/img/home/picmix.com_9868202.gif" class="img-fluid mb-3" alt="Ad 2">
                <!-- Add more advertisement images as needed -->
            </aside>
            <!-- Phần hiển thị quảng cáo -->
            <aside class="mb-3" style="background-color: #f8f9fa; padding: 10px;">

                <img src="assets/img/home/picmix.com_9868202.gif" class="img-fluid mb-3" alt="Ad 2">
                <!-- Add more advertisement images as needed -->
            </aside>
            <!-- Phần hiển thị quảng cáo -->
            <aside class="mb-3" style="background-color: #f8f9fa; padding: 10px;">

                <img src="assets/img/home/picmix.com_9868202.gif" class="img-fluid mb-3" alt="Ad 2">
                <!-- Add more advertisement images as needed -->
            </aside>
            <!-- Phần hiển thị quảng cáo -->
            <aside class="mb-3" style="background-color: #f8f9fa; padding: 10px;">

                <img src="assets/img/home/picmix.com_9868202.gif" class="img-fluid mb-3" alt="Ad 2">
                <!-- Add more advertisement images as needed -->
            </aside>
        </div>






    </div>
</div>
<?php include(__DIR__ . '/../templates/footer.php'); ?>