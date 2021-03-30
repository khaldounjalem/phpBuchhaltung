<?php
//
//    echo "<pre>";
//	print_r($_REQUEST);
//	echo "</pre>";

if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
require_once("db.php");
        $id_user = $_REQUEST["id_user"];
if (isset($_REQUEST["save_record"])) {
        $name_user = $_REQUEST["name_user"];
//        $benutzertyp = $_REQUEST["benutzertyp"];
        $address = $_REQUEST["address"];
        $telephon = $_REQUEST["telephon"];
        $number_user = $_REQUEST["number_user"];
        $principal_id = $_REQUEST["principal_id"];    
        $general_id = $_REQUEST["general_id"];    
        $mobile = $_REQUEST["mobile"];
		
		$sql = "UPDATE users
				SET 	number_user=".$number_user.",
                        principal=".$principal_id.",
                        general=".$general_id.",
                        name_user='".$name_user."',
                        address='".$address."',
                        telephon='".$telephon."',
                        mobile='".$mobile."'                        
				WHERE	id_user=".$id_user;
				
		$result = mysqli_query($con, $sql); 
            if(!$result) {
                    echo mysqli_error($con);
                }
            if (!empty($result) ){
              header('location:users.php');
            }
		
	}
     $sql = "SELECT users.id_user, users.principal, users.general, users.number_user, users.name_user_ar, users.name_user, users.art, users.art1, users.benutzertyp, users.address, users.telephon, users.mobile, principal.principal_name_ar, principal.principal_name_en, general.general_name_ar, general.general_name_en
FROM (users LEFT JOIN principal ON users.principal = principal.principal_id) LEFT JOIN general ON users.general = general.general_id
            WHERE id_user=".$id_user;


    $result = mysqli_query($con, $sql);
    
?>
<html>
<head>
<title>PHP Msqli - Edit Record</title>
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
<!--<div style="margin:20px 0px;text-align:right;"><a href="index.php" class="button_link">Back to List</a></div>-->
<div class="frm-add">
<h1 class="demo-form-heading">Edit Record</h1>
    
<form name="frmEdit" action="" method="POST">
    <?php 
        if ($result) {

        $data = mysqli_fetch_assoc($result);
            
	$number_user = $data["number_user"];               
	$name_user = $data["name_user"];
	$benutzertyp = $data["benutzertyp"];
    $address = $data["address"];
    $telephon = $data["telephon"];            
    $mobile = $data["mobile"];            
    ?>            
<!---------------------- list Principal -------->
  <div class="demo-form-row">
	  <label>Pricipal: </label>

   <select class="ns demo-form-field" name="principal_id" required>
<option value="<?php echo $data["principal"] ?>"><?php echo  $data["principal_name_en"]; ?></option>   
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
<option value="<?php echo $data["general"] ?>"><?php echo  $data["general_name_en"]; ?></option>
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
    <input type="text" name="number_user" class="demo-form-field" value="<?php echo $number_user; ?>" required  />
  </div>
  <div class="demo-form-row">
	  <label>User Name: </label>
    <input type="text" name="name_user" class="demo-form-field" value="<?php echo $name_user; ?>" required  />
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
//        }
//            if ($benutzertyp == "Kunde") {
//				
//				$Kunde = "checked";
//				
//			}else {
//				
//				$Lieferant = "checked";
//			}
//		
//            
//        echo"<br>";
//        echo '<div>';	
//		echo '<label for="benutzertyp">Benutzertyp:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>';           
//		echo '<input type="radio" name="benutzertyp" value="Kunde" id="Kunde" '.$Kunde.'>';
//		echo '<for="Kunde">Kunde</label>';
//			
//		echo '<input type="radio" name="benutzertyp" value="Lieferant" id="Lieferant" '.$Lieferant.'>';
//		echo '<for="Lieferant">Lieferant</label>';
//	    echo '</div>';
        
//            ------------ End Rdio ------------
    
?>   
    
    
    
  <div class="demo-form-row">
	  <label>address: </label>
    <input type="text" name="address" class="demo-form-field" value="<?php echo $address; ?>"   />
  </div>
    
  <div class="demo-form-row">
      <label>telephon: </label>
    <input type="text" name="telephon" class="demo-form-field" value="<?php echo $telephon; ?>"   />
  </div>
  <div class="demo-form-row">
      <label>Mobile: </label>
    <input type="text" name="mobile" class="demo-form-field" value="<?php echo $mobile; ?>"   />
  </div>    
    
    <div class="demo-form-row">
        <?php
		}
//    }
	?>  
  <input name="save_record" type="submit" value="Save" class="demo-form-submit">
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