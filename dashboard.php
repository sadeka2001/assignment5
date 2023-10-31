<?php
session_start();
if ($_SESSION["role"] == "admin") {
    header("Location: admin_dashboard.php");
  
}

elseif ($_SESSION["role"] == "user") {
    header("Location: user_dashboard.php");
  
}
else {
    header("Location: manager_dashboard.php");
    exit();
}

?>

