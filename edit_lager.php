<?php
require_once("db.php");
        $id_lager = $_REQUEST["id_lager"];
if (isset($_REQUEST["save_record"])) {
        $name_lager = $_REQUEST["name_lager"];
		
		$sql = "UPDATE lager
				SET 	name_lager='".$name_lager."'
				WHERE	id_lager=".$id_lager;
				
		$result = mysqli_query($con, $sql); 
            if(!$result) {
                    echo mysqli_error($con);
                }
            if (!empty($result) ){
              header('location:lager.php');
            }
		
	}
     $sql = "SELECT lager.id_lager, lager.name_lager
            FROM lager
            WHERE id_lager=".$id_lager;


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
.demo-form-row input{position: absolute;left:200px;}    
.demo-form-row select{position: absolute;left:200px;} 
label{font-size: 20px; line-height: 40px;}     
.demo-form-field{width:300px;padding:10px;font-size: 20px;}
.demo-form-submit{color:#FFF;background-color:#414444;padding:10px 50px;border:0px;cursor:pointer;border-radius: 4px;}
</style>
</head>
<body>
<div style="margin:20px 0px;text-align:right;"><a href="material.php" class="button_link">Back to List</a></div>
<div class="frm-add">
<h1 class="demo-form-heading">Edit Record</h1>
    
<form name="frmEdit" action="" method="POST">
    <?php 
        if ($result) {

              $data = mysqli_fetch_assoc($result);
               
	$name_lager = $data["name_lager"];
    ?>            


  <div class="demo-form-row">
	  <label>Lager: </label>
    <input type="text" name="name_lager" class="demo-form-field" value="<?php echo $name_lager; ?>" required  />
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
</body>
</html>