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
            <li><a href="day.php">Täglich</a></li>
                <li><a href="users.php">Kunden</a></li>
                <li class="active"><a href="seller.php">Mitarbeiter</a></li>
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

    
	$sql = "SELECT seller.id_seller, seller.number_seller, seller.name_seller, seller.address, seller.telephon
FROM seller";

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
	  <th class="table-header" width="5%"><div style="text-align:right;"><a href="add_s.php" class="button_link"><img src="crud-icon/add.png" title="Add New Record" style="vertical-align:bottom;" />Add</a></div ></th>
	  <th class="table-header" width="10%">Nr. Verkauver</th>
	  <th class="table-header" width="20%">Verkauver</th> 
      <th class="table-header" width="25%">Address</th>        
      <th class="table-header" width="15%">Telephon</th>
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
		<td><?php echo $row["id_seller"]; ?></td>
		<td><?php echo $row["number_seller"]; ?></td>
        <td><?php echo $row["name_seller"]; ?></td>          
        <td><?php echo $row["address"]; ?></td>        
		<td><?php echo $row["telephon"]; ?></td>
	<td>
		<a href='edit_s.php?id_seller=<?php echo $row['id_seller']; ?>'><img src="crud-icon/edit.png" title="Edit" />
        </a>
    </td>
          
<!--		<a href='delete_u.php?id_user=<?php echo $row['id_user']; ?>'><img src="crud-icon/delete.png" title="Delete" /></a>-->
        <td><a href='report_seller.php?id_seller=<?php echo $row['id_seller']; ?>' target="_blank"> <img src="crud-icon/is4.png" title="Print" />
        </a>
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
<!--        </div>        -->
    <?php
            }  else {
    header("Location: login.php");//if there is no cookie
}
            ?> 
</body>
</html>