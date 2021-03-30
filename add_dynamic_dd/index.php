<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
session_start();
//   echo "<pre>";
//	print_r($_REQUEST);
//	echo "</pre>";


	if(!empty($_POST["save"])) {
        require_once("../db.php");

        $itemCount = count($_POST["id_user"]);
		$itemValues=0;

        
		$query = "INSERT INTO day_detail (id_user, debit, credit, statement_day_detail,id_day) VALUES ";
		$queryValue = "";
		for($i=0;$i<$itemCount;$i++) {
			if(!empty($_POST["id_user"][$i]) || !empty($_POST["debit"][$i]) || ($_POST["credit"][$i]) || !empty($_POST["statement_day_detail"][$i])) {
				$itemValues++;
				if($queryValue!="") {
					$queryValue .= ",";
				}
				$queryValue .= "('" . $_POST["id_user"][$i] . "','" . $_POST["debit"][$i] . "', '" . $_POST["credit"][$i] . "', '" . $_POST["statement_day_detail"][$i] . "','" . $_SESSION["id_day"] . "')";
			}
		}
		$sql = $query.$queryValue;
		if($itemValues!=0) {
            $result = mysqli_query($con, $sql);
			if(!empty($result)) $message = "Added Successfully.";
            ?>
           
  <?php          
		}
	}
?>
<HTML>
<HEAD>
<TITLE>PHP jQuery Dynamic Textbox</TITLE>
<LINK href="style.css" rel="stylesheet" type="text/css" />
<SCRIPT src="http://code.jquery.com/jquery-2.1.1.js"></SCRIPT>
<SCRIPT>
function addMore() {
	$("<DIV>").load("input.php", function() {
			$("#product").append($(this).html());
	});	
}
function deleteRow() {
	$('DIV.product-item').each(function(index, item){
		jQuery(':checkbox', this).each(function () {
            if ($(this).is(':checked')) {
				$(item).remove();
            }
        });
	});
}
</SCRIPT>
</HEAD>
<BODY>
<form name="frmProduct" method="post" action="">
<DIV id="outer">
<DIV id="header">
<DIV class="float-left">&nbsp;</DIV>
<DIV class="float-left col-heading">Name</DIV>
<DIV class="float-left col-heading">Debit</DIV>
<DIV class="float-left col-heading">Credit</DIV>
<DIV class="float-left col-heading">Beschreibung</DIV>    
</DIV>
<DIV id="product">
<?php require_once("input.php") ?>
</DIV>
<DIV class="btn-action float-clear">
<input type="button" name="add_item" value="Add More" onClick="addMore();" />
<input type="button" name="del_item" value="Delete" onClick="deleteRow();" />
<span class="success"><?php if(isset($message)) { echo $message; }?></span>
</DIV>
<DIV class="footer">
<input type="submit" name="save" value="Save" />

    <a style="text-align:right;" class="back" href="../day_detail.php?id_day=<?php echo $_SESSION["id_day"]; ?>" >Zuruck</a>
     
</DIV>
</DIV>
</form>
    <?php
            }  else {
    header("Location: login.php");//if there is no cookie
}
            ?>      
</BODY>
</HTML>