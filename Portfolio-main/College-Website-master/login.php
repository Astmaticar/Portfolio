<?php
session_start();
include 'config.php';

$error = '';

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND password=?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        // prvo provjerimo je li admin
        if($user['role'] == 'admin'){
            header("Location: admin_dashboard.php");
            exit();
        }

        // ako običan korisnik želi pristupiti nekoj stranici prije logina
        if(isset($_SESSION['redirect_after_login'])){
            $redirect = $_SESSION['redirect_after_login'];
            unset($_SESSION['redirect_after_login']);
            header("Location: $redirect");
            exit();
        }

        // inače ide na index.php
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="css/admission_style.css">
</head>
<body>

<div class="wrapper">
    <div class="r_form_wrap">
        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'login_required'): ?>
    <p style="color:red; text-align:center; font-weight:bold;">
        You must be logged in to access that page.
    </p>
<?php endif; ?>

        <div class="title">
            <p>Login</p>
        </div>
        <div class="r_form">
            <?php if($error != ''){ echo "<p style='color:red; text-align:center;'>$error</p>"; } ?>
            <form method="post">
                <div class="input_wrap">
                    <label for="email">Email</label>
                    <div class="input_item">
                        <i class="fa fa-envelope" id="icon"></i>
                        <input type="text" name="email" class="input" id="email" placeholder="Enter email" required>
                    </div>
                </div>
                <div class="input_wrap">
                    <label for="password">Password</label>
                    <div class="input_item">
                        <i class="fa fa-key" id="icon"></i>
                        <input type="password" name="password" class="input" id="password" placeholder="Enter password" required>
                    </div>
                </div>
                <input type="submit" class="button" name="login" value="Login">
            </form>
            <p>Don't have an account? <a href="register.php">Register</a></p>

        </div>
    </div>
</div>

</body>
</html>


