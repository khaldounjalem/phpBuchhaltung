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
	   #wrap2{width: 1100px;}
</style>
</head>
<body>

<?php

	$search_keyword = '';
    if(!empty($_REQUEST['id_day'])){
          $search_keyword =$_REQUEST['id_day'];  
    }
	if(!empty($_POST['search']['keyword'])) {
		$search_keyword = $_POST['search']['keyword'];
	}
	
	$sql = "SELECT day.id_day, day.active, day.statement_day, day.date_day, day_detail.id_day_detail, day_detail.id_day, day_detail.id_user, day_detail.debit, day_detail.credit, day_detail.statement_day_detail, users.id_user, users.number_user, users.name_user, users.benutzertyp, users.address, users.telephon
FROM (day LEFT JOIN day_detail ON day.id_day = day_detail.id_day) LEFT JOIN users ON day_detail.id_user = users.id_user
WHERE (((day.id_day)=$search_keyword))
ORDER BY day_detail.id_day_detail";

   $result = mysqli_query($con, $sql);

//  ---------------------  Total ------
	$total2=0;
    $total3=0;
    $sql2= "SELECT Sum(debit) as 'total2' FROM day_detail
    WHERE id_day =$search_keyword";
    $result2 = mysqli_query($con, $sql2);

    $sql3= "SELECT Sum(credit) as 'total3' FROM day_detail
    WHERE id_day =$search_keyword";

    $result3 = mysqli_query($con, $sql3);
    $result4 = mysqli_query($con, $sql);
  
              
?>
    <div id="wrap2">      
<form name='frmSearch' action='' method='post'>    
<div style='text-align:right;margin:20px 0px;'><b>Enter Day ID. : </b><input type='text' name='search[keyword]' autofocus value="<?php echo utf8_encode($search_keyword); ?> " id='keyword' maxlength='25'></div>
	
<?php    
      if ( ($result) && ($result2) && ($result3) && ($result4)) {  
       $data2 = mysqli_fetch_assoc($result2);
       $data3 = mysqli_fetch_assoc($result3);
       $data4 = mysqli_fetch_assoc($result4); 
?>
<!--
<main>
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
		<li><p>aktuelles Datum</p></li>     
		</ul>
	</aside>

<section class="content3">
<ul type="none">
<li><p>Sehr geehrte Frau Beispiel,</p></li>
<li><p>für die Erledigung der von Ihnen beauftragen Tätigkeiten berechne ich Ihnen wie folgt:</p></li>
</ul> 
</section> 
</main>        
-->
<table class="tbl-qa">
    <tr class="table-row">
    <td>ID Day :
    <?php echo utf8_encode($data4["id_day"]); ?></td>
    <td colspan="3">Beschreibung :
    <?php echo $data4["statement_day"]; ?></td>
    <td colspan="2">Datum :
   <?php echo utf8_encode(date_format(date_create($data4["date_day"]),"d.m.Y")); ?></td>  
    </tr>
    </table>    
<table class="tbl-qa">
  <thead>
	<tr >
	  <th class="table-header" width="5%">Pos.</th>        
	  <th class="table-header" width="10%">Nr K/L</th>
	  <th class="table-header" width="20%">Name</th>
<!--	  <th class="table-header" width="10%">typ</th>-->
	  <th class="table-header" width="10%">Debit</th>        
      <th class="table-header" width="10%">Credit</th>
      <th class="table-header" width="30%">Beschreibung</th>    

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
		<td><?php echo utf8_encode($row["number_user"]); ?></td>		
        <td><?php echo utf8_encode($row["name_user"]); ?></td>
<!--        <td><?php echo utf8_encode($row["benutzertyp"]); ?></td>          -->
		<td><?php echo round($row["debit"],2); ?></td>
        <td><?php echo round($row["credit"],2); ?></td>
        <td><?php echo utf8_encode($row["statement_day_detail"]); ?></td>  
	  </tr>
    <?php
      }
       ?>
      <tr class="table-row">
      <td></td> 
      <td></td> 
<!--      <td></td> -->
      <td></td>          
      <td ><b><?php echo round($data2["total2"],2); ?></b></td>
      <td ><b><?php echo round($data3["total3"],2); ?></b></td> 
      <td ><b><?php echo round(($data3["total3"]-$data2["total2"]),2); ?></b> </td>          
<!--      <td colspan="2"></td>      -->
      </tr>


    </tbody>
</table>
<!--
<div>
    <ul type="none">
    <li><p>Vielen Dank für Ihren Auftrag!</p></li>
    <li><p>Ich bitte um Überweisung des Rechnungsbetrages</p></li>
    <li><p>innerhalb von 14 Tagen an die unten genannte Bankverbindung.</p></li>
    <li><p>Mit freundlichen Grüßen</p></li>
    <li><p>Max Mustermann </p></li> 
    <li><p>Bankverbindung: Max Mustermann – Deutsche Bank AG – BLZ 300 700 24 – KTO 987654321</p></li>          
    </ul>
</div>        
-->
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