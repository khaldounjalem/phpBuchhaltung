<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
require_once("db.php");
session_start();
     $id_day=$_SESSION["id_day"];

    $id_day_detail = $_REQUEST["id_day_detail"];
        $t=time();
    $date_delet = date("Y-m-d",$t);
        $user=$_COOKIE['user'];
    
    $sql1 = "INSERT INTO day_detail_deleted ( id_day_detail, id_day, id_user, debit, credit, statement_day_detail, user, date_delet )
SELECT day_detail.id_day_detail, day_detail.id_day, day_detail.id_user, day_detail.debit, day_detail.credit, day_detail.statement_day_detail, '$user', '$date_delet'
FROM day_detail
WHERE day_detail.id_day_detail=".$id_day_detail;

    $result1 = mysqli_query($con, $sql1)or die("MySQL: ".mysqli_error($con));

		
	$sql = "DELETE FROM day_detail WHERE id_day_detail=".$id_day_detail;

    $result = mysqli_query($con, $sql)or die("MySQL: ".mysqli_error($con));

    if (!empty($result) ){
//	  header('location:rechnungen_detail.php');
        
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">    
<!--<link href="style.css" rel="stylesheet" type="text/css">-->
<style>
.button_link {color:#FFF;text-decoration:none; background-color:#428a8e;padding:10px;}
</style>    
</head>
<body>
<div style="text-align:left;">
    <h3>Record Deleted</h3>
    <a class="button_link" href="day_detail.php?id_day=<?php echo $_SESSION["id_day"]; ?>" class="button_link">Zuruck Day Detail</a>
</div>
    <?php
//    session_destroy();
    ?>
    <?php
            }  else {
    header("Location: login.php");//if there is no cookie
}
            ?> 
 </body>
</html>