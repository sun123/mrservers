 <script>
$(document).ready(function(){
	jQuery("#edit_news").validationEngine();
});
 </script>
  <?php 	$language = get_cookie('language');
	// debug($news_detail);
  ?>
 <div class="row-fluid">		<div class="block">			<div class="navbar navbar-inner block-header" >
                                <div class="muted pull-left">Edit News</div>
             </div>			
				<div class="block-content collapse in">
					<div class="span12">
						<form class="form-horizontal" method="post" name="edit_news" id="edit_news"  action="<?php echo base_url().$language;?>/admin/news/update_news">
						  <fieldset>
							 <div class="control-group">
							  <label class="control-label" for="typeahead">News Title</label>
							  <div class="controls">
								<input type="text" class="span6 validate[required]"  id="news_title" name="news_title" value="<?php if(!empty($news_detail->news_title)) { echo $news_detail->news_title;  } ?>" >
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="textarea2">News Description</label>
							  <div class="controls">
								<?php
										echo $this->ckeditor->editor("news_content", $news_detail->news_content); 
									?>	
							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" id="save_page">Update News</button>
							</div>
							<input type="hidden" name="news_id" id="news_id" value="<?php echo $news_detail->id; ?>"/>
						  </fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
                </div>
       </div>
</div>