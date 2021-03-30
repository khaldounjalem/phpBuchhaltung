<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
require_once("db.php");
?>
<!DOCTYPE html>
<html>
  <head>

<meta charset="utf-8"> 
    <title>Kundenkontoauszug</title>
      	<link href="style.css" rel="stylesheet">
<style >
	#keyword2{border: #CCC 1px solid; border-radius: 4px; padding: 2px;font-size: 18px;background-color:#f5f5f5;}
       #wrap2{width: 1100px;}
</style>
</head>
<body>

<?php

	$search_keyword = '';
    if(!empty($_REQUEST['id_user'])){
          $search_keyword =$_REQUEST['id_user'];  
    }
	if(!empty($_POST['search']['keyword'])) {
		$search_keyword = $_POST['search']['keyword'];
	}
    $search_keyword2 = "2017-12-01";
	if(!empty($_POST['search2'])) {
		$search_keyword2 = $_POST['search2'];
	}
// -------------------------- Delete Daily -------   
   $sql11 = " DELETE FROM `daily`";
   $result11 = mysqli_query($con, $sql11);
//    ---------Appen Day ----
    
$sql22 = "INSERT INTO daily ( id, art, date_daily, id_user, debit, credit, statement, number_user, name_user )
SELECT day.id_day, day.art, day.date_day, day_detail.id_user, day_detail.debit, day_detail.credit, day_detail.statement_day_detail, users.number_user, users.name_user
FROM day LEFT JOIN (day_detail LEFT JOIN users ON day_detail.id_user = users.id_user) ON day.id_day = day_detail.id_day
WHERE (((day_detail.id_user)=$search_keyword) AND ((day.active)=1))";

            $result22 = mysqli_query($con, $sql22);
//------------- Apend Rechnung kunde ---------
  $sql33 = "INSERT INTO daily ( retoure, id, art, number_user, id_user, sales, name_user, statement, date_daily, debit )
SELECT invoice.retoure, invoice.id_Invoice, invoice.art, users.number_user, users.id_user, invoice.sales, users.name_user, artikel.name_artikel, invoice.date_Invoice, quantity*price AS Expr1
FROM (invoice LEFT JOIN users ON invoice.id_user = users.id_user) LEFT JOIN (invoice_details LEFT JOIN artikel ON invoice_details.statement_Invoice_details = artikel.id_artikel) ON invoice.id_Invoice = invoice_details.id_Invoice
WHERE (((invoice.retoure)='No') AND ((users.id_user)=$search_keyword) AND ((invoice.sales)='verkauf') AND ((invoice.active)=1))";

        $result33 = mysqli_query($con, $sql33);
//------------- Apend Rechnung Lieferant ---------
    $sql44 = "INSERT INTO daily ( retoure, id, art, number_user, id_user, sales, name_user, statement, date_daily, credit )
SELECT invoice.retoure, invoice.id_Invoice, invoice.art, users.number_user, users.id_user, invoice.sales, users.name_user, artikel.name_artikel, invoice.date_Invoice, quantity*price AS Expr1
FROM (invoice LEFT JOIN users ON invoice.id_user = users.id_user) LEFT JOIN (invoice_details LEFT JOIN artikel ON invoice_details.statement_Invoice_details = artikel.id_artikel) ON invoice.id_Invoice = invoice_details.id_Invoice
WHERE (((invoice.retoure)='No') AND ((users.id_user)=$search_keyword) AND ((invoice.sales)='einkauf') AND ((invoice.active)=1))";

    $result44 = mysqli_query($con, $sql44);
//---------------  Reture Kunde ----------------
    $sql55 = "INSERT INTO daily ( retoure, id, art, number_user, id_user, sales, name_user, statement, date_daily, credit )
SELECT invoice.retoure, invoice.id_Invoice, invoice.art, users.number_user, users.id_user, invoice.sales, users.name_user, artikel.name_artikel, invoice.date_Invoice, quantity*price AS Expr1
FROM (invoice LEFT JOIN users ON invoice.id_user = users.id_user) LEFT JOIN (invoice_details LEFT JOIN artikel ON invoice_details.statement_Invoice_details = artikel.id_artikel) ON invoice.id_Invoice = invoice_details.id_Invoice
WHERE (((invoice.retoure)='Yes') AND ((users.id_user)=$search_keyword) AND ((invoice.sales)='verkauf') AND ((invoice.active)=1))";

    $result55 = mysqli_query($con, $sql55);
//--------------- Reture Lieferant --------------------
    $sql66 = "INSERT INTO daily ( retoure, id, art, number_user, id_user, sales, name_user, statement, date_daily, debit )
SELECT invoice.retoure, invoice.id_Invoice, invoice.art, users.number_user, users.id_user, invoice.sales, users.name_user, artikel.name_artikel, invoice.date_Invoice, quantity*price AS Expr1
FROM (invoice LEFT JOIN users ON invoice.id_user = users.id_user) LEFT JOIN (invoice_details LEFT JOIN artikel ON invoice_details.statement_Invoice_details = artikel.id_artikel) ON invoice.id_Invoice = invoice_details.id_Invoice
WHERE (((invoice.retoure)='Yes') AND ((users.id_user)=$search_keyword) AND ((invoice.sales)='einkauf') AND ((invoice.active)=1))";


      $result66 = mysqli_query($con, $sql66);
    


    //	---------- daily zeigen ---------------------

    $sql = "SELECT daily.id, daily.number_user, daily.id_user, daily.sales, daily.name_user, daily.debit, daily.credit, daily.statement, daily.date_daily, daily.art, daily.retoure
FROM daily
WHERE (((daily.id_user)=$search_keyword) AND (daily.date_daily >= '$search_keyword2%'))
ORDER BY daily.art, daily.id, daily.date_daily";
    
//	LIKE '$date%'
	
    $result = mysqli_query($con, $sql);
//  ---------------------  Total ------
	$total2=0;
    $total3=0;
    $sql2= "SELECT Sum(debit) as 'total2' FROM daily
    WHERE id_user =$search_keyword";
    $result2 = mysqli_query($con, $sql2);
    $sql3= "SELECT Sum(credit) as 'total3' FROM daily
    WHERE id_user =$search_keyword";
    $result3 = mysqli_query($con, $sql3);
    $result4 = mysqli_query($con, $sql);
  
              
?>
    <div id="wrap2">      
<form name='frmSearch' action='' method='post'> 
<div style='text-align:right;margin:20px 0px;'><b>Ab Datum : </b><input type='date' name='search2' value="<?php echo $search_keyword2; ?>" id="keyword2" maxlength='25'></div>
    
<div style='text-align:right;margin:20px 0px;'><b>Enter Kunden/Lieferant ID. : </b><input type='text' name='search[keyword]' autofocus value="<?php echo $search_keyword; ?> " id='keyword' maxlength='25'></div>

	
<?php    
      if ( ($result) && ($result2) && ($result3)&& ($result4)) {  
       $data2 = mysqli_fetch_assoc($result2);
       $data3 = mysqli_fetch_assoc($result3);
       $data4 = mysqli_fetch_assoc($result4); 
?>
        
<table class="tbl-qa">
    <tr class="table-row">
    <td>ID User:
    <?php echo $data4["id_user"]; ?></td>
    <td>Nr :
    <?php echo $data4["number_user"]; ?></td>
    <td>
    <?php echo $data4["name_user"]; ?></td>    
    </tr>
    </table>    
<table class="tbl-qa">
  <thead>
	<tr >
	  <th class="table-header" width="10%">Pos.</th>
	  <th class="table-header" width="15%">ID</th>
	  <th class="table-header" width="15%">ART</th>        
	  <th class="table-header" width="15%"></th>          
      <th class="table-header" width="15%">Retoure</th> 
	  <th class="table-header" width="15%">Debit</th>
	  <th class="table-header" width="15%">Credit</th>
      <th class="table-header" width="40%">Beschreibung</th>
      <th class="table-header" width="15%">Datum</th>    

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
		<td><?php echo utf8_encode($row["id"]); ?></td>
		<td><?php echo utf8_encode($row["art"]); ?></td>          
		<td><?php echo utf8_encode($row["sales"]); ?></td>            
        <td><?php echo utf8_encode($row["retoure"]); ?></td>
		<td><?php echo round($row["debit"],2); ?></td>
		<td><?php echo round($row["credit"],2); ?></td>
        <td><?php echo utf8_encode($row["statement"]); ?></td>
        <td><?php echo date_format(date_create($row["date_daily"]),"d.m.Y"); ?></td>  
          
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
      <td ><b><?php echo round($data2["total2"],2); ?></b></td>      
      <td ><b><?php echo round($data3["total3"],2); ?></b></td> 
      <td ><b><?php echo round((($data3["total3"])-($data2["total2"])),2); ?></b></td> 
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