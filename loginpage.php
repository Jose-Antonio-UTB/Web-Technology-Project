<?php
session_start();

$errors = [
    'login' => $_SESSION['login_error'] ?? ''
];

$activeform = $_SESSION['active_form'] ?? 'login';

session_unset();

function showError($error) {
    return !empty($error) ? "<p class='error message'>$error</p>" : '';
}

function isActiveForm($formName, $activeform) {
    return $formName === $activeform ? ' active' : ''; // ← Note the space at the beginning
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>The Unofficial Warframe Merchandise Website</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="view-transition" content="same-origin">
    <link rel="stylesheet" href="loginstyle.css">
    <script src="site.js" defer></script>
</head>
<body>
    <div class="mainbody">
        <div class="loginspace<?= isActiveForm('login', $activeform) ?>">
            <div class="loginwindow">
                <h2>Log In</h2>
                <?= showError($errors['login']) ?> 
                <form action="./login_register.php" method="post">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" required />

                    <label for="pw">Password</label>
                    <input type="password" id="pw" name="password" placeholder="Password" required />

                    <button type="submit" name="signin">Log In</button>
                    <p style="text-align:center; margin-top:10px;">
                        Don't have an account? <a href="./registration.php">Sign Up</a> here!
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>