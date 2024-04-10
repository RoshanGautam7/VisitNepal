<?php
include("./components/header.php");
if (!isset($_SESSION['username'])):
  // Display the login modal
  include("./components/error.php"); 
else:
  
  $room = $crud->getById('rooms',$_GET['id']);
?>


<!-- details -->
<div class="container">
  <div class="row">

    <div class="col-12 my-5 mb-4 px-4">
      <h2 class="fw-bold">CONFIRM BOOKING</h2>
      <div style="font-size: 14px;">
        <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
        <span class="text-secondary"> > </span>
        <a href="rooms.php" class="text-secondary text-decoration-none">ROOMS</a>
        <span class="text-secondary"> > </span>
        <a href="#" class="text-secondary text-decoration-none">CONFIRM</a>
      </div>
    </div>

    <div class="col-lg-7 col-md-12 px-4">

      <div class="card p-3 shadow-sm rounded">
      <div class="carousel-image" style="width:46vw;">
          <img src="<?php echo str_replace('../', './', $room['image']); ?>" class="card-img-top">
          </div>
        <h5><?php echo $room['name']; ?></h5>
        <h6>$<?php echo $room['price']; ?> per night</h6>
      </div>
    </div>
<?php

  if (isset($_POST['submit'])) {
    $data=[
      'room_id'=>$_GET['id'],
      'name'=>$_POST['name'],
      'phone'=>$_POST['phonenum'],
      'address'=>$_POST['address'],
      'check_in'=>$_POST['checkin'],
      'check_out'=>$_POST['checkout'],
      'user_name'=>$_SESSION['username'],
      'isConfirmed'=>0,
      'user_id'=>$_SESSION['id'],
    ];

    $result = $crud->create('bookings',$data);

    if ($result) {
      header('Location:index.php');
    }
  }

 ?>
    <div class="col-lg-5 col-md-12 px-4">
      <div class="card mb-4 border-0 shadow-sm rounded-3">
        <div class="card-body">
          <form action="" method="POST" id="booking_form">
            <h6 class="mb-3">BOOKING DETAILS</h6>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Name</label>
                <input name="name" type="text" value="" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Phone Number</label>
                <input name="phonenum" type="number" value="" class="form-control shadow-none" required>
              </div>
              <div class="col-md-12 mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Check-in</label>
                <input name="checkin"type="date" class="form-control shadow-none"
                  required>
              </div>
              <div class="col-md-6 mb-4">
                <label class="form-label">Check-out</label>
                <input name="checkout"  type="date" class="form-control shadow-none"
                  required>
              </div>
                <button name="submit" class="btn w-100 text-white custom-bg shadow-none mb-1">Pay
                  Now</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- footer -->
<script src='https://code.jquery.com/jquery-3.5.1.slim.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<?php
endif;
include("./components/footer.php");
?>