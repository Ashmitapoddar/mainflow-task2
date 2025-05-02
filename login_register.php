
<?php

session_start();
require_once('config.php');
if(isset($_POST['register'])){
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
        $_SESSION['register_error'] = 'Password must be at least 8 characters and include upper, lower, number, and special character.';
        $_SESSION['active_form'] = 'register';
    }
    
    elseif($password !== $confirm_password){
        $_SESSION['register_error'] = 'Passwords do not match';
        $_SESSION['active_form'] = 'register';
    } else {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $verifyEmail = $conn->query("SELECT email FROM users WHERE email='$email'");
        if ($verifyEmail->num_rows > 0){
            $_SESSION['register_error'] = 'Email is already registered';
            $_SESSION['active_form'] = 'register';
        } else {
            $conn->query("INSERT INTO users (username, email, password) VALUES('$name','$email','$password_hashed')");
            $_SESSION['register_success'] = 'Registration successful!';
            $_SESSION['active_form'] = 'register'; // Stay on register form
        }
    }
    header("Location: login.php");
    exit();
}





if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=$_POST['password'];

    $result=$conn->query("SELECT * FROM users WHERE email ='$email'");

    if($result->num_rows > 0){
        $user=$result->fetch_assoc();
        if(password_verify($password, $user['password'])){
            $_SESSION['name']=$user['username'];
            $_SESSION['email']=$user['email'];
        

    header("Location: web design/landing_pg.html");
            
        

        exit();
    }
}

$_SESSION['login_error']="Incorrect email or password";
$_SESSION['active_form']='login';

header("Location: login.php");

exit();
}
?>