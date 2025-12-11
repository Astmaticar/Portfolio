<?php
session_start();
include 'config.php';

// Inicijaliziraj varijable da PHP ne baca upozorenja
$error = '';
$success = '';

if(isset($_POST['register'])){
    $name = $_POST['yourname'];
    $email = $_POST['emailaddress'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmpassword'];

    // Provjera lozinke
    if($password != $confirm_password){
        $error = "Passwords do not match!";
    } else {
        // Provjeri da li email već postoji
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0){
            $error = "This email is already registered!";
        } else {
            // Ako email ne postoji, ubaci korisnika u bazu
            $stmt = $conn->prepare("INSERT INTO users (name,email,phone,gender,dob,password) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssssss", $name, $email, $phone, $gender, $dob, $password);

            if($stmt->execute()){
                // Nakon uspješne registracije, preusmjeri na login.php
                header("Location: login.php");
                exit();
            } else {
                $error = "Database error: " . $stmt->error;
            }
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/admission_style.css"> <!-- koristi isti CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script>
</head>
<body>
<div class="wrapper">
    <div class="r_form_wrap">
        <div class="title">
            <p>Register</p>
        </div>
        <?php if($error) { echo "<p style='color:red;text-align:center;'>$error</p>"; } ?>
        <?php if($success) { echo "<p style='color:green;text-align:center;'>$success</p>"; } ?>
        <div class="r_form">
            <form method="post">
                <div class="input_wrap">
                    <label for="yourname">Your Name</label>
                    <div class="input_item">
                        <i class="fa fa-user" id="icon"></i>
                        <input type="text" name="yourname" class="input" id="yourname" placeholder="Enter your name" required>
                    </div>
                </div>
                <div class="input_wrap">
                    <label for="emailaddress">Email Address</label>
                    <div class="input_item">
                        <i class="fa fa-envelope" id="icon"></i>
                        <input type="email" name="emailaddress" class="input" id="emailaddress" placeholder="Enter email address" required>
                    </div>
                </div>
                <div class="input_wrap">
                    <label for="phone">Phone</label>
                    <div class="input_item">
                        <i class="fa fa-phone-square" id="icon"></i>
                        <input type="text" name="phone" class="input" id="phone" placeholder="Enter phone number" required>
                    </div>
                </div>
                <div class="input_wrap">
                    <label>Gender</label>
                    <div class="input_radio">
                        <div class="input_radio_item">
                            <input type="radio" id="male" name="gender" class="radio" value="male" checked>
                            <label for="male" class="radio_mark">
                                <ion-icon class="i" name="male-sharp"></ion-icon> Male
                            </label>
                        </div>
                        <div class="input_radio_item">
                            <input type="radio" id="female" name="gender" class="radio" value="female">
                            <label for="female" class="radio_mark">
                                <ion-icon class="i" name="female-sharp"></ion-icon> Female
                            </label>
                        </div>
                        <div class="input_radio_item">
                            <input type="radio" id="others" name="gender" class="radio" value="others">
                            <label for="others" class="radio_mark">
                                <ion-icon class="i" name="male-female-sharp"></ion-icon> Others
                            </label>
                        </div>
                    </div>
                </div>
                <div class="input_wrap">
                    <label for="dob">Date of Birth</label>
                    <div class="input_item">
                        <i class="fa fa-calendar" id="icon"></i>
                        <input type="date" name="dob" class="input" id="dob" required>
                    </div>
                </div>
                
                
        
                <div class="input_wrap">
                    <label for="password">Password</label>
                    <div class="input_item">
                        <i class="fa fa-key" id="icon"></i>
                        <input type="password" name="password" class="input" id="password" placeholder="Enter password" required>
                    </div>
                </div>
                <div class="input_wrap">
                    <label for="confirmpassword">Confirm Password</label>
                    <div class="input_item">
                        <i class="fa fa-check-circle" id="icon"></i>
                        <input type="password" name="confirmpassword" class="input" id="confirmpassword" placeholder="Confirm password" required>
                    </div>
                </div>
                <input type="submit" name="register" class="button" value="Register Now">
                <input type="reset" class="clear_ad" value="Clear">
            </form>
        </div>
    </div>
</div>

</body>
</html>
