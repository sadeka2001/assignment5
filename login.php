<?php 

session_start();
$fp = fopen("./user.txt", "r");
$roles = array();
$emails = array();
$passwords = array();
$names = array();

while (!feof($fp)) {
    $line = fgets($fp);
    $userData = explode(",", $line);
    print_r($userData);
    $roles[] = trim($userData[0]);
    $emails[] = trim($userData[1]);
    $passwords[] = trim($userData[2]);
    $names[] = trim($userData[3]);
}
fclose($fp);
print_r($roles);
print_r($emails);
print_r($passwords);

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
$errorMessage = '';
for ($i = 0; $i < count($roles); $i++) {
    if($roles[$i] == 'admin'){
        if($emails[$i] == $email && $passwords[$i] == $password){
            $_SESSION['name'] = $names[$i];
            $_SESSION['role'] = $roles[$i];
            header("Location: admin_dashboard.php");
        }else{
            $errorMessage = "Incorrect email or password";
        }
    }elseif($roles[$i] == 'manager'){
        if($emails[$i] == $email && $passwords[$i] == $password){
            $_SESSION['name'] = $names[$i];
            $_SESSION['role'] = $roles[$i];
            header("Location: manager_dashboard.php");
        }else{
            $errorMessage = "Incorrect email or password";
        }
    }elseif($roles[$i] == 'user'){
        if($emails[$i] == $email && $passwords[$i] == $password){
            $_SESSION['name'] = $names[$i];
            $_SESSION['role'] = $roles[$i];
            header("Location: user_dashboard.php");
        }else{
            $errorMessage = "Incorrect email or password";
        }
    }
    
}
}
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




<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <div class="fadeIn first">
                <img src="" id="icon" alt="User Icon" />
            </div>
            <h2>Login Form</h2>
            <form action="login.php" method="POST">
                <input type="text" id="email" class="fadeIn second" name="email" placeholder="Enter your email"
                    required>
                <input type="password" id="password" class="fadeIn third" name="password"
                    placeholder="Enter your password" required>

                <input type="submit" class="fadeIn fourth" name="submit">
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
