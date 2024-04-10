<?php

include './components/header.php';

require_once './admin/database/crud.php';

$crud = new CRUD();

$id = '';

if (isset($_GET['user_id'])) {
  $id = $_GET['user_id'];
}else {
  $id =$_SESSION['id'];
}

$result = $crud->getById('users',$id);
?>

<section class="vh-100" style="background-color: #f4f5f7;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-6 mb-4 mb-lg-0">
        <div class="card mb-3" style="border-radius: .5rem;">
          <div class="row g-0">
            <div class="col-md-4 custom-bg text-center text-white"
              style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
              <img src="<?php echo $result['image']; ?>"
                alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
              <h5 class="text-uppercase"><?php echo $result['name']; ?></h5>
              <p>User</p>
              <a class="text-white" href="edit_profile.php?user_id=<?php echo $result['id']; ?>"><i class="far fa-edit mb-5"></i></a>
            </div>
            <div class="col-md-8">
              <div class="card-body p-4">
                <h6>Information</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Email</h6>
                    <p class="text-muted"><?php echo $result['email']; ?></p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Phone</h6>
                    <p class="text-muted"><?php echo $result['phone']; ?></p>
                  </div>
                </div>
           
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Address</h6>
                    <p class="text-muted"><?php echo $result['address']; ?></p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Date of Birth</h6>
                    <p class="text-muted"><?php echo $result['dob']; ?></p>
                  </div>
                </div>
                <div class="d-flex justify-content-start">
                  <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                  <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                  <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php

include './components/footer.php';
?>