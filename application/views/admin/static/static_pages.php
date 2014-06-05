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
<div class="row-fluid">
                        <div class="block">
                            <div class="navbar navbar-inner block-header" >
                                <div class="muted pull-left">Manage Static Pages</div>
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
												<th>Page Name</th>
												<th>Page Title</th>
												<th>Page Description</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										if(!empty($pages))
										{
										    $i=1;
											foreach($pages as $page)
											{
											$page_id = $page->page_id;
											if($page->status == '1')
												{
													$str = '<img style="cursor:pointer;" src="'.base_url().'images/admin/yes.gif" title="Unpublish" width="16" height="16" alt="" onclick="return changeStatus(\'tbl_pages\', \'status\', \'0\', \'page_id\', \''.$page_id.'\');" />';
												}
												else
												{
													$str = '<img style="cursor:pointer;" src="'.base_url().'images/admin/cross.gif" title="Publish" width="16" height="16" alt="" onclick="return changeStatus(\'tbl_pages\', \'status\', \'1\', \'page_id\', \''.$page_id.'\');" />';
												}
											?>
														<tr class="odd gradeX">
															<td><?php echo $i; ?></td>
															<td><?php echo $page->page_name; ?></td>
															<td><?php echo $page->page_title; ?></td>
															<td><?php echo substr($page->page_body ,0 ,100);?></td>
															<td class="center"><?php echo $str; ?></td>
															<td class="center">
																	<a href="<?php echo base_url();?>admin/page/edit/<?php echo $page->page_id;?>" class="table-icon edit" title="Edit"><img src="<?php echo base_url(); ?>images/admin/i_edit.png" alt=""></a>
																	<a href="<?php echo base_url();?>admin/page/delete_page/<?php echo $page->page_id;?>" onclick="return confirm('Are you sure want to delete it? ');" class="table-icon delete" title="Delete"><img src="<?php echo base_url(); ?>images/admin/i_delete.png" alt=""></a>
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
                    </div>
                </div>
                </div>
            </div>
