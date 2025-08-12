<?php include '../header.php'; ?>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-7">
            <h2 class="mb-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>Đà Nẵng & Hội An Tour (5 Days)</h2>
            <p class="lead">Experience the best of Central Vietnam with our 5-day Đà Nẵng - Hội An tour. Enjoy beautiful
                beaches, ancient towns, and unique cuisine!</p>
            <ul class="list-group mb-4">
                <li class="list-group-item"><i class="fa fa-calendar-alt text-primary me-2"></i><b>Duration:</b> 5 days
                </li>
                <li class="list-group-item"><i class="fa fa-users text-primary me-2"></i><b>Group Size:</b> 2-20 people
                </li>
                <li class="list-group-item"><i class="fa fa-map text-primary me-2"></i><b>Departure:</b> Đà Nẵng</li>
                <li class="list-group-item"><i class="fa fa-ship text-primary me-2"></i><b>Destination:</b> Đà Nẵng, Hội
                    An</li>
                <li class="list-group-item"><i class="fa fa-dollar-sign text-primary me-2"></i><b>Price:</b> From
                    $299/person</li>
            </ul>
            <h4 class="mb-3"><i class="fa fa-info-circle text-success me-2"></i>Tour Highlights</h4>
            <ul>
                <li>Relax at My Khe Beach and visit Dragon Bridge</li>
                <li>Full-day at Ba Na Hills and Golden Bridge</li>
                <li>Explore Marble Mountains and Hội An Ancient Town</li>
                <li>Join a Vietnamese cooking class and lantern-making workshop</li>
                <li>Stay in 4-star hotels in both cities</li>
            </ul>
            <a href="../booking.php" class="btn btn-primary mt-4"><i class="fa fa-calendar-check me-2"></i>Book Now</a>
        </div>
        <div class="col-lg-5">
            <div class="card shadow-sm mb-4 position-relative">
                <img src="../img/destination-8.jpg" class="card-img-top" alt="Đà Nẵng & Hội An">
                <!-- Plus icon at top-right -->
                <span class="position-absolute top-0 end-0 m-2" style="z-index:2;">
                    <i class="fa fa-plus-circle fa-2x text-primary" title="View more images" style="cursor:pointer;"
                        data-bs-toggle="modal" data-bs-target="#galleryModal"></i>
                </span>
                <div class="card-body">
                    <h5 class="card-title">Itinerary & Famous Destinations</h5>
                    <ul class="fa-ul mb-0">
                        <li><span class="fa-li"><i class="fa fa-check-circle text-success"></i></span><b>Day 1:</b>
                            Arrive in Đà Nẵng, relax at My Khe Beach, visit Dragon Bridge</li>
                        <li><span class="fa-li"><i class="fa fa-check-circle text-success"></i></span><b>Day 2:</b> Ba
                            Na Hills, Golden Bridge, French Village, buffet lunch</li>
                        <li><span class="fa-li"><i class="fa fa-check-circle text-success"></i></span><b>Day 3:</b>
                            Marble Mountains, transfer to Hội An, ancient town walking tour</li>
                        <li><span class="fa-li"><i class="fa fa-check-circle text-success"></i></span><b>Day 4:</b> Hội
                            An countryside, cooking class, lantern-making workshop</li>
                        <li><span class="fa-li"><i class="fa fa-check-circle text-success"></i></span><b>Day 5:</b> Free
                            time, shopping, departure</li>
                    </ul>
                </div>
                <!-- Gallery of 5 famous places -->
                <div class="d-flex flex-row flex-nowrap overflow-auto p-2 pb-3" style="gap:10px;">
                    <img src="../img/destination-8.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="My Khe Beach">
                    <img src="../img/destination-1.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Golden Bridge">
                    <img src="../img/destination-2.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Ba Na Hills">
                    <img src="../img/destination-3.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Marble Mountains">
                    <img src="../img/destination-4.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Hội An Ancient Town">
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
                                            <img src="../img/destination-8.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="My Khe Beach">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../img/destination-1.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Golden Bridge">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../img/destination-2.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Ba Na Hills">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../img/destination-3.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Marble Mountains">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../img/destination-4.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Hội An Ancient Town">
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