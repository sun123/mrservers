 <script>
$(document).ready(function(){
jQuery("#add_news").validationEngine();});
 
 </script>
 <?php 	$language = get_cookie('language');?>
 
 <div class="row-fluid">
			<!-- block -->
			<div class="block">
			
					<div class="navbar navbar-inner block-header" >
                                <div class="muted pull-left">Add News</div>
								<!--div class="muted pull-right"><a href="<?php echo base_url(); ?>admin/page/add">Add Products</a></div-->
                            </div>
				
				<div class="block-content collapse in">
					<div class="span12">
					
						<form class="form-horizontal" method="post" name="add_news" id="add_news"  action="<?php echo base_url().$language;?>/admin/news/save_news">
						  <fieldset>
				
							 <div class="control-group">
							  <label class="control-label" for="typeahead">News Title</label>
							  <div class="controls">
								<input type="text" class="span6 validate[required]"   id="news_title" name="news_title" >
							  </div>
							</div>
						  
							<div class="control-group">
							  <label class="control-label" for="textarea2">News Content</label>
							  <div class="controls">
								<?php
										
										echo $this->ckeditor->editor("news_content"); 
									?>	
							  </div>
							</div>
							
							<div class="form-actions">
							 <button type="submit" class="btn btn-primary">Submit</button>
							 
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
					
