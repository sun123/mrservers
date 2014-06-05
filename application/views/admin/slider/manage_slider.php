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
                                <div class="muted pull-left"><?php echo $title; ?></div>
								<div class="muted pull-left" style="margin-left:10px;">
								<input class="field1" type="text" id="search" placeholder="Enter keyword to search "/>
							</div>
							<a href="<?php echo base_url();?>admin/slider/add_slider" >
								<div class="pull-right" >
									<span class="badge badge-info" >Add Slider</span>
								</div>
							</a>
                            </div>
							
							<?php 
								if ( $this->session->userdata("success_message")) { ?>
								<div class="error_message">
								<?php 
										echo $this->session->userdata("success_message"); 
										$this->session->unset_userdata("success_message");
								?>					
								</div>
							<?php 	} ?> 
                            <div class="block-content collapse in">
                                <div class="span12">
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="tblData">
										<thead>
											<tr>
												<th>Sr.No.</th>
												<th>Page Name</th>
												<th>Slider name</th>
												<th>Slider Image</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										if(!empty($sliders))
										{
										    $i=1;
											foreach($sliders as $slider_detail)
											{
											$slider_id = $slider_detail["slider_id"];
											if($slider_detail["status"]== '1')
												{
													$str = '<img style="cursor:pointer;" src="'.base_url().'images/admin/yes.gif" title="Unpublish" width="16" height="16" alt="" onclick="return changeStatus(\'tbl_slider\', \'status\', \'0\', \'slider_id\', \''.$slider_id.'\');" />';
												}
												else
												{
													$str = '<img style="cursor:pointer;" src="'.base_url().'images/admin/cross.gif" title="Publish" width="16" height="16" alt="" onclick="return changeStatus(\'tbl_slider\', \'status\', \'1\', \'slider_id\', \''.$slider_id.'\');" />';
												}
											?>
														<tr class="odd gradeX">
															<td><?php echo $i; ?></td>
															<td><?php echo $slider_detail["slider_page"]; ?></td>
															<td><?php echo $slider_detail["slider_title"]; ?></td>
															<td><img src="<?php echo base_url(); ?>uploads/slider/<?php echo $slider_id; ?>/thumbs/<?php echo $slider_detail["slider_image"]; ?>" ></td>
															<td class="center"><?php echo $str; ?></td>
															<td class="center">
																	<a href="<?php echo base_url();?>admin/slider/edit_slider/<?php echo $slider_id;?>" class="table-icon edit" title="Edit"><img src="<?php echo base_url(); ?>images/admin/i_edit.png" alt=""></a>
																	<a href="<?php echo base_url();?>admin/slider/delete_slider/<?php echo $slider_id;?>" onclick="return confirm('Are you sure want to delete it? ');" class="table-icon delete" title="Delete"><img src="<?php echo base_url(); ?>images/admin/i_delete.png" alt=""></a>
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
								<div class="pagination">
									<?php generate_pagination($total_rows, $url, $limit, $page, $extraparams); ?>
								</div>
							</div>	
                        </div>
                    </div>
                </div>
                </div>
            </div>
