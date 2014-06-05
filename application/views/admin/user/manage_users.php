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
<div class="block">
					<div class="navbar navbar-inner block-header">
					<div class="muted pull-left">Manage Users</div>
						<a href="<?php echo base_url().$language;?>/admin/users/edit_users" ><div class="pull-right" >Add user</div></a>					</div>
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
									<th style="text-align:center;">Username</th>
									<th style="text-align:center;">Email</th>
									<th style="text-align:center;">Phone</th>
									<th style="text-align:center;">Status</th>
									<th style="text-align:center;">Action</th>
								</tr>							
								<?php $i = 1; foreach ($users as $users_arr) { //debug($users_arr); 
								
									$name = $users_arr->f_name.' '.$users_arr->l_name;
									
									$id = $users_arr->id;
											if($users_arr->status == '1')
												{
													$str = '<img style="cursor:pointer;" src="'.base_url().'images/admin/yes.gif" title="Unpublish" width="16" height="16" alt="" onclick="return changeStatus(\'tbl_users\', \'status\', \'0\', \'id\', \''.$id.'\');" />';
												}
												else
												{
													$str = '<img style="cursor:pointer;" src="'.base_url().'images/admin/cross.gif" title="Publish" width="16" height="16" alt="" onclick="return changeStatus(\'tbl_users\', \'status\', \'1\', \'id\', \''.$id.'\');" />';
												}
								
								?>	
								<tr>
									<td height="30" align="center"><?php echo $i;?></td>
									<td style="text-align:center;"><?php if(!empty($name )) { 	echo ucfirst($name );	} ?></td>
									<td style="text-align:center;"><?php if(!empty($users_arr->email  )) { 	echo ucfirst($users_arr->email  );	} ?></td>
									<td style="text-align:center;"><?php if(!empty($users_arr->phone  )) { 	echo ucfirst($users_arr->phone  );	} else {  echo "NO"; } ?></td>
									<td class="center"><?php echo $str; ?></td>

									<td style="text-align:center;">									
									<a href="<?php echo base_url().$language;?>/admin/users/edit_users/<?php echo $users_arr->id ;?>" class="table-icon edit" title="Edit"><img src="<?php echo base_url(); ?>images/admin/i_edit.png" alt=""></a>														
									<a href="<?php echo base_url().$language;?>/admin/users/delete_users/<?php echo $users_arr->id ;?>" onclick="return confirm('Are you sure want to delete it? ');" class="table-icon delete" title="Delete"><img src="<?php echo base_url(); ?>images/admin/i_delete.png" alt=""></a>							
								</tr>								
								<?php $i++; } ?>								
						</table>
					<p style="float:right;">	<?php echo $links; ?></p>
					</div>
				</div>							
		</div>
	</div>
</div>