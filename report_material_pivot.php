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
	#keyword2{border: #CCC 1px solid; border-radius: 4px; padding: 2px;font-size: 18px;background-color:#f5f5f5;}
	#keyword3{border: #CCC 1px solid; border-radius: 4px; padding: 2px;font-size: 18px;background-color:#f5f5f5;}    
       #wrap2{width: 1100px;}
</style>
</head>
<body>
<div id="wrap2">     
<form name='frmSearch' action='' method='post'> 
<div style='text-align:left;margin:20px 0px;'><b>&nbsp;&nbsp;&nbsp;&nbsp; Von : </b><input type='date' name='search2' value="<?php echo $search2; ?>" id="keyword2" maxlength='25'>
    
<b>&nbsp;&nbsp;&nbsp;&nbsp; Bis : </b><input type='date' name='search3' value="<?php echo $search3; ?>" id="keyword3" maxlength='25'>
<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enter Name OR Artikel. : </b><input type='text' name='search[keyword]' autofocus value="<?php echo $search_keyword; ?>" id='keyword' maxlength='25'>

    
<input name="new_date" type="submit" value="Start" class="btn">
</div>
<?php

	$search_keyword = '';
    if(!empty($_REQUEST['id_artikel'])){
          $search_keyword =$_REQUEST['id_artikel'];  
    }
	if(!empty($_POST['search']['keyword'])) {
		$search_keyword = $_POST['search']['keyword'];
	}
    $search_keyword2 = "2017-12-01";
	if(!empty($_POST['search2'])) {
		$search_keyword2 = $_POST['search2'];
	}
// -------------------------- Delete Daily -------   
   $sql11 = " DELETE FROM `daily_artikel`";
   $result11 = mysqli_query($con, $sql11);
//    ---------Appen kunde ----
    
    
$sql22 = "INSERT INTO daily_artikel ( id_artikel, name_artikel, quantity_kunde, id_user, sales, name_user, id_Invoice, price, date, retoure, id_lager, name_lager )
SELECT  invoice_details.statement_Invoice_details, artikel.name_artikel, invoice_details.quantity, invoice.id_user, invoice.sales, users.name_user, invoice.id_Invoice, invoice_details.price, invoice.date_Invoice, invoice.retoure, lager.id_lager, lager.name_lager
FROM ((users RIGHT JOIN invoice ON users.id_user = invoice.id_user) LEFT JOIN (invoice_details LEFT JOIN artikel ON invoice_details.statement_Invoice_details = artikel.id_artikel) ON invoice.id_Invoice = invoice_details.id_Invoice) LEFT JOIN lager ON invoice_details.lager_detail_invoice = lager.id_lager
WHERE (((invoice.sales)='verkauf') AND ((invoice.retoure)='No'))";

    $result22 = mysqli_query($con, $sql22);
//------------- Apend Rechnung Lieferant ---------
  $sql33 = "INSERT INTO daily_artikel ( id_artikel, name_artikel, quantity_Lieferant, id_user, sales, name_user, id_Invoice, price, date, retoure, id_lager, name_lager )
SELECT  invoice_details.statement_Invoice_details, artikel.name_artikel, invoice_details.quantity, invoice.id_user, invoice.sales, users.name_user, invoice.id_Invoice, invoice_details.price, invoice.date_Invoice, invoice.retoure, lager.id_lager, lager.name_lager
FROM ((users RIGHT JOIN invoice ON users.id_user = invoice.id_user) LEFT JOIN (invoice_details LEFT JOIN artikel ON invoice_details.statement_Invoice_details = artikel.id_artikel) ON invoice.id_Invoice = invoice_details.id_Invoice) LEFT JOIN lager ON invoice_details.lager_detail_invoice = lager.id_lager
WHERE (((invoice.sales)='einkauf') AND ((invoice.retoure)='No'))";



        $result33 = mysqli_query($con, $sql33);
//    ---------Appen kunde Retoure----
    
$sql55 = "INSERT INTO daily_artikel ( id_artikel, name_artikel, quantity_Lieferant, id_user, sales, name_user, id_Invoice, price, date, retoure, id_lager, name_lager )
SELECT  invoice_details.statement_Invoice_details, artikel.name_artikel, invoice_details.quantity, invoice.id_user, invoice.sales, users.name_user, invoice.id_Invoice, invoice_details.price, invoice.date_Invoice, invoice.retoure, lager.id_lager, lager.name_lager
FROM ((users RIGHT JOIN invoice ON users.id_user = invoice.id_user) LEFT JOIN (invoice_details LEFT JOIN artikel ON invoice_details.statement_Invoice_details = artikel.id_artikel) ON invoice.id_Invoice = invoice_details.id_Invoice) LEFT JOIN lager ON invoice_details.lager_detail_invoice = lager.id_lager
WHERE (((invoice.sales)='verkauf') AND ((invoice.retoure)='Yes'))";

    $result55 = mysqli_query($con, $sql55);
//------------- Apend Rechnung Lieferant Retoure---------
  $sql66 = "INSERT INTO daily_artikel ( id_artikel, name_artikel, quantity_kunde, id_user, sales, name_user, id_Invoice, price, date, retoure, id_lager, name_lager )
SELECT  invoice_details.statement_Invoice_details, artikel.name_artikel, invoice_details.quantity, invoice.id_user, invoice.sales, users.name_user, invoice.id_Invoice, invoice_details.price, invoice.date_Invoice, invoice.retoure, lager.id_lager, lager.name_lager
FROM ((users RIGHT JOIN invoice ON users.id_user = invoice.id_user) LEFT JOIN (invoice_details LEFT JOIN artikel ON invoice_details.statement_Invoice_details = artikel.id_artikel) ON invoice.id_Invoice = invoice_details.id_Invoice) LEFT JOIN lager ON invoice_details.lager_detail_invoice = lager.id_lager
WHERE ( ((invoice.sales)='einkauf') AND ((invoice.retoure)='Yes'))";



        $result66 = mysqli_query($con, $sql66);    
//------------- Apend  LagerArtikel Anzahl ---------
  $sql44 = "INSERT INTO daily_artikel ( id_Invoice, id_artikel, name_artikel, quantity_Lieferant, id_user, price, name_user, date, sales )
SELECT lagerartikel.lagerartikel_id, lagerartikel.id_artikel, artikel.name_artikel, lagerartikel.anzahl, lager.id_lager, lagerartikel.price, lager.name_lager, lagerartikel.date_lagerartikel, lagerartikel.art
FROM (lager RIGHT JOIN lagerartikel ON lager.id_lager = lagerartikel.id_lager) LEFT JOIN artikel ON lagerartikel.id_artikel = artikel.id_artikel";

    $result44 = mysqli_query($con, $sql44);        
// ---------------- Pivot ------------------
$sql = "SELECT  
	IFNULL(name_artikel, 'TOTAL') AS officer_name,
	SUM( IF( MONTH(date) = 1, quantity_Lieferant-quantity_kunde, NULL) ) AS coun_1,
	SUM( IF( MONTH(date) = 1, price*(quantity_Lieferant-quantity_kunde), 0) ) AS january,
	SUM( IF( MONTH(date) = 2, quantity_Lieferant-quantity_kunde, NULL) ) AS coun_2,
	SUM( IF( MONTH(date) = 2, price*(quantity_Lieferant-quantity_kunde), 0) ) AS februay,
	SUM( IF( MONTH(date) = 3, quantity_Lieferant-quantity_kunde, NULL) ) AS coun_3,
	SUM( IF( MONTH(date) = 3, price*(quantity_Lieferant-quantity_kunde), 0) ) AS march,
    SUM( IF( MONTH(date) = 4, quantity_Lieferant-quantity_kunde, NULL) ) AS coun_4,
	SUM( IF( MONTH(date) = 4, price*(quantity_Lieferant-quantity_kunde), 0) ) AS April,
	SUM( IF( MONTH(date) = 5, quantity_Lieferant-quantity_kunde, NULL) ) AS coun_5,
	SUM( IF( MONTH(date) = 5, price*(quantity_Lieferant-quantity_kunde), 0) ) AS May,
	SUM( IF( MONTH(date) = 6, quantity_Lieferant-quantity_kunde, NULL) ) AS coun_6,
	SUM( IF( MONTH(date) = 6, price*(quantity_Lieferant-quantity_kunde), 0) ) AS June,
    SUM( IF( MONTH(date) = 7, quantity_Lieferant-quantity_kunde, NULL) ) AS coun_7,
	SUM( IF( MONTH(date) = 7, price*(quantity_Lieferant-quantity_kunde), 0) ) AS July,
	SUM( IF( MONTH(date) = 8, quantity_Lieferant-quantity_kunde, NULL) ) AS coun_8,
	SUM( IF( MONTH(date) = 8, price*(quantity_Lieferant-quantity_kunde), 0) ) AS August,
	SUM( IF( MONTH(date) = 9, quantity_Lieferant-quantity_kunde, NULL) ) AS coun_9,
	SUM( IF( MONTH(date) = 9, price*(quantity_Lieferant-quantity_kunde), 0) ) AS September,
    SUM( IF( MONTH(date) = 10, quantity_Lieferant-quantity_kunde, NULL) ) AS coun_10,
	SUM( IF( MONTH(date) = 10, price*(quantity_Lieferant-quantity_kunde), 0) ) AS October,
	SUM( IF( MONTH(date) = 11, quantity_Lieferant-quantity_kunde, NULL) ) AS coun_11,
	SUM( IF( MONTH(date) = 11, price*(quantity_Lieferant-quantity_kunde), 0) ) AS November,
	SUM( IF( MONTH(date) = 12, quantity_Lieferant-quantity_kunde, NULL) ) AS coun_12,
	SUM( IF( MONTH(date) = 12, price*(quantity_Lieferant-quantity_kunde), 0) ) AS December,
	
	sum(quantity_Lieferant-quantity_kunde) AS count,
	SUM( price*(quantity_Lieferant-quantity_kunde) ) AS total
FROM daily_artikel
WHERE ((name_user LIKE '%$search_keyword%'or name_artikel LIKE '%$search_keyword%') AND (daily_artikel.date Between '$search2%' AND '$search3%' ))
GROUP BY name_artikel
WITH ROLLUP";

    $result = mysqli_query($con, $sql);

    
?>
<table class="tbl-qa">
  <thead>
	<tr>
	  <th class="table-header" width="4%">Name</th>
	  <th class="table-header" width="4%">c1</th>
      <th class="table-header" width="4%">Jan</th>
      <th class="table-header" width="4%">c2</th>    
      <th class="table-header" width="4%">Feb</th>    
      <th class="table-header" width="4%">c3</th>   
      <th class="table-header" width="4%">Mar</th>
	  <th class="table-header" width="4%">c4</th>
      <th class="table-header" width="4%">Abr</th>
      <th class="table-header" width="4%">c5</th>    
      <th class="table-header" width="4%">May</th>    
      <th class="table-header" width="4%">c6</th>   
      <th class="table-header" width="4%">Jui</th> 
	  <th class="table-header" width="4%">c7</th>
      <th class="table-header" width="4%">Jul</th>
      <th class="table-header" width="4%">c8</th>    
      <th class="table-header" width="4%">Aug</th>    
      <th class="table-header" width="4%">c9</th>   
      <th class="table-header" width="4%">Sep</th>
	  <th class="table-header" width="4%">c10</th>
      <th class="table-header" width="4%">Oct</th>
      <th class="table-header" width="4%">c11</th>    
      <th class="table-header" width="4%">Nov</th>    
      <th class="table-header" width="4%">c12</th>   
      <th class="table-header" width="4%">Dec</th>  
      <th class="table-header" width="4%">Count</th>         
      <th class="table-header" width="4%">Total</th> 
	</tr>
  </thead>
  <tbody id="table-body">
	<?php
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
	?>
	  <tr class="table-row">
		<td><?php echo $row["officer_name"]; ?></td>
        <td><?php echo $row["coun_1"]; ?></td>
        <td><?php echo round($row["january"],1); ?></td>
        <td><?php echo $row["coun_2"]; ?></td>  
   		<td><?php echo round($row["februay"],1); ?></td>
        <td><?php echo $row["coun_3"]; ?></td>
        <td><?php echo round($row["march"],1); ?></td>
        <td><?php echo $row["coun_4"]; ?></td>  
   		<td><?php echo round($row["April"],1); ?></td>
        <td><?php echo $row["coun_5"]; ?></td>
        <td><?php echo round($row["May"],1); ?></td>
        <td><?php echo $row["coun_6"]; ?></td>  
   		<td><?php echo round($row["June"],1); ?></td>
        <td><?php echo $row["coun_7"]; ?></td>
        <td><?php echo round($row["July"],1); ?></td>
        <td><?php echo $row["coun_8"]; ?></td>  
   		<td><?php echo round($row["August"],1); ?></td>
        <td><?php echo $row["coun_9"]; ?></td>
        <td><?php echo round($row["September"],1); ?></td>
        <td><?php echo $row["coun_10"]; ?></td>  
   		<td><?php echo round($row["October"],1); ?></td>
        <td><?php echo $row["coun_11"]; ?></td>
        <td><?php echo round($row["November"],1); ?></td>
        <td><?php echo $row["coun_12"]; ?></td>  
   		<td><?php echo round($row["December"],1); ?></td>          

        <td><?php echo $row["count"]; ?></td>
        <td><?php echo round($row["total"],0); ?></td>

	  </tr>
    <?php
      }
        }
       ?>
      <tr class="table-row">
      
      <td colspan="3">Diagramm</td>   
      <td><a href='static/local.html' target="_blank"> <img src="crud-icon/diag3.png"title="Print" /></a ></td>
     <td colspan="23"></td>          
      </tr>
    </tbody>
</table>    
<?php    
    
//    ------- End Pivot ------------

    //	---------- daily zeigen ---------------------

    $sql = "SELECT daily_artikel.id_lager, daily_artikel.name_lager, daily_artikel.id_artikel, daily_artikel.name_artikel, daily_artikel.anzahl, daily_artikel.id_user, daily_artikel.name_user, daily_artikel.sales, daily_artikel.id_Invoice, daily_artikel.quantity_kunde, daily_artikel.quantity_Lieferant, daily_artikel.price, daily_artikel.date, daily_artikel.retoure
FROM daily_artikel
WHERE ((name_user LIKE '%$search_keyword%'or name_artikel LIKE '%$search_keyword%') AND (daily_artikel.date Between '$search2%' AND '$search3%' ))
ORDER BY daily_artikel.date";

	
    $result = mysqli_query($con, $sql);
//  ---------------------  Total ------
	$total2=0;
    $total3=0;
    $sql2= "SELECT Sum(quantity_kunde) as 'total2' FROM daily_artikel
    WHERE ((name_user LIKE '%$search_keyword%'or name_artikel LIKE '%$search_keyword%') AND (daily_artikel.date Between '$search2%' AND '$search3%' ))";
    $result2 = mysqli_query($con, $sql2);
    $sql3= "SELECT Sum(quantity_Lieferant) as 'total3' FROM daily_artikel
    WHERE ((name_user LIKE '%$search_keyword%'or name_artikel LIKE '%$search_keyword%') AND (daily_artikel.date Between '$search2%' AND '$search3%' ))";
    $result3 = mysqli_query($con, $sql3);
    $sql4= "SELECT Sum(price*(quantity_Lieferant-quantity_kunde)) as 'total4' FROM daily_artikel
    WHERE ((name_user LIKE '%$search_keyword%'or name_artikel LIKE '%$search_keyword%') AND (daily_artikel.date Between '$search2%' AND '$search3%' ))";
    $result4 = mysqli_query($con, $sql4);
  
              
?>


	
<?php    
      if ( ($result) && ($result2) && ($result3)&& ($result4)) {  
       $data2 = mysqli_fetch_assoc($result2);
       $data3 = mysqli_fetch_assoc($result3);
       $data4 = mysqli_fetch_assoc($result4); 
?>
    
<table class="tbl-qa">
  <thead>
	<tr >
	  <th class="table-header" width="5%">Pos.</th>
	  <th class="table-header" width="15%">ID Rech/Lager</th>           
	  <th class="table-header" width="15%">ID K/Lief/La</th>
      <th class="table-header" width="25%">Lager</th>
      <th class="table-header" width="25%">Name</th>
      <th class="table-header" width="5%">Typ</th> 
      <th class="table-header" width="5%">Retoure</th> 
        
      <th class="table-header" width="5%">ID Artikel</th> 
      <th class="table-header" width="5%">Artikel</th>      
	  <th class="table-header" width="10%">Menge -</th>
	  <th class="table-header" width="10%">Menge +</th>
      <th class="table-header" width="5%">Einzelpreis</th>
      <th class="table-header" width="5%">Total</th>
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
        <td><?php echo $i; ?></td>
		<td><?php echo utf8_encode($row["id_Invoice"]); ?></td>              
		<td><?php echo utf8_encode($row["id_user"]); ?></td>
		<td><?php echo utf8_encode($row["name_lager"]); ?></td>
        <td><?php echo utf8_encode($row["name_user"]); ?></td>
		<td><?php echo utf8_encode($row["sales"]); ?></td>
		<td><?php echo utf8_encode($row["retoure"]); ?></td> 
          
		<td><?php echo $row["id_artikel"]; ?></td>
		<td><?php echo $row["name_artikel"]; ?></td>       
		<td><?php echo round($row["quantity_kunde"],1); ?></td>
		<td><?php echo round($row["quantity_Lieferant"],1); ?></td>
        <td><?php echo round($row["price"],1); ?></td>    
        <td><?php echo round($row["price"]*($row["quantity_kunde"]+$row["quantity_Lieferant"]),1); ?></td>              
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
      <td></td>          
      <td ><b><?php echo round($data2["total2"],1); ?></b></td>      
      <td ><b><?php echo round($data3["total3"],1); ?></b></td> 
      <td></td>
<!--      <td ><b><?php echo round($data4["total4"],1); ?></b></td> -->
      <td></td>          
      <td></td>      
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