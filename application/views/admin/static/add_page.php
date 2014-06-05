 <script>
$(document).ready(function(){

jQuery("#add_page").validationEngine();


});
 
 </script>
 
 
 <div class="row-fluid">
			<!-- block -->
			<div class="block">
			
					<div class="navbar navbar-inner block-header" >
                                <div class="muted pull-left">Add Page</div>
								<!--div class="muted pull-right"><a href="<?php echo base_url(); ?>admin/page/add">Add Products</a></div-->
                            </div>
				
				<div class="block-content collapse in">
					<div class="span12">
					
						<form class="form-horizontal" method="post" name="add_page" id="add_page"  action="<?php echo base_url();?>admin/page/add_page">
						  <fieldset>
					
							
							
							<div class="control-group">
							  <label class="control-label" for="typeahead">Page Name</label>
							  <div class="controls">
								<input type="text" class="span6 validate[required]" id="page_name" name="page_name" value="<?php if(!empty($page_detail->page_name)) { echo $page_detail->page_name;  } ?>">
					
							  </div>
							</div>
							
							
							 <div class="control-group">
							  <label class="control-label" for="typeahead">Page Title</label>
							  <div class="controls">
								<input type="text" class="span6 validate[required]"   id="page_title" name="page_title" >
							  </div>
							</div>
						  
							<div class="control-group">
							  <label class="control-label" for="textarea2">Page Description</label>
							  <div class="controls">
								<?php
										
										echo $this->ckeditor->editor("page_description"); 
									?>	
							  </div>
							</div>
							
							<div class="form-actions">
							  <input type="submit" class="btn btn-primary" id="save_page">
							 
							</div>
							
						  </fieldset>
						</form>

					</div>
				</div>
			</div>
			<!-- /block -->
		</div>
					
                </div>
                </div>
            </div>
					