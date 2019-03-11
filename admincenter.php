<?php require_once 'includes/header.php'; ?>

<div id="wrapper">
	<div class="main-content">
		<div class="col-xs-12">
			<div class="box-content">
				<h4 class="box-title">Admin QNA</h4>
				<div class="dropdown js__drop_down">
				    <a href="http://www.anekapetindo.com/inventory/custom/panduan.html" style="margin-right:5px" class="btn btn-xs btn-warning" target="_blank"><i class="ico ico-left fa fa-book"></i>Panduan</a>
					<button type="button" class="btn btn-xs btn-primary pull-right button1" data-toggle="modal" id="addQnaModalBtn" data-target="#addQnaModal"><i class="ico ico-left fa fa-plus"></i>Add QNA</button>
				</div>
				<div class="remove-messages"></div>
				<table class="table manord" id="manageQnaTable" style="overflow: hidden;">
					<thead> 
						<tr>
							<th style="width:30%;">Kondisi</th>
							<th>Penanganan</th>
							<th style="width:10%;">Options</th>
						</tr> 
					</thead> 
				</table> 
			</div>
		</div>
	</div>
</div>


<!-- add categories -->
<div class="modal fade" id="addQnaModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitQnaForm" action="php_action/createQna.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add QNA</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-qna-messages"></div>

	        <div class="form-group">
	        	<label for="categoriesName" class="col-sm-2 control-label">Kondisi :</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="kondisi" placeholder="Kondisi" name="kondisi" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="categoriesName" class="col-sm-2 control-label">Penanganan :</label>
				    <div class="col-sm-10">
				      <textarea style="min-height:280px" type="text" class="form-control" id="penanganan" placeholder="Penanganan" name="penanganan"></textarea>
				    </div>
	        </div> <!-- /form-group-->
	        
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createQnaBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!-- /add categories -->


<!-- edit categories brand -->
<div class="modal fade" id="editQnaModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editQnaForm" action="php_action/editQna.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit QNA</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-qna-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-categories-result">
		      	<div class="form-group">
		        	<label for="editCategoriesName" class="col-sm-2 control-label">Kondisi :</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="editQnaName" placeholder="Kondisi" name="editQnaName" autocomplete="off">
					    </div>
		        </div> <!-- /form-group-->
				<div class="form-group">
					<label for="categoriesName" class="col-sm-2 control-label">Penanganan :</label>
				    <div class="col-sm-10">
				      <textarea style="min-height:280px" type="text" class="form-control" id="editPenanganan" placeholder="Penanganan" name="editPenanganan" autocomplete="off"></textarea>
				    </div>
				</div> <!-- /form-group-->
		      </div>         	        
		      <!-- /edit brand result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editQnaFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editCategoriesBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- /categories brand -->

<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeQnaModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Brand</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeQnaBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->

<script src="http://gramtool.net/inv/admincenter.js"></script>


<?php require_once 'includes/footer.php'; ?>