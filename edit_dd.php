<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
require_once("db.php");
session_start();
     $id_day=$_SESSION["id_day"];
if (isset($_REQUEST["save_record"])) {
        $id_user = $_REQUEST["id_user"];
        $debit = $_REQUEST["debit"];
        $credit = $_REQUEST["credit"];
        $statement_day_detail = $_REQUEST["statement_day_detail"];
        $id_day_detail = $_REQUEST["id_day_detail"];
		
		$sql = "UPDATE day_detail
				SET 	id_user=".$id_user.",
						debit=".$debit.",
                        credit=".$credit.",
                        statement_day_detail='".$statement_day_detail."'
				WHERE	id_day_detail=".$id_day_detail;
				
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
//    session_destroy();            
//              header('location:index.php');
            }
		
	}
$sql = "SELECT day_detail.id_day_detail, day_detail.id_day, day_detail.id_user, day_detail.debit, day_detail.credit, day_detail.statement_day_detail, users.id_user, users.name_user, users.benutzertyp, users.address, users.telephon
FROM day_detail LEFT JOIN users ON day_detail.id_user = users.id_user
WHERE id_day_detail=".$_REQUEST['id_day_detail'];



    $result = mysqli_query($con, $sql);
    
?>
<html>
<head>
<title>PHP Msqli - Edit Record</title>
<style>
body{width:615px;font-family:arial;letter-spacing:1px;line-height:20px;}
.button_link {color:#FFF;text-decoration:none; background-color:#428a8e;padding:10px;border-radius: 4px;}
.frm-add {position: relative;width:615px;border: #c3bebe 1px solid;margin-top: 10px;padding: 30px;}
.demo-form-heading {margin-top:0px;font-weight: 500;}	
.demo-form-row{margin-top:20px;}
.demo-form-row input{position: absolute;left:200px;}    
.demo-form-row select{position: absolute;left:200px;} 
label{font-size: 20px; line-height: 40px;}     
.demo-form-field{width:300px;padding:10px;font-size: 20px;}
.demo-form-submit{color:#FFF;background-color:#414444;padding:10px 50px;border:0px;cursor:pointer;border-radius: 4px;}
</style>
</head>
<body>
<!--<div style="margin:20px 0px;text-align:right;"><a href="index.php" class="button_link">Back to List</a></div>-->
<div class="frm-add">
<h1 class="demo-form-heading">Edit Record</h1>
    
<form name="frmEdit" action="" method="POST">
    <?php 
        if ($result) {

              $data = mysqli_fetch_assoc($result);
               
	$id_user = $data["id_user"];
	$debit = $data["debit"];
    $credit = $data["credit"];
    $statement_day_detail = $data["statement_day_detail"];            
    $id_day = $data["id_day"];            
    ?>            

    <!---------------------- list kauf -------->
  <div class="demo-form-row">
	  <label>Name: </label>

   <select class="ns demo-form-field" name="id_user">
                   <option value="<?php echo $data["id_user"] ?>"><?php echo  $data["name_user"]; ?></option>
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
<!--	  <label>id_day: </label><br>-->
    <input type="hidden" name="id_day" class="demo-form-field" value="<?php echo $id_day; ?>" required  />
  </div>    
  <div class="demo-form-row">
	  <label>Debit: </label>
    <input type="text" name="debit" class="demo-form-field" value="<?php echo $debit; ?>" required  />
  </div>
    
  <div class="demo-form-row">
      <label>Credit: </label>
    <input type="text" name="credit" class="demo-form-field" value="<?php echo $credit; ?>" required  />
  </div>
  <div class="demo-form-row">
      <label>Beschreibung: </label>
    <input type="text" name="statement_day_detail" class="demo-form-field" value="<?php echo $statement_day_detail; ?>" required  />
  </div>    
    <div class="demo-form-row">
        <?php
		}
//    }
	?>  
  <input name="save_record" type="submit" value="Save" class="demo-form-submit">
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