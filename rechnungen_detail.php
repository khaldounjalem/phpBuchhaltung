<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
//    echo "<pre>";
//	print_r($_REQUEST);
//	echo "</pre>";

session_start();
require_once("db.php");
	$id_Invoice = $_REQUEST["id_Invoice"];
 $_SESSION["id_Invoice"]=$id_Invoice;
?>
<!doctype html>
<html>
<head>     
<meta charset="utf-8"> 
<title>Rechnung</title>
<link rel="shortcut icon" href="images/ico_khaldoun.png" type="image/x-icon">
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/style1.css" rel="stylesheet">
<link href="style.css" rel="stylesheet" type="text/css">
<style>
.navbar-right {float: right !important;margin-right: 50px; }
/*.block2{padding-top:2px;padding-bottom:2px;background: rgba(39, 39, 80, 0.41);}*/
    #wrap{width: 100%; box-shadow: 4px 4px 8px #061738;background: #fff;}
    @font-face{
    font-family: 'Jenna Sue';
    src: url('../fonts/JennaSue-webfont.eot');
    src: local("Jenna Sue"), url('../fonts/JennaSue-webfont.ttf');}
</style>
<script>
        function confirmDelete(delUrl) {
          if (confirm("Are you sure you want to delete")) {
           document.location = delUrl;
          }
        }
</script>    
</head>
<body>
<!--  Block 1   Menu -->
<div class="container-fluid">
<!--<div class="container">-->
<div class="row">
  <div class="col-md-12">
  <nav class="navbar navbar-default navbar-inverse navbar-static-top ">
    <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
          <a class="navbar-brand" href="#">Khal<span>doun</span></a></div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="defaultNavbar1">
          <ul class="nav navbar-nav navbar-right">
            <li ><a href="contact.php">Contact<span class="sr-only">(current)</span></a></li>
            <li class="active"><a href="index.php">Rechnung</a></li>
            <li><a href="day.php">Täglich</a></li>
                <li><a href="users.php">Kunden</a></li>
                <li><a href="seller.php">Mitarbeiter</a></li>
                <li><a href="material.php">Artikel</a></li>
                <li><a href="lager.php">Lager</a></li>
                <li><a href="lagerartikel.php">Lager/Artikel</a></li>
                <li><a href="logout.php">Logout</a></li>
<!--
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Listen<span class="caret"></span></a>
              <ul class="dropdown-menu">

              </ul>
            </li>
-->
          </ul>
        </div>
    </nav>
</div></div></div>
<!--    </div>-->
<!----------------- End Menu ---------     -->
<?php

	$sql = "SELECT invoice_details.id_details_invoice, invoice_details.id_Invoice, invoice_details.statement_Invoice_details, invoice_details.lager_detail_invoice, invoice_details.quantity, invoice_details.price, invoice_details.rabatt_rd, artikel.id_artikel, artikel.name_artikel, (quantity*price-quantity*price*rabatt_rd/100) AS total, lager.name_lager
FROM (invoice_details LEFT JOIN artikel ON invoice_details.statement_Invoice_details = artikel.id_artikel) LEFT JOIN lager ON invoice_details.lager_detail_invoice = lager.id_lager
WHERE id_Invoice=".$id_Invoice;
    
    $result = mysqli_query($con, $sql);
    //  ---------------------  Total ------
	$total2=0;
    $total3=0;
    $sql22= "SELECT Sum(quantity*price-quantity*price*rabatt_rd/100) as 'total22' FROM invoice_details
    WHERE id_Invoice =".$id_Invoice;
    $result22 = mysqli_query($con, $sql22);
    $sql33= "SELECT Sum(quantity) as 'total33' FROM invoice_details
    WHERE id_Invoice =".$id_Invoice;
    $result33 = mysqli_query($con, $sql33);
    $result44 = mysqli_query($con, $sql);
//    -----------------
    
    $sql2 = "SELECT invoice.id_Invoice, users.name_user, users.benutzertyp, invoice.date_Invoice, invoice.statement_invoice, invoice.number_Invoice, invoice.rabatt_r, invoice_details.id_details_invoice, artikel.name_artikel, invoice_details.quantity, invoice_details.price, invoice_details.rabatt_rd, quantity*price AS total, lager.name_lager
FROM ((users RIGHT JOIN invoice ON users.id_user = invoice.id_user) LEFT JOIN (invoice_details LEFT JOIN artikel ON invoice_details.statement_Invoice_details = artikel.id_artikel) ON invoice.id_Invoice = invoice_details.id_Invoice) LEFT JOIN lager ON invoice_details.lager_detail_invoice = lager.id_lager
WHERE invoice.id_Invoice=".$id_Invoice;
    
    $result2 = mysqli_query($con, $sql2);
    
     if ( ($result) && ($result22) && ($result33)&& ($result44) && ($result2) ) { 
       $data22 = mysqli_fetch_assoc($result22);
       $data33 = mysqli_fetch_assoc($result33);
//       $data4 = mysqli_fetch_assoc($result4);        
    $data = mysqli_fetch_assoc($result2);
 ?>
 <div class="container-fluid">
<!--<div class="container">      -->
<div class="row">
<div class="col-md-12">    
<div id="wrap">
    <table class="tbl-qa">
    <tr class="table-row">
    <td>Rechnung Nr. :<?php echo utf8_encode($data["id_Invoice"]); ?></td>
    <td>Der : <?php echo $data["name_user"]; ?></td>
    <td>Datum :
   <?php echo utf8_encode(date_format(date_create($data["date_Invoice"]),"d.m.Y")); ?></td>  
    </tr>
    </table>
        <?php
   
    ?>
    
<table class="tbl-qa">
  <thead>
	<tr>
	  <th class="table-header" width="5%"><div style="text-align:right;"><a href="add_dynamic_rd/index.php" class="button_link"><img src="crud-icon/add.png" title="Add New Record" style="vertical-align:bottom;" />Add</a></div ></th>
	  <th class="table-header" width="15%">ID Rechnung</th>
      <th class="table-header" width="30%">Artikel</th>
      <th class="table-header" width="15%">lager</th>
      <th class="table-header" width="10%">Menge</th>    
      <th class="table-header" width="10%">Einzelpreis</th>    
      <th class="table-header" width="10%">Rabatt %</th>          
      <th class="table-header" width="10%">Gesamt</th> 
      <th colspan="2" class="table-header" width="5%">Actions</th> 
	</tr>
  </thead>
  <tbody id="table-body">
	<?php

//    if ($result){
		
		// mysqli_fetch_assoc
		// Holt den nächsten Datensatz der Abfrage und erzeugt daraus
		// ein assoziatives Array		
        while ($row = mysqli_fetch_assoc($result)) {
	?>
	  <tr class="table-row">
		<td><?php echo $row["id_details_invoice"]; ?></td>
		<td><?php echo $row["id_Invoice"]; ?></td>
		<td><?php echo $row["name_artikel"]; ?></td>
        <td><?php echo $row["name_lager"]; ?></td>
        <td><?php echo $row["quantity"]; ?></td>
        <td><?php echo $row["price"]; ?></td>  
        <td><?php echo $row["rabatt_rd"]; ?></td>            
        <td><?php echo round($row["total"],2); ?></td>  

         
	<td>
		<a href='edit_rd.php?id_details_invoice=<?php echo $row['id_details_invoice']; ?>'><img src="crud-icon/edit.png" title="Edit" /></a>
          </td>  
<!--        <a href="index.php?delete=1" onclick="return confirm(\'Are you sure you want to delete ?\')">Delete</a>-->
        <td>
		<a href="delete_rd.php?id_details_invoice=<?php echo $row['id_details_invoice']; ?>" onclick="return confirm('Are you sure you want to delete?')" ><img src="crud-icon/delete.png" title="Delete" /></a>
		</td>
	  </tr>
    <?php
      }
       ?>
      <tr class="table-row">
      <td></td> 
      <td></td>          
      <td></td>
      <td></td>          
      <td></td>             
      <td ><b><?php echo round($data33["total33"],2); ?></b></td> 
       
      <td ></td>         
      <td ><b><?php echo round($data22["total22"],2); ?></b></td>
      <td colspan="2"><a href="report.php?id_Invoice=<?php echo $_REQUEST['id_Invoice']; ?>" target="_blank"><img src="crud-icon/is5.png" title="Print" /></a></td>      
      </tr>
      
      <tr class="table-row">
      <td colspan="3"></td>
      <td colspan="2">Rabatt  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data["rabatt_r"]; ?></td>       
      <td colspan="3">Rechnungsbetrag  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> <?php echo round(($data22["total22"]-$data["rabatt_r"]),1); ?></b></td>        
      <td></td>
      <td></td>          
      </tr>      
    <?php
       }
       ?>
    </tbody>
</table>
</div>    
      <script src="js/jquery-1.11.3.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/plugins.js"></script> 
         </div>
        </div>
         </div>
<!--        </div>         -->
    <?php
            }  else {
    header("Location: login.php");//if there is no cookie
}
            ?> 
</body>
</html>