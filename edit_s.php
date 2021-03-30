<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
require_once("db.php");
        $id_seller = $_REQUEST["id_seller"];
if (isset($_REQUEST["save_record"])) {
        $number_seller = $_REQUEST["number_seller"];
        $name_seller = $_REQUEST["name_seller"];
        $address = $_REQUEST["address"];
        $telephon = $_REQUEST["telephon"];
		
		$sql = "UPDATE seller
				SET 	number_seller=".$number_seller.",
                        name_seller='".$name_seller."',
                        address='".$address."',
                        telephon='".$telephon."'
				WHERE	id_seller=".$id_seller;
				
		$result = mysqli_query($con, $sql); 
            if(!$result) {
                    echo mysqli_error($con);
                }
            if (!empty($result) ){
              header('location:seller.php');
            }
		
	}
     $sql = "SELECT seller.id_seller, seller.number_seller, seller.name_seller, seller.address, seller.telephon
            FROM seller
            WHERE id_seller=".$id_seller;


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
.demo-form-row input{position: absolute;left:200px;}    
.demo-form-row select{position: absolute;left:200px;} 
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
            
	$number_seller = $data["number_seller"];               
	$name_seller = $data["name_seller"];
    $address = $data["address"];
    $telephon = $data["telephon"];            
    ?>            

  <div class="demo-form-row">
	  <label>Nr Verkaufer: </label>
    <input type="text" name="number_seller" class="demo-form-field" value="<?php echo $number_seller; ?>" required  />
  </div>
  <div class="demo-form-row">
	  <label>Name Verkaufer: </label>
    <input type="text" name="name_seller" class="demo-form-field" value="<?php echo $name_seller; ?>" required  />
  </div>
 <?php

?>   

  <div class="demo-form-row">
	  <label>Address: </label>
    <input type="text" name="address" class="demo-form-field" value="<?php echo $address; ?>"   />
  </div>
    
  <div class="demo-form-row">
      <label>Telephon: </label>
    <input type="text" name="telephon" class="demo-form-field" value="<?php echo $telephon; ?>"   />
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