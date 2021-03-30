<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
//   echo "<pre>";
//	print_r($_REQUEST);
//	echo "</pre>";
require_once("db.php");
if (isset($_REQUEST["add_record"])) {
		$id_user = $_REQUEST["id_user"];
		$statement_invoice = $_REQUEST["statement_invoice"];
    	$number_Invoice = $_REQUEST["number_Invoice"];
        $date_Invoice = $_REQUEST["date_Invoice"];
        $id_seller = $_REQUEST["id_seller"];
        $retoure = $_REQUEST["retoure"];
        $sales = $_REQUEST["sales"];
        $rabatt_r = $_REQUEST["rabatt_r"];    


		$sql = "INSERT INTO invoice 
                (id_user, id_seller, date_Invoice, statement_invoice, number_Invoice, retoure, sales, rabatt_r) 
				VALUES 	(".$id_user.", ".$id_seller.", '".$date_Invoice."', '".$statement_invoice."',".$number_Invoice.",'".$retoure."','".$sales."',".$rabatt_r.")";

		// Query absenden
		$result = mysqli_query($con, $sql);

		if(!$result) {
			echo mysqli_error($con);
		}
    if (!empty($result) ){
	  header('location:index.php');
	}
}
?>
<html>
<head>
<title>PHP Mysqli - Add New Record</title>
<style>
/*    <link href="style2.css" rel="stylesheet" type="text/css" />*/
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
<div style="margin:20px 0px;text-align:right;"><a href="index.php" class="button_link">Back to List</a></div>
<div class="frm-add">
<h1 class="demo-form-heading">Add New Record</h1>

<form name="frmAdd" action="" method="POST">
  <!---------------------- list Seller -------->
  <div class="demo-form-row">
	  <label>Name Verkaufer: </label>

   <select class="ns demo-form-field" name="id_seller" required>
                    <option value = "">-- Verkaufer --</option>
         <?php
            $qry22 = "select * from seller";
             $result22 = mysqli_query($con, $qry22);
            while ($row22 = mysqli_fetch_assoc($result22)) {
                echo "<option value='$row22[id_seller]'>$row22[name_seller]</option>";
            }
         ?>

    </select> 
    </div>

  <!---------------------- list verkaufer -------->
  <div class="demo-form-row">
	  <label>Name: </label>

   <select class="ns demo-form-field" name="id_user" required>
                    <option value = "">-- Name --</option>
         <?php
            $qry2 = "select * from users
            WHERE ((number_user Between 161001 AND 162000 ) OR (number_user Between 261001 AND 262000 )) ORDER BY users.name_user";
             $result2 = mysqli_query($con, $qry2);
            while ($row = mysqli_fetch_assoc($result2)) {
                echo "<option value='$row[id_user]'>$row[name_user]</option>";
            }
         ?>

    </select> 
    </div>
<!--   ------------------------ end list --------->
  <div class="demo-form-row">
	  <label>Datum: </label>
	  <input type="date" name="date_Invoice" class="demo-form-field"  required />
  </div><br>
    <div class="demo-form-row">
	  <label>Beschreibung: </label>
	  <input type="text" name="statement_invoice" class="demo-form-field"  required />
  </div>
  <div class="demo-form-row">
	  <label>Rechnung Nr: </label>
	  <input type="text" name="number_Invoice" class="demo-form-field"  required />
  </div>
  <div class="demo-form-row">
	  <label>Rabatt: </label>
	  <input type="text" name="rabatt_r" class="demo-form-field"  required />
  </div>    
<?php 
//                ----------------  sales ----------------
		$verkauf = "";
		$einkauf = "";
		
		if (isset($_REQUEST["sales"]) ) {
			
			if ($_REQUEST["sales"] == "verkauf") {
				
				$verkauf = "checked";
				
			}else {
				
				$einkauf = "checked";
			}
		}
        echo"<br>";
        echo '<div>';	
		echo '<label for="sales">sales:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>';           
		echo '<input type="radio" name="sales" value="verkauf" id="verkauf" '.$verkauf.'>';
		echo '<for="verkauf">verkauf</label>';
			
		echo '<input type="radio" name="sales" value="einkauf" id="einkauf" '.$einkauf.'>';
		echo '<for="einkauf">einkauf</label>';
	    echo '</div>';
//                ----------------  Radio ----------------
		$Yes = "";
		$No = "checked";
		
		if (isset($_REQUEST["retoure"]) ) {
			
			if ($_REQUEST["retoure"] == "Yes") {
				
				$Yes = "checked";
				
			}else {
				
				$No = "checked";
			}
		}
        echo"<br>";
        echo '<div>';	
		echo '<label for="retoure">Retoure:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>';           
		echo '<input type="radio" name="retoure" value="Yes" id="Yes" '.$Yes.'>';
		echo '<for="Yes">Yes</label>';
			
		echo '<input type="radio" name="retoure" value="No" id="No" '.$No.'>';
		echo '<for="No">No</label>';
	    echo '</div>';
            
//            ------------ End Rdio ------------    
?>
  <div class="demo-form-row">
	  <input name="add_record" type="submit" value="Add" class="demo-form-submit">
  </div>  <br>
  </form>
</div> 
    <?php
            }  else {
    header("Location: login.php");//if there is no cookie
}
            ?> 
</body>
</html>