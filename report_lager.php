<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
require_once("db.php");
	$search_keyword = '';
    $search2 = "2017-12-01";

    $t=time();
    //echo($t . "<br>");
    //echo(date("Y-m-d",$t));
    $search3 = date("Y-m-d",$t);
        $id_lager =$_REQUEST['id_lager']; 
if (isset($_REQUEST["new_date"])) {

		$search_keyword = $_REQUEST['search']['keyword'];
		$search2 = $_REQUEST['search2'];
		$search3 = $_REQUEST['search3'];
    }     
?>
<!DOCTYPE html>
<html>
  <head>

<meta charset="utf-8"> 
    <title>Artikel</title>
      	<link href="style.css" rel="stylesheet">
<style >
    .btn { color:#FFF;border-radius: 4px;background-color:#cde4e5; padding:4px;font-size: 18px;}
    #wrap2{width: 1100px;}
	#keyword2{border: #CCC 1px solid; border-radius: 4px; padding: 2px;font-size: 18px;background-color:#f5f5f5;}
    #keyword3{border: #CCC 1px solid; border-radius: 4px; padding: 2px;font-size: 18px;background-color:#f5f5f5;}
</style>
</head>
<body>

<?php

//    if(!empty($_REQUEST['id_artikel'])){
//  
//    }
//	if(!empty($_POST['search']['keyword'])) {
//		$search_keyword = $_POST['search']['keyword'];
//	}
//    $search_keyword2 = "2017-12-01";
//	if(!empty($_POST['search2'])) {
//		$search_keyword2 = $_POST['search2'];
//	}
// -------------------------- Delete Daily -------   
   $sql11 = " DELETE FROM `daily_artikel`";
   $result11 = mysqli_query($con, $sql11);
//    ---------Appen kunde ----
    
$sql22 = "INSERT INTO daily_artikel ( id_artikel, name_artikel, quantity_kunde, id_user, sales, name_user, id_Invoice, price, date, retoure, id_lager, name_lager )
SELECT artikel.id_artikel, artikel.name_artikel, invoice_details.quantity, invoice.id_user, invoice.sales, users.name_user, invoice.id_Invoice, invoice_details.price, invoice.date_Invoice, invoice.retoure, invoice_details.lager_detail_invoice, lager.name_lager
FROM ((users RIGHT JOIN invoice ON users.id_user = invoice.id_user) LEFT JOIN (invoice_details LEFT JOIN artikel ON invoice_details.statement_Invoice_details = artikel.id_artikel) ON invoice.id_Invoice = invoice_details.id_Invoice) LEFT JOIN lager ON invoice_details.lager_detail_invoice = lager.id_lager
WHERE (((invoice.sales)='verkauf') AND ((invoice.retoure)='No'))";

    $result22 = mysqli_query($con, $sql22);
//------------- Apend Rechnung Lieferant ---------
  $sql33 = "INSERT INTO daily_artikel ( id_artikel, name_artikel, quantity_Lieferant, id_user, sales, name_user, id_Invoice, price, date, retoure, id_lager, name_lager )
SELECT artikel.id_artikel, artikel.name_artikel, invoice_details.quantity, invoice.id_user, invoice.sales, users.name_user, invoice.id_Invoice, invoice_details.price, invoice.date_Invoice, invoice.retoure, invoice_details.lager_detail_invoice, lager.name_lager
FROM ((users RIGHT JOIN invoice ON users.id_user = invoice.id_user) LEFT JOIN (invoice_details LEFT JOIN artikel ON invoice_details.statement_Invoice_details = artikel.id_artikel) ON invoice.id_Invoice = invoice_details.id_Invoice) LEFT JOIN lager ON invoice_details.lager_detail_invoice = lager.id_lager
WHERE ( AND ((invoice.sales)='einkauf') AND ((invoice.retoure)='No'))";



        $result33 = mysqli_query($con, $sql33);
//    ---------Appen kunde Retoure----
    
$sql55 = "INSERT INTO daily_artikel ( id_artikel, name_artikel, quantity_Lieferant, id_user, sales, name_user, id_Invoice, price, date, retoure, id_lager, name_lager )
SELECT artikel.id_artikel, artikel.name_artikel, invoice_details.quantity, invoice.id_user, invoice.sales, users.name_user, invoice.id_Invoice, invoice_details.price, invoice.date_Invoice, invoice.retoure, invoice_details.lager_detail_invoice, lager.name_lager
FROM ((users RIGHT JOIN invoice ON users.id_user = invoice.id_user) LEFT JOIN (invoice_details LEFT JOIN artikel ON invoice_details.statement_Invoice_details = artikel.id_artikel) ON invoice.id_Invoice = invoice_details.id_Invoice) LEFT JOIN lager ON invoice_details.lager_detail_invoice = lager.id_lager
WHERE ( ((invoice.sales)='verkauf') AND ((invoice.retoure)='Yes'))";

    $result55 = mysqli_query($con, $sql55);
//------------- Apend Rechnung Lieferant Retoure---------
  $sql66 = "INSERT INTO daily_artikel ( id_artikel, name_artikel, quantity_kunde, id_user, sales, name_user, id_Invoice, price, date, retoure, id_lager, name_lager )
SELECT artikel.id_artikel, artikel.name_artikel, invoice_details.quantity, invoice.id_user, invoice.sales, users.name_user, invoice.id_Invoice, invoice_details.price, invoice.date_Invoice, invoice.retoure, invoice_details.lager_detail_invoice, lager.name_lager
FROM ((users RIGHT JOIN invoice ON users.id_user = invoice.id_user) LEFT JOIN (invoice_details LEFT JOIN artikel ON invoice_details.statement_Invoice_details = artikel.id_artikel) ON invoice.id_Invoice = invoice_details.id_Invoice) LEFT JOIN lager ON invoice_details.lager_detail_invoice = lager.id_lager
WHERE (((invoice.sales)='einkauf') AND ((invoice.retoure)='Yes'))";



        $result66 = mysqli_query($con, $sql66);    
//------------- Apend  LagerArtikel Anzahl ---------
  $sql44 = "INSERT INTO daily_artikel ( id_Invoice, id_artikel, name_artikel, quantity_Lieferant, id_user, price, name_user, date, sales, id_lager, name_lager )
SELECT lagerartikel.lagerartikel_id, lagerartikel.id_artikel, artikel.name_artikel, lagerartikel.anzahl, lager.id_lager, lagerartikel.price, lager.name_lager, lagerartikel.date_lagerartikel, lagerartikel.art, lager.id_lager, lager.name_lager
FROM (lager RIGHT JOIN lagerartikel ON lager.id_lager = lagerartikel.id_lager) LEFT JOIN artikel ON lagerartikel.id_artikel = artikel.id_artikel";
//WHERE (((lagerartikel.id_lager)=$id_lager))";

    $result44 = mysqli_query($con, $sql44);        

    //	---------- daily zeigen ---------------------

    $sql = "SELECT daily_artikel.id_lager, daily_artikel.name_lager, daily_artikel.id_artikel, daily_artikel.name_artikel, daily_artikel.anzahl, daily_artikel.id_user, daily_artikel.name_user, daily_artikel.sales, daily_artikel.id_Invoice, daily_artikel.quantity_kunde, daily_artikel.quantity_Lieferant, daily_artikel.price, daily_artikel.date, daily_artikel.retoure
FROM daily_artikel
WHERE (((daily_artikel.id_lager)=$id_lager) AND 
(daily_artikel.date Between '$search2%' AND '$search3%' )) AND
( daily_artikel.name_artikel LIKE '%$search_keyword%' or daily_artikel.name_user LIKE '%$search_keyword%' or daily_artikel.retoure LIKE '%$search_keyword%' or daily_artikel.sales LIKE '%$search_keyword%')
ORDER BY daily_artikel.date";

    $result = mysqli_query($con, $sql);
//  ---------------------  Total ------
	$total2=0;
    $total3=0;
    $sql2= "SELECT Sum(quantity_kunde) as 'total2' FROM daily_artikel
    WHERE (((daily_artikel.id_lager)=$id_lager) AND 
(daily_artikel.date Between '$search2%' AND '$search3%' )) AND
( daily_artikel.name_artikel LIKE '%$search_keyword%' or daily_artikel.name_user LIKE '%$search_keyword%' or daily_artikel.retoure LIKE '%$search_keyword%' or daily_artikel.sales LIKE '%$search_keyword%')";

    $result2 = mysqli_query($con, $sql2);
    $sql3= "SELECT Sum(quantity_Lieferant) as 'total3' FROM daily_artikel
    WHERE (((daily_artikel.id_lager)=$id_lager) AND 
(daily_artikel.date Between '$search2%' AND '$search3%' )) AND
( daily_artikel.name_artikel LIKE '%$search_keyword%' or daily_artikel.name_user LIKE '%$search_keyword%' or daily_artikel.retoure LIKE '%$search_keyword%' or daily_artikel.sales LIKE '%$search_keyword%')";
    $result3 = mysqli_query($con, $sql3);
    $result4 = mysqli_query($con, $sql);
  
              
?>
<div id="wrap2">      
<form name='frmSearch' action='' method='post'> 
<div style='text-align:left;margin:20px 0px;'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Von : </b><input type='date' name='search2' value="<?php echo $search2; ?>" id="keyword2" maxlength='25'>
    
<b>&nbsp;&nbsp;&nbsp;&nbsp; Bis : </b><input type='date' name='search3' value="<?php echo $search3; ?>" id="keyword3" maxlength='25'>
<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search </b><input type='text' name='search[keyword]' autofocus value="<?php echo $search_keyword; ?>" id='keyword' maxlength='25'>

    
<input name="new_date" type="submit" value="Start" class="btn">
</div>     
    
    
    
<!--
<div style='text-align:right;margin:20px 0px;'><b>Ab Datum : </b><input type='date' name='search2' value="<?php echo $search_keyword2; ?>" id="keyword2" maxlength='25'></div>
    
<div style='text-align:right;margin:20px 0px;'><b>Enter Artikel ID. : </b><input type='text' name='search[keyword]' autofocus value="<?php echo $search_keyword; ?> " id='keyword' maxlength='25'></div>
-->

	
<?php    
      if ( ($result) && ($result2) && ($result3)&& ($result4)) {  
       $data2 = mysqli_fetch_assoc($result2);
       $data3 = mysqli_fetch_assoc($result3);
       $data4 = mysqli_fetch_assoc($result4); 
?>
<table class="tbl-qa">
  <thead>
    <tr class="table-row">
        <td colspan="12">ID Lager:
        <?php echo utf8_encode($data4["id_lager"]); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lager :
        <?php echo utf8_encode($data4["name_lager"]); ?>
<!--
        </td>
        <td colspan="6"></td>
-->
    </tr>
	<tr >
	  <th class="table-header" width="5%">Pos.</th>
	  <th class="table-header" width="15%">ID Rech/Lager</th>
      <th class="table-header" width="25%">id_artikel</th>
      <th class="table-header" width="5%">name_artikel</th>         
	  <th class="table-header" width="15%">ID K/Lief/La</th>
      <th class="table-header" width="25%">Name</th>
      <th class="table-header" width="5%">Typ</th> 
      <th class="table-header" width="5%">Retoure</th> 
     
	  <th class="table-header" width="10%">Menge -</th>
	  <th class="table-header" width="10%">Menge +</th>
      <th class="table-header" width="5%">Einzelpreis</th>
      <th class="table-header" width="5%">Datum</th>         

	</tr>
  </thead>
  <tbody id="table-body">
	<?php

		
		// mysqli_fetch_assoc
		// Holt den nächsten Datensatz der Abfrage und erzeugt daraus
		// ein assoziatives Array
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $i=$i+1;
	?>
	  <tr class="table-row">
<!--
		<td><?php echo utf8_encode($row["id_lager"]); ?></td>          
		<td><?php echo utf8_encode($row["name_lager"]); ?></td>          
-->
        <td><?php echo $i; ?></td>
		<td><?php echo utf8_encode($row["id_Invoice"]); ?></td>
		<td><?php echo utf8_encode($row["id_artikel"]); ?></td>
		<td><?php echo utf8_encode($row["name_artikel"]); ?></td>           
		<td><?php echo utf8_encode($row["id_user"]); ?></td>

        <td><?php echo utf8_encode($row["name_user"]); ?></td>
		<td><?php echo utf8_encode($row["sales"]); ?></td>
		<td><?php echo utf8_encode($row["retoure"]); ?></td>          
      
		<td><?php echo utf8_encode($row["quantity_kunde"]); ?></td>
		<td><?php echo utf8_encode($row["quantity_Lieferant"]); ?></td>
        <td><?php echo utf8_encode($row["price"]); ?></td>          
        <td><?php echo date_format(date_create($row["date"]),"d.m.Y"); ?></td>  
          
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
      <td></td>          
      <td></td>          
      <td></td>                 
      <td ><b><?php echo utf8_encode($data2["total2"]); ?></b></td>      
      <td ><b><?php echo utf8_encode($data3["total3"]); ?></b></td> 
      <td>Rest</td>
      <td ><b><?php echo ($data4["anzahl"]+$data3["total3"]-$data2["total2"]); ?></b></td> 
          
<!--      <td colspan="2"></td>      -->
      </tr>


    </tbody>
</table>
        
    </form>
<?php
	}
?>
    </div>
    <?php
            }  else {
    header("Location: login.php");//if there is no cookie
}
            ?> 
    </body>
</html>