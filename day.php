<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
require_once("db.php");
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
	// TOGGLE --------------------------------
	if (isset($_REQUEST["toggle"])) {
		
		// Werte vorbereiten
		$id_day = $_REQUEST["id_day"];
		$active = $_REQUEST["value"];
		
		if ($active == 1) {
			$active = 0;			
		} else {
			$active = 1;
		}
		
		// Werte verarbeiten
		$sql = "UPDATE day
				SET 	active=".$active."
				WHERE 	id_day=".$id_day;
				
		mysqli_query($con, $sql) or die("MySQL: ".mysqli_error($con));
	}
//	-------- End TOGGLE -------------
    $sql = "SELECT day.id_day, day.active, day.id_seller, day.statement_day, day.date_day, day.art, seller.id_seller, seller.number_seller, seller.name_seller, seller.address, seller.telephon
    FROM seller RIGHT JOIN day ON seller.id_seller = day.id_seller";


    $result = mysqli_query($con, $sql);
?>     
 <div class="container-fluid">
<!--<div class="container">      -->
<div class="row">
<div class="col-md-12">    
<div id="wrap">    
<table class="tbl-qa">
  <thead>
	<tr>
	  <th class="table-header" width="10%"><div style="text-align:right;"><a href="add_d.php" class="button_link"><img src="crud-icon/add.png" title="Add New Record" style="vertical-align:bottom;" />Add</a></div ></th>
      <th class="table-header" width="10%">Active</th>
      <th class="table-header" width="15%">Verkaufer</th>
	  <th class="table-header" width="30%">Beschreibung</th>        
	  <th class="table-header" width="15%">Datum</th>
      <th colspan="2" class="table-header" width="5%">Actions</th> 
      <th class="table-header" width="25%">Detail</th>         

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
          
        <td><?php echo $row["id_day"]; ?></td>
          
        <td><?php echo '<a href="day.php?toggle=yes&id_day='.$row["id_day"].'&value='.$row["active"].'">'.$row["active"].'</a>'; ?></td>             
        <td><?php echo $row["name_seller"]; ?></td>  
        <td><?php echo $row["statement_day"]; ?></td>
        <td><?php echo date_format(date_create($row["date_day"]),"d.m.Y"); ?></td>         
          

         
         
	<td>
		<a href='edit_d.php?id_day=<?php echo $row['id_day']; ?>'><img src="crud-icon/edit.png" title="Edit" /></a>
          </td>
    <td><a href="report_d.php?id_day=<?php echo $row['id_day']; ?>" target="_blank"><img src="crud-icon/is4.png" title="Print" /></a></td> 
<!--	<td><a href='delete_d.php?id_day=<?php echo $row['id_day']; ?>'><img src="crud-icon/delete.png" title="Delete" /></a>-->
<!--		</td>-->
        <td> 
		<a href='day_detail.php?id_day=<?php echo $row['id_day']; ?>'>Tägliche Details</a>
		</td>
	  </tr>
    <?php
      }
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
<!--        </div>     -->
    <?php
            }  else {
    header("Location: login.php");//if there is no cookie
}
            ?> 
</body>
</html>