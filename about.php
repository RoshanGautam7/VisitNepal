<?php

include("./components/header.php");
require_once('./admin/database/crud.php');

$crud = new CRUD();

?>

<style>
  .box {
    border-top-color: var(--teal) !important;
  }

  .image-container {
    width: 24.7rem;
    height: 24.7rem;
    position: relative;
  }

  .image-container img {
    position: absolute;
    top: 0;
    left: 0;
    object-fit: cover;
    width: 100%;
    height: 100%;
  }
</style>

<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">ABOUT US</h2>
  <div class="h-line bg-dark"></div>
  <p class="text-center mt-3">

    Welcome to "Visit Nepal" - Your Passport to Himalayan Adventure!

    At Visit Nepal, we're your digital guide to the wonders of the Himalayas.
    Nestled between India and China, Nepal beckons with its awe-inspiring landscapes,
    vibrant cultures, and warm hospitality. Our mission is to transform your
    travel dreams into reality by providing a seamless and personalized
    journey through this Himalayan jewel.


  </p>
</div>

<div class="container">
  <div class="row justify-content-between align-items-center">
    <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
      <h3 class="mb-3">Lorem ipsum dolor sit</h3>
      <p>
        Why choose Visit Nepal? We're not just a webapp; we're your travel companion, offering
        a treasure trove of information on everything from the majestic peaks of the
        Annapurna and Everest to the hidden gems of Kathmandu
        and beyond. Whether you're an intrepid trekker, a cultural connoisseur,
        or someone seeking serenity in the lap of
        nature, Visit Nepal is your key to unlocking the magic of this incredible destination.
      </p>
    </div>
    <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
      <img src="images/about/about.jpg" class="w-100">
    </div>
  </div>
</div>

<div class="container mt-5">
  <div class="row">
    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
        <img src="images/about/hotel.svg" width="70px">
        <h4 class="mt-3">100+ ROOMS</h4>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
        <img src="images/about/customers.svg" width="70px">
        <h4 class="mt-3">200+ CUSTOMERS</h4>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
        <img src="images/about/rating.svg" width="70px">
        <h4 class="mt-3">150+ REVIEWS</h4>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
        <img src="images/about/staff.svg" width="70px">
        <h4 class="mt-3">200+ STAFFS</h4>
      </div>
    </div>
  </div>
</div>

<h3 class="my-5 fw-bold h-font text-center">MANAGEMENT TEAM</h3>

<div class="container px-4">
  <div class="swiper mySwiper">
    <div class="swiper-wrapper mb-5">
      <?php
      $managements = $crud->getAll('management');

      foreach ($managements as $management):
        ?>
        <div class="swiper-slide bg-white text-center rounded">
          <div class="image-container overflow-hidden">
            <img src="<?php echo str_replace('../', './', $management['image']); ?>" style="width:100%; height:auto;">
          </div>
          <h5 class="mt-2">
            <?php echo $management['name']; ?>
          </h5>
        </div>

      <?php endforeach; ?>
    </div>
    <div class="swiper-pagination"></div>
  </div>
</div>

<?php
include("./components/footer.php");
?>
<script>
  var swiper = new Swiper(".mySwiper", {
    spaceBetween: 40,
    pagination: {
      el: ".swiper-pagination",
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
      },
      640: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 3,
      },
      1024: {
        slidesPerView: 3,
      },
    }
  });
</script>