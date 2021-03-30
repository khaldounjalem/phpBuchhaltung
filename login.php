<?php

error_reporting('E_ALL & ~E_Notice');
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){//check if isset cookie
    die("<h2 style='text-align: center;'>You are already login <br /> >> <a href='logout.php'>Log out</a></h2>");
}else{
    

if($_REQUEST['login']){
//       echo "<pre>";
//	print_r($_REQUEST);
//	echo "</pre>";
//    
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $password = md5($password);

//    include_once 'includes/connect.php';
    require_once("db.php");
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($result);
    
    $errors = array();
    
    if(empty($username) || empty($password)){
        $errors[] = "User name and Password are reqiuerd";
    }elseif ($username != $data['username'] && $password != $data['password']) {
        $errors[] = "Invalid user name or password";
    }  else {
        $cookie = setcookie("user",$data['username'], time()+3600*24);
        if($cookie){
         
        echo '<meta http-equiv="refresh" content="1;url=index.php">';
        }
        
    }
    
}

?>
<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	    <title>Login</title>
	    <link rel="stylesheet" href="css/login.css" type="text/css">
        <link rel="stylesheet" href="css/adminStyle.css" type="text/css">
    
    
        <link rel="shortcut icon" href="images/ico_khaldoun.png" type="image/x-icon">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">		
		<link rel="stylesheet" href="css/base.css">
        <link rel="stylesheet" href="style.css">
</head>

<?php
if($errors){
        foreach ($errors as $error){
            echo '<h2 class="error">'.$error.'</h2>';
        }
    }
?>
    <body>
    		<header>
			<h1>Buchhaltungsprogramm</h1>
		</header>
    		<main class="clearfix">
		
			<section>
				<h2>Willkommen beim Buchhaltungsprogramm</h2>
				
				<p>Bitte melden Sie sich mit ihren Benutzerdaten an um fortzufahren.</p>
				
            <form action="" method="post" class="clearfix" id="login">
				
                <label for="username">Benutzername :&nbsp;&nbsp;&nbsp;&nbsp;   admin</label>
                <input type="text" name="username" id="username" value="<?php echo $username; ?>">

                <label for="password">Passwort  :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; admin</label>
                <input type="password" name="password" id="password" value="<?php echo $password; ?>">

					<input type="submit" name="login" value="Einloggen">
					
<!--					<a href="register.php">Registrieren</a>-->
            </form>
				
			</section>
			
			<aside>
				<h5>khaldoun-mic@hotmail.com</h5>
			</aside>
			
		</main>
    		<footer class="footer footer_color">
      <p>© untitled. All rights reserved. | Photos by fotograph | Designed by Designer</p>
      <ul>
      	<li><a href="#" class="fa fa-twitter" aria-hidden="true"></a></li>
      	<li><a href="#" class="fa fa-facebook" aria-hidden="true"></a></li>
      	<li><a href="#" class="fa fa-google-plus" aria-hidden="true"></a></li>
      	<li><a href="#" class="fa fa-instagram" aria-hidden="true" ></a></li>
      	<li><a href="#" class="fa fa-youtube-play" aria-hidden="true"></a></li>
      </ul>
		</footer>
    
<!--
    <table border="0" class="login">
        
    <form action="login.php" method="post" >
        
        <tr>
            <td colspan="2"><h2> Login To Control Panel </h2></td>
            
        </tr>
        <tr>
            <td width="130px">User Name :    admin</td>
            <td><input type="text" name="username" autofocus/></td>
        </tr>
        <tr>
            <td width="130px">PassWord :      admin</td>
            <td><input type="text" name="password" /></td>
        </tr>
        <tr>
            <td width="130px"><input type="submit" name="login" value="Login" /></td>
            <td></td>
        </tr>
    
    
    </form>    
</table>
-->
    
</body>
</html>
<?php  } ?>