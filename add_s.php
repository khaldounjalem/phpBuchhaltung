<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
require_once("db.php");
if (isset($_REQUEST["add_record"])) {
		$number_seller = $_REQUEST["number_seller"];
		$name_seller = $_REQUEST["name_seller"];
    	$address = $_REQUEST["address"];
        $telephon = $_REQUEST["telephon"];



		$sql = "INSERT INTO seller 
						(number_seller, name_seller, address, telephon) 
				VALUES 	(".$number_seller.",'".$name_seller."','".$address."','".$telephon."')";

		// Query absenden
		$result = mysqli_query($con, $sql);

		if(!$result) {
			echo mysqli_error($con);
		}
    if (!empty($result) ){
	  header('location:seller.php');
	}
}
?>
<html>
<head>
<title>PHP Mysqli - Add New Record</title>
<style>
body{width:615px;font-family:arial;letter-spacing:1px;line-height:20px;}
.button_link {color:#FFF;text-decoration:none; background-color:#428a8e;padding:10px;border-radius: 4px;}
.frm-add {position: relative;width:615px;border: #c3bebe 1px solid;
    padding: 30px;}
.demo-form-heading {margin-top:0px;font-weight: 500;}	
.demo-form-row{margin-top:20px;}
.demo-form-row input{position: absolute;left:220px;}    
.demo-form-row select{position: absolute;left:220px;} 
label{font-size: 20px; line-height: 40px;}     
.demo-form-field{width:300px;padding:10px;font-size: 20px;}
.demo-form-submit{color:#FFF;background-color:#414444;padding:10px 50px;border:0px;cursor:pointer;border-radius: 4px;}
</style>
</head>
<body>
<div style="margin:20px 0px;text-align:right;"><a href="seller.php" class="button_link">Back to List</a></div>
<div class="frm-add">
<h1 class="demo-form-heading">Add New Record</h1>

<form name="frmAdd" action="" method="POST">
  
    <div class="demo-form-row">
	  <label>Number Verkaufer: </label>
	  <input type="text" name="number_seller" class="demo-form-field"  required />
  </div>
    <div class="demo-form-row">
	  <label>Verkaufer: </label>
	  <input type="text" name="name_seller" class="demo-form-field"  required />
  </div>
<?php
    
?>
  <div class="demo-form-row">
	  <label>Address: </label>
	  <input type="text" name="address" class="demo-form-field"   />
  </div>
  <div class="demo-form-row">
	  <label>Telephon: </label>
	  <input type="text" name="telephon" class="demo-form-field"   />
  </div>   
    
	
  <div class="demo-form-row">
	  <input name="add_record" type="submit" value="Add" class="demo-form-submit">
  </div><br>
  </form>
</div> 
    <?php
            }  else {
    header("Location: login.php");//if there is no cookie
}
            ?> 
</body>
</html>