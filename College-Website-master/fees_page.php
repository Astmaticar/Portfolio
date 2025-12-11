<?php
session_start();

// Ako korisnik nije ulogiran, preusmjeri na login.php
if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI']; // zapamti stranicu
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
  <title data-translate="fees_page_title">Purchase a painting</title>
  <link rel="shortcut icon" href="image/logo.png" type="image/svg+xml">
  <link rel="stylesheet" href="css/fees_style.CSS">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
</head>
<body>
  <section class="header">
    <nav>
        <a href="index.php"><img src="image/logo.png" id="logo-img"></a>

        <div class="nav-links" id="navLinks">
            <span class="icon" onclick="hidemenu()">&#10005;</span>
            <ul>
                <li><a href="index.php" data-translate="nav_home">Home</a></li>
                <li><a href="#course_call" data-translate="nav_work">Work</a></li>
                <li><a href="gallery.html" data-translate="nav_gallery">Gallery</a></li>
                <li><a href="Admission_page.php" data-translate="nav_custom_order">Custom order</a></li>
                <li><a href="fees_page.php" data-translate="nav_purchase_painting">Purchase painting</a></li>
                <li><a href="Contact_page.html" data-translate="nav_contact">Contact</a></li>
                <li><a href="#" id="lang-toggle">HR</a></li>
                <li class="user-menu">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <a href="#">Welcome, <?php echo $_SESSION['user_name']; ?></a>
                        <ul class="dropdown">
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    <?php else: ?>
                        <a href="login.php">Login</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div> 
        <span class="icon" onclick="showmenu()">&#9776;</span>
    </nav>

  <div class="wrapper">
    <div class="r_form_wrap">
        <div class="title">
          <p data-translate="fees_page_header" id="header_fees">Purchase painting</p>
        </div>
        
        <!-- Purchase form -->
        <div class="r_form">
            <form method="post" onsubmit="sendmail(); reset(); return false;">
                <div class="input_wrap">
                    <label for="course" data-translate="fees_course_label">Course</label>
                    <div class="input_item">
                        <i class="fa fa-bars" aria-hidden="true" id="icon"></i>
                        <select id="course" name="cars" class="input" required>
                            <option value="select" data-translate="fees_select_technique">Select the technique</option>
                            <option value="aquarelle" data-translate="fees_aquarelle">Aquarelle on paper</option>
                            <option value="oil" data-translate="fees_oil">Oil on canvas/wood/cardboard</option>
                            <option value="coal" data-translate="fees_coal">Coal on paper</option>
                        </select>
                    </div>
                </div>

                <div class="input_wrap">
                    <label for="uid" data-translate="fees_artwork_id_label">ID of artwork</label>
                    <div class="input_item">
                        <i class="fa fa-list-ol" aria-hidden="true" id="icon"></i>
                        <input type="number" class="input" id="uid" placeholder="Enter the last two ID digits">
                    </div>
                </div>

                <p data-translate="fees_artwork_id_detail" id="uid_detail">Ex: 001 to enter the: 01</p>
                <input type="button" class="button" data-translate="fees_get_button" value="Get" onclick="getInputValue()">

                <div class="input_wrap">
                    <label for="demo" data-translate="fees_artwork_label">Artwork</label>
                    <div class="input_item">
                        <i class="fa fa-picture-o" id="icon"></i>
                        <p id="demo" class="input"></p>
                    </div>
                </div>

                <div class="input_wrap">
                    <label for="demo1" data-translate="fees_price_label">Price in euros</label>
                    <div class="input_item">
                        <i class="fa fa-credit-card" id="icon"></i>
                        <p id="demo1" class="input"></p>
                    </div>
                </div>

                <input type="button" class="button" data-translate="fees_pay_button" value="Pay" onclick="window.location.href='https://www.paypal.com/us/signin'">
            </form>
        </div>
    </div>
  </div>
  </section>

<div class="none_div"></div>

<script src="javascript/fees_script.js"></script>
<script>
var navLinks= document.getElementById("navLinks");

function showmenu(){
    navLinks.style.right="0";
}   
function hidemenu(){
    navLinks.style.right="-200px";
}
function sendmail(){
    Email.send({}).then(message => alert("Thank you!"));
}
</script>
<script src="javascript/lang.js"></script>
</body>
</html>
