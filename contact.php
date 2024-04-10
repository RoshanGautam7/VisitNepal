<?php
include("./components/header.php");
require_once("./admin/database/crud.php");

$crud = new CRUD();

if (isset($_POST['send'])) {
  $data = [
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'subject' => $_POST['subject'],
    'message' => $_POST['message'],
    'date' => date('Y-m-d'),
  ];
  $result = $crud->create('user_queries', $data);

  if ($result) {
    echo "Successfully sent query";
  }
}
?>
<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">CONTACT US</h2>
  <div class="h-line bg-dark"></div>
  <p class="text-center mt-3">
    Contatc us for more info

  </p>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-6 col-md-6 mb-5 px-4">

      <div class="bg-white rounded shadow p-4">
        <iframe class="w-100 rounded mb-4" height="320px"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3530.63504262862!2d85.3430345120337!3d27.75940062309239!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1fdc51164935%3A0x374ea58de634ee6a!2sBudhanilkantha%20Ward%206%20Office%2C%20Khadka%20Bhadrakali!5e0!3m2!1sen!2snp!4v1700204669646!5m2!1sen!2snp"
          loading="lazy"></iframe>

        <h5>Address</h5>
        <a href="" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
          <i class="bi bi-geo-alt-fill"></i> Kapan, Kathmandu, Nepal
        </a>

        <h5 class="mt-4">Call us</h5>
        <a href="tel: +" class="d-inline-block mb-2 text-decoration-none text-dark">
          <i class="bi bi-telephone-fill"></i> +9865461461
        </a>
        <br>

        <a href="tel: +$contact_r[pn2]" class="d-inline-block text-decoration-none text-dark">
          <i class="bi bi-telephone-fill"></i> +9865461461
        </a>

        <h5 class="mt-4">Email</h5>
        <a href="mailto" class="d-inline-block text-decoration-none text-dark">
          <i class="bi bi-envelope-fill"></i> kalyanacharya267@gmail.com
        </a>

        <h5 class="mt-4">Follow us</h5>
        <a href="" class="d-inline-block text-dark fs-5 me-2">
          <i class="bi bi-twitter me-1"></i>
        </a>


        <a href="" class="d-inline-block text-dark fs-5 me-2">
          <i class="bi bi-facebook me-1"></i>
        </a>
        <a href="" class="d-inline-block text-dark fs-5">
          <i class="bi bi-instagram me-1"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 px-4">
      <div class="bg-white rounded shadow p-4">
        <form method="POST" action="">
          <h5>Send a message</h5>
          <div class="mt-3">
            <label class="form-label" style="font-weight: 500;">Name</label>
            <input name="name" required type="text" class="form-control shadow-none">
          </div>
          <div class="mt-3">
            <label class="form-label" style="font-weight: 500;">Email</label>
            <input name="email" required type="email" class="form-control shadow-none">
          </div>
          <div class="mt-3">
            <label class="form-label" style="font-weight: 500;">Subject</label>
            <input name="subject" required type="text" class="form-control shadow-none">
          </div>
          <div class="mt-3">
            <label class="form-label" style="font-weight: 500;">Message</label>
            <textarea name="message" required class="form-control shadow-none" rows="5"
              style="resize: none;"></textarea>
          </div>
          <button type="submit" name="send" class="btn text-white custom-bg mt-3">SEND</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- footer -->
<?php
include("./components/footer.php");
?>