<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
    
require_once("db.php");
$search_keyword = '';
	if(!empty($_POST['search']['keyword'])) {
		$search_keyword = $_POST['search']['keyword'];
	}
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
    .btn { color:#FFF;border-radius: 4px;background-color:#cde4e5; padding:4px;font-size: 18px;}
   .navbar-right {float: right !important;margin-right: 50px; }
/*.block2{padding-top:2px;padding-bottom:2px;background: rgba(39, 39, 80, 0.41);}*/
    #wrap{width: 100%; box-shadow: 4px 4px 8px #061738;background: #fff;}
    .button_link1 {position: absolute;top: 63px;left: 15px;color:#FFF;text-decoration:none;
        border-radius: 6px;background-color:#428a8e;padding:10px;}
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
                <li class="active"><a href="users.php">Kunden</a></li>
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
	$sql = "SELECT users.id_user, users.principal, users.general, users.number_user, users.name_user_ar, users.name_user, users.art, users.art1, users.benutzertyp, users.address, users.telephon, users.mobile, principal.principal_name_ar, principal.principal_name_en, general.general_name_ar, general.general_name_en
FROM (users LEFT JOIN principal ON users.principal = principal.principal_id) LEFT JOIN general ON users.general = general.general_id
          WHERE  (users.number_user LIKE '%$search_keyword%' or users.name_user LIKE '%$search_keyword%' or users.address LIKE '%$search_keyword%'or users.telephon LIKE '%$search_keyword%' or users.mobile LIKE '%$search_keyword%' or principal.principal_name_en LIKE '%$search_keyword%'or general.general_name_en LIKE '%$search_keyword%')
          ORDER BY users.principal, users.general, users.number_user";

    $result = mysqli_query($con, $sql);

?>
<form name='frmSearch' action='' method='post'>    
 <div class="container-fluid">
<!--<div class="container">      -->
<div class="row">
<div class="col-md-12">    
<div id="wrap">

<table class="tbl-qa">
  <thead>
<tr class="table-row">
     
<td colspan="10">Statistische Studie für ein Jahr
<a href='report_user_pivot.php' target="_blank"> <img src="crud-icon/is5.png"title="Print" /></a >
&nbsp;&nbsp;&nbsp;&nbsp;Täglisch Von Bis
<a href='report_alluser.php' target="_blank"> <img src="crud-icon/is5.png"title="Print" /></a > 
<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sehrch : </b><input type='text' name='search[keyword]' autofocus value="<?php echo $search_keyword; ?>" id='keyword' maxlength='25'></td>    
</tr>      
	<tr>
	  <th class="table-header" width="5%"><div style="text-align:right;"><a href="add_u.php" class="button_link1"><img src="crud-icon/add.png" title="Add New Record" style="vertical-align:bottom;" />Add</a></div ></th>
      <th class="table-header" width="10%">Principal</th>
      <th class="table-header" width="15%">General</th>         
	  <th class="table-header" width="5%">Nr.User</th>
	  <th class="table-header" width="20%">Name</th> 
      <th class="table-header" width="15%">Address</th>
      <th class="table-header" width="15%">Telephon</th>
      <th class="table-header" width="10%">Mobile</th>          
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
		<td><?php echo $row["id_user"]; ?></td>
 		<td><?php echo $row["principal_name_en"]; ?></td>
        <td><?php echo $row["general_name_en"]; ?></td>          
		<td><?php echo $row["number_user"]; ?></td>
        <td><?php echo $row["name_user"]; ?></td>   
           
		<td><?php echo $row["address"]; ?></td>
        <td><?php echo $row["telephon"]; ?></td>
        <td><?php echo $row["mobile"]; ?></td>           
	<td>
		<a href='edit_u.php?id_user=<?php echo $row['id_user']; ?>'><img src="crud-icon/edit.png" title="Edit" />
        </a>
    </td>
          
<!--		<a href='delete_u.php?id_user=<?php echo $row['id_user']; ?>'><img src="crud-icon/delete.png" title="Delete" /></a>-->
        <td><a href='report_user.php?id_user=<?php echo $row['id_user']; ?>' target="_blank"> <img src="crud-icon/is4.png" title="Print" />
        </a>
		</td>
	  </tr>
    <?php
      }
        }
       ?>


    </tbody>
</table>
       </form>
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