<?php
include("./components/header.php");

if ($_GET['id']) {
  $id = $_GET['id'];
}

$room = $crud->getById('rooms', $id);
$username = '';
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
}
$booking = $crud->getOneByCondition('bookings', 'user_name', $username);
?>
<!-- details -->
<div class="container">
  <div class="row">

    <div class="col-12 my-5 mb-4 px-4">
      <h2 class="fw-bold">
        <?php echo $room['name']; ?>
      </h2>
      <div style="font-size: 14px;">
        <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
        <span class="text-secondary"> > </span>
        <a href="rooms.php" class="text-secondary text-decoration-none">ROOMS</a>
      </div>
    </div>

    <div class="col-lg-7 col-md-12 px-4">
      <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class='carousel-item active'>
          <div class="carousel-image">
          <img src="<?php echo str_replace('../', './', $room['image']); ?>" class="img-fluid">
          </div>
          </div>
          <div class='carousel-item'>
          <div class="carousel-image">
          <img src="./images/rooms/IMG_11892.png" class="card-img-top">
          </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

    </div>

    <div class="col-lg-5 col-md-12 px-4">
      <div class="card mb-4 border-0 shadow-sm rounded-3">
        <div class="card-body">
          <h3> $
            <?php echo $room['price']; ?> per night
          </h3>
          <div class="mb-3">
            <h6 class="mb-1">Features</h6>
            <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
              <?php echo $room['features']; ?>
            </span>
            <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
              balcony
            </span>
            <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
              kitchen
            </span>
          </div>

          <div class="mb-3">
            <h6 class="mb-1">Facilities</h6>
            <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
              <?php echo $room['facilities']; ?>
            </span>
            <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
              WIFI
            </span>
            <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
              Room Heater
            </span>
          </div>

          <div class="mb-3">
            <h6 class="mb-1">Guests</h6>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              <?php echo $room['adult']; ?> Adults
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              <?php echo $room['children']; ?> Children
            </span>
          </div>

          <div class="mb-3">
            <h6 class="mb-1">Area</h6>
            <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
              <?php echo $room['area']; ?> sq.ft
            </span>
          </div>

          <?php

          if (isset($_SESSION['username']) && isset($booking['user_name']) && $_SESSION['username'] == $booking['user_name']) {
            // Check if the booking is confirmed
            if (isset($booking['isConfirmed']) && $booking['isConfirmed'] == 1) {
              // Display a button for a confirmed booking
              echo '<a href="£" class="btn btn-success">Booked</a>';

            } else {
              echo '<a href="£" class="btn btn-danger">Pending</a>';
            }
          } else {
            // Display a button to book now
            echo '<a href="confirm_booking.php?id=' . $room['id'] . '" class="btn custom-bg text-white">Book Now</a>';

          }

          ?>







        </div>
      </div>
    </div>

    <div class="col-12 mt-4 px-4">
      <div class="mb-5">
        <h5>Description</h5>
        <p>
          <?php echo $room['description']; ?>
        </p>
      </div>

      <div>
        <h5 class="mb-3">Reviews & Ratings</h5>
        <div class="mb-4">
          <div class="d-flex align-items-center mb-2">
            <img src="./images/about/IMG_17352.jpg" class="rounded-circle" loading="lazy" width="30px">
            <h6 class="m-0 ms-2">kalyan</h6>
          </div>
          <p class="mb-1">
            very good
          </p>
          <div>
            <i class='bi bi-star-fill text-warning mx-2'></i>
            <i class='bi bi-star-fill text-warning mx-2'></i>
            <i class='bi bi-star-fill text-warning mx-2'></i>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>

<?php
include("./components/footer.php");
?>