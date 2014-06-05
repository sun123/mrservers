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
if(!empty($user_info['id'])){
	$user_id = $user_info['id'];
	$title = "Edit User";
}else{
	$user_id='0';
	$title = "Add User";
}
?>
<?php 	$language = get_cookie('language');   //debug($user_info);?>
<div class="block">
			<div class="navbar navbar-inner block-header">
				<div class="muted pull-left"><?php echo $title; ?></div>
			</div>
			<div class="block-content collapse in">
				<div class="span12">
					 <form class="form-horizontal" id="profile_form" name="profile_form" method="post"  action="<?php echo base_url().$language;?>/admin/users/edit_save_users" enctype="multipart/form-data">
					  <fieldset>
						<div class="control-group">
						  <label class="control-label" for="focusedInput">First Name</label>
						  <div class="controls">
							<input class="input-xlarge focused validate[required]" name="first_name"  id="first_name" type="text" value="<?php if(!empty($user_info['f_name'])){ echo $user_info['f_name']; } ?>">
						  </div>
						</div>
						<div class="control-group">
						  <label class="control-label">Last Name</label>
						  <div class="controls">
							<input class="input-xlarge uneditable-input validate[required]" name="last_name" id="last_name" type="text" value="<?php if(!empty($user_info['l_name'])){ echo $user_info['l_name']; } ?>">
						  </div>
						</div>
						<div class="control-group">
						  <label class="control-label">Business Name</label>
						  <div class="controls">
							<input class="input-xlarge uneditable-input validate[required]" name="busnesname" id="busnesname" type="text" value="<?php if(!empty($user_info['business_name'])){ echo $user_info['business_name']; } ?>">
						  </div>
						</div>
						<div class="control-group">
						  <label class="control-label" for="disabledInput">Email Address</label>
						  <div class="controls">
						  <input class="input-xlarge disabled validate[required,custom[email]],ajax[ajaxEmailCall]" name="useremail" id="email" type="text" value="<?php if(!empty($user_info['email'])){ echo $user_info['email']; } ?>">
						  </div>
						</div>
						<?php  if(empty($user_info['id'])) { ?>
						<div class="control-group">
						  <label class="control-label" for="disabledInput">Password</label>
						  <div class="controls">
						  <input class="input-xlarge disabled validate[required],minSize[6] " name="password" id="password" type="password">
						  </div>
						</div>
						<div class="control-group">
						  <label class="control-label" for="disabledInput">Conform Password</label>
						  <div class="controls">
						  <input class="input-xlarge disabled validate[required],equals[password] " name="c_password" id="c_password" type="password">
						  </div>
						</div>
						<?php  } ?>
						<div class="control-group">
						  <label class="control-label" for="disabledInput">Address</label>
						  <div class="controls">
						  <input class="input-xlarge disabled validate[required]" name="address" id="address" type="text" value="<?php if(!empty($user_info['address'])){ echo $user_info['address']; } ?>" >
						  </div>
						</div>
						<div class="control-group">
						  <label class="control-label" for="disabledInput">City</label>
						  <div class="controls">
						  <input class="input-xlarge disabled validate[required]" name="city" id="city" type="text" value="<?php if(!empty($user_info['city'])){ echo $user_info['city']; } ?>" >
						  </div>
						</div>
						<div class="control-group">
						  <label class="control-label" for="disabledInput">Country</label>
						  <div class="controls">
						  <select class="input-xlarge disabled validate[required]" name="country" id="country" style="width:285px">
						  <option value="">Select Country</option>
						 <?php   
						 
							foreach($country as $cntry) {   ?>
						  <option value="<?php  echo $cntry['country_id'] ;  ?>"  <?php if(!empty($user_info)){ if($cntry['country_id'] == $user_info['country']){ echo "selected=selected" ;} } ?>><?php  if(!empty($cntry['country_name'])){ echo $cntry['country_name'] ;} ?></option>
						  
						  <?php  }  ?>
						  </select>
						  </div>
						</div>
						 <?php
								if(!empty($user_info)){
								$cntry_id = $user_info['country'];
								$states = $this->User_Model->get_states($cntry_id);
						   //debug($states);
						   }
						   ?>
						<div class="control-group">
						  <label class="control-label" for="disabledInput">State</label>
						  <div class="controls">
						  <select class="input-xlarge disabled validate[required]" name="state" id="state"  style="width:285px" >
						
							 <option value=""> Select  State</option>
							  <?php   
									foreach($states as $state) {   ?>
								  <option value="<?php  echo $state->state_id ;  ?>"  <?php if(!empty($user_info)){ if($state->state_id == $user_info['state']){ echo "selected=selected" ;} } ?>><?php  if(!empty($state->state_name)){ echo $state->state_name ;} ?></option>
								  
								  <?php  }  ?>
							 </select>
						  </div>
						</div>
						<div class="control-group">
						  <label class="control-label" for="disabledInput">Zip Code</label>
						  <div class="controls">
						  <input class="input-xlarge disabled validate[required]" name="zip" id="zip" type="text" value="<?php if(!empty($user_info['zip_code'])){ echo $user_info['zip_code']; } ?>" >
						  </div>
						</div>
						<div class="control-group">
						  <label class="control-label" for="disabledInput">Phone</label>
						  <div class="controls">
						  <input class="input-xlarge disabled validate[required],custom[phone]" name="phn" id="phn" type="text" value="<?php if(!empty($user_info['phone'])){ echo $user_info['phone']; } ?>" >
						  </div>
						</div>
						<div class="control-group">
						  <label class="control-label" for="disabledInput">VAT ID#</label>
						  <div class="controls">
						  <input class="input-xlarge disabled validate[required]" name="vat_id" id="vat_id" type="text" value="<?php if(!empty($user_info['vat_id'])){ echo $user_info['vat_id']; } ?>" >
						  </div>
						</div>
						<div class="form-actions">
						  <button type="submit" class="btn btn-primary">Submit</button>
						</div>
					  </fieldset>
					  <input type="hidden" name="user_id" id="user_id" value="<?php if(!empty($user_info['id'])){ echo $user_info['id']; }else{ echo '0';} ?>">
					</form>
				</div>
			</div>
			</div>
			</div>
		
		
		
		
		