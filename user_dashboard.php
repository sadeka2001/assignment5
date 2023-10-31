<?php
session_start();

if ($_SESSION["role"] !== "user") {
    header("Location: unauthorized.php");
    exit();
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

$data = file('./user.txt');
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>
    <h2>Welcome, USer</h2>
    <p>Role Management Options:</p>
  <table>
<table><tr>
<th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
    </tr>
    <?php for ($i = 0; $i < count($data); $i++){ ?>
    <tr>
        <td>#<?php echo $i + 1; ?></td>
        <td><?php echo $names[$i]; ?></td>
        <td><?php echo $emails[$i]; ?></td>
        <td><?php echo ucwords($roles[$i]); ?></td>
    </tr>
    <?php } ?>
</table>

  </table>
     
      
        
    </ul>
    <a href="logout.php">Logout</a>
</body>
</html>
