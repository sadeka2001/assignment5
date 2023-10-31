<?php
session_start();
if ($_SESSION["role"] != "admin") {
    header("Location: login.php");
}

$fileName = './user.txt';
$fp = fopen($fileName, 'a+');
$names = array();
$emails = array();
$passwords = array();
$roles = array();


while (!feof($fp)) {
    $line = fgets($fp);
    $userData = explode(",", $line);
    $names[] = trim($userData[0]);
    $emails[] = trim($userData[1]);
    $passwords[] = trim($userData[2]);
    $roles[] = trim($userData[3]);
}
$data = file('.user.txt');
if (isset($_GET['id']) && isset($_GET['id']) != NULL) {
    $id = $_GET['id'];
    unset($data[$id]);
    file_put_contents('./user.txt', $data);
    header("Location: admin_dashboard.php");
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
</head>

<body>
    <div class="container">

        <h2>Welcome, Admin</h2>
        <p>Role Management Options:</p>
        <div class="admin">
            <h4>Admin</h4>
            <p><?php
                $data = file('./user.txt');
                echo count(array_filter($data, function ($line) {
                    return strpos($line, 'admin') !== false;
                }))
                ?></p>
        </div>


        <div class="manager"></div>
        <h4>Manager</h4>
        <p><?php
            $data = file('./user.txt');
            echo count(array_filter($data, function ($line) {
                return strpos($line, 'manager') !== false;
            }))
            ?></p>
    </div>
    <div class="user">
        <h4>User</h4>
        <p><?php
            $data = file('./user.txt');
            echo count(array_filter($data, function ($line) {
                return strpos($line, 'user') !== false;
            }))
            ?></p>
    </div>

    <div>
        <a href="create_role">Add</a>
    </div>


    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        <?php for ($i = 0; $i < count($data); $i++) { ?>
            <tr>
                <td>#<?php echo $i + 1; ?></td>
                <td><?php echo $names[$i]; ?></td>
                <td><?php echo $emails[$i]; ?></td>
                <td><?php echo ucwords($roles[$i]); ?></td>
                <td><a href="edit_role.php?id=<?php echo $i; ?>">edit</a>
                    <a href="?id=<?php echo $i; ?>">delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    </div> <a href="logout.php">Logout</a>
</body>

</html>