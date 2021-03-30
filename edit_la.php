<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
require_once("db.php");
session_start();
	$lagerartikel_id = $_REQUEST["lagerartikel_id"];
    $_SESSION["lagerartikel_id"]=$lagerartikel_id;
if (isset($_REQUEST["save_record"])) {
        $id_artikel = $_REQUEST["id_artikel"];
        $id_lager = $_REQUEST["id_lager"];
        $anzahl = $_REQUEST["anzahl"];
        $lagerartikel_id = $_REQUEST["lagerartikel_id"];
        $price = $_REQUEST["price"];
        $date_lagerartikel = $_REQUEST["date_lagerartikel"];
		
		$sql = "UPDATE lagerartikel
				SET 	id_artikel=".$id_artikel.",
                        id_lager=".$id_lager.",
						anzahl=".$anzahl.",
                        price=".$price.",
                        date_lagerartikel='".$date_lagerartikel."'
				WHERE	lagerartikel_id=".$_SESSION["lagerartikel_id"];
       session_destroy();
				
		$result = mysqli_query($con, $sql); 
            if(!$result) {
                    echo mysqli_error($con);
                }
            if (!empty($result) ){
              header('location:lagerartikel.php');
            }
		
	}
       $sql = "SELECT lagerartikel.lagerartikel_id, lagerartikel.id_artikel, lagerartikel.id_lager, lagerartikel.anzahl,lagerartikel.price ,lagerartikel.date_lagerartikel ,artikel.id_artikel, artikel.name_artikel, lager.id_lager, lager.name_lager
FROM (artikel RIGHT JOIN lagerartikel ON artikel.id_artikel = lagerartikel.id_artikel) LEFT JOIN lager ON lagerartikel.id_lager = lager.id_lager
WHERE lagerartikel_id=".$_REQUEST["lagerartikel_id"];

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
<div style="margin:20px 0px;text-align:right;"><a href="lagerartikel.php" class="button_link">Back to List</a></div>
<div class="frm-add">
<h1 class="demo-form-heading">Edit Record</h1>
    
<form name="frmEdit" action="" method="POST">
    <?php 
        if ($result) {

              $data = mysqli_fetch_assoc($result);
               
	$id_artikel = $data["id_artikel"];
	$id_lager = $data["id_lager"];
    $anzahl = $data["anzahl"];
    $lagerartikel_id = $data["lagerartikel_id"];
    $price = $data["price"];            
    $date_lagerartikel = $data["date_lagerartikel"];            
            
    ?>  
    <!---------------------- list Lager -------->
  <div class="demo-form-row">
	  <label>Name Lager: </label>

   <select class="ns demo-form-field" name="id_lager" required>
<option value ="<?php echo $data['id_lager'] ?>"><?php echo  $data["name_lager"]; ?>
         <?php
            $qry33 = "select * from lager";
             $result33 = mysqli_query($con, $qry33);
            while ($row33 = mysqli_fetch_assoc($result33)) {
                echo "<option value='$row33[id_lager]'>$row33[name_lager]</option>";
            }
         ?>

    </select> 
    </div>    
    <!---------------------- list Artikel -------->
  <div class="demo-form-row">
	  <label>Name Artikel: </label>

   <select class="ns demo-form-field" name="id_artikel" required>

       <option value ="<?php echo $data['id_artikel'] ?>"><?php echo  $data["name_artikel"]; ?>
         <?php
            $qry22 = "select * from artikel";
             $result22 = mysqli_query($con, $qry22);
            while ($row22 = mysqli_fetch_assoc($result22)) {
                echo "<option value='$row22[id_artikel]'>$row22[name_artikel]</option>";
            }
         ?>

    </select> 
    </div>


<!--    ------------------->
  <div class="demo-form-row">
	  <label>Anzahl: </label>
    <input type="text" name="anzahl" class="demo-form-field" value="<?php echo $anzahl; ?>" required />
  </div>
  <div class="demo-form-row">
	  <label>Price: </label>
    <input type="text" name="price" class="demo-form-field" value="<?php echo $price; ?>" required />
  </div>
  <div class="demo-form-row">
	  <label>Datum: </label>
    <input type="date" name="date_lagerartikel" class="demo-form-field" value="<?php echo $date_lagerartikel; ?>" required />
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