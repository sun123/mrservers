<script src="<?php echo base_url(); ?>js/general.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function() {
		jQuery("#profile_form").validationEngine();
		
		UserManager.fetchStates();
		
	});
</script>
<style>
fieldset{

margin-top:50px;

}
</style>
<?php
if(!empty($info['id'])){
	$id = $info['id'];
	$title = "Edit Invoice";
}else{
	$id='0';
	$title = "Add Invoice";
}
?>
<?php 	$language = get_cookie('language');   //debug($info);?>
<div class="block">
			<div class="navbar navbar-inner block-header">
				<div class="muted pull-left"><?php echo $title; ?></div>
			</div>
			<div class="block-content collapse in">
				<div class="span12">
					 <form class="form-horizontal" id="profile_form" name="profile_form" method="post"  action="<?php echo base_url().$language;?>/admin/invoice/edit_save_invoice" enctype="multipart/form-data" >
					  <fieldset>
					  <div class="control-group">
						  <label class="control-label" for="focusedInput">Pdf Title </label>
						  <div class="controls">
							<input class="input-xlarge focused validate[required]" name="pdf_title"  id="pdf_title" type="text" value="<?php if(!empty($info['pdf_title'])){ echo $info['pdf_title']; } ?>" >
						  </div>
						</div>
						<div class="control-group">
						  <label class="control-label" for="focusedInput">Invoice Number </label>
						  <div class="controls">
							<input class="input-xlarge focused validate[required]" name="in_number"  id="in_number" type="text" value="<?php if(!empty($info['invoice_number'])){ echo $info['invoice_number']; } ?>" >
						  </div>
						</div>
						<div class="control-group">
						  <label class="control-label">Invoice Amount</label>
						  <div class="controls">
							<input class="input-xlarge focused validate[required]" name="in_amnt" id="in_amnt" type="text" value="<?php if(!empty($info['invoice_amount'])){ echo $info['invoice_amount']; } ?>" >
						  </div>
						</div>
						<div class="control-group">
						  <label class="control-label">	Invoice Pdf</label>
						  <div class="controls">
						  <?php if(!empty($info)) { ?>
							<input name="in_pdf" id="in_pdf" type="file">
							<?php if(!empty($info['invoice_pdf'])){ echo $info['invoice_pdf']; } }else{?>
							<input class="input-xlarge focused validate[required]" name="in_pdf" id="in_pdf" type="file" >
							<?php  }  ?>
						  </div>
						</div>
						
						
						
						<div class="form-actions">
						  <button type="submit" class="btn btn-primary">Submit</button>
						</div>
					  </fieldset>
					  <input type="hidden" name="invoice_id" id="invoice_id" value="<?php if(!empty($info['id'])){ echo $info['id']; }else{ echo '0';} ?>">
					</form>
				</div>
			</div>
			</div>
			</div>
		
		
		
		
		