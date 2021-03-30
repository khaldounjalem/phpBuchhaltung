<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
//     echo "<pre>";
//	print_r($_REQUEST);
//	echo "</pre>";
    
require_once("db.php");
session_start();
	$id_Invoice = $_REQUEST["id_Invoice"];
    $_SESSION["id_Invoice"]=$id_Invoice;
if (isset($_REQUEST["save_record"])) {
        $id_user = $_REQUEST["id_user"];
        $statement_invoice = $_REQUEST["statement_invoice"];
        $number_Invoice = $_REQUEST["number_Invoice"];
        $id_Invoice = $_REQUEST["id_Invoice"];
        $date_Invoice = $_REQUEST["date_Invoice"];
        $id_seller = $_REQUEST["id_seller"];
        $retoure = $_REQUEST["retoure"];
        $sales = $_REQUEST["sales"];     
        $rabatt_r = $_REQUEST["rabatt_r"];     
		
		$sql = "UPDATE invoice
				SET 	id_user=".$id_user.",
                        id_seller=".$id_seller.",
                        date_Invoice='".$date_Invoice."',
						statement_invoice='".$statement_invoice."',
                        number_Invoice=".$number_Invoice.",
                        retoure='".$retoure."',
                        sales='".$sales."',
                        rabatt_r=".$rabatt_r."
				WHERE	id_Invoice=".$_SESSION["id_Invoice"];
       session_destroy();
				
		$result = mysqli_query($con, $sql); 
            if(!$result) {
                    echo mysqli_error($con);
                }
            if (!empty($result) ){
              header('location:index.php');
            }
		
	}

 $sql = "SELECT invoice.id_Invoice, invoice.active, invoice.id_user, invoice.id_seller, invoice.date_Invoice, invoice.statement_invoice, invoice.number_Invoice, invoice.art, invoice.retoure, invoice.sales, invoice.rabatt_r, users.id_user, users.number_user, users.name_user, users.benutzertyp, users.address, users.telephon, seller.id_seller, seller.name_seller
FROM seller RIGHT JOIN (users RIGHT JOIN invoice ON users.id_user = invoice.id_user) ON seller.id_seller = invoice.id_seller
WHERE id_Invoice=".$_REQUEST["id_Invoice"];

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
<div style="margin:20px 0px;text-align:right;"><a href="index.php" class="button_link">Back to List</a></div>
<div class="frm-add">
<h1 class="demo-form-heading">Edit Record</h1>
    
<form name="frmEdit" action="" method="POST">
    <?php 
        if ($result) {

              $data = mysqli_fetch_assoc($result);
               
	$id_user = $data["id_user"];
    $date_Invoice = $data["date_Invoice"];
	$statement_invoice = $data["statement_invoice"];
    $number_Invoice = $data["number_Invoice"]; 
    $id_Invoice = $_REQUEST["id_Invoice"];
    $id_seller = $data["id_seller"];            
    $retoure = $data["retoure"];            
    $sales = $data["sales"];             
    $rabatt_r = $data["rabatt_r"];               
    ?>            
  <!---------------------- list Seller -------->
  <div class="demo-form-row">
	  <label>Name Verkaufer: </label>

   <select class="ns demo-form-field" name="id_seller" required>
                    <option value ="<?php echo $data["id_seller"] ?>"><?php echo  $data["name_seller"]; ?></option>
         <?php
            $qry22 = "select * from seller";
             $result22 = mysqli_query($con, $qry22);
            while ($row22 = mysqli_fetch_assoc($result22)) {
                echo "<option value='$row22[id_seller]'>$row22[name_seller]</option>";
            }
         ?>

    </select> 
    </div>
    <!---------------------- list user -------->
  <div class="demo-form-row">
	  <label>Name: </label>

   <select class="ns demo-form-field" name="id_user">
                   <option value="<?php echo $data["id_user"] ?>"><?php echo  $data["name_user"]; ?></option>
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
	  <label>Date: </label>
    <input type="date" name="date_Invoice" class="demo-form-field" value="<?php echo $date_Invoice; ?>" required />
  </div>
    
  <div class="demo-form-row">
	  <label>Statement: </label>
    <input type="text" name="statement_invoice" class="demo-form-field" value="<?php echo $statement_invoice; ?>" required />
  </div>
    
  <div class="demo-form-row">
      <label>Rechnung Nr: </label>
    <input type="text" name="number_Invoice" class="demo-form-field" value="<?php echo $number_Invoice; ?>" required />
  </div>
<div class="demo-form-row">
      <label>Rabatt: </label>
    <input type="text" name="rabatt_r" class="demo-form-field" value="<?php echo $rabatt_r; ?>" required />
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
            if ($sales == "verkauf") {
				
				$verkauf = "checked";
				
			}else {
				
				$einkauf = "checked";
			}
        echo"<br>";
        echo '<div>';	
		echo '<label for="sales">sales:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>';           
		echo '<input type="radio" name="sales" value="verkauf" id="verkauf" '.$verkauf.'>';
		echo '<for="verkauf">verkauf</label>';
			
		echo '<input type="radio" name="sales" value="einkauf" id="einkauf" '.$einkauf.'>';
		echo '<for="einkauf">einkauf</label>';
	    echo '</div>';            
//                ----------------  Radio ----------------
		$Yes = "";
		$No = "";
		
		if (isset($_REQUEST["retoure"]) ) {
			
			if ($_REQUEST["retoure"] == "Yes") {
				
				$Yes = "checked";
				
			}else {
				
				$No = "checked";
			}
        }
            if ($retoure == "Yes") {
				
				$Yes = "checked";
				
			}else {
				
				$No = "checked";
			}
		
            
        echo"<br>";
        echo '<div>';	
		echo '<label for="retoure">Retoure:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>';           
		echo '<input type="radio" name="retoure" value="Yes" id="Yes" '.$Yes.'>';
		echo '<for="Yes">Yes</label>';
			
		echo '<input type="radio" name="retoure" value="No" id="No" '.$No.'>';
		echo '<for="No">No</label>';
	    echo '</div>';
        
//            ------------ End Rdio ------------
    
?>    
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