<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
session_start();
require_once("db.php");
	$id_day = $_REQUEST["id_day"];
 $_SESSION["id_day"]=$id_day;
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
            <li><a href="index.php">Rechnung</a></li>
            <li class="active"><a href="day.php">Täglich</a></li>
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

	$sql = "SELECT day_detail.id_day_detail, day_detail.id_day, day_detail.id_user, day_detail.debit, day_detail.credit, day_detail.statement_day_detail, users.id_user, users.number_user, users.name_user, users.benutzertyp, users.address, users.telephon
FROM day_detail LEFT JOIN users ON day_detail.id_user = users.id_user
WHERE day_detail.id_day=".$id_day;
    
    $result = mysqli_query($con, $sql);
    
    $sql2 = "SELECT day.id_day, day.active, day.statement_day, day.date_day, day_detail.id_day_detail, day_detail.id_day, day_detail.id_user, day_detail.debit, day_detail.credit, day_detail.statement_day_detail
FROM day LEFT JOIN day_detail ON day.id_day = day_detail.id_day
WHERE day.id_day=".$id_day;
    
    $result2 = mysqli_query($con, $sql2);
    
    if ($result2) {
    $data = mysqli_fetch_assoc($result2);
 ?>
 <div class="container-fluid">
<!--<div class="container">      -->
<div class="row">
<div class="col-md-12">    
<div id="wrap">
    <table class="tbl-qa">
    <tr class="table-row">
    <td>ID Tag. :
    <?php echo $data["id_day"]; ?></td>
    <td>Beschreibung :
    <?php echo $data["statement_day"]; ?></td>
    <td>Datum :
   <?php echo date_format(date_create($data["date_day"]),"d.m.Y"); ?></td>  
    </tr>
    </table>
        <?php
    }
    ?>
<table class="tbl-qa">
  <thead>
	<tr>
	  <th class="table-header" width="5%"><div style="text-align:right;"><a href="add_dynamic_dd/index.php" class="button_link"><img src="crud-icon/add.png" title="Add New Record" style="vertical-align:bottom;" />Add</a></div ></th>
	  <th class="table-header" width="8%">ID Tag</th>
	  <th class="table-header" width="9%">Nr User</th>        
      <th class="table-header" width="20%">Name</th>
<!--      <th class="table-header" width="10%">BenutzerTyp</th>-->
      <th class="table-header" width="10%">Debit</th>    
      <th class="table-header" width="10%">Credit</th>    
      <th class="table-header" width="26%">Beschreibung</th>         
      <th colspan="2" class="table-header" width="10%">Actions</th> 
	</tr>
  </thead>
  <tbody id="table-body">
	<?php

    if ($result) {
		
		// mysqli_fetch_assoc
		// Holt den nächsten Datensatz der Abfrage und erzeugt daraus
		// ein assoziatives Array		
        while ($row = mysqli_fetch_assoc($result)) {
	?>
	  <tr class="table-row">
		<td><?php echo $row["id_day_detail"]; ?></td>
		<td><?php echo $row["id_day"]; ?></td>
		<td><?php echo $row["number_user"]; ?></td>          
		<td><?php echo $row["name_user"]; ?></td>
<!--		<td><?php echo $row["benutzertyp"]; ?></td>          -->
        <td><?php echo $row["debit"]; ?></td>
        <td><?php echo $row["credit"]; ?></td>  
        <td><?php echo $row["statement_day_detail"]; ?></td>
	<td>
		<a href='edit_dd.php?id_day_detail=<?php echo $row['id_day_detail']; ?>'><img src="crud-icon/edit.png" title="Edit" /></a></td>
        
<!--        <a href="index.php?delete=1" onclick="return confirm(\'Are you sure you want to delete ?\')">Delete</a>-->
        <td>
		<a href="delete_dd.php?id_day_detail=<?php echo $row['id_day_detail']; ?>" onclick="return confirm('Are you sure you want to delete?')"><img src="crud-icon/delete.png" title="Delete" /></a>
		</td>
	  </tr>
<?php
        }
	$total2=0;
    $total3=0;
    $sql3= "SELECT Sum(debit) as 'total3' FROM day_detail
    WHERE id_day =".$id_day;
    $result3 = mysqli_query($con, $sql3);

    $sql4= "SELECT Sum(credit) as 'total4' FROM day_detail
    WHERE id_day =".$id_day;

    $result4 = mysqli_query($con, $sql4);
    if (($result3) && ($result4)) {            
       $data3 = mysqli_fetch_assoc($result3);
       $data4 = mysqli_fetch_assoc($result4); 
?>            
      <tr class="table-row">
      <td></td> 
      <td></td>          
      <td></td>       
<!--      <td></td> -->
      <td></td>           
      <td ><b><?php echo round($data3["total3"],2); ?></b></td>
      <td ><b><?php echo round($data4["total4"],2); ?></b></td> 
      <td ><b><?php echo round(($data4["total4"]-$data3["total3"]),2); ?></b> </td>  
      <td colspan="2" ><a href="report_d.php?id_day=<?php echo $_REQUEST['id_day']; ?>" target="_blank"><img src="crud-icon/is5.png" title="Print" /></a></td>       

      </tr>
      
      
    <?php
      }
        
        }
       ?>


<!--    </tbody>-->
</table>
</div>    
      <script src="js/jquery-1.11.3.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/plugins.js"></script> 
         </div>
        </div>
         </div>
<!--        </div>       -->
    <?php
            }  else {
    header("Location: login.php");//if there is no cookie
}
            ?> 
</body>
</html>