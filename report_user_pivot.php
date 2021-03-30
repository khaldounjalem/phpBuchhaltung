<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
    
require_once("db.php");
     $search_keyword2 = "2017-12-01";
    $sales="verkauf";
    
    if (isset($_REQUEST["new_date"])) {
        $sales = $_REQUEST['sales'];
	if(!empty($_REQUEST['search2'])) {
		$search_keyword2 = $_POST['search2'];
	}  }  
?>
<!DOCTYPE html>
<html>
  <head>

<meta charset="utf-8"> 
    <title>Kundenkontoauszug</title>
      	<link href="style.css" rel="stylesheet">
<style >
        .btn { position: absolute;top: 0px;left: 930px; color:#FFF;border-radius: 4px;
        background-color:#cde4e5; padding:6px;font-size: 18px;}
    .hin { position: absolute;top: 10px;left: 50px;}
    .ben { position: absolute;top: 10px;left: 550px;font-size: 20px;}
/*
    label{position: absolute;top: 50px;left: 100px;font-size: 20px; line-height: 40px;}
    #kunde {position: absolute;top: 50px;left: 120px;font-size: 20px; line-height: 40px;}
*/
	#keyword2{border: #CCC 1px solid; border-radius: 4px; padding: 2px;font-size: 18px;background-color:#f5f5f5;}
       #wrap2{width: 1300px;position: relative;}
</style>
</head>
<body>
    <div id="wrap2">      
<form name='frmSearch' action='' method='post'> 
<div style='text-align:right;margin:20px 0px;'><b>Ab Datum : </b><input type='date' name='search2' value="<?php echo $search_keyword2; ?>" id="keyword2" maxlength='25'></div>
  <div>
	  <input name="new_date" type="submit" value="Start" class="btn">
  </div>
    <div class="hin"><h3>Hinweis: Statistische Studie für nur ein Jahr</h3></div>
 <?php
//                ----------------  Radio ----------------
		$verkauf = "checked";
		$einkauf = "";
		
		if (isset($_REQUEST["sales"]) ) {
			
			if ($_REQUEST["sales"] == "verkauf") {
				
				$verkauf = "checked";
				
			}else {
				
				$einkauf = "checked";
			}
		}
//        echo"<br>";
        echo '<div class="ben">';	
		echo '<label for="sales">Typ:&nbsp;&nbsp;</label>';           
		echo '<input type="radio" name="sales" value="verkauf" id="verkauf" '.$verkauf.'>';
		echo '<label for="verkauf">&nbsp;&nbsp;verkauf&nbsp;&nbsp;&nbsp;</label>';
			
		echo '<input type="radio" name="sales" value="einkauf" id="einkauf" '.$einkauf.'>';
		echo '<label for="einkauf">&nbsp;&nbsp;einkauf&nbsp;&nbsp;&nbsp;</label>';
	    echo '</div>';
            
//            ------------ End Rdio ------------
   
// -------------------------- Delete Daily -------   
   $sql11 = " DELETE FROM `daily`";
   $result11 = mysqli_query($con, $sql11);
//    ---------Appen Day ----
    
$sql22 = "INSERT INTO daily ( id, art, date_daily, id_user, debit, credit, statement, number_user, name_user )
SELECT day.id_day, day.art, day.date_day, day_detail.id_user, day_detail.debit, day_detail.credit, day_detail.statement_day_detail, users.number_user, users.name_user
FROM day LEFT JOIN (day_detail LEFT JOIN users ON day_detail.id_user = users.id_user) ON day.id_day = day_detail.id_day
WHERE ((day.active)=1)";
   
            $result22 = mysqli_query($con, $sql22);
//------------- Apend Rechnung kunde ---------
  $sql33 = "INSERT INTO daily ( retoure, id, art, number_user, id_user, sales, name_user, statement, date_daily, debit )
SELECT invoice.retoure, invoice.id_Invoice, invoice.art, users.number_user, users.id_user, invoice.sales, users.name_user, artikel.name_artikel, invoice.date_Invoice, quantity*price AS Expr1
FROM (invoice LEFT JOIN users ON invoice.id_user = users.id_user) LEFT JOIN (invoice_details LEFT JOIN artikel ON invoice_details.statement_Invoice_details = artikel.id_artikel) ON invoice.id_Invoice = invoice_details.id_Invoice
WHERE (((invoice.retoure)='No') AND ((invoice.sales)='verkauf') AND ((invoice.active)=1))";

        $result33 = mysqli_query($con, $sql33);
//------------- Apend Rechnung Lieferant ---------
    $sql44 = "INSERT INTO daily ( retoure, id, art, number_user, id_user, sales, name_user, statement, date_daily, credit )
SELECT invoice.retoure, invoice.id_Invoice, invoice.art, users.number_user, users.id_user, invoice.sales, users.name_user, artikel.name_artikel, invoice.date_Invoice, quantity*price AS Expr1
FROM (invoice LEFT JOIN users ON invoice.id_user = users.id_user) LEFT JOIN (invoice_details LEFT JOIN artikel ON invoice_details.statement_Invoice_details = artikel.id_artikel) ON invoice.id_Invoice = invoice_details.id_Invoice
WHERE (((invoice.retoure)='No') AND ((invoice.sales)='einkauf') AND ((invoice.active)=1))";

    $result44 = mysqli_query($con, $sql44);
//---------------  Reture Kunde ----------------
    $sql55 = "INSERT INTO daily ( retoure, id, art, number_user, id_user, sales, name_user, statement, date_daily, credit )
SELECT invoice.retoure, invoice.id_Invoice, invoice.art, users.number_user, users.id_user, invoice.sales, users.name_user, artikel.name_artikel, invoice.date_Invoice, quantity*price AS Expr1
FROM (invoice LEFT JOIN users ON invoice.id_user = users.id_user) LEFT JOIN (invoice_details LEFT JOIN artikel ON invoice_details.statement_Invoice_details = artikel.id_artikel) ON invoice.id_Invoice = invoice_details.id_Invoice
WHERE (((invoice.retoure)='Yes') AND ((invoice.sales)='verkauf') AND ((invoice.active)=1))";

    $result55 = mysqli_query($con, $sql55);
//--------------- Reture Lieferant --------------------
    $sql66 = "INSERT INTO daily ( retoure, id, art, number_user, id_user, sales, name_user, statement, date_daily, debit )
SELECT invoice.retoure, invoice.id_Invoice, invoice.art, users.number_user, users.id_user, invoice.sales, users.name_user, artikel.name_artikel, invoice.date_Invoice, quantity*price AS Expr1
FROM (invoice LEFT JOIN users ON invoice.id_user = users.id_user) LEFT JOIN (invoice_details LEFT JOIN artikel ON invoice_details.statement_Invoice_details = artikel.id_artikel) ON invoice.id_Invoice = invoice_details.id_Invoice
WHERE (((invoice.retoure)='Yes') AND ((invoice.sales)='einkauf') AND ((invoice.active)=1))";


      $result66 = mysqli_query($con, $sql66);

// ---------------- Pivot ------------------
$sql = "SELECT  
	IFNULL(name_user, 'TOTAL') AS officer_name,
	COUNT( IF( MONTH(date_daily) = 1, debit+credit, NULL) ) AS coun_1,
	SUM( IF( MONTH(date_daily) = 1, debit+credit, 0) ) AS january,
	COUNT( IF( MONTH(date_daily) = 2, debit+credit, NULL) ) AS coun_2,
	SUM( IF( MONTH(date_daily) = 2, debit+credit, 0) ) AS februay,
	COUNT( IF( MONTH(date_daily) = 3, debit+credit, NULL) ) AS coun_3,
	SUM( IF( MONTH(date_daily) = 3, debit+credit, 0) ) AS march,
    COUNT( IF( MONTH(date_daily) = 4, debit+credit, NULL) ) AS coun_4,
	SUM( IF( MONTH(date_daily) = 4, debit+credit, 0) ) AS April,
	COUNT( IF( MONTH(date_daily) = 5, debit+credit, NULL) ) AS coun_5,
	SUM( IF( MONTH(date_daily) = 5, debit+credit, 0) ) AS May,
	COUNT( IF( MONTH(date_daily) = 6, debit+credit, NULL) ) AS coun_6,
	SUM( IF( MONTH(date_daily) = 6, debit+credit, 0) ) AS June,
    COUNT( IF( MONTH(date_daily) = 7, debit+credit, NULL) ) AS coun_7,
	SUM( IF( MONTH(date_daily) = 7, debit+credit, 0) ) AS July,
	COUNT( IF( MONTH(date_daily) = 8, debit+credit, NULL) ) AS coun_8,
	SUM( IF( MONTH(date_daily) = 8, debit+credit, 0) ) AS August,
	COUNT( IF( MONTH(date_daily) = 9, debit+credit, NULL) ) AS coun_9,
	SUM( IF( MONTH(date_daily) = 9, debit+credit, 0) ) AS September,
    COUNT( IF( MONTH(date_daily) = 10, debit+credit, NULL) ) AS coun_10,
	SUM( IF( MONTH(date_daily) = 10, debit+credit, 0) ) AS October,
	COUNT( IF( MONTH(date_daily) = 11, debit+credit, NULL) ) AS coun_11,
	SUM( IF( MONTH(date_daily) = 11, debit+credit, 0) ) AS November,
	COUNT( IF( MONTH(date_daily) = 12, debit+credit, NULL) ) AS coun_12,
	SUM( IF( MONTH(date_daily) = 12, debit+credit, 0) ) AS December,
	
	COUNT(date_daily) AS count,
	SUM( debit+credit ) AS total
FROM daily WHERE (((art)='rechnung') AND (daily.date_daily >= '$search_keyword2%') AND (retoure='No') AND (sales='$sales'))
GROUP BY name_user
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

    $sql = "SELECT daily.id, daily.number_user, daily.id_user, daily.sales, daily.name_user, daily.debit, daily.credit, daily.statement, daily.date_daily, daily.art, daily.retoure
FROM daily
WHERE (((art)='rechnung') AND (daily.date_daily >= '$search_keyword2%') AND (retoure='No') AND (daily.sales='$sales'))
ORDER BY daily.art, daily.id, daily.date_daily";

	
    $result = mysqli_query($con, $sql);
//  ---------------------  Total ------
	$total2=0;
    $total3=0;
    $sql2= "SELECT Sum(debit) as 'total2' FROM daily
    WHERE (((art)='rechnung') AND (daily.date_daily >= '$search_keyword2%') AND (retoure='No') AND (sales='$sales'))";
    $result2 = mysqli_query($con, $sql2);
    $sql3= "SELECT Sum(credit) as 'total3' FROM daily
    WHERE (((art)='rechnung') AND (daily.date_daily >= '$search_keyword2%') AND (retoure='No') AND (sales='$sales'))";
    $result3 = mysqli_query($con, $sql3);
    $result4 = mysqli_query($con, $sql);
  
              
?>

    
	
<?php    
      if ( ($result) && ($result2) && ($result3)&& ($result4)) {  
       $data2 = mysqli_fetch_assoc($result2);
       $data3 = mysqli_fetch_assoc($result3);

?>
    <br>
<table class="tbl-qa">
  <thead>
	<tr >
	  <th class="table-header" width="10%">Pos.</th>
	  <th class="table-header" width="15%">ID</th>
	  <th class="table-header" width="15%">ART</th>

      <th class="table-header" width="15%">ID User.</th>
	  <th class="table-header" width="15%">Nr</th>
	  <th class="table-header" width="10%">Typ</th>          
      <th class="table-header" width="10%">Name</th>  
      <th class="table-header" width="5%">Retoure</th> 
	  <th class="table-header" width="10%">Debit</th>
	  <th class="table-header" width="10%">Credit</th>
      <th class="table-header" width="30%">Artikel</th>
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
		<td><?php echo utf8_encode($row["id_user"]); ?></td>
		<td><?php echo utf8_encode($row["number_user"]); ?></td>  
		<td><?php echo utf8_encode($row["sales"]); ?></td>
		<td><?php echo utf8_encode($row["name_user"]); ?></td>            
        <td><?php echo utf8_encode($row["retoure"]); ?></td>
		<td><?php echo round($row["debit"],2); ?></td>
		<td><?php echo round($row["credit"],2); ?></td>
        <td><?php echo $row["statement"]; ?></td>
        <td><?php echo date_format(date_create($row["date_daily"]),"d.m.Y"); ?></td>  
          
	  </tr>
    <?php
      }
       ?>
      <tr class="table-row">
      <td colspan="5"></td>
      <td></td>
      <td></td>
      <td></td>
      <td ><b><?php echo round($data2["total2"],2); ?></b></td>      
      <td ><b><?php echo round($data3["total3"],2); ?></b></td> 
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