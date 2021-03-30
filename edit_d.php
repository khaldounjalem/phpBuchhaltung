<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
require_once("db.php");
session_start();
	$id_day = $_REQUEST["id_day"];
    $_SESSION["id_day"]=$id_day;
if (isset($_REQUEST["save_record"])) {
        $statement_day = $_REQUEST["statement_day"];
        $date_day = $_REQUEST["date_day"];
        $id_day = $_REQUEST["id_day"];
        $id_seller = $_REQUEST["id_seller"];
		
		$sql = "UPDATE day
				SET 	id_seller=".$id_seller.",
                        statement_day='".$statement_day."',
						date_day='".$date_day."'
				WHERE	id_day=".$_SESSION["id_day"];
       session_destroy();
				
		$result = mysqli_query($con, $sql); 
            if(!$result) {
                    echo mysqli_error($con);
                }
            if (!empty($result) ){
              header('location:day.php');
            }
		
	}
       $sql = "SELECT day.id_day, day.active, day.id_seller, day.statement_day, day.date_day, day.art, seller.id_seller, seller.number_seller, seller.name_seller, seller.address, seller.telephon
FROM seller RIGHT JOIN day ON seller.id_seller = day.id_seller
WHERE id_day=".$_REQUEST["id_day"];

    $result = mysqli_query($con, $sql);
    
?>
<html>
<head>
<title>PHP Msqli - Edit Record</title>
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
<div style="margin:20px 0px;text-align:right;"><a href="day.php" class="button_link">Back to List</a></div>
<div class="frm-add">
<h1 class="demo-form-heading">Edit Record</h1>
    
<form name="frmEdit" action="" method="POST">
    <?php 
        if ($result) {

              $data = mysqli_fetch_assoc($result);
               
	$id_day = $data["id_day"];
	$statement_day = $data["statement_day"];
    $date_day = $data["date_day"];
    $id_seller = $data["id_seller"];
            
    ?>  
<!--    ---------- verkaufer ------->
  <div class="demo-form-row">
	  <label>Name Verkaufer: </label>

   <select class="ns demo-form-field" name="id_seller" required>
                <option value ="<?php echo $data['id_seller'] ?>"><?php echo  $data["name_seller"]; ?></option>
         <?php
            $qry22 = "select * from seller";
             $result22 = mysqli_query($con, $qry22);
            while ($row22 = mysqli_fetch_assoc($result22)) {
                echo "<option value='$row22[id_seller]'>$row22[name_seller]</option>";
            }
         ?>

    </select> 
    </div>
<!--    ------------->
  <div class="demo-form-row">
	  <label>Beschreibung: </label>
    <input type="text" name="statement_day" class="demo-form-field" value="<?php echo $statement_day; ?>" required />
  </div>
    
  <div class="demo-form-row">
      <label>Date Nr: </label>
    <input type="date" name="date_day" class="demo-form-field" value="<?php echo $date_day; ?>" required />
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