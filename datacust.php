<?php require_once 'includes/header.php'; ?>

<div id="wrapper">
	<div class="main-content">
		<div class="col-xs-12">
			<div class="box-content">
				<h4 class="box-title">Data Customer</h4>
				<div class="dropdown js__drop_down">
					<a href="cust.php" style="margin-left:10px" class="btn btn-xs btn-primary pull-right button1"><i class="ico ico-left fa fa-google"></i>Create Contact</a>
					<button type="button" class="btn btn-xs btn-success pull-right button1"><i class="ico ico-left fa fa-file-excel-o"></i>Export</button>
				</div>
				<div class="remove-messages"></div>
				<table class="table table-striped manord" id="dataCustomerTable">
					<thead> 
						<tr>
							<th style="width:6%;">#</th>
							<th>Nama Customer</th>
							<th>Contact</th>
							<th>Alamat</th>
							<th>Platform</th>
						</tr> 
					</thead> 
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="http://gramtool.net/inv/datacust.js"></script>
<?php require_once 'includes/footer.php'; ?>