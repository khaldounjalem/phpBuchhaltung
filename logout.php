<?php

setcookie("user");
header("Location: login.php");
echo "<h2 style='text-align: center;'>You are Logged out <br /> >> <a href='login.php'>Login</a></h2>";
?>
