
<?php 
session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

</head>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $role = "user"; 

    $user = "$username,$email,$password,$role" . PHP_EOL;
    file_put_contents("user.txt", $user, FILE_APPEND);
    
  
    header("Location: login.php");
}
?>

<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <h2>Register Form</h2>

            <form action="register.php" method="post">
                <input type="text" id="username" class="fadeIn second" name="username"  placeholder="Enter your Name" required>
                <input type="text" id="email" class="fadeIn third" name="email" placeholder="Enter your email" required>
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="Enter your password" >
                <input type="submit" class="fadeIn fourth" value="submit">
            </form>
        </div>
    </div>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>