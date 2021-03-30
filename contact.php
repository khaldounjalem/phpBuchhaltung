<?php 
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
require_once("db.php");
if(!empty($_REQUEST['contactErrors'])) {
		$search_keyword = $_POST['contactErrors'];}

?>
<!doctype html>
<html>
<head>     
<meta charset="utf-8"> 
<title>Rechnung</title>
<link rel="shortcut icon" href="images/ico_khaldoun.png" type="image/x-icon">
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/style1.css" rel="stylesheet">
<link href="style.css" rel="stylesheet" type="text/css">
<link href="contact.css" rel="stylesheet" type="text/css">
<style>
 
/*.block2{padding-top:2px;padding-bottom:2px;background: rgba(39, 39, 80, 0.41);}*/
    #wrap{width: 100%; box-shadow: 4px 4px 8px #061738;background: #fff;}
    @font-face{
    font-family: 'Jenna Sue';
    src: url('../fonts/JennaSue-webfont.eot');
    src: local("Jenna Sue"), url('../fonts/JennaSue-webfont.ttf');}
    .block33{
    padding-top: 30px;
    padding-bottom: 0px;
/*    border: 1px solid #d5d5d5;*/
    padding-left: 50px;
}
</style>
<script>
        function confirmDelete(delUrl) {
          if (confirm("Are you sure you want to delete")) {
           document.location = delUrl;
          }
        }
</script>    
</head>
<body>
<!--  Block 1   Menu -->
<div class="container-fluid">
<!--<div class="container">-->
<div class="row">
  <div class="col-md-12">
  <nav class="navbar navbar-default navbar-inverse navbar-static-top ">
    <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
          <a class="navbar-brand" href="#">Khal<span>doun</span></a></div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="defaultNavbar1">
          <ul class="nav navbar-nav navbar-right">
            <li class="active" ><a href="contact.php">Contact<span class="sr-only">(current)</span></a></li>
            <li><a href="index.php">Rechnung</a></li>
            <li><a href="day.php">Täglich</a></li>
                <li><a href="users.php">Kunden</a></li>
                <li><a href="seller.php">Verkauver</a></li>
                <li><a href="material.php">Artikel</a></li>
                <li><a href="lager.php">Lager</a></li>
                <li><a href="lagerartikel.php">Lager/Artikel</a></li> 
                <li><a href="logout.php">Logout</a></li>              
<!--
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Listen<span class="caret"></span></a>
              <ul class="dropdown-menu">

              </ul>
            </li>
-->
          </ul>
        </div>
    </nav>
</div></div></div>
<!--    </div>-->
    <!----------------- End Menu ---------     -->

<?php
if (isset($_REQUEST["send"])) {
		
    $name = strip_tags($_REQUEST['name']);
    $email = strip_tags($_REQUEST['email']);
    $subject = strip_tags($_REQUEST['subject']);
    $content = strip_tags(addslashes($_REQUEST['content']));
    $contactErrors = array();
    
    if(empty($name) || empty($email) || empty($subject) || empty($content)){
       $contactErrors[] = "All Fields Are Requierd"; 
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $contactErrors[] = "This is not Email";
    }  else {
        
        		$contact_sql = "INSERT INTO contact 
						(name,email,subject,content,type) 
				VALUES 	('".$name."','".$email."','".$subject."','".$content."','user')";
           $result = mysqli_query($con, $contact_sql);


            if($result) {
                echo '<h2 class="success">Message send  successfully<h2>';
                echo '<meta http-equiv="refresh" content="3;url=contact.php">'; 
        }
    		if(!$result) {
			echo mysqli_error($con);
		} 

       		
    }
    
    
}
?>    

	<section class="container threeColum clearfix">
    <div id="tbox3">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2511.339448470993!2d7.126991620353043!3d50.99139915622052!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47bed7dbca719627%3A0x80524de4a065e18a!2sBergisch+Gladbach+(S)!5e0!3m2!1sar!2sde!4v1504633883840" width="500" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
 
	</div>
		<div id="tbox1">
			<h1>Kontakt Uns</h1>
			<p>
				Wenn Sie eine Frage, einen Kommentar oder einen Vorschlag haben.
			</p>
                <?php
                if(isset($contactErrors)){
                    foreach ($contactErrors as $error){
                        echo '<h2 class="error">'.$error.'</h2>';
                    }
                }

                ?>
			<form action="contact.php" method="post" class="message">
				<input type="text" value="Name" name="name" autofocus onFocus="this.select(); " onMouseOut="javascript:return false;"/>
				<input type="text" value="Email" name="email" onFocus="this.select();" onMouseOut="javascript:return false;"/>
				<input type="text" value="Subject" name="subject" onFocus="this.select();" onMouseOut="javascript:return false;"/>
				<textarea name="content"></textarea>
				<input type="submit" value="Send" name="send"/>
			</form>
		</div>

    <div id="tbox2">    

			<p>For Inquiries Please Call: 	</p>
			<p>Or you can visit us at: <span>.</span></p>
                <p>khaldoun-mic@hotmail.com</p>

    </div>

</section>  
<div clas="clearfix"></div>

  <script src="js/jquery-1.11.3.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/plugins.js"></script> 

    <?php
            }  else {
    header("Location: login.php");//if there is no cookie
}
            ?> 
    </body>
</html>