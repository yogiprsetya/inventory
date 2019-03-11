<?php
require_once 'includes/header.php';
require_once 'php_action/core.php';
?>
<div id="wrapper">
	<div class="main-content">
		<div class="col-xs-12">
			<div class="box-content">
				<h4 class="box-title"><i class="glyphicon glyphicon-check"></i>	Report Data Customer</h4>
				<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="getDataCust" name="getDataCust">
				  <div class="form-group">
				    <label for="startDate" class="col-sm-2 control-label">Start Date</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="startDate" name="startDate" placeholder="Start Date" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="endDate" class="col-sm-2 control-label">End Date</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="endDate" name="endDate" placeholder="End Date" />
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-success" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Generate Report</button>
				    </div>
				  </div>
				</form>
			</div>
		</div>
		<?php
			if($_POST) {

				$startDate = $_POST['startDate'];
				$date = DateTime::createFromFormat('m/d/Y',$startDate);
				$start_date = $date->format("Y-m-d");

				$endDate = $_POST['endDate'];
				$format = DateTime::createFromFormat('m/d/Y',$endDate);
				$end_date = $format->format("Y-m-d");

				$sql = "SELECT orders.order_id, orders.order_date, orders.client_name, orders.client_contact, orders.alamat, orders.sub_total, orders.note, orders.platform, orders.shipping FROM orders WHERE order_date >= '$start_date' AND order_date <= '$end_date' AND order_status = 1 AND platform != 0";
				$query = $connect->query($sql);
				
				$data = $query->fetch_row();
				$orderid = $data[0];
				
				$downloadXLS = "$('#customers').tableExport({type:'csv',tableName:'id',escape:'false'});";

				$table = '
		<div class="col-xs-12">
			<div class="box-content">
				<h4 class="box-title">Data Customer</h4>
				<!-- /.box-title -->
				<div class="dropdown js__drop_down">
					<button onclick="'.$downloadXLS.'" type="button" class="btn btn-xs btn-success pull-right button1"><i class="ico ico-left fa fa-file-excel-o"></i>Download File</button>
				</div>
				<table class="table table-hover" id="customers">
					<thead>
						<tr>
							<th>Name</th>
							<th>Given Name</th>
							<th>Note</th>
							<th>Phone 1 - Type</th>
							<th style="width:15%">Phone 1 - Value</th>
							<th>Address 1 - Formatted</th>
							<th>Address 1 - Street</th>
							<th>Custom Field 1 - Type</th>
							<th>Custom Field 1 - Value</th>
						</tr>
					</thead>
					<tbody>';
							while ($result = $query->fetch_assoc()) {

							$order_id = $result['order_id'];
							$kutip = "'";
							
							$orderItemSql = "SELECT product_id FROM order_item WHERE order_id = '$order_id'";
							$product = $connect->query($orderItemSql);
							$dataproduct = $product->fetch_row();
							$beliapa = $dataproduct[0];
							
							$productItemSql = "SELECT product_id, product_name FROM product WHERE product_id = '$beliapa'";
							$productapa = $connect->query($productItemSql);
							$beliini = $productapa->fetch_row();
							//$beliapa = $dataproduct[0];
				
							// platform
							if($result['platform'] == 1) {
								$platform = "Bukalapak";
							} else if($result['platform'] == 2) {
								$platform = "Tokopedia";
							} else if($result['platform'] == 3) {
								$platform = "Shopee";
							} else if($result['platform'] == 4) {
								$platform = "Lazada";
							} else if($result['platform'] == 5) {
								$platform = "Elevenia";
							} else {
								$platform = "Direct";
							}
								$table .= '<tr class="border-top">
								<td>C.MP '.$result['client_name'].'</td>
								<td>C.MP '.$result['client_name'].'</td>
								<td>'.$beliini[1].'</td>
								<td>Mobile</td>
								<td>'.$result['client_contact'].'</td>
								<td>'.$result['alamat'].'</td>
								<td>'.$result['alamat'].'</td>
								<td>Platform</td>
								<td>'.$platform.'</td>
							</tr>'; } '
					</tbody>
				</table>'; echo $table; } ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="http://gramtool.net/inv/cust.js"></script>
<script type="text/javascript" src="assets/plugin/export/tableExport.js"></script>
<script type="text/javascript" src="assets/plugin/export/jquery.base64.js"></script>
<?php require_once 'includes/footer.php'; ?>