<?php

session_start();

$error = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''

];

$activeForm = $_SESSION['active_form'] ?? 'login';


function showError($error){
    return !empty($error) ? "<p class='error-message'>$error</p>" :'';

}

function isActiveForm($formName, $activeForm){
    return $formName === $activeForm ? 'active' : '';

}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    
</head>
<body>
    <div class="container">
        <div class="box <?=isActiveForm('login', $activeForm); ?>" id="login-box">
        <form action="login_register.php" method="post">
            <h2>Login</h2>
            <?= showError($error['login']); ?>
            <input type="email" name="email" placeholder="Enter email" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit" name="login" >Login</button>
            <p>Don't have an account?<a href="#" onclick="show('register-box')">Register yourself</a></p>


        </form>      


        </div>

        <div class="container">

<div class="box <?=isActiveForm('register', $activeForm); ?>" id="register-box">
<form action="login_register.php" method="post">
    <h2>Register</h2>
    <?php if(isset($_SESSION['register_success'])): ?>
        <div class="success-message">
            <?= $_SESSION['register_success']; unset($_SESSION['register_success']); ?>
        </div>
    <?php endif; ?>
    <?= showError($error['register']); ?>
    <input type="text" name="username" placeholder="Enter Username" required>
    <input type="email" name="email" placeholder="Enter Email" required>
    <input type="password" name="password" placeholder="Enter Password" required>
    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
    <button type="submit" name="register">Register</button>
    <p>Already have an account?<a href="#" onclick="show('login-box')">Login</a></p>
  

</form>      

</div>

</div>

</div>

<script src="script.js"></script>
</body>
</html>

<?php 
session_unset();
?>