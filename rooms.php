<?php
include("./components/header.php");
?>

<style>
  @media screen and (max-width:1000px) {
    .no-small {
      display: none !important;
    }
  }
</style>

<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">OUR ROOMS</h2>
  <div class="h-line bg-dark"></div>
</div>

<div class="container-fluid">
  <div class="row">

    <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 ps-4">
      <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
        <div class="container-fluid flex-lg-column align-items-stretch">
          <h4 class="mt-2">FILTERS</h4>
          <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
            <!-- Check availablity -->
            <div class="border bg-light p-3 rounded mb-3">
              <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size: 18px;">
                <span>CHECK AVAILABILITY</span>
                <button id="chk_avail_btn" class="btn shadow-none btn-sm text-secondary d-none">Reset</button>
              </h5>
              <label class="form-label">Check-in</label>
              <input type="date" class="form-control shadow-none mb-3" value="" id="checkin">
              <label class="form-label">Check-out</label>
              <input type="date" class="form-control shadow-none" value="" id="checkout">
            </div>

            <!-- Facilities -->
            <div class="border bg-light p-3 rounded mb-3">
              <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size: 18px;">
                <span>FACILITIES</span>
                <button id="facilities_btn" class="btn shadow-none btn-sm text-secondary d-none">Reset</button>
              </h5>
              <div class="mb-2">
                <input type="checkbox" name="facilities" value="$row[id]" class="form-check-input shadow-none me-1"
                  id="$row[id]">
                <label class="form-check-label">FACILITIES</label>
              </div>
            </div>

            <!-- Guests -->
            <div class="border bg-light p-3 rounded mb-3">
              <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size: 18px;">
                <span>GUESTS</span>
                <button id="guests_btn" class="btn shadow-none btn-sm text-secondary d-none">Reset</button>
              </h5>
              <div class="d-flex">
                <div class="me-3">
                  <label class="form-label">Adults</label>
                  <input type="number" min="1" id="adults" value="" class="form-control shadow-none">
                </div>
                <div>
                  <label class="form-label">Children</label>
                  <input type="number" min="1" id="children" value="" class="form-control shadow-none">
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-6">
              <button class="btn custom-bg text-white w-100">Filter</button>
            </div>
          </div>
        </div>
      </nav>
    </div>

    <div class="col-lg-9 col-md-12 px-4" id="rooms-data">

      <div class="container">
        <?php
        $rooms = $crud->getAll('rooms');
        foreach ($rooms as $room):

          ?>
          <div class="rooms bg-white p-2 mb-3">
            <div class="row justify-content-between">
              <div class="col-lg-10 col-md-6 col-sm-12">
                <div class="d-flex">
                  <div class="package-image">
                    <img src="<?php echo str_replace('../', './', $room['image']); ?>" class="card-img-top">
                  </div>
                  <div class="d-flex flex-column ps-lg-5 no-small">
                    <h5>
                      <?php echo $room['name']; ?>
                    </h5>
                    <div class="features mb-4">
                      <h6 class="mb-1">Features</h6>
                      <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                        <?php echo $room['features']; ?>
                      </span>
                      <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                        bedroom
                      </span>
                    </div>
                    <div class="features mb-4">
                      <h6 class="mb-1">Facilities</h6>
                      <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                        <?php echo $room['facilities']; ?>
                      </span>
                      <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                        bedroom
                      </span>
                    </div>
                    <div class='rating mb-4'>
                      <h6 class='mb-1'>Rating</h6>
                      <span class='badge rounded-pill bg-light'>
                        <i class='bi bi-star-fill text-warning mx-2'></i>
                        <i class='bi bi-star-fill text-warning mx-2'></i>
                        <i class='bi bi-star-fill text-warning mx-2'></i>
                        <i class='bi bi-star-fill text-warning mx-2'></i>

                      </span>
                    </div>

                  </div>
                </div>

              </div>
              <div class="col-lg-2 col-sm-12 col-md-6 d-flex flex-column justify-content-center align-items-center">
                <h4 class="text-muted">
                  <?php echo $room['price']; ?>
                </h4>
                <a href="view_details.php?id=<?php echo $room['id']; ?>"
                  class="btn btn-sm custom-bg shadow-none text-white px-4 w-100 mb-3">Book Now</a>
                <a href="view_details.php?id=<?php echo $room['id']; ?>"
                  class="btn btn-sm btn-outline-dark shadow-none px-4 w-100">More Details</a>

              </div>
            </div>


          </div>
        <?php endforeach; ?>


      </div>
    </div>

  </div>
</div>
<!-- footer -->
<?php
include("./components/footer.php");
?>