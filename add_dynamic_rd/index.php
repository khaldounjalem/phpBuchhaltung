<?php
if(isset($_COOKIE['user'] )&& $_COOKIE['user'] != ''){
    error_reporting('E_ALL & ~E_Notice');
    
session_start();

//   echo "<pre>";
//	print_r($_REQUEST);
//	echo "</pre>";

	if(!empty($_POST["save"])) {
          require_once("../db.php");
        $itemCount = count($_POST["id_artikel"]);
		$itemValues=0;

    
		$query = "INSERT INTO invoice_details (statement_Invoice_details, lager_detail_invoice, quantity, price, rabatt_rd, id_Invoice) VALUES ";
		$queryValue = "";
		for($i=0;$i<$itemCount;$i++) {
			if(!empty($_POST["id_artikel"][$i]) || !empty($_POST["id_lager"][$i]) || ($_POST["quantity"][$i]) || !empty($_POST["price"][$i]) || !empty($_POST["rabatt_rd"][$i])) {
				$itemValues++;
				if($queryValue!="") {
					$queryValue .= ",";
				}
				$queryValue .= "('" . $_POST["id_artikel"][$i] . "','" . $_POST["id_lager"][$i] . "', '" . $_POST["quantity"][$i] . "', '" . $_POST["price"][$i] . "','" . $_POST["rabatt_rd"][$i] . "','" . $_SESSION["id_Invoice"] . "')";
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
<DIV class="float-left col-heading">Artikel</DIV>
<DIV class="float-left col-heading">Lager</DIV>
<DIV class="float-left col-heading">Menge</DIV>
<DIV class="float-left col-heading">Einzelpreis</DIV>    
<DIV class="float-left col-heading">Rabatt</DIV>      
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

    <a class="back" href="../rechnungen_detail.php?id_Invoice=<?php echo $_SESSION["id_Invoice"]; ?>" >Zuruck</a>
     
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