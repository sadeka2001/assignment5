<?php
session_start();
if($_SESSION['role'] == 'user' ){
    header("Location: login.php");
}
$id = $_GET['id'];
$fp = fopen(".user.txt", "r");
$roles = array();
$emails = array();
$passwords = array();
$names = array();

while (!feof($fp)) {
    $line = fgets($fp);
    $userData = explode(",", $line);
    $roles[] = trim($userData[4]);
    $emails[] = trim($userData[1]);
    $passwords[] = trim($userData[2]);
    $names[] = trim($userData[0]);
}
$data = file('./user.txt');
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $data[$id] = "$role, $email, $password, $name";
    file_put_contents('.user.txt', $data);
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
                <input type="text" value="<?php echo $names[$id]; ?>" id="name" class="fadeIn second" name="name"  placeholder="Enter your Name" required>
                <input type="text" id="email"value="<?php echo $emails[$id]; ?> class="fadeIn third" name="email" placeholder="Enter your email" required>
                <input type="password" value="<?php echo $passwords[$id]; ?>" id="password" class="fadeIn third" name="password" placeholder="Enter your password" required>
                <div class="col-8">
                        <label for="roles" class="fadeIn third">Select
                            an option</label>
                        <select name="role" id="roles"
                            class="">
                            <option selected>Select a Role</option>
                            <option value="admin"  <?php if($roles[$id] == 'admin') echo 'selected'; ?>>Admin</option>
                            <option value="manager"  <?php if($roles[$id] == 'manager') echo 'selected'; ?>>Manager</option>
                            <option value="user"  <?php if($roles[$id] == 'user') echo 'selected'; ?>>User</option>
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
