<?php include '../header.php'; ?>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-7">
            <h2 class="mb-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>Can Tho & Ho Chi Minh City Tour (3
                Days)</h2>
            <p class="lead">Experience the best of the Mekong Delta and Saigon with our 3-day tour. Enjoy floating
                markets, city landmarks, and delicious local cuisine.</p>
            <ul class="list-group mb-4">
                <li class="list-group-item"><i class="fa fa-calendar-alt text-primary me-2"></i><b>Duration:</b> 3 days
                </li>
                <li class="list-group-item"><i class="fa fa-users text-primary me-2"></i><b>Group Size:</b> 2-20 people
                </li>
                <li class="list-group-item"><i class="fa fa-map text-primary me-2"></i><b>Departure:</b> Ho Chi Minh
                    City</li>
                <li class="list-group-item"><i class="fa fa-ship text-primary me-2"></i><b>Destination:</b> Can Tho, Ho
                    Chi Minh City</li>
                <li class="list-group-item"><i class="fa fa-dollar-sign text-primary me-2"></i><b>Price:</b> From
                    $179/person</li>
            </ul>
            <h4 class="mb-3"><i class="fa fa-info-circle text-success me-2"></i>Tour Highlights</h4>
            <ul>
                <li>Explore Cai Rang Floating Market by boat</li>
                <li>Visit Notre-Dame Cathedral, Ben Thanh Market, and more</li>
                <li>Enjoy authentic Mekong Delta and Saigon cuisine</li>
                <li>Stay in 4-star hotels in both cities</li>
                <li>Professional local guides</li>
            </ul>
            <a href="../booking.php" class="btn btn-primary mt-4"><i class="fa fa-calendar-check me-2"></i>Book Now</a>
        </div>
        <div class="col-lg-5">
            <div class="card shadow-sm mb-4 position-relative">
                <img src="../img/gallery-6.jpg" class="card-img-top" alt="Can Tho & Ho Chi Minh City">
                <!-- Plus icon at top-right -->
                <span class="position-absolute top-0 end-0 m-2" style="z-index:2;">
                    <i class="fa fa-plus-circle fa-2x text-primary" title="View more images" style="cursor:pointer;"
                        data-bs-toggle="modal" data-bs-target="#galleryModal"></i>
                </span>
                <div class="card-body">
                    <h5 class="card-title">Itinerary & Famous Destinations</h5>
                    <ul class="fa-ul mb-0">
                        <li><span class="fa-li"><i class="fa fa-check-circle text-success"></i></span><b>Day 1:</b> Ho
                            Chi Minh City arrival, city tour, transfer to Can Tho, night market</li>
                        <li><span class="fa-li"><i class="fa fa-check-circle text-success"></i></span><b>Day 2:</b> Cai
                            Rang Floating Market, Binh Thuy Ancient House, Ong Pagoda, return to Saigon</li>
                        <li><span class="fa-li"><i class="fa fa-check-circle text-success"></i></span><b>Day 3:</b> War
                            Remnants Museum, Reunification Palace, shopping, departure</li>
                    </ul>
                </div>
                <!-- Gallery of 5 famous places -->
                <div class="d-flex flex-row flex-nowrap overflow-auto p-2 pb-3" style="gap:10px;">
                    <img src="../img/gallery-6.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Cai Rang Market">
                    <img src="../img/gallery-7.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Ben Thanh Market">
                    <img src="../img/gallery-8.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Notre-Dame Cathedral">
                    <img src="../img/gallery-9.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Binh Thuy House">
                    <img src="../img/gallery-10.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Saigon Night">
                </div>
                <!-- Modal Gallery -->
                <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content bg-transparent border-0">
                            <div class="modal-body p-0 position-relative">
                                <button type="button"
                                    class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel"
                                    data-bs-interval="false">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="../img/gallery-6.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Cai Rang Market">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../img/gallery-7.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Ben Thanh Market">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../img/gallery-8.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Notre-Dame Cathedral">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../img/gallery-9.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Binh Thuy House">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../img/gallery-10.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Saigon Night">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#galleryCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#galleryCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-info"><i class="fa fa-info-circle me-2"></i>Contact us for private tours or custom
                itineraries!</div>
        </div>
    </div>
</div>
<?php include '../footer.php'; ?>