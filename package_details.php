<?php
include("./components/header.php");
if (!isset($_SESSION['username'])):
  // Display the login modal
  include("./components/error.php");

else:
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$package = $crud->getById('packages',$id);

$images = json_decode($package['image_path'], true); // Decode as an associative array
$firstImage = $images[0];
$imageHtml = '';

?>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.all.min.js"></script>

<section class="py-5">
  <div class="container">
    <div class="row gx-5">
      <aside class="col-lg-6">
        <div class="border rounded-4 mb-3 d-flex justify-content-center">
          <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big.webp">
            <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="<?php echo str_replace('../','./',$firstImage); ?>" />
          </a>
        </div>
        <div class="d-flex  mb-3">
       <?php foreach ($images as $image):
            if ($image!=$firstImage) {
                ?>

            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image">
                        <img width="60" height="60" class="rounded-2" src="<?php echo str_replace('../','./',$image); ?>" />
                    </a>
            <?php 
            }
            endforeach;

            ?>
        </div>
        <!-- thumbs-wrap.// -->
        <!-- gallery-wrap .end// -->
      </aside>
      <main class="col-lg-6">
        <div class="ps-lg-3">
          <h4 class="title text-dark">
           <?php echo $package['title']; ?>
          </h4>
          <div class="d-flex flex-row my-3">
          <?php
          // Assuming $package contains the details fetched from the 'packages' table including the package ID
$packageId = $package['id']; // Assuming 'id' is the column name for the package ID

// Fetch ratings for the specific package ID
$ratings = $crud->getByCondition('ratings', 'package_id', $packageId);

$totalRatings = count($ratings); // Total number of ratings for the package
$sumRatings = 0;

// Calculate the sum of ratings
foreach ($ratings as $rating) {
    $sumRatings += $rating['rating']; // Assuming 'rating' is the column name for the rating value
}

$averageRating = ($totalRatings > 0) ? round($sumRatings / $totalRatings, 1) : 0; // Calculate average rating

// Display stars and average rating
echo '<div class="text-warning mb-1 me-2">';
for ($i = 1; $i <= 5; $i++) {
    if ($i <= $averageRating) {
        if ($i == floor($averageRating) && $averageRating - floor($averageRating) > 0.5) {
            // Display half star
            echo '<i class="fas fa-star-half-alt"></i>';
        } else {
            // Display full star
            echo '<i class="fa fa-star"></i>';
        }
    } else {
        // Display empty star
        echo '<i class="far fa-star"></i>';
    }
}
echo '<span class="ms-1">' . $averageRating . '</span>';
echo '</div>';

          
          ?>
          </div>

          <div class="mb-3">
            <span class="h5">$<?php echo $package['price']; ?></span>
            <span class="text-muted">/per package</span>
          </div>

          <p>
          <?php echo $package['description']; ?>
          </p>

          <div class="row">
            <dt class="col-3">Type:</dt>
            <dd class="col-9 text-capitalize"><?php echo $package['type']; ?></dd>

            <dt class="col-3">Flights</dt>
            <dd class="col-9"><?php echo $package['flights']; ?> Flights Included</dd>

            <dt class="col-3">Bus</dt>
            <dd class="col-9"><?php echo $package['bus'];?> Bus Tour Package </dd>

            <dt class="col-3">Hotels</dt>
            <dd class="col-9"><?php echo $package['hotel']; ?> Hotels Included</dd>
          </div>

          <hr />
          <?php
                if (isset($_POST['confirm'])) {
                    $data = ['user_id' => $_SESSION['id'], 'package_id' => $package['id'],];
                    $result = $crud->create('package_bookings', $data);
                    if ($result) {
                        // Show SweetAlert confirmation message
                        echo '<script>
                                Swal.fire({
                                  title: "Are you sure?",
                                  text: "You want to buy this package?",
                                  icon: "question",
                                  showCancelButton: true,
                                  confirmButtonColor: "#3085d6",
                                  cancelButtonColor: "#d33",
                                  confirmButtonText: "Yes, buy it!",
                                  cancelButtonText: "Cancel"
                                }).then((result) => {
                                  if (result.isConfirmed) {
                                   
                                    Swal.fire("Success!", "Package bought successfully.", "success");
                                  }
                                });
                            </script>';
                    }
                }
            ?>
        
        <form method="post" action="">
  
          <input type="hidden" name="confirm">
          <button type="submit" class="btn custom-bg text-white">Buy Package</button>
      </form>
        </div> 
      </main>
    </div>
  </div>
</section>
<!-- content -->

<section class="bg-light border-top py-4">
  <div class="container">
    <div class="row gx-4">
      <div class="col-lg-8 mb-4">
        <div class="border rounded-2 px-3 py-2 ">
        <h4 class="mb-3">Specification:</h4>

          <!-- Pills content -->
          <div class="tab-content" id="ex1-content">
            <div class="tab-pane fade show active">
              <p>
             <?php echo $package['description']; ?>
              </p>
              <div class="row mb-2">
                <div class="col-12 col-md-6">
                  <ul class="list-unstyled mb-0">
                    <li><i class="fas fa-check text-success me-2"></i>Some great feature name here</li>
                    <li><i class="fas fa-check text-success me-2"></i>Lorem ipsum dolor sit amet, consectetur</li>
                    <li><i class="fas fa-check text-success me-2"></i>Duis aute irure dolor in reprehenderit</li>
                    <li><i class="fas fa-check text-success me-2"></i>Optical heart sensor</li>
                  </ul>
                </div>
              </div>
           
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="px-0 border rounded-2 shadow-0">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Exclusive Packages</h5>
              <?php 
              
              $packages=$crud->getAll('packages');

              $i = 1;
              foreach($packages as $package):
                $images = json_decode($package['image_path'], true); // Decode as an associative array
                ++$i;
                if ($i>4) {
                 
                  continue;
                }
              
              ?>
              <div class="d-flex flex-column align-items-center justify-content-center mb-3">
                <a href="package_details.php?id=<?php echo $package['id']; ?>" class="me-3">
                  <img src="<?php echo str_replace('../','./',$images[0]); ?>" style="min-width: 96px; height: 96px;" class="img-md img-thumbnail" />
                </a>
                <div class="info d-flex flex-column justify-content-center align-items-center">
                  <a href="package_details.php?id=<?php echo $package['id']; ?>" class="nav-link mb-1">
                    <?php echo $package['title']; ?>
                  </a>
                  <strong class="text-dark"> $<?php echo $package['price']; ?></strong>
                </div>
              </div>
              <?php endforeach; ?>
 
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- footer -->



<?php
endif;
include("./components/footer.php");
?>
