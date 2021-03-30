<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
require_once("db.php");
if (isset($_REQUEST["add_record"])) {
		$id_artikel = $_REQUEST["id_artikel"];
		$id_lager = $_REQUEST["id_lager"];
        $anzahl = $_REQUEST["anzahl"];
        $price = $_REQUEST["price"];
        $date_lagerartikel = $_REQUEST["date_lagerartikel"];

		$sql = "INSERT INTO lagerartikel 
						(id_artikel, id_lager, anzahl, price, date_lagerartikel) 
				VALUES 	(".$id_artikel.",".$id_lager.",".$anzahl.",".$price.",'".$date_lagerartikel."')";

		// Query absenden
		$result = mysqli_query($con, $sql);

		if(!$result) {
			echo mysqli_error($con);
		}
    if (!empty($result) ){
	  header('location:lagerartikel.php');
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
<div style="margin:20px 0px;text-align:right;"><a href="lagerartikel.php" class="button_link">Back to List</a></div>
<div class="frm-add">
<h1 class="demo-form-heading">Add New Record</h1>

<form name="frmAdd" action="" method="POST">
    <!---------------------- list Lager -------->
  <div class="demo-form-row">
	  <label>Name Lager: </label>

   <select class="ns demo-form-field" name="id_lager" required>
                    <option value = "">-- Lager --</option>
         <?php
            $qry33 = "select * from lager";
             $result33 = mysqli_query($con, $qry33);
            while ($row33 = mysqli_fetch_assoc($result33)) {
                echo "<option value='$row33[id_lager]'>$row33[name_lager]</option>";
            }
         ?>

    </select> 
    </div>    
    <!---------------------- list Artikel -------->
  <div class="demo-form-row">
	  <label>Name Artikel: </label>

   <select class="ns demo-form-field" name="id_artikel" required>
                    <option value = "">-- Artikel --</option>
         <?php
            $qry22 = "select * from artikel";
             $result22 = mysqli_query($con, $qry22);
            while ($row22 = mysqli_fetch_assoc($result22)) {
                echo "<option value='$row22[id_artikel]'>$row22[name_artikel]</option>";
            }
         ?>

    </select> 
    </div>


<!--    ------------------->    

    <div class="demo-form-row">
	  <label>Anzahl: </label>
	  <input type="text" name="anzahl" class="demo-form-field"  required />
  </div>
  <div class="demo-form-row">
	  <label>Price: </label>
	  <input type="text" name="price" class="demo-form-field"  required />
  </div>
   <div class="demo-form-row">
	  <label>Datum: </label>
	  <input type="date" name="date_lagerartikel" class="demo-form-field"  required />
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