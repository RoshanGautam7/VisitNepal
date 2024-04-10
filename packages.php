<?php
include("./components/header.php");
?>

<style>
  .pop:hover {
    border-top-color: var(--teal) !important;
    transform: scale(1.03);
    transition: all 0.3s;
  }
</style>

<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">OUR PACKAGES</h2>
  <div class="h-line bg-dark"></div>
  <p class="text-center mt-3">
    Embark on an unforgettable journey through the enchanting landscapes and vibrant
    cultures of Nepal with our carefully crafted tour packages. At "Visit Nepal Tours,"
    we curate experiences that cater to every traveler's passion, whether it's trekking in the Himalayas,
    exploring ancient heritage sites, or immersing yourself in the local way of life.
  </p>
</div>

<div class="container">
  <div class="row">
    <?php
    $packages = $crud->getAll('packages');
    foreach ($packages as $package):
      $image = json_decode($package['image_path'], true);
      $image = $image[0];
      ?>
      <div class="col-lg-4 col-md-6 mb-5 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop"
          style="max-height:600px; overflow:hidden;">
          <div class="d-flex flex-column overflow-hidden align-items-center mb-2">
            <div class="package-image">
              <img src="<?php echo str_replace('../', './', $image); ?>" class="card-img-top" alt="" />
            </div>
            <h5 class="m-0 ms-3 mt-3">
              <?php echo $package['title']; ?>
            </h5>
          </div>
          <div class="d-flex justify-content-between px-3 mt-3">
            <div class="service d-flex flex-column justify-content-center align-items-center">
              <i class="fa-solid fa-plane-departure"></i>
              <p>
                <?php echo $package['flights']; ?> Flights
              </p>
            </div>
            <div class="service d-flex flex-column justify-content-center align-items-center">
              <i class="fa-solid fa-bus"></i>
              <p>
                <?php echo $package['bus']; ?> bus
              </p>
            </div>
            <div class="service d-flex flex-column justify-content-center align-items-center">
              <i class="fa-solid fa-hotel"></i>
              <p>
                <?php echo $package['hotel']; ?> hotels
              </p>
            </div>
          </div>
          <p class="ps-3" style="max-height:100px; overflow:hidden;">
            <?php echo $package['description']; ?>
          </p>
          <div class="d-flex justify-content-center align-items-center">
            <a href="package_details.php?id=<?php echo $package['id']; ?>"
              class="btn btn-sm custom-bg shadow-none text-white px-4 w-75 mb-3">Book Now</a>

          </div>
        </div>
      </div>
    <?php endforeach; ?>


  </div>
</div>
</div>

<!-- footer -->
<?php
include("./components/footer.php");
?>