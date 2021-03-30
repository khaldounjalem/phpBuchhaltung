<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
//    echo "<pre>";
//	print_r($_REQUEST);
//	echo "</pre>";

require_once("db.php");
session_start();
     $id_Invoice=$_SESSION["id_Invoice"];
if (isset($_REQUEST["save_record"])) {

    
        $id_artikel = $_REQUEST["id_artikel"];
        $quantity = $_REQUEST["quantity"];
        $price = $_REQUEST["price"];
        $id_lager = $_REQUEST["id_lager"];
        $id_details_invoice = $_REQUEST["id_details_invoice"];
        $rabatt_rd = $_REQUEST["rabatt_rd"];
		
		$sql = "UPDATE invoice_details
				SET 	statement_Invoice_details=".$id_artikel.",
                        lager_detail_invoice=".$id_lager.",
						quantity=".$quantity.",
                        price=".$price.",
                        rabatt_rd=".$rabatt_rd."
				WHERE	id_details_invoice=".$id_details_invoice;
				
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
//    session_destroy();            
//              header('location:index.php');
            }
		
	}
$sql = "SELECT invoice_details.id_details_invoice, invoice_details.id_Invoice, invoice_details.statement_Invoice_details, invoice_details.quantity, invoice_details.price, invoice_details.rabatt_rd, artikel.id_artikel, artikel.name_artikel, lager.id_lager, lager.name_lager
FROM (invoice_details LEFT JOIN artikel ON invoice_details.statement_Invoice_details = artikel.id_artikel) LEFT JOIN lager ON invoice_details.lager_detail_invoice = lager.id_lager
WHERE id_details_invoice=".$_REQUEST['id_details_invoice'];

//WHERE (((Invoice_details.id_details_invoice)=1) AND ((Invoice_details.id_Invoice)=2));


    $result = mysqli_query($con, $sql);
    
?>
<html>
<head>
<title>PHP Msqli - Edit Record</title>
<style>
body{width:615px;font-family:arial;letter-spacing:1px;line-height:20px;}
.button_link {color:#FFF;text-decoration:none; background-color:#428a8e;padding:10px;border-radius: 4px;}
.frm-add {position: relative;width:615px;border: #c3bebe 1px solid;margin-top: 10px;padding: 30px;}
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
               
	$id_artikel = $data["id_artikel"];
	$quantity = $data["quantity"];
    $price = $data["price"];
    $id_Invoice = $data["id_Invoice"];
    $id_lager = $data["id_lager"];            
    $rabatt_rd = $data["rabatt_rd"];             
    ?>            

    <!---------------------- list kauf -------->
  <div class="demo-form-row">
	  <label>Artikel: </label>

   <select class="ns demo-form-field" name="id_artikel">
                   <option value="<?php echo $data["id_artikel"] ?>"><?php echo  $data["name_artikel"]; ?></option>
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

   <select class="ns demo-form-field" name="id_lager">
                   <option value="<?php echo $data["id_lager"] ?>"><?php echo  $data["name_lager"]; ?></option>
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
<!--	  <label>id_Invoice: </label><br>-->
    <input type="hidden" name="id_Invoice" class="demo-form-field" value="<?php echo $id_Invoice; ?>" required  />
  </div>    
  <div class="demo-form-row">
	  <label>Menge: </label>
    <input type="text" name="quantity" class="demo-form-field" value="<?php echo $quantity; ?>" required  />
  </div>
    
  <div class="demo-form-row">
      <label>Einzelpreis: </label>
    <input type="text" name="price" class="demo-form-field" value="<?php echo $price; ?>" required  />
  </div>
  <div class="demo-form-row">
      <label>Rabatt: </label>
    <input type="text" name="rabatt_rd" class="demo-form-field" value="<?php echo $rabatt_rd; ?>" required  />
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