<?php
/* ======== Permission Check ======== */
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
}
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $fp = fopen("./user.txt", "a");
    fwrite($fp, "$role, $email, $password, $name\n");
    fclose($fp);
    header("Location: admin_dashboard.php");
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
            <h2>Create Form</h2>

            <form action="create_role.php" method="post">
                <input type="text" id="name" class="fadeIn second" name="name" placeholder="Enter your Name" required>
                <input type="text" id="email" class="fadeIn third" name="email" placeholder="Enter your email" required>
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="Enter your password" required>
                <div class="col-8">
                    <label for="roles" class="fadeIn third">Select
                        an option</label>
                    <select name="role" id="roles" class="">
                        <option selected>Select a Role</option>
                        <option value="admin">Admin</option>
                        <option value="manager">Manager</option>
                        <option value="user">User</option>
                    </select>
                </div>

                <input type="submit" class="fadeIn fourth" value="submit">
            </form>
        </div>
    </div>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>


</html>