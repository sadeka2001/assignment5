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
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    
    $lines = file("user.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
       
        $data = explode(",", $line);
        if ($data[1] == $email && password_verify($password, $data[2])) {
           
            $_SESSION["username"] = $data[0];
            $_SESSION["role"] = $data[3];
           

            if ($_SESSION['role'] === 'admin') {
                header('Location: admin_dashboard.php');
            } elseif ($_SESSION['role'] === 'manager') {
                header('Location: manager_dashboard.php');
            } else {
                header('Location: user_dashboard.php');
            }
            exit();
        }
    }
   
   // header("Location: login.php");
}
?>


<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <div class="fadeIn first">
                <img src="" id="icon" alt="User Icon" />
            </div>
            <h2>Login Form</h2>
            <form action="login.php" method="post">
                <input type="text" id="email" class="fadeIn second" name="email" placeholder="Enter your email" required>
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="Enter your password"required>
                <input type="submit" class="fadeIn fourth" value="Submit">
            </form>

            <div id="formFooter">
                <a class="underlineHover" href="#">Forgot Password?</a>
            </div>

        </div>
    </div>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>