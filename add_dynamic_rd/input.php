<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
    
require_once("../db.php");

?>
<HTML>
<HEAD>
<body>    
<DIV class="product-item float-clear" style="clear:both;">
<DIV class="float-left"><input type="checkbox" name="item_index[]" /></DIV>
 <DIV class="float-left">    
   <select class="sel" name="id_artikel[]" autofocus required>
                    <option value = "">-- Add --</option>
         <?php
            $qry2 = "select * from artikel";
             $result2 = mysqli_query($con, $qry2);
            while ($row = mysqli_fetch_assoc($result2)) {
                echo "<option value='$row[id_artikel]'>$row[name_artikel]</option>";
            }
         ?>

    </select>
</DIV>     
 <DIV class="float-left">    
   <select class="sel" name="id_lager[]" required>
                    <option value = "">-- Add --</option>
         <?php
            $qry2 = "select * from lager";
             $result2 = mysqli_query($con, $qry2);
            while ($row = mysqli_fetch_assoc($result2)) {
                echo "<option value='$row[id_lager]'>$row[name_lager]</option>";
            }
         ?>

    </select>    
    
 </DIV>   
    
<DIV class="float-left"><input type="text" name="quantity[]" /></DIV>
<DIV class="float-left"><input type="text" name="price[]" /></DIV>
<DIV class="float-left"><input type="text" name="rabatt_rd[]" /></DIV>    
</DIV>
    <?php
            }  else {
    header("Location: login.php");//if there is no cookie
}
            ?>
</body>
    </HEAD>
</HTML>