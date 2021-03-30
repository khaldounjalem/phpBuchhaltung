<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
//   echo "<pre>";
//	print_r($_REQUEST);
//	echo "</pre>";
session_start();
 $id_Invoice=$_SESSION["id_Invoice"];
require_once("db.php");
if (isset($_REQUEST["add_record"])) {
		$id_artikel = $_REQUEST["id_artikel"];
		$quantity = $_REQUEST["quantity"];
    	$price = $_REQUEST["price"];
	    $id_Invoice = $_SESSION["id_Invoice"];
        $id_lager = $_REQUEST["id_lager"];
        $rabatt_rd = $_REQUEST["rabatt_rd"];

		$sql = "INSERT INTO invoice_details 
				(id_Invoice, statement_Invoice_details,lager_detail_invoice, quantity, price, rabatt_rd) 
				VALUES 	(".$id_Invoice.",".$id_artikel.",".$id_lager.",".$quantity.",".$price.",".$rabatt_rd.")";

		// Query absenden
		$result = mysqli_query($con, $sql);

		if(!$result) {
			echo mysqli_error($con);
		}
    if (!empty($result) ){
?>
<div style="text-align:right;">
    <a href="rechnungen_detail.php?id_Invoice=<?php echo $_SESSION["id_Invoice"]; ?>" class="button_link">Zuruck Rechnung Detail</a>
</div>
<?php
//	  header('location:index.php');
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
<!--<div style="margin:20px 0px;text-align:right;"><a href="index.php" class="button_link">Back to List</a></div>-->
<div class="frm-add">
<h1 class="demo-form-heading">Add New Record</h1>

<form name="frmAdd" action="" method="POST">
  
  <!---------------------- list kauf -------->
  <div class="demo-form-row">
	  <label>Artikel: </label>

   <select class="ns demo-form-field" name="id_artikel" required>
                    <option value = "">-- Add --</option>
         <?php
            $qry2 = "select * from artikel";
             $result2 = mysqli_query($con, $qry2);
            while ($row = mysqli_fetch_assoc($result2)) {
                echo "<option value='$row[id_artikel]'>$row[name_artikel]</option>";
            }
         ?>

    </select> 
    </div>
  <!---------------------- list lager -------->
  <div class="demo-form-row">
	  <label>Lager: </label>

   <select class="ns demo-form-field" name="id_lager" required>
                    <option value = "">-- Add --</option>
         <?php
            $qry2 = "select * from lager";
             $result2 = mysqli_query($con, $qry2);
            while ($row = mysqli_fetch_assoc($result2)) {
                echo "<option value='$row[id_lager]'>$row[name_lager]</option>";
            }
         ?>

    </select> 
    </div>
<!--   ------------------------ end list --------->    
    <div class="demo-form-row">
	  <label>Menge: </label>
	  <input type="text" name="quantity" class="demo-form-field"  required />
  </div>

  <div class="demo-form-row">
	  <label>Einzelpreis: </label>
	  <input type="text" name="price" class="demo-form-field"  required />
  </div>
  <div class="demo-form-row">
	  <label>Rabatt: </label>
	  <input type="text" name="rabatt_rd" class="demo-form-field"  required />
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