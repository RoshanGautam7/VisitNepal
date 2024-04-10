<?php

include("./components/header.php");

require_once './admin/database/crud.php';
$id = $_GET['user_id'];

$crud = new CRUD();
$result = $crud->getById('users', $id);


if (isset($_POST['save'])) {

  $data = [
    'name' => $_POST['name'],
    'phone' => $_POST['phonenum'],
    'dob' => $_POST['dob'],
    'pincode' => $_POST['pincode'],
    'address' => $_POST['address'],
  ];
  $success = $crud->update('users', $data, "id = $id");
if ($success) {
     // Redirect to the profile page
     header("Location: profile.php");
     exit(); // Prevent further code execution after redirection
}
} elseif (isset($_POST['passed'])) {
  if ($_POST['new_pass'] !== $_POST['confirm_pass']) {
  } else {
    $data = [
      'password' => password_hash($_POST['new_pass'], PASSWORD_DEFAULT),
    ];
    $result = $crud->update('users', $data, "id=$id");
    if ($result) {
         // Redirect to the profile page
   header("Location: profile.php");
   exit(); // Prevent further code execution after redirection
    }
  }

} elseif (isset($_POST['changed'])) {
  $uploadDir = './images/users/';
    $uploadFile = $uploadDir . basename($_FILES['profile']['name']);

    if (move_uploaded_file($_FILES['profile']['tmp_name'], $uploadFile)) {

        $data = ['image' => $uploadFile]; 
        $condition = "id = $id"; 

        
        // Call the update function
        $result = $crud->update('users', $data, $condition);

      if ($result) {
         // Redirect to the profile page
   header("Location: profile.php");
   exit(); // Prevent further code execution after redirection
    }
 
}
}
?>

<div class="container">
  <div class="row">

    <div class="col-12 my-5 px-4">
      <h2 class="fw-bold">PROFILE</h2>
      <div style="font-size: 14px;">
        <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
        <span class="text-secondary"> > </span>
        <a href="#" class="text-secondary text-decoration-none">PROFILE</a>
      </div>
    </div>


    <div class="col-12 mb-5 px-4">
      <div class="bg-white p-3 p-md-4 rounded shadow-sm">
        <form id="info-form" action="" method="POST" enctype="multipart/form-data">
          <h5 class="mb-3 fw-bold">Basic Information</h5>
          <div class="row">
            <div class="col-md-4 mb-3">
              <label class="form-label">Name</label>
              <input name="name" type="text" value="<?php echo $result['name']; ?>"
                class="form-control shadow-none text-capitalize" required>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Phone Number</label>
              <input name="phonenum" type="number" value="<?php echo $result['phone']; ?>"
                class="form-control shadow-none" required>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Date of birth</label>
              <input name="dob" type="date" value="<?php echo $result['dob']; ?>" class="form-control shadow-none"
                required>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Pincode</label>
              <input name="pincode" type="number" value="<?php echo $result['pincode']; ?>"
                class="form-control shadow-none" required>
            </div>
            <div class="col-md-8 mb-4">
              <label class="form-label">Address</label>
              <textarea name="address" class="form-control shadow-none" rows="1"
                required><?php echo $result['address']; ?></textarea>
            </div>
          </div>
          <button type="submit" name="save" class="btn text-white custom-bg shadow-none">Save Changes</button>
        </form>
      </div>
    </div>

    <div class="col-md-4 mb-5 px-4">
      <div class="bg-white p-3 p-md-4 rounded shadow-sm">
        <form id="profile-form" method="POST" action="" enctype="multipart/form-data">
          <h5 class="mb-3 fw-bold">Picture</h5>
          <img src="<?php echo $result['image']; ?>" class="rounded-circle img-fluid mb-3">

          <label class="form-label">New Picture</label>
          <input name="profile" type="file" accept=".jpg, .jpeg, .png, .webp" class="mb-4 form-control shadow-none"
            required>

          <button type="submit" name="changed" class="btn text-white custom-bg shadow-none">Save Changes</button>
        </form>
      </div>
    </div>


    <div class="col-md-8 mb-5 px-4">
      <div class="bg-white p-3 p-md-4 rounded shadow-sm">
        <form id="pass-form" method="POST" action="" enctype="multipart/form-data">
          <h5 class="mb-3 fw-bold">Change Password</h5>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">New Password</label>
              <input name="new_pass" type="password" class="form-control shadow-none" required>
            </div>
            <div class="col-md-6 mb-4">
              <label class="form-label">Confirm Password</label>
              <input name="confirm_pass" type="password" class="form-control shadow-none" required>
            </div>
          </div>
          <button type="submit" name="passed" class="btn text-white custom-bg shadow-none">Save Changes</button>
        </form>
      </div>
    </div>


  </div>
</div>

<!-- footer -->
<?php
include("./components/footer.php");
?>