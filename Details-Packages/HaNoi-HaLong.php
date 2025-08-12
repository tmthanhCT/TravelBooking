<?php
include '../header.php';
?>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-7">
            <h2 class="mb-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>Hà Nội - Hạ Long Tour (3-5 Days)</h2>
            <p class="lead">Discover the beauty of Northern Vietnam with our 3 to 5-day tour from Hà Nội to Hạ Long Bay.
                Enjoy breathtaking landscapes, world heritage sites, and unique local experiences.</p>
            <ul class="list-group mb-4">
                <li class="list-group-item"><i class="fa fa-calendar-alt text-primary me-2"></i><b>Duration:</b> 3-5
                    days</li>
                <li class="list-group-item"><i class="fa fa-users text-primary me-2"></i><b>Group Size:</b> 2-20 people
                </li>
                <li class="list-group-item"><i class="fa fa-map text-primary me-2"></i><b>Departure:</b> Hà Nội</li>
                <li class="list-group-item"><i class="fa fa-ship text-primary me-2"></i><b>Destination:</b> Hạ Long Bay
                </li>
                <li class="list-group-item"><i class="fa fa-dollar-sign text-primary me-2"></i><b>Price:</b> From
                    $199/person</li>
            </ul>
            <h4 class="mb-3"><i class="fa fa-info-circle text-success me-2"></i>Tour Highlights</h4>
            <ul>
                <li>Explore the Old Quarter of Hà Nội</li>
                <li>Visit Hoan Kiem Lake and Ngoc Son Temple</li>
                <li>Overnight cruise on Hạ Long Bay</li>
                <li>Kayaking and swimming in emerald waters</li>
                <li>Seafood feast on board</li>
                <li>Visit Sung Sot Cave and Titop Island</li>
                <li>Optional: Extend to 5 days with Ninh Binh or Cat Ba Island</li>
            </ul>
            <a href="../booking.php" class="btn btn-primary mt-4"><i class="fa fa-calendar-check me-2"></i>Book Now</a>
        </div>
        <div class="col-lg-5">
            <div class="card shadow-sm mb-4 position-relative">
                <img src="../img/destination-1.jpg" class="card-img-top" alt="Hà Nội - Hạ Long Bay">
                <!-- Plus icon at top-right -->
                <span class="position-absolute top-0 end-0 m-2" style="z-index:2;">
                    <i class="fa fa-plus-circle fa-2x text-primary" title="View more images" style="cursor:pointer;"
                        data-bs-toggle="modal" data-bs-target="#galleryModal"></i>
                </span>
                <div class="card-body">
                    <h5 class="card-title">Itinerary & Famous Destinations</h5>
                    <ul class="fa-ul mb-0">
                        <li><span class="fa-li"><i class="fa fa-check-circle text-success"></i></span><b>Day 1:</b> Hà
                            Nội city tour, street food, water puppet show</li>
                        <li><span class="fa-li"><i class="fa fa-check-circle text-success"></i></span><b>Day 2:</b>
                            Transfer to Hạ Long, board cruise, visit caves & islets</li>
                        <li><span class="fa-li"><i class="fa fa-check-circle text-success"></i></span><b>Day 3:</b>
                            Morning Tai Chi, kayaking, return to Hà Nội</li>
                        <li><span class="fa-li"><i class="fa fa-check-circle text-success"></i></span><b>Day 4-5
                                (Optional):</b> Ninh Binh or Cat Ba Island extension</li>
                    </ul>
                </div>
                <!-- Gallery of 5 famous places -->
                <div class="d-flex flex-row flex-nowrap overflow-auto p-2 pb-3" style="gap:10px;">
                    <img src="../img/gallery-1.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Hà Nội">
                    <img src="../img/gallery-2.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Hạ Long Bay">
                    <img src="../img/gallery-3.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Sung Sot Cave">
                    <img src="../img/gallery-4.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Titop Island">
                    <img src="../img/gallery-5.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Ninh Binh">
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
                                            <img src="../img/gallery-1.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Hà Nội">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../img/gallery-2.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Hạ Long Bay">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../img/gallery-3.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Sung Sot Cave">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../img/gallery-4.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Titop Island">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../img/gallery-5.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Ninh Binh">
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
        </div>
        <div class="alert alert-info"><i class="fa fa-info-circle me-2"></i>Contact us for private tours or custom
            itineraries!</div>
    </div>
</div>
</div>
<?php include '../footer.php'; ?>