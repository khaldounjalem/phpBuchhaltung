<?php
//// Include config file
require_once 'db.php';
// 
//// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
// 
//// Processing form data when form is submitted
//if($_SERVER["REQUEST_METHOD"] == "POST"){
 if(isset($_REQUEST['signup'])){
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement ----------------------------------------------
		require_once 'db.php';
		$username=$_REQUEST["username"];
		 $query = "SELECT * FROM user WHERE username='$username'";
		
        $result = mysqli_query($con, $query);
		if ($result){
				  $rows = mysqli_num_rows($result);
//			      printf("Result set has %d rows.\n",$rows);
					if($rows >=1){
					$username_err = "This username is already taken.";	
//						 echo "Welcome: " .$_POST['username'];
					}
		}
     }
    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
            $username = $_REQUEST["username"];
            $password = $_REQUEST["password"];
            $password = md5($password);   
        require_once 'db.php';
         $sql = "INSERT INTO user 
						(username, password) 
				VALUES 	('".$username."','".$password."')";
         $result = mysqli_query($con, $sql);
        if($result) {
                // Redirect to login page
                header("location: login.php");
//			echo "done";
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
     // Close connection
//    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/base.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 0px; }
        .SignUp{
/*                width:360px;*/
/*                margin:5px auto;*/
                font:Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
/*                border-radius:10px;*/
/*                border:2px solid #ccc;*/
                padding:0px 40px 25px;
                margin-top:0px; 
        }
    </style>
</head>
<body>
		
		<header>
			<h1>Comcave Ticketsystem</h1>
		</header>
		
		<main class="clearfix">
		
			<section>    


    
    <div class="wrapper SignUp">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="register.php" method="post">
            <div class="form-group" <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>>
                <label>Username:<sup>*</sup></label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group" <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>>
                <label>Password:<sup>*</sup></label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group" <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>>
                <label>Confirm Password:<sup>*</sup></label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" name="signup" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</section>
			
<aside>
    <h3>Nebeninhalt</h3>
</aside>
			
</main>

<footer>
    Impressum
</footer>		
</body>
</html>