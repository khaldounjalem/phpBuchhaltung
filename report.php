<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
require_once("db.php");
?>
<!DOCTYPE html>
<html>
  <head>

<meta charset="utf-8"> 
    <title>PHP mysqli</title>
      	<link href="style.css" rel="stylesheet">
<style >
    aside.sidebar1{position: absolute;top: 3px;right: 100px;}
    .logo {position: absolute;top: 20px;right: 600px;}
	   #wrap2{width: 1100px;margin-left: 10px;letter-spacing:1px; line-height:24px;}
</style>
</head>
<body>

<?php

	$search_keyword = '';
    if(!empty($_REQUEST['id_Invoice'])){
          $search_keyword =$_REQUEST['id_Invoice'];  
    }

	if(!empty($_POST['search']['keyword'])) {
		$search_keyword = $_POST['search']['keyword'];
	}
	
	$sql = "SELECT invoice.id_Invoice, users.name_user, users.benutzertyp, users.number_user,  invoice.date_Invoice, invoice.statement_invoice, invoice.number_Invoice,invoice.rabatt_r, invoice_details.id_details_invoice, artikel.name_artikel, invoice_details.quantity, invoice_details.price, invoice_details.rabatt_rd, (quantity*price) AS total
FROM (users RIGHT JOIN invoice ON users.id_user = invoice.id_user) LEFT JOIN (invoice_details LEFT JOIN artikel ON invoice_details.statement_Invoice_details = artikel.id_artikel) ON invoice.id_Invoice = invoice_details.id_Invoice
WHERE (((invoice.id_Invoice)=$search_keyword))
ORDER BY invoice_details.id_details_invoice";

	
	
    $result = mysqli_query($con, $sql);
//  ---------------------  Total ------
	$total2=0;
    $total3=0;
    $sql2= "SELECT Sum(quantity*price) as 'total2' FROM invoice_details
    WHERE id_Invoice =$search_keyword";
    $result2 = mysqli_query($con, $sql2);
    
    $sql22= "SELECT Sum(quantity*price-quantity*price*rabatt_rd/100) as 'total22' FROM invoice_details
    WHERE id_Invoice =$search_keyword";
    $result22 = mysqli_query($con, $sql22);  
    
    $sql3= "SELECT Sum(quantity) as 'total3' FROM invoice_details
    WHERE id_Invoice =$search_keyword";
    $result3 = mysqli_query($con, $sql3);
    $result4 = mysqli_query($con, $sql);
  
              
?>
<div id="wrap2">      
<form name='frmSearch' action='' method='post'>    
<!--<div style='text-align:right;margin:20px 0px;'><b></b><input type='text' name='search[keyword]' autofocus value="<?php echo utf8_encode($search_keyword); ?> " id='keyword' maxlength='25'></div>-->
	
<?php    
      if ( ($result) && ($result2) && ($result3)&& ($result4)) {  
       $data2 = mysqli_fetch_assoc($result2);
       $data22 = mysqli_fetch_assoc($result22);          
       $data3 = mysqli_fetch_assoc($result3);
       $data4 = mysqli_fetch_assoc($result4); 
?>
<main>
    <img class="logo" width="150" src="images/logo.png">
	<section class="content2">
		<ul type="none">
		<li><p>Max Mustermann | Musterstr. 1 | 41321 Musterstadt</p></li>
		<li><p>Frau</p></li>
		<li><p>Beispielstr. 27</p></li>
		<li><p>54657 Beispielstadt</p></li> 
		</ul>
	</section>
	<aside class="sidebar1 clearfix ">
		<ul type="none">
		<li><p>Telefon: 01234/987654-0</p></li>
		<li><p>Telefax: 01234/987654-1</p></li>
		<li><p>Mobil: 01234/987654-3</p></li>
		<li><p>E-Mail: max@mustermann.de</p></li>
		<li><p>Internet: www.mustermann.de</p></li>
		<li><p>Steuernummer: xxxx/xxxx/xxxx</p></li>
		<br>
		<li><p>USt-ID-Nr.: DExxxx</p></li>
		<li><p>aktuelles Datum: <?php echo date("d.m.Y", time())?></p></li>     
		</ul>
	</aside>

<section class="content3">
<br><br><br><br>    
<ul type="none">
<li><p>Sehr geehrte Damen Und Herren </p></li>
<li><p>für die Erledigung der von Ihnen beauftragen Tätigkeiten berechne ich Ihnen wie folgt:</p></li>
<br>    
</ul> 
</section> 
</main>        
<table class="tbl-qa">
    <tr class="table-row">
    <td>Rechnung Nr. :
    <?php echo utf8_encode($data4["id_Invoice"]); ?></td>
    <td>Der
    <?php echo utf8_encode($data4["name_user"]." Nr. ".$data4["number_user"]); ?></td>
    <td>Datum :
   <?php echo utf8_encode(date_format(date_create($data4["date_Invoice"]),"d.m.Y")); ?></td>  
    </tr>
    </table>    
<table class="tbl-qa">
  <thead>
	<tr >
	  <th class="table-header" width="10%">Pos.</th>        
	  <th class="table-header" width="30%">Artikel</th>
	  <th class="table-header" width="10%">Menge</th>
      <th class="table-header" width="10%">Einzelpreis</th>
      <th class="table-header" width="10%">Gesamt</th>    

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
		<td><?php echo utf8_encode($row["name_artikel"]); ?></td>
		<td><?php echo utf8_encode($row["quantity"]); ?></td>
        <td><?php echo utf8_encode($row["price"]); ?></td>
        <td><?php echo utf8_encode($row["total"]); ?></td>  
	  </tr>
    <?php
      }
       ?>
      <tr class="table-row">
      <td></td> 
      <td></td>          
      <td ><b><?php echo round($data3["total3"],2); ?></b></td> 
      <td ></td>         
      <td ><b><?php echo round($data2["total2"],2); ?></b></td>
      </tr>
      <tr class="table-row">
      <td></td> 
      <td></td>          
      <td ><b></b></td> 
      <td >Rabat </td>         
      <td ><b><?php echo round(($data2["total2"]-$data22["total22"]+$data4["rabatt_r"]),2); ?></b></td>
      </tr>       
      <tr class="table-row">
      <td></td> 
      <td></td>          
      <td ><b></b></td> 
      <td >Rechnungsbetrag </td>         
      <td ><b><?php echo round(($data22["total22"]-$data4["rabatt_r"]),2); ?></b></td>
      </tr>      


    </tbody>
</table>
<div>
    <br>
    <ul type="none">
    <li><p>Vielen Dank für Ihren Auftrag!</p></li>
    <li><p>Ich bitte um Überweisung des Rechnungsbetrages</p></li>
    <li><p>innerhalb von 14 Tagen an die unten genannte Bankverbindung.</p></li>
    <li><p>Mit freundlichen Grüßen</p></li>
    <li><p>Max Mustermann </p></li> 
    <li><p>Bankverbindung: Max Mustermann – Deutsche Bank AG – BLZ 300 700 24 – KTO 987654321</p></li>          
    </ul>
</div>        
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