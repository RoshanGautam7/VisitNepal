<?php
include("./components/header.php");
$bookings = $crud->getByCondition('bookings','user_name',$_SESSION['username']);
$packages_bookings = $crud->getByCondition('package_bookings','user_id',$_SESSION['id']);


?>



<div class="container py-5">


  <div class="row">
    <div class="col-lg-8 mx-auto">

      <!-- List group-->
      <ul class="list-group shadow">
      <h2 class="pt-4 mb-4 text-center fw-bold h-font">BOOKED ROOMS</h2>
      <?php foreach($bookings as $booking): 
        $room = $crud->getById('rooms',$booking['room_id']);

        ?>
    
   
        <!-- list group item-->
        <li class="list-group-item">

    
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row p-3">
            <div class="media-body order-2 order-lg-1">
              <h5 class="mt-0 font-weight-bold mb-2"><?php echo $room['name']; ?></h5>
              <p class="font-italic text-muted mb-0 small"><?php echo $room['description']; ?></p>
              <div class="d-flex align-items-center justify-content-between mt-1">
                <h6 class="font-weight-bold my-2">$<?php echo $room['price']; ?></h6>
                <ul class="list-inline small">
                  <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                  <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                  <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                  <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>         
                </ul>
      </div>
              <div class="d-flex align-items-center justify-content-between mt-1">
              <img src="<?php echo str_replace('../','./',$room['image']); ?>"  width="200"`>
               <a href="view_details.php?id=<?php echo $room['id'];?>" class="btn custom-bg text-white">View Details</a>
      </div>
          </div>
          <!-- End -->
        </li>
        <?php endforeach; ?>
    <h2 class="pt-4 mb-4 text-center fw-bold h-font mb-5">BOOKED PACKAGE</h2>
<?php foreach($packages_bookings as $package_booking):
      $package = $crud->getById('packages',$package_booking['package_id']);
      $images = json_decode($package['image_path'], true); // Decode as an associative array
      $firstImage = $images[0];
    ?>
        <li class="list-group-item">
        

          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row p-3">
            <div class="media-body order-2 order-lg-1">
              <h5 class="mt-0 font-weight-bold mb-2"><?php echo $package['title']; ?></h5>
              <p class="font-italic text-muted mb-0 small"><?php echo $package['description']; ?></p>
              <div class="d-flex align-items-center justify-content-between mt-1">
                <h6 class="font-weight-bold my-2">$<?php echo $package['price']; ?></h6>
                <ul class="list-inline small">
                  <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                  <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                  <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                  <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                  <li class="list-inline-item m-0"><i class="fa fa-star text-warning"></i></li>
                 
                </ul>
              </div>
              <div class="d-flex align-items-center justify-content-between mt-1">
              <img src="<?php echo str_replace('../','./',$firstImage); ?>"  width="200">
              <form action="" method="POST">
                <!-- "Rate Our Service" link with data attributes -->
                <a href="#" class="btn custom-bg text-white" data-bs-toggle="modal" data-bs-target="#rateModal" data-package-id="<?php echo $package['id']; ?>">
                    Rate Our Service
                    </a>
            </form>
              </li>
        <?php endforeach; ?>

      </ul>
            <!-- Modal -->

            <?php
            
            if (isset($_POST['rating'])) {
                $data = [
                    'rating'=>$_POST['rating'],
                    'package_id'=>$_POST['package_id'],
                    'review'=>$_POST['feedback'],
                    'user_id'=>$_SESSION['id'],
                ];

               $result = $crud->create('ratings',$data);

               if ($result) {
                header('Location:bookings.php');
               }else {
                echo "Failed";
               }
            }
            
            ?>
            <!-- Modal -->
            <div class="modal fade" id="rateModal" tabindex="-1" aria-labelledby="rateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rateModalLabel">Rate Our Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label id="ratingLabel" class="form-label">Please rate your experience:</label>
                    <select name="rating" class="form-select" id="ratingSelect">
                        <option value="1">Very Bad</option>
                        <option value="2">Bad</option>
                        <option value="3">Satisfactory</option>
                        <option value="4">Good</option>
                        <option value="5">Very Good</option>
                    </select>

                    <label for="feedback" class="form-label mt-3">Additional feedback:</label>
                    <textarea class="form-control" name="feedback" id="feedback" rows="4"></textarea>

                    <input type="hidden" name="package_id" id="packageIdInput">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn custom-bg text-white">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

    </div>
  </div>
</div>
<script>
const rateModal = document.getElementById('rateModal');
const feedbackTextarea = document.getElementById('feedback');
const packageIdInput = document.getElementById('packageIdInput');

rateModal.addEventListener('shown.bs.modal', (event) => {
  const packageId = event.relatedTarget.dataset.packageId;
  packageIdInput.value = packageId;
});
</script>
<?php
include("./components/footer.php");
?>