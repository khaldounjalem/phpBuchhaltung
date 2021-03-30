<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
require_once("db.php");
session_start();
     $id_Invoice=$_SESSION["id_Invoice"];
//    echo $id_Invoice;

    $id_details_invoice = $_REQUEST["id_details_invoice"];

    

        $t=time();
//    $date_delet = date("Y-m-d",$t);
    $date_delet =date('Y-m-d G:i:s');
    $user=$_COOKIE['user'];
    echo $user;
    echo $date_delet;
    $sql1 = "INSERT INTO invoice_details_deleted ( id_details_invoice, id_Invoice, statement_Invoice_details, lager_detail_invoice, quantity, price, rabatt_rd, user, date_delet )
SELECT invoice_details.id_details_invoice, invoice_details.id_Invoice, invoice_details.statement_Invoice_details, invoice_details.lager_detail_invoice, invoice_details.quantity, invoice_details.price, invoice_details.rabatt_rd, '$user', '$date_delet'
FROM invoice_details
WHERE invoice_details.id_details_invoice=".$id_details_invoice;

    $result1 = mysqli_query($con, $sql1)or die("MySQL: ".mysqli_error($con));
    
    
		
	$sql = "DELETE FROM invoice_details WHERE id_details_invoice=".$id_details_invoice;

    $result = mysqli_query($con, $sql)or die("MySQL: ".mysqli_error($con));

    if (!empty($result) ){
//	  header('location:rechnungen_detail.php');
        
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
<!--<link href="style.css" rel="stylesheet" type="text/css">-->
<style>
.button_link {color:#FFF;text-decoration:none; background-color:#428a8e;padding:10px;}
</style>
</head>
<body>
<div style="text-align:left;" >
    <h3>Record Deleted</h3>
    <a class="button_link" href="rechnungen_detail.php?id_Invoice=<?php echo $_SESSION["id_Invoice"]; ?>">Zuruck Rechnung Detail</a>
</div>
    <?php
//    session_destroy();
    ?>
    <?php
            }  else {
    header("Location: login.php");//if there is no cookie
}
            ?> 
</body>
</html>