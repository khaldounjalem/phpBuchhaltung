<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
session_start();
require_once("db.php");
$id_day=$_SESSION["id_day"];
if (isset($_REQUEST["add_record"])) {
		$id_day = $_SESSION["id_day"];
		$id_user = $_REQUEST["id_user"];
    	$debit = $_REQUEST["debit"];
	    $credit = $_REQUEST["credit"];
        $statement_day_detail = $_REQUEST["statement_day_detail"];

		$sql = "INSERT INTO day_detail 
						(id_day, id_user, debit, credit, statement_day_detail) 
				VALUES 	(".$id_day.",".$id_user.",".$debit.",".$credit.",'".$statement_day_detail."')";

		// Query absenden
		$result = mysqli_query($con, $sql);

		if(!$result) {
			echo mysqli_error($con);
		}
    if (!empty($result) ){
?>
<div style="text-align:right;">
    <a href="day_detail.php?id_day=<?php echo $_SESSION["id_day"]; ?>" class="button_link">Zuruck Day Detail</a>
</div>
<?php
//	  header('location:index.php');
	}
}
?>
<html>
<head>
<title>PHP Mysqli - Add New Record</title>
<style>
body{width:615px;font-family:arial;letter-spacing:1px;line-height:20px;}
.button_link {color:#FFF;text-decoration:none; background-color:#428a8e;padding:10px;border-radius: 4px;}
.frm-add {position: relative;width:615px;border: #c3bebe 1px solid;
    padding: 30px;}
.demo-form-heading {margin-top:0px;font-weight: 500;}	
.demo-form-row{margin-top:20px;}
.demo-form-row input{position: absolute;left:220px;}    
.demo-form-row select{position: absolute;left:220px;} 
label{font-size: 20px; line-height: 40px;}     
.demo-form-field{width:300px;padding:10px;font-size: 20px;}
.demo-form-submit{color:#FFF;background-color:#414444;padding:10px 50px;border:0px;cursor:pointer;border-radius: 4px;}
</style>
</head>
<body>
<!--<div style="margin:20px 0px;text-align:right;"><a href="index.php" class="button_link">Back to List</a></div>-->
<div class="frm-add">
<h1 class="demo-form-heading">Add New Record</h1>

<form name="frmAdd" action="" method="POST">
  
  <!---------------------- list kauf -------->
  <div class="demo-form-row">
	  <label>Nmae: </label>

   <select class="ns demo-form-field" name="id_user" required>
                    <option value = "">-- Add --</option>
         <?php
            $qry2 = "select * from users
            WHERE ((number_user Between 161001 AND 162000 ) OR (number_user Between 261001 AND 262000 )) ORDER BY users.name_user";
             $result2 = mysqli_query($con, $qry2);
            while ($row = mysqli_fetch_assoc($result2)) {
                echo "<option value='$row[id_user]'>$row[name_user]</option>";
            }
         ?>

    </select> 
    </div>
<!--   ------------------------ end list --------->
    <div class="demo-form-row">
	  <label>debit: </label>
	  <input type="text" name="debit" class="demo-form-field"  value="0" />
  </div>

  <div class="demo-form-row">
	  <label>credit: </label>
	  <input type="text" name="credit" class="demo-form-field" value="0"  />
  </div>
    
  <div class="demo-form-row">
	  <label>Beschreibung: </label>
	  <input type="text" name="statement_day_detail" class="demo-form-field"  required />
  </div>    

  <div class="demo-form-row">
	  <input name="add_record" type="submit" value="Add" class="demo-form-submit">
  </div><br>
    

  </form>
</div> 
    <?php
            }  else {
    header("Location: login.php");//if there is no cookie
}
            ?> 
</body>
</html>