<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
require_once("db.php");
if (isset($_REQUEST["add_record"])) {
		$name_user = $_REQUEST["name_user"];
		$benutzertyp = $_REQUEST["benutzertyp"];
    	$address = $_REQUEST["address"];
        $telephon = $_REQUEST["telephon"];
        $mobile = $_REQUEST["mobile"];    
        $number_user = $_REQUEST["number_user"];
        $principal_id = $_REQUEST["principal_id"];    
        $general_id = $_REQUEST["general_id"];

		$sql = "INSERT INTO users 
                (principal, general,number_user, name_user, benutzertyp, address, telephon, mobile) 
				VALUES 	(".$principal_id.",".$general_id.",".$number_user.",'".$name_user."','".$benutzertyp."','".$address."','".$telephon."','".$mobile."')";

		// Query absenden
		$result = mysqli_query($con, $sql);

		if(!$result) {
			echo mysqli_error($con);
		}
    if (!empty($result) ){
	  header('location:users.php');
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
.demo-form-row input{position: absolute;left:200px;}    
.demo-form-row select{position: absolute;left:200px;} 
label{font-size: 20px; line-height: 40px;}     
.demo-form-field{width:300px;padding:10px;font-size: 20px;}
.demo-form-submit{color:#FFF;background-color:#414444;padding:10px 50px;border:0px;cursor:pointer;border-radius: 4px;}
</style>
</head>
<body>
<div style="margin:20px 0px;text-align:right;"><a href="users.php" class="button_link">Back to List</a></div>
<div class="frm-add">
<h1 class="demo-form-heading">Add New Record</h1>

<form name="frmAdd" action="" method="POST">
  <!---------------------- list Principal -------->
  <div class="demo-form-row">
	  <label>Pricipal: </label>

   <select class="ns demo-form-field" name="principal_id" required>
                    <option value = "">-- Pricipal --</option>
         <?php
            $qry = "select * from principal";
             $result = mysqli_query($con, $qry);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='$row[principal_id]'>$row[principal_name_en]</option>";
            }
         ?>

    </select> 
    </div>
  <!---------------------- list Genearl -------->
  <div class="demo-form-row">
	  <label>General: </label>

   <select class="ns demo-form-field" name="general_id" required>
                    <option value = "">-- General --</option>
         <?php
            $qry = "select * from general";
             $result = mysqli_query($con, $qry);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='$row[general_id]'>$row[general_name_en]</option>";
            }
         ?>

    </select> 
    </div>
<!--   ------------------------ end  --------->      
  
    <div class="demo-form-row">
	  <label>Number User: </label>
	  <input type="text" name="number_user" class="demo-form-field"  required />
  </div>
    <div class="demo-form-row">
	  <label>User Name: </label>
	  <input type="text" name="name_user" class="demo-form-field"  required />
  </div>
<?php
//                ----------------  Radio ----------------
//		$Kunde = "";
//		$Lieferant = "";
//		
//		if (isset($_REQUEST["benutzertyp"]) ) {
//			
//			if ($_REQUEST["benutzertyp"] == "Kunde") {
//				
//				$Kunde = "checked";
//				
//			}else {
//				
//				$Lieferant = "checked";
//			}
//		}
//        echo"<br>";
//        echo '<div>';	
//		echo '<label for="benutzertyp">Benutzertyp:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>';           
//		echo '<input type="radio" name="benutzertyp" value="Kunde" id="Kunde" '.$Kunde.'>';
//		echo '<for="Kunde">Kunde</label>';
//			
//		echo '<input type="radio" name="benutzertyp" value="Lieferant" id="Lieferant" '.$Lieferant.'>';
//		echo '<for="Lieferant">Lieferant</label>';
//	    echo '</div>';
            
//            ------------ End Rdio ------------
    
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
	  <label>Mobile: </label>
	  <input type="text" name="mobile" class="demo-form-field"   />
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