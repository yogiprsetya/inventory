<?php
require_once 'includes/header.php';
require_once 'php_action/core.php';
?>
<div id="wrapper">
	<div class="main-content">
		<div class="col-xs-12">
			<div class="box-content">
				<h4 class="box-title"><i class="glyphicon glyphicon-check"></i>	Order Report</h4>
				<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="getOrderReportForm" name="getOrderReportForm">
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

				$sql = "SELECT * FROM orders WHERE order_date >= '$start_date' AND order_date <= '$end_date' and order_status = 1";
				$query = $connect->query($sql);
				
				$x = 1;
				
				$downloadXLS = "$('#report').tableExport({type:'excel',tableName:'id',escape:'false'});";

				$table = '
		<div class="col-xs-12">
			<div class="box-content">
				<h4 class="box-title">Laporan Penjualan</h4>
				<!-- /.box-title -->
				<div class="dropdown js__drop_down">
					<button onclick="'.$downloadXLS.'" type="button" class="btn btn-xs btn-success pull-right button1"><i class="ico ico-left fa fa-file-excel-o"></i>Export Excel</button>
				</div>
				<table class="table table-hover" id="report">
					<thead>
						<tr>
						    <th style="width:5%">#</th>
							<th>Order Date</th>
							<th>Client Name</th>
							<th style="width:20%">Contact</th>
							<th>Qty</th>
							<th>Platform</th>
							<th>Pengiriman</th>
							<th class="text-right">Sub Total</th>
						</tr>
					</thead>
					<tbody>';
							$totalAmount = "";
							while ($result = $query->fetch_assoc()) {
							
							$order_id = $result['order_id'];
							$qtySql = "SELECT SUM(quantity) FROM order_item WHERE order_id = '$order_id'";
							$qtyResult = $connect->query($qtySql);
							$qty = $qtyResult->fetch_row();
							
				
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
							} else if($result['platform'] == 6) {
								$platform = "Blanja";
							} else if($result['platform'] == 7) {
								$platform = "JD.ID";
							} else {
								$platform = "Direct";
							}
							// shipping
							if($result['shipping'] == 1) { 		
								$shipping = "J N E";
							} else if($result['shipping'] == 2) {
								$shipping = "SiCepat";
							} else if($result['shipping'] == 3) {
								$shipping = "Go-Send";
							} else if($result['shipping'] == 4) {
								$shipping = "Grab Parcel";
							} else if($result['shipping'] == 5) {
								$shipping = "NinjaExpress";
							} else if($result['shipping'] == 6) {
								$shipping = "LEX";
							} else if($result['shipping'] == 7) {
								$shipping = "JX";
							} else {
								$shipping = "Direct";
							}
								$table .= '<tr class="border-top">
								<th>'.$x.'</th>
								<td>'.$result['order_date'].'</td>
								<td>'.$result['client_name'].'</td>
								<td>'.$result['client_contact'].'</td>
								<td>'.$qty[0].'</td>
								<td>'.$platform.'</td>
								<td>'.$shipping.'</td>
								<td class="text-right">'.$result['sub_total'].'</td>
							</tr>';	
							$totalAmount += $result['sub_total']; $x++;}
							$table .= '
						<tr>
							<th colspan="7"><center>Total</center></th>
							<th class="text-right">'.$totalAmount.'</th>
						</tr>
					</tbody>
				</table>';	echo $table; } ?>
			</div>
		</div>
	</div>
</div>
<script src="http://gramtool.net/inv/report.js"></script>
<script type="text/javascript" src="assets/plugin/export/tableExport.js"></script>
<script type="text/javascript" src="assets/plugin/export/jquery.base64.js"></script>
<?php require_once 'includes/footer.php'; ?>