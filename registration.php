<?php
session_start();
include('./connect.php');

$errors = [
    'register' => $_SESSION['register_error'] ?? ''
];

$activeform = $_SESSION['active_form'] ?? 'login';

session_unset();

function showError($error) {
    return !empty($error) ? "<p class='error message'>$error</p>" : '';
}

function isActiveForm($formName, $activeform) {
    return $formName === $activeform ? 'active' : '';
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>The Unofficial Warframe Merchandise Website</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="view-transition" content="same-origin">
        <link rel="stylesheet" href="registration.css">
        <script src="site.js"></script>
    </head>

    <body>
        <div class="mainbody">
            <div class="registerspace">
                <div class="registerwindow" <?= isActiveForm('register',$activeform)?>>
                <h2>Register</h2>
                <?= showError($errors['register']) ; ?> 
                <form method="post" action="login_register.php">
                    <label for="username">Username</label>
                    <input type="text" id="username "placeholder="Username" name="username" required><br>
                    <label for="email">Email</label>
                    <input type="email" id="email "placeholder="Email" name="email" required><br>
                    <label for="pw">Password</label>
                    <input type="password" id="pw" placeholder="Password" name="password" required><br>
                    <label for="confirm_pw">Re-Enter Password</label>
                    <input type="password" id="confirm_pw" placeholder="Re-Enter Password" required><br>
                    <div class="terms">
                        <input type="checkbox" id="checkbox">
                        <label for="checkbox">Accept <a href="#">Terms & Conditions</a></label>
                    </div>
                    <button type="submit" name="signup">Register</button>
                </form> 
                Already have an account? <a href="./loginpage.php">Log In</a> here!
                </div>
            </div>   
        </div>          
    </body>
</html>