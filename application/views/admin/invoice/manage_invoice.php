
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
<div class="block">
					<div class="navbar navbar-inner block-header">
					<div class="muted pull-left">Manage Invoice</div>
						<a href="<?php echo base_url().$language;?>/admin/invoice/edit_invoice" ><div class="pull-right" >Add Invoice</div></a>					</div>
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
						<table class="table table-striped table-bordered" id="tblData" style="text-align:center;" >							
								<tr>
								  	<th style="text-align:center;">id</th>								
								  	<th style="text-align:center;">Pdf Title</th>								
									<th style="text-align:center;">Invoice Number</th>
									<th style="text-align:center;">Invoice Amount</th>
									<th style="text-align:center;">Invoice Status</th>
									<th style="text-align:center;">Invoice Pdf</th>
									<th style="text-align:center;">Action</th>
								</tr>							
								<?php 
								
								if(!empty($all_info)){
								
								$i = 1; foreach ($all_info as $info) { //debug($info); 
								
									
									$id = $info->id;
									
									if($info->invoice_status  == 'Paid')
												{
													$str = '<img style="cursor:pointer;" src="'.base_url().'images/admin/yes.gif" title="Unpublish" width="16" height="16" alt="" onclick="return changeStatus(\'tbl_invoice_pdf\', \'invoice_status\', \'Not Paid\', \'id\', \''.$id.'\');" />';
												}
												else
												{
													$str = '<img style="cursor:pointer;" src="'.base_url().'images/admin/cross.gif" title="Publish" width="16" height="16" alt="" onclick="return changeStatus(\'tbl_invoice_pdf\', \'invoice_status\', \'Paid\', \'id\', \''.$id.'\');" />';
												}
										
								
								?>	
								<tr>
									<td height="30" align="center"><?php echo $i++;?></td>
									<td style="text-align:center;"><?php if(!empty($info->pdf_title )) { 	echo $info->pdf_title;	} ?></td>
									<td style="text-align:center;"><?php if(!empty($info->invoice_number )) { 	echo $info->invoice_number;	} ?></td>
									<td style="text-align:center;"><?php if(!empty($info->invoice_amount  )) { 	echo $info->invoice_amount;	} ?></td>
									
									<td class="center"><?php echo $str; ?></td>
									
									<td style="text-align:center;"><?php if(!empty($info->invoice_pdf)) { 	echo $info->invoice_pdf ; } ?></td>

									<td style="text-align:center;">									
									<a href="<?php echo base_url().$language;?>/admin/invoice/edit_invoice/<?php echo $info->id ;?>" class="table-icon edit" title="Edit"><img src="<?php echo base_url(); ?>images/admin/i_edit.png" alt=""></a>														
									<a href="<?php echo base_url().$language;?>/admin/invoice/delete_invoice/<?php echo $info->id ;?>" onclick="return confirm('Are you sure want to delete it? ');" class="table-icon delete" title="Delete"><img src="<?php echo base_url(); ?>images/admin/i_delete.png" alt=""></a>							
								</tr>								
								<?php $i++; } } ?>								
						</table>
					<p style="float:right;">	<?php echo $links; ?></p>
					</div>
				</div>							
		</div>
	</div>
</div>