<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="The Barbara Jurić at Sidhpur provide one of the earliest form of technical studies, which has been vital in setting up the standard of brilliance.">
    <meta name="keywords" content="Barbara Jurić,Collage">
    <meta name="author" content="Lana Gale">

    <title>Barbara Jurić</title>
    
    <link rel="stylesheet" href="css/main_style.css">
    <link rel="shortcut icon" href="image/logo.png" type="image/svg+xml">
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
                    <li><a href="fees_page.php" data-translate="nav_purchase">Purchase painting</a></li>
                    <li><a href="Contact_page.html" data-translate="nav_contact">Contact</a></li>
                    <li><a href="#" id="lang-toggle">HR</a></li>
                    <li class="user-menu">
                        <?php if(isset($_SESSION['user_id'])): ?>
                            <a href="#">Welcome, <?php echo $_SESSION['user_name']; ?></a>
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
       
        <div class="text-box">
            <h1 data-translate="home_title">Barbara Jurić</h1>
            <p data-translate="home_paragraph">Barbara Jurić is a visual artist and painter known for her expressive approach to color and composition.</br>Her work draws inspiration from personal experiences, natural environments, and contemporary artistic movements.</p>
            <a href="Admission_page.php" class="hero-btn" data-translate="order_button">Order a painting</a>
        </div>
    </section>

    <!--Course of Collage-->
    <section class="course" id="course_call">
        <h1 data-translate="course_section">Discover Barbara’s Work</h1>
        <p data-translate="course_paragraph">Explore her artworks, themed collections, and exhibitions that highlight her creative vision.</p>

        <div class="row">
            <div class="course-col">
                <h2 data-translate="artworks_section">Artworks</h2>
                <p data-translate="artworks_paragraph">A curated selection of Barbara Jurić’s most notable paintings, showcasing her distinctive visual language, attention to detail, and evolving artistic style. Each piece reflects her dedication to exploring color, form, and emotion through traditional and contemporary techniques.</p>
            </div>

            <div class="course-col">
                <h2 data-translate="collections_section">Collections</h2>
                <p data-translate="collections_paragraph">Barbara’s work is organized into thematic collections that illustrate the progression of her artistic practice. These series highlight her interest in human expression, nature, abstract forms, and storytelling through visual composition.</p>
            </div>

            <div class="course-col">
                <h2 data-translate="exhibitions_section">Exhibitions</h2>
                <p data-translate="exhibitions_paragraph">A documented overview of exhibitions where Barbara Jurić’s works have been featured. This includes solo shows, group exhibitions, and collaborative art events. Each exhibition represents a milestone in her career and her ongoing engagement with the artistic community.</p>
            </div>
        </div>
    </section>

    <!--Campus Section-->
    <section class="campus">
        <h1 data-translate="collections_section_title">Collections</h1>
        <p data-translate="collections_text">A vibrant collection of Barbara Jurić’s creations, highlighting her mastery of texture, composition, and expressive use of color.</br> Each artwork invites viewers into a unique visual narrative, blending imagination with skillful technique to evoke emotion and spark reflection.</p>

        <div class="row">
            <div class="campus-col">
                <img src="image/cm1.jpg" alt="">
                <div class="layer">
                    <li><a href="gallery.html#aquarelle"><h3 data-translate="artworks_aquarelle">Aquarelle on paper</h3></a></li>
                </div>
            </div>

            <div class="campus-col">
                <img src="image/cm2.jpg" alt="">
                <div class="layer">
                    <li><a href="gallery.html#oil"><h3 data-translate="artworks_oil">Oil on </br> cavnvas/wood/cardboard</h3></a></li>
                </div>
            </div>

            <div class="campus-col">
                <img src="image/cm3.jpg" alt="">
                <div class="layer">
                    <li><a href="gallery.html#coal"><h3 data-translate="artworks_coal">Coal on paper</h3></a></li>
                </div>
            </div>
        </div>
    </section>

    <!--Facilities Section-->
    <section class="facilities">
        <h1 data-translate="exhibitions_section_title">Exhibitions</h1>
        <p data-translate="exhibitions_text">A documented overview of exhibitions where Barbara Jurić’s works have been featured. This includes solo shows, group exhibitions, and collaborative art events.</br>Each exhibition represents a milestone in her career and her ongoing engagement with the artistic community.</p>

        <div class="scroll-wrapper">
            <div class="row exhibitions-row">
                <div class="facilities-col">
                    <img src="image/lol.jpg" alt="">
                    <h3 data-translate="exhibition_1">Izložba studenata Akademije likovnih umjetnosti u Zagrebu, </br>Akademija primijenjenih umjetnosti, Rijeka</h3>
                </div>

                <div class="facilities-col">
                    <img src="image/loll.jpg" alt="">
                    <h3 data-translate="exhibition_2">Skupna izložba "ALU perspektiva", HDLU Zagreb</h3>
                </div>

                <div class="facilities-col">
                    <img src="image/lolll.jpg" alt="">
                    <h3 data-translate="exhibition_3">Izložba "Baza poteza", Galerija K2, Križevci</h3>
                </div>
            </div>
        </div>
    </section>

    <!--Call To Action Section-->
    <section class="ctn">
        <h1> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h1>
    </section>

    <!--Footer-->
    <section class="footer">
        <h4 data-translate="footer_about_title">About</h4>
        <p data-translate="footer_about_text">Through each piece, she aims to evoke emotion, invite interpretation, and create a meaningful connection with the viewer.</br>
        With a strong dedication to her craft, Barbara continues to develop her artistic identity, exhibiting her work and expanding her presence within the art world.</br>
        Her portfolio reflects both the refinement of her technique and her passion for visual storytelling.</p>
        <p id="copyright" data-translate="footer_made_by">Made By &#10084; Lana Gale</p>
    </section>

    <!--Javascript is Start-->
    <script src="javascript/lang.js"></script>
    <script src="javascript/main_script.js"></script>
    
</body>
</html>
