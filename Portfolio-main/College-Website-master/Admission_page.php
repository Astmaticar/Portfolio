<?php
session_start();

// Ako korisnik nije ulogiran, preusmjeri na login.php
if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php?msg=login_required");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title data-translate="admission_page_title">Admission form - GGU</title>
  <link rel="shortcut icon" href="image/logo.png" type="image/svg+xml">
  <link rel="stylesheet" href="css/admission_style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
</head>
<body>

<section class="header">
  <nav>
    <a href="index.php"><img src="image/logo.png" id="logo-img" alt="logo"></a>

    <div class="nav-links" id="navLinks">
      <span class="icon" onclick="hidemenu()">&#10005;</span>  
      <ul>
        <li><a href="index.php" data-translate="nav_home">Home</a></li>
        <li><a href="#course_call" data-translate="nav_work">Work</a></li>
        <li><a href="gallery.html" data-translate="nav_gallery">Gallery</a></li>
        <li><a href="Admission_page.php" data-translate="nav_custom_order">Custom order</a></li>
        <li><a href="fees_page.php" data-translate="nav_purchase">Purchase painting</a></li>
        <li><a href="Contact_page.html" data-translate="nav_contact">Contact</a></li>
        <li><a href="#" id="lang-toggle">HR</a></li>
        <li class="user-menu">
          <?php if(isset($_SESSION['user_id'])): ?>
            <a href="#" data-translate="nav_welcome">Welcome, <?php echo $_SESSION['user_name']; ?></a>
            <ul class="dropdown">
              <li><a href="logout.php" data-translate="nav_logout">Logout</a></li>
            </ul>
          <?php else: ?>
            <a href="login.php" data-translate="nav_login">Login</a>
          <?php endif; ?>
        </li>
      </ul>
    </div> 
    <span class="icon" onclick="showmenu()">&#9776;</span>
  </nav>

  <div class="wrapper">
    <div class="r_form_wrap">
      <div class="title">
        <p data-translate="admission_title">Order a custom painting</p>
      </div>

      <div class="r_form">
        <form id="admissionForm" onsubmit="sendAdmission(); return false;">
          <div class="input_wrap">
            <label for="yourname" data-translate="admission_name_label">Your Name</label>
            <div class="input_item">
              <i class="fa fa-user" id="icon"></i>
              <input type="text" name="your name" class="input" id="yourname" placeholder="Enter the name" required>
            </div>
          </div>

          <div class="input_wrap">
            <label for="emailaddress" data-translate="admission_email_label">Email Address</label>
            <div class="input_item">
              <i class="fa fa-envelope" id="icon"></i>
              <input type="text" name="email address" class="input" id="emailaddress" placeholder="Enter email adress" required>
            </div>
          </div>

          <div class="input_wrap">
            <label for="phone" data-translate="admission_phone_label">Phone</label>
            <div class="input_item">
              <i class="fa fa-phone-square" id="icon"></i>
              <input type="number" name="phone" class="input" id="phone" placeholder="Enter the Mobile number" required>
            </div>
          </div>

          <div class="input_wrap">
            <label for="address" data-translate="admission_address_label">Address</label>
            <div class="input_item">
              <i class="fa fa-home" id="icon"></i>
              <input type="text" name="address" class="input" id="address" placeholder="Enter the delivery address" required>
            </div>
          </div>

          <div class="input_wrap">
            <label for="dob" data-translate="admission_dob_label">Wanted date of delivery</label>
            <div class="input_item">
              <i class="fa fa-calendar" id="icon"></i>
              <input type="date" name="dob" class="input" id="dob" required>
            </div>
          </div>

          <div class="input_wrap">
            <label for="course" data-translate="admission_technique_label">Technique</label>
            <div class="input_item">
              <i class="fa fa-caret-square-o-down" aria-hidden="true" id="icon"></i>
              <select id="course" name="cars" class="input" required>
                <option value="select" data-translate="admission_select_technique">Select the technique</option>
                <option value="Oil on wood" data-translate="admission_oil_wood">Oil on wood</option>
                <option value="Oil on canvas" data-translate="admission_oil_canvas">Oil on canvas</option>
                <option value="Oil on cardboard" data-translate="admission_oil_cardboard">Oil on cardboard</option>
                <option value="Aquarelle on paper" data-translate="admission_aquarelle">Aquarelle on paper</option>
                <option value="Coal on paper" data-translate="admission_coal">Coal on paper</option>
              </select>
            </div>
          </div>

          <div class="input_wrap">
            <label for="file" data-translate="admission_reference_label">Reference</label>
            <div class="input_item">
              <input type="file" id="fileInput" accept="image/*" required>
            </div>
          </div>

          <input type="submit" class="button" value="Send order" data-translate="admission_send_button">
          <input type="reset" class="clear_ad" value="Clear" data-translate="admission_clear_button">
        </form>
      </div>
    </div>
  </div>
</section>

<div class="none_div"></div>

<script src="https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js"></script>
<script>
    emailjs.init("VBKV3r6XaaFW3B8so");
</script>

<script>
function sendAdmission() {
    const fileInput = document.getElementById("fileInput");
    const file = fileInput.files[0];
    
    if (!file) {
        alert("Please upload a reference image!");
        return;
    }
    
    if (file.size > 2 * 1024 * 1024) {
        alert("File is too large. Max 2MB.");
        return;
    }

    const reader = new FileReader();
    reader.onload = function(event) {
        const base64Image = event.target.result;

        const params = {
            from_name: document.getElementById("yourname").value,
            from_email: document.getElementById("emailaddress").value,
            phone: document.getElementById("phone").value,
            address: document.getElementById("address").value,
            dob: document.getElementById("dob").value,
            technique: document.getElementById("course").value,
            reference_image: base64Image
        };

        emailjs.send("service_iuylq7d", "template_mvlogkj", params)
        .then(() => {
            alert("Order sent successfully!");
            document.getElementById("admissionForm").reset();
        }, (error) => {
            console.log(error);
            alert("Error sending order. Check console.");
        });
    };

    reader.readAsDataURL(file);
}
</script>

<script>
var navLinks = document.getElementById("navLinks");
function showmenu(){ navLinks.style.right="0"; }
function hidemenu(){ navLinks.style.right="-200px"; }
</script>

<!-- Lang.js must be included here -->
<script src="javascript/lang.js"></script>

</body>
</html>
