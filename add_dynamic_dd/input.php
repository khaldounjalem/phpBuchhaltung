<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');

require_once("../db.php");

?>

<DIV class="product-item float-clear" style="clear:both;">
<DIV class="float-left"><input type="checkbox" name="item_index[]" /></DIV>
 <DIV class="float-left">   
   <select class="float-left sel" name="id_user[]" required>
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
</DIV>    
<DIV class="float-left"><input type="text" name="debit[]" /></DIV>
<DIV class="float-left"><input type="text" name="credit[]" /></DIV>
<DIV class="float-left"><input type="text" name="statement_day_detail[]" /></DIV>    
</DIV>
    <?php
            }  else {
    header("Location: login.php");//if there is no cookie
}
            ?>  