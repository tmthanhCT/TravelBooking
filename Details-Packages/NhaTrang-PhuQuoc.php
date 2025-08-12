<?php include '../header.php'; ?>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-7">
            <h2 class="mb-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>Nha Trang & Phu Quoc Tour (4 Days)
            </h2>
            <p class="lead">Enjoy the best of Vietnam's beaches and islands with this 4-day Nha Trang - Phu Quoc tour.
                Relax, explore, and indulge in local seafood and culture!</p>
            <ul class="list-group mb-4">
                <li class="list-group-item"><i class="fa fa-calendar-alt text-primary me-2"></i><b>Duration:</b> 4 days
                </li>
                <li class="list-group-item"><i class="fa fa-users text-primary me-2"></i><b>Group Size:</b> 2-20 people
                </li>
                <li class="list-group-item"><i class="fa fa-map text-primary me-2"></i><b>Departure:</b> Nha Trang</li>
                <li class="list-group-item"><i class="fa fa-ship text-primary me-2"></i><b>Destination:</b> Nha Trang,
                    Phu Quoc</li>
                <li class="list-group-item"><i class="fa fa-dollar-sign text-primary me-2"></i><b>Price:</b> From
                    $259/person</li>
            </ul>
            <h4 class="mb-3"><i class="fa fa-info-circle text-success me-2"></i>Tour Highlights</h4>
            <ul>
                <li>Relax on the white sand beaches of Nha Trang and Phu Quoc</li>
                <li>Snorkeling and island-hopping boat tour</li>
                <li>Visit VinWonders, Hon Mun, Hon Tam, and Dinh Cau Night Market</li>
                <li>Enjoy fresh seafood and local specialties</li>
                <li>Stay in 4-star beachfront hotels</li>
            </ul>
            <a href="../booking.php" class="btn btn-primary mt-4"><i class="fa fa-calendar-check me-2"></i>Book Now</a>
        </div>
        <div class="col-lg-5">
            <div class="card shadow-sm mb-4 position-relative">
                <img src="../img/destination-2.jpg" class="card-img-top" alt="Nha Trang & Phu Quoc">
                <!-- Plus icon at top-right -->
                <span class="position-absolute top-0 end-0 m-2" style="z-index:2;">
                    <i class="fa fa-plus-circle fa-2x text-primary" title="View more images" style="cursor:pointer;"
                        data-bs-toggle="modal" data-bs-target="#galleryModal"></i>
                </span>
                <div class="card-body">
                    <h5 class="card-title">Itinerary & Famous Destinations</h5>
                    <ul class="fa-ul mb-0">
                        <li><span class="fa-li"><i class="fa fa-check-circle text-success"></i></span><b>Day 1:</b>
                            Arrive in Nha Trang, check-in, relax at Tran Phu Beach, seafood dinner</li>
                        <li><span class="fa-li"><i class="fa fa-check-circle text-success"></i></span><b>Day 2:</b>
                            Island-hopping tour: Hon Mun, Hon Tam, snorkeling, VinWonders</li>
                        <li><span class="fa-li"><i class="fa fa-check-circle text-success"></i></span><b>Day 3:</b> Fly
                            to Phu Quoc, visit Dinh Cau Night Market, enjoy sunset beach</li>
                        <li><span class="fa-li"><i class="fa fa-check-circle text-success"></i></span><b>Day 4:</b>
                            Explore Sao Beach, Ham Ninh fishing village, local market, departure</li>
                    </ul>
                </div>
                <!-- Gallery of 5 famous places -->
                <div class="d-flex flex-row flex-nowrap overflow-auto p-2 pb-3" style="gap:10px;">
                    <img src="../img/destination-2.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Nha Trang Beach">
                    <img src="../img/destination-3.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Hon Mun Island">
                    <img src="../img/destination-4.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="VinWonders Nha Trang">
                    <img src="../img/destination-5.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Phu Quoc Beach">
                    <img src="../img/destination-6.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Dinh Cau Night Market">
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
                                            <img src="../img/destination-2.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Nha Trang Beach">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../img/destination-3.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Hon Mun Island">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../img/destination-4.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="VinWonders Nha Trang">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../img/destination-5.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Phu Quoc Beach">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../img/destination-6.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Dinh Cau Night Market">
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