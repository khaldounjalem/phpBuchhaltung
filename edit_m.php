<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
require_once("db.php");
        $id_artikel = $_REQUEST["id_artikel"];
if (isset($_REQUEST["save_record"])) {
        $name_artikel = $_REQUEST["name_artikel"];
		
		$sql = "UPDATE artikel
				SET 	name_artikel='".$name_artikel."'
				WHERE	id_artikel=".$id_artikel;
				
		$result = mysqli_query($con, $sql); 
            if(!$result) {
                    echo mysqli_error($con);
                }
            if (!empty($result) ){
              header('location:material.php');
            }
		
	}
     $sql = "SELECT artikel.id_artikel, artikel.name_artikel
            FROM artikel
            WHERE id_artikel=".$id_artikel;


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
               
	$name_artikel = $data["name_artikel"];
    ?>            


  <div class="demo-form-row">
	  <label>Artikel: </label>
    <input type="text" name="name_artikel" class="demo-form-field" value="<?php echo $name_artikel; ?>" required  />
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