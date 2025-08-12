<?php include '../header.php'; ?>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-7">
            <h2 class="mb-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>Đà Lạt & Sapa Tour (4 Days)</h2>
            <p class="lead">Enjoy the cool climate, stunning landscapes, and unique culture of Đà Lạt and Sapa in this
                4-day adventure. Perfect for nature lovers and explorers!</p>
            <ul class="list-group mb-4">
                <li class="list-group-item"><i class="fa fa-calendar-alt text-primary me-2"></i><b>Duration:</b> 4 days
                </li>
                <li class="list-group-item"><i class="fa fa-users text-primary me-2"></i><b>Group Size:</b> 2-15 people
                </li>
                <li class="list-group-item"><i class="fa fa-map text-primary me-2"></i><b>Departure:</b> Đà Lạt or Sapa
                </li>
                <li class="list-group-item"><i class="fa fa-ship text-primary me-2"></i><b>Destination:</b> Đà Lạt, Sapa
                </li>
                <li class="list-group-item"><i class="fa fa-dollar-sign text-primary me-2"></i><b>Price:</b> From
                    $249/person</li>
            </ul>
            <h4 class="mb-3"><i class="fa fa-info-circle text-success me-2"></i>Tour Highlights</h4>
            <ul>
                <li>Visit Valley of Love, Xuan Huong Lake, and Da Lat Flower Park</li>
                <li>Explore Fansipan Mountain ("Roof of Indochina") by cable car</li>
                <li>Discover Sapa's ethnic villages: Cat Cat, Ta Van, Lao Chai</li>
                <li>Enjoy local cuisine and night markets</li>
                <li>Professional local guides</li>
            </ul>
            <a href="../booking.php" class="btn btn-primary mt-4"><i class="fa fa-calendar-check me-2"></i>Book Now</a>
        </div>
        <div class="col-lg-5">
            <div class="card shadow-sm mb-4 position-relative">
                <img src="../img/gallery-11.jpg" class="card-img-top" alt="Đà Lạt & Sapa">
                <!-- Plus icon at top-right -->
                <span class="position-absolute top-0 end-0 m-2" style="z-index:2;">
                    <i class="fa fa-plus-circle fa-2x text-primary" title="View more images" style="cursor:pointer;"
                        data-bs-toggle="modal" data-bs-target="#galleryModal"></i>
                </span>
                <div class="card-body">
                    <h5 class="card-title">Itinerary & Famous Destinations</h5>
                    <ul class="fa-ul mb-0">
                        <li><span class="fa-li"><i class="fa fa-check-circle text-success"></i></span><b>Day 1:</b> Đà
                            Lạt city tour: Valley of Love, Xuan Huong Lake, night market</li>
                        <li><span class="fa-li"><i class="fa fa-check-circle text-success"></i></span><b>Day 2:</b> Da
                            Lat Flower Park, Datanla Waterfall, transfer to Sapa</li>
                        <li><span class="fa-li"><i class="fa fa-check-circle text-success"></i></span><b>Day 3:</b>
                            Fansipan Mountain by cable car, Cat Cat Village</li>
                        <li><span class="fa-li"><i class="fa fa-check-circle text-success"></i></span><b>Day 4:</b> Lao
                            Chai & Ta Van villages, local market, departure</li>
                    </ul>
                </div>
                <!-- Gallery of 5 famous places -->
                <div class="d-flex flex-row flex-nowrap overflow-auto p-2 pb-3" style="gap:10px;">
                    <img src="../img/gallery-11.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Valley of Love">
                    <img src="../img/gallery-12.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Fansipan Mountain">
                    <img src="../img/gallery-3.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Cat Cat Village">
                    <img src="../img/gallery-4.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Datanla Waterfall">
                    <img src="../img/gallery-5.jpg" class="rounded shadow-sm"
                        style="width:90px;height:70px;object-fit:cover;" alt="Sapa Night">
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
                                            <img src="../img/gallery-11.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Valley of Love">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../img/gallery-12.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Fansipan Mountain">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../img/gallery-3.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Cat Cat Village">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../img/gallery-4.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Datanla Waterfall">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../img/gallery-5.jpg" class="d-block w-100 rounded"
                                                style="max-height:70vh;object-fit:contain;background:#222;"
                                                alt="Sapa Night">
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