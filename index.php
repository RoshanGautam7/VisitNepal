<?php
include("./components/header.php");

?>



<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.all.min.js"></script>

<!-- Carosuel -->
<div class="container-fluid px-lg-4 mt-4">
  <div class="swiper swiper-container">
    <div class="swiper-wrapper">
      <?php
      $carousels = $crud->getAll('carousel');
      foreach ($carousels as $carousel): ?>
        <div class="swiper-slide">
          <div class="image-container">
            <img src="<?php echo str_replace('../', './', $carousel['image']); ?>" alt="" />
          </div>

        </div>
      <?php endforeach; ?>

    </div>
  </div>
</div>


<!-- AVAILABILITY FORM -->
<div class="container availability-form">
  <div class="row">
    <div class="col-lg-12 bg-white shadow p-4 rounded">
      <h5 class="mb-4">Check Booking Availability</h5>
      <form action="rooms.php">
        <div class="row align-items-end">
          <div class="col-lg-3 mb-3">
            <label class="form-label" style="font-weight: 500;">Check-in</label>
            <input type="date" class="form-control shadow-none" name="checkin" required>
          </div>
          <div class="col-lg-3 mb-3">
            <label class="form-label" style="font-weight: 500;">Check-out</label>
            <input type="date" class="form-control shadow-none" name="checkout" required>
          </div>
          <div class="col-lg-3 mb-3">
            <label class="form-label" style="font-weight: 500;">Adult</label>
            <select class="form-select shadow-none" name="adult">
              <?php
              for ($i = 1; $i <= 10; $i++) {
                echo "<option value=\"$i\">$i</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-lg-2 mb-3">
            <label class="form-label" style="font-weight: 500;">Children</label>
            <select class="form-select shadow-none" name="children">
              <?php
              for ($i = 1; $i <= 10; $i++) {
                echo "<option value=\"$i\">$i</option>";
              }
              ?>
            </select>
          </div>
          <input type="hidden" name="check_availability">
          <div class="col-lg-1 mb-lg-3 mt-2">
            <a href="" class="btn text-white shadow-none custom-bg">Submit</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- tour Packages -->

<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR TOUR PACKAGES</h2>

<div class="container">
  <div class="row">

    <?php
    $packages = $crud->getAll('packages');

    foreach ($packages as $package):
      $images = json_decode($package['image_path'], true); // Decode as an associative array
      $firstImage = $images[0];

      ?>

      <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
          <div class="package-image">
            <img src="<?php echo str_replace('../', './', $firstImage); ?>" class="card-img-top" alt="" />
          </div>
          <div class="card-body">
            <h5 class="text-center">
              <?php echo $package['title']; ?>
            </h5>
            <div class="d-flex justify-content-between px-5">
              <div class="service d-flex flex-column justify-content-center align-items-center">
                <i class="fa-solid fa-plane-departure"></i>
                <p>
                  <?php echo $package['flights']; ?> flights
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
            <div class="d-flex text-justify px-4 justify-content-center align-items-center">
              <p style="max-height:200px; overflow:hidden;">
                <?php echo $package['description']; ?>
              </p>
            </div>
            <div class="d-flex justify-content-evenly mb-2">
              <a href="package_details.php?id=<?php echo $package['id']; ?>"
                class="btn btn-sm btn-outline-dark shadow-none">More
                details</a>

            </div>

          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <div class="col-lg-12 text-center mt-5">
      <a href="packages.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Packages >>></a>
    </div>
  </div>
</div>
<!-- HOTEL ROOMS -->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR HOTELS</h2>

<div class="container">
  <div class="row">
    <?php
    $hotels = $crud->getAll('rooms');
    foreach ($hotels as $hotel):
      ?>
      <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
          <div class="package-image">
            <img src="<?php echo str_replace('../', './', $hotel['image']); ?>" class="card-img-top">
          </div>
          <div class="card-body">
            <h5>
              <?php echo $hotel['name']; ?>
            </h5>
            <h6 class="mb-4">$
              <?php echo $hotel['price']; ?> per night
            </h6>
            <div class="features mb-4">
              <h6 class="mb-1">Features</h6>
              <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                <?php echo $hotel['features']; ?>
              </span>
            </div>
            <div class="facilities mb-4">
              <h6 class="mb-1">Facilities</h6>
              <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                <?php echo $hotel['facilities']; ?>

              </span>
            </div>
            <div class="guests mb-4">
              <h6 class="mb-1">Guests</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                <?php echo $hotel['adult']; ?>
                adults
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                <?php echo $hotel['children']; ?>
                Children
              </span>
            </div>
            <div class='rating mb-4'>
              <h6 class='mb-1'>Rating</h6>
              <span class='badge rounded-pill bg-light'>
                <i class='bi bi-star-fill text-warning'></i>
                <i class='bi bi-star-fill text-warning'></i>
                <i class='bi bi-star-fill text-warning'></i>

              </span>
            </div>
            <div class="d-flex justify-content-evenly mb-2">
              <a href="view_details.php?id=<?php echo $hotel['id']; ?>"
                class="btn btn-sm btn-outline-dark shadow-none">More
                details</a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

    <div class="col-lg-12 text-center mt-5">
      <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms >>></a>
    </div>
  </div>
</div>
<!-- tour guides -->

<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">HIRE OUR GUIDES</h2>

<div class="container">
  <div class="row">
    <?php
    if (isset($_POST['hire_guide'])) {

      if (isset($_SESSION['username'])) {
        // User is logged in
        $client_name = $_SESSION['username'];
        $guide_name = $_POST['guide_name'];

        $data = [
          'client_name' => $client_name,
          'guide_name' => $guide_name,
        ];

        // Insert data into the guides table
        $result = $crud->create('guides', $data);

        if ($result) {
          header('Location:index.php');
        } else {
          echo "failed";
        }

      } else {
        // User is not logged in, open the login modal
        echo '<script>
                $(document).ready(function(){
                    $("#loginModal").modal("show");
                });
            </script>';
      }
    }
    ?>



    <?php
    $guides = $crud->getByCondition('users', 'role', 'guide');
    foreach ($guides as $guide): ?>
      <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
          <div class="card-img-container" style="width: 100%; height: 200px; overflow: hidden;">
            <img src="<?php echo $guide['image']; ?>" class="card-img-top"
              style="width: 100%; height: 100%; object-fit: cover; object-position: top;" alt="Guide Image">
          </div>
          <div class="card-body">
            <h5 class="text-center">
              <?php echo $guide['name']; ?>
            </h5>
            <div class="d-flex justify-content-evenly mb-2">

              <?php if (isset($_SESSION['username'])): ?>
                <!-- User is logged in, show SweetAlert confirmation -->
                <form class="hire-guide-form" method="post" action="index.php"
                  onsubmit="return confirmHire('<?php echo $guide['name']; ?>')">
                  <input type="hidden" name="guide_name" value="<?php echo $guide['name']; ?>">
                  <button type="button" name="hire_guide" class="btn btn-sm btn-outline-dark shadow-none"
                    onclick="confirmAndSubmit('<?php echo $guide['name']; ?>')">Hire Me</button>
                </form>
              <?php else: ?>
                <!-- User is not logged in, show login modal -->
                <button type="button" data-bs-toggle="modal" data-bs-target="#loginModal"
                  class="btn btn-sm btn-outline-dark shadow-none">Hire Me</button>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

    <script>
      function confirmAndSubmit(guideName) {
        confirmHire(guideName).then((confirmed) => {
          if (confirmed) {
            // If the user confirms, change the button type to "submit" and submit the form
            var button = document.querySelector('.hire-guide-form button[name="hire_guide"]');
            button.type = 'submit';
            var guide = document.querySelector('.hire-guide-form input[name="guide_name"]');
            guide.value = guideName;
            button.click();
            // Change the button type back to "button" after submission
            button.type = 'button';
          }
        });
      }

      function confirmHire(guideName) {
        return new Promise((resolve) => {
          Swal.fire({
            title: 'Are you sure?',
            text: `Do you want to hire ${guideName}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, hire!',
            cancelButtonText: 'No, cancel'
          }).then((result) => {
            if (result.isConfirmed) {
              resolve(true);
            } else {
              resolve(false);
            }
          });
        });
      }
    </script>

    <div class="col-lg-12 text-center mt-5">
      <button type="button" class="btn btn-outline-dark shadow-none w-25" data-bs-toggle="modal"
        data-bs-target="#guideModal">
        Wanna Be a Guide??
      </button>
    </div>
  </div>
</div>




<?php
if (isset($_POST['guide_submit'])) {

  $userData = array(
    'name' => $_POST['name'],
    'password' => password_hash($_POST['pass'], PASSWORD_DEFAULT), // Hash the password
    'role' => 'guide',
    'phone' => $_POST['phonenum'],
    'email' => $_POST['email'],
    'address' => $_POST['address'],
    'pincode' => $_POST['pincode'],
    'dob' => $_POST['dob'],
  );

  // Handle image upload
  $imagePath = handleImageUpload();

  // Check if image upload was successful
  if ($imagePath) {
    $userData['image'] = $imagePath;

    // Insert data into the 'users' table
    $result = $crud->create('users', $userData);

    if ($result) {
      echo "<script>alert('User created successfully'); location.reload();</script>";
    } else {
      echo "Error creating user";
    }
  } else {
    echo "Error uploading image";
  }
}
?>

<div class="modal fade" id="guideModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="index.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center">
            <i class="bi bi-person-lines-fill fs-3 me-2"></i> Guide Registration
          </h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Name</label>
                <input name="name" type="text" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control shadow-none" required>
                <input type="hidden" name="action" value="register">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Phone Number</label>
                <input name="phonenum" type="number" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Picture</label>
                <input name="profile" type="file" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none"
                  required>
              </div>
              <div class="col-md-12 mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Pincode</label>
                <input name="pincode" type="number" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Date of birth</label>
                <input name="dob" type="date" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Password</label>
                <input name="pass" type="password" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Confirm Password</label>
                <input name="cpass" type="password" class="form-control shadow-none" required>
              </div>
            </div>
          </div>
          <div class="text-center my-1">
            <button type="submit" name="guide_submit" class="btn btn-dark shadow-none">REGISTER</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- TESTIMONIALS -->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">TESTIMONIALS</h2>
<div class="container mt-5">
  <div class="swiper swiper-testimonials">
    <div class="swiper-wrapper mb-5">
      <?php
      $ratings = $crud->getAll('ratings');

      foreach ($ratings as $rating):
        $user = $crud->getById('users', $rating['user_id']);
        ?>
        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
            <img src="<?php echo $user['image']; ?>" alt="" width="30px">
            <h6 class="m-0 ms-2">
              <?php echo $user['name']; ?>
            </h6>
          </div>
          <p>
            <?php
            $review = $rating['review'];
            $words = explode(' ', $review);
            $limitedReview = implode(' ', array_slice($words, 0, 20));

            echo $limitedReview;
            ?>....
          </p>
          <div class="rating">
            <?php
            $ratingValue = $rating['rating'];

            for ($i = 1; $i <= 5; $i++) {
              if ($i <= $ratingValue) {
                echo '<i class="bi bi-star-fill text-warning"></i>';
              } else {
                echo '<i class="bi bi-star text-warning"></i>';
              }
            }
            ?>
          </div>

        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
</div>
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">REACH US</h2>

<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
      <iframe class="w-100 rounded" height="320px"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3530.63504262862!2d85.3430345120337!3d27.75940062309239!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1fdc51164935%3A0x374ea58de634ee6a!2sBudhanilkantha%20Ward%206%20Office%2C%20Khadka%20Bhadrakali!5e0!3m2!1sen!2snp!4v1700204669646!5m2!1sen!2snp"
        loading="lazy"></iframe>

    </div>
    <div class="col-lg-4 col-md-4">
      <div class="bg-white p-4 rounded mb-4">
        <h5>Call us</h5>
        <a href="tel:  +977 9865461461" class="d-inline-block mb-2 text-decoration-none text-dark">
          <i class="bi bi-telephone-fill"></i>
          +977 9865461461
        </a>
        <br>
        <a href="tel: +$contact_r[pn2]" class="d-inline-block text-decoration-none text-dark">
          <i class="bi bi-telephone-fill"></i> +977 9865461461
        </a>
      </div>
      <div class="bg-white p-4 rounded mb-4">
        <h5>Follow us</h5>
        <a href="" class="d-inline-block mb-3">
          <span class="badge bg-light text-dark fs-6 p-2">
            <i class="bi bi-twitter me-1"></i> Twitter
          </span>
        </a>
        <br>

        <a href="" class="d-inline-block mb-3">
          <span class="badge bg-light text-dark fs-6 p-2">
            <i class="bi bi-facebook me-1"></i> Facebook
          </span>
        </a>
        <br>
        <a href="" class="d-inline-block">
          <span class="badge bg-light text-dark fs-6 p-2">
            <i class="bi bi-instagram me-1"></i> Instagram
          </span>
        </a>
      </div>
    </div>
  </div>
</div>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
  var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
  (function () {
    var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
    s1.async = true;
    s1.src = 'https://embed.tawk.to/655f50e3da19b36217900820/1hfu57ukc';
    s1.charset = 'UTF-8';
    s1.setAttribute('crossorigin', '*');
    s0.parentNode.insertBefore(s1, s0);
  })();


</script>
<!--End of Tawk.to Script-->
<?php
include("./components/footer.php");
?>