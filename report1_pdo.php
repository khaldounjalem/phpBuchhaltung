<?php
define("ROW_PER_PAGE",2000); // number row in page
require_once('db1.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">    
<style>
body{width:615px;font-family:arial;letter-spacing:1px;line-height:20px;}
.tbl-qa{width: 100%;font-size:0.9em;background-color: #f5f5f5;}
.tbl-qa th.table-header {padding: 5px;text-align: left;padding:10px; text-align: center;}
.tbl-qa .table-row td {padding:10px;background-color: #FDFDFD;vertical-align:top; text-align: center;}
.button_link {color:#FFF;text-decoration:none; background-color:#428a8e;padding:10px;}
#keyword{border: #CCC 1px solid; border-radius: 4px; padding: 7px;background:url("demo-search-icon.png") no-repeat center right 7px;}
.btn-page{margin-right:10px;padding:5px 10px; border: #CCC 1px solid; background:#FFF; border-radius:4px;cursor:pointer;}
.btn-page:hover{background:#F0F0F0;}
.btn-page.current{background:#F0F0F0;}
</style>
</head>
<body>
<?php	
	$search_keyword = '';
	if(!empty($_POST['search']['keyword'])) {
		$search_keyword = $_POST['search']['keyword'];
	}
//	$sql = 'SELECT * FROM posts WHERE post_title LIKE :keyword OR description LIKE :keyword OR post_at LIKE :keyword ORDER BY id DESC ';
    $enter_number_Invoice=1;
    $sql = "SELECT Invoice.id_Invoice, users.name_user, Invoice.date_Invoice, Invoice.statement_invoice, Invoice.number_Invoice, materials.name_materials, Invoice_details.quantity, Invoice_details.price, (quantity * price) AS 'total'
FROM (users RIGHT JOIN Invoice ON users.id_user = Invoice.id_user) LEFT JOIN (Invoice_details LEFT JOIN materials ON Invoice_details.statement_Invoice_details = materials.id_materials) ON Invoice.id_Invoice = Invoice_details.id_Invoice
WHERE Invoice.id_Invoice LIKE :keyword";

	
	/* Pagination Code starts */
	$per_page_html = '';
	$page = 1;
	$start=0;
	if(!empty($_POST["page"])) {
		$page = $_POST["page"];
		$start=($page-1) * ROW_PER_PAGE;
	}
	$limit=" limit " . $start . "," . ROW_PER_PAGE;
	$pagination_statement = $pdo_conn->prepare($sql);
	$pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
	$pagination_statement->execute();

	$row_count = $pagination_statement->rowCount();
	if(!empty($row_count)){
		$per_page_html .= "<div style='text-align:center;margin:20px 0px;'>";
		$page_count=ceil($row_count/ROW_PER_PAGE);
		if($page_count>1) {
			for($i=1;$i<=$page_count;$i++){
				if($i==$page){
					$per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
				} else {
					$per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
				}
			}
		}
		$per_page_html .= "</div>";
	}
	
	$query = $sql.$limit;
	$pdo_statement = $pdo_conn->prepare($query);
	$pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
   
    $sql2= "SELECT Sum(quantity*price) as 'total2' FROM Invoice_details 
    WHERE id_Invoice LIKE :keyword";
	$query2 = $sql2.$limit;
	$pdo_statement2 = $pdo_conn->prepare($query2);
	$pdo_statement2->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
	$pdo_statement2->execute();
	$result2 = $pdo_statement2->fetchAll();
    

?>
<form name='frmSearch' action='' method='post'>
<div style='text-align:right;margin:20px 0px;'><b>Enter ID Invoice : </b><input type='text' name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='25'></div>

    <?php
    if(!empty($result) && !empty($result2) ) {

         echo'ID_Invoice :';   
         echo utf8_encode($result[0]['id_Invoice']);
         echo'<br>Client :';    
         echo utf8_encode($result[0]['name_user']); 
         echo'<br>Date :';    
         echo utf8_encode($result[0]['date_Invoice']);
    

//         echo'ID_Invoice :';   
//         echo utf8_encode($rows['id_Invoice']);
//         echo'<br>Client :';    
//         echo utf8_encode($rows['name_user']); 
//         echo'<br>Date :';    
//         echo utf8_encode($rows['date_Invoice']);
//
//           break;
//        }
          
//        foreach($result2 as $rows) {
         echo'<br><hr>Total :';    
         echo utf8_encode($result2[0]['total2']);
//        echo utf8_encode($rows['total2']);
//            break;
//        }
//        

    ?>

<table class='tbl-qa'>
  <thead>
	<tr>
	  <th class='table-header' width='20%'>name_materials</th>
	  <th class='table-header' width='10%'>quantity</th>
	  <th class='table-header' width='10%'>price</th>
      <th class='table-header' width='10%'>total</th>
	</tr>
  </thead>
  <tbody id='table-body'>
	<?php
	
		foreach($result as $row) {
	?>
	  <tr class='table-row'>
		<td><?php echo utf8_encode($row['name_materials']); ?></td>
		<td ><?php echo utf8_encode($row['quantity']); ?></td>
		<td ><?php echo utf8_encode($row['price']); ?></td>
        <td ><?php echo utf8_encode($row['total']); ?></td>  
	  </tr>
    <?php
		}
	}
	?>
  </tbody>
</table>
<?php echo $per_page_html; ?>
</form>
</body>
</html>