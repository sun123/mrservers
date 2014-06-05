<script>
$(document).ready(function()
{
	$('#search').keyup(function()
	{
		searchTable($(this).val());
	});
});
</script>
<style>
.table-bordered th
{
text-align:center;
}
.table-bordered td
{
text-align:center;
}
</style>
<?php 	$language = get_cookie('language');?>
<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header" >
                                <div class="muted pull-left">Manage News</div>
								<a href="<?php echo base_url().$language; ?>/admin/news/add_news"><div class="muted pull-right">Add News</div></a>
                            </div>
							
							<?php if($this->session->flashdata('suc_message')) {  ?>
							<div class="error_message">
							<?php echo  $this->session->flashdata('suc_message'); ?>
							</div>
							<?php }  ?>
							
							
                            <div class="block-content collapse in">
                                <div class="span12">
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
										<thead>
											<tr>
												<th>Sr.No.</th>
												<th>News Title</th>
												<th>News Description</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										
										<?php
										//debug($newss);
										if(!empty($all_news))
										{
										    $i=1;
											foreach($all_news as $news) //debug($news);
											{
											
											$id = $news->id;
											if($news->news_status == '1')
												{
													$str = '<img style="cursor:pointer;" src="'.base_url().'images/admin/yes.gif" title="Unpublish" width="16" height="16" alt="" onclick="return changeStatus(\'tbl_news\', \'news_status\', \'0\', \'id\', \''.$id.'\');" />';
												}
												else
												{
													$str = '<img style="cursor:pointer;" src="'.base_url().'images/admin/cross.gif" title="Publish" width="16" height="16" alt="" onclick="return changeStatus(\'tbl_news\', \'news_status\', \'1\', \'id\', \''.$id.'\');" />';
												}
											
										
											?>
														<tr class="odd gradeX">
															<td><?php echo $i; ?></td>
															<td><?php echo $news->news_title; ?></td>
															<td><?php echo substr($news->news_content ,0 ,100);?></td>
															<td class="center"><?php echo $str; ?></td>
															<td class="center">
															
																	<a href="<?php echo base_url().$language;?>/admin/news/edit_news/<?php echo $news->id;?>" class="table-icon edit" title="Edit"><img src="<?php echo base_url(); ?>images/admin/i_edit.png" alt=""></a>
																	
																	<a href="<?php echo base_url().$language;?>/admin/news/delete_news/<?php echo $news->id;?>" onclick="return confirm('Are you sure want to delete it? ');" class="table-icon delete" title="Delete"><img src="<?php echo base_url(); ?>images/admin/i_delete.png" alt=""></a>
																	
															</td>
														</tr>
											
											<?php
											$i++;
											}
										}
										?>
											
										</tbody>
									</table>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
					
                </div>
                </div>
            </div>
					
