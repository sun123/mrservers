<script src="<?php echo base_url(); ?>js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
	$(document).ready(function() {
	
		UserManager.validateUserForm();
		UserManager.fetchStates();
		UserManager.validatePassword();
		
	});
	
	 function submit_reg_frm(){
		
		$("#chng_pass").submit();	
	
	}
//-->
</script>
<style>
label.error {
    margin-left: 25.5%;
    width: 74%;
}
label{

	font-weight:normal;
	color: red;
	margin-left: 25%;
}

</style>
<?php $language = $this->lang->lang(); ?>
<div class="banner-bg2"></div>
 <div class="container">
<div class="banner2">
<img src="<?php echo base_url(); ?>images/banner-2.png" alt="">

 	<div class="banner_con">
  <div class="row">
   <div class="col-md-12">
    <div class="banner-heading">
     <h1 class="save1">Save on the domain</h1> 
     <h1 class="right1">that's right for you</h1>     
    </div>        
   </div>
  </div>
 </div>
 </div>
</div>
<?php //debug($user_info); ?>
<div class="container">
 <div class="row">
  <div class="col-md-8 col-sm-8">
   <form name="reg_form" id="reg_form" method="post" action="<?php echo base_url().$language;?>/users/update_user">
	   <div class="registration">
    <h1>Change Contact Information</h1>

   <?php if($this->session->userdata("success_message")!=""){ ?>
							<div class="alert-success">
							<strong>Success! </strong>
							<?php echo $this->session->userdata("success_message");
									$this->session->unset_userdata("success_message");	?>
							</div>
						<?php }
						else if($this->session->userdata("error_message")!=""){ ?>
							<div class="alert-error">
							<strong>Error! </strong>
							<?php echo $this->session->userdata("error_message");
									$this->session->unset_userdata("error_message");	?>
							</div>
						<?php } ?>

    
    <div class="registration_row">
	 <p>First Name :</p>
	 <input type="text"  id="f_name" name="f_name" class="validate[required],custom[onlyLetterSp]" value="<?php echo $user_info['f_name']; ?>">
	</div>
    
    <div class="registration_row">
	 <p>Last Name :</p>
	 	 <input type="text" id="l_name" name="l_name" class="validate[required],custom[onlyLetterSp]" value="<?php echo $user_info['l_name']; ?>">
	</div>
    
    <div class="registration_row">
	 <p>Business Name :</p>
		 <input type="text"  id="business_name" name="business_name" class="validate[required]" value="<?php echo $user_info['business_name']; ?>">
      <span class="text-bottom"> (Completing this field gives us permission to contact you.)</span>
	</div>
    
    <div class="registration_row">
	 <p>Email Address :</p>
	<input type="text" name="email" id="email" class="validate[required,custom[email]],ajax[ajaxEmailCall]" value="<?php echo $user_info['email']; ?>">
	</div>
    
    
    <div class="registration_row">
	 <p>Country / Region :</p>
	<select id="country" name="country" >
	<option>Select Country</option>
	<?php   
	
		foreach($country as $cntry) {   ?>
	  <option value="<?php  echo $cntry['country_id'] ;  ?>"  <?php if($cntry['country_id'] == $user_info['country']){ echo "selected=selected" ;}  ?>><?php  if(!empty($cntry['country_name'])){ echo $cntry['country_name'] ;} ?></option>
	  
	  <?php  }  ?>
	</select>
	</div>
    
     <div class="registration_row">
	 <p>Address  :</p>
		 <input type="text" id="address" name="address"  value="<?php echo $user_info['address']; ?>">
	</div>
    
  
    
    <div class="registration_row">
	 <p>Zip-Code  :</p>
		 <input type="text" id="zip_code" name="zip_code"  value="<?php echo $user_info['zip_code']; ?>">
	</div>
    
    <div class="f_fild_address2">
    <p>City :</p>
	   <input type="text"  id="city" name="city" class=" fild_n_address2 validate[required]" value="<?php echo $user_info['city']; ?>">
	   <?php
	   
			$cntry_id = $user_info['country'];
			$states = $this->USER_MODEL->get_states($cntry_id);
	   // debug($states);
	   ?>
	   
      <span class="middle1">State</span>

	  <select  id="state" name="state" >
	  <?php   
		foreach($states as $state) {   ?>
	  <option value="<?php  echo $state->state_id ;  ?>"  <?php if($state->state_id == $user_info['state']){ echo "selected=selected" ;}  ?>><?php  if(!empty($state->state_name)){ echo $state->state_name ;} ?></option>
	  
	  <?php  }  ?>
	  
	  </select>
    </div>
    
     
    <div class="registration_row">
	 <p>Phone Number :</p>
	<input type="text" placeholder="(123) 132-3658"  class="fild_n_address"  id="phone" name="phone" class="validate[required]" value="<?php echo $user_info['phone']; ?>">

	</div>
	
     <div class="send-btn5"><input type="image" alt="Update"  >   </div> 
    <div class="border-bottom"></div>
    
   </div>
   </form>
   <div class="registration">
    <h1>Change Password</h1>
	<div id="errormsg" style="margin:0px 0 20px 150px;color:#FF3F3F;padding:10px; "></div> 
<form name="chng_pass" id="chng_pass" action="<?php echo base_url().''   ?>" method="post">
    <div class="registration_row">
	 <p>Current Password :</p>
	 <input type="password" name="old_pass" id="old_pass" class="required" >
	</div>

     <div class="registration_row">
	 <p>New Password :</p>
	 <input type="password" name="new_pass" id="new_pass" class="required">
	</div>
    
    
    <div class="registration_row">
	 <p>Re-type Password :</p>
	 <input type="password" name="conf_pass" id="conf_pass" class="required">
	</div>
    
    <div class="update-password"><a href="javascript:void(0);" onclick="submit_reg_frm();">Change password</a></div>
    </form>
    <div class="border-bottom"></div>
   </div>
   
  </div>
  
  <div class="clear1"></div>
  
  <div class="col-md-4 col-sm-4">
   <div class="side-bar">
   
    
    <div class="news1">
      <?php $this->load->view('news'); ?>
    </div>
    
   </div>
  </div>
  
 </div>
</div>

<div class="container">
 <div class="row">
  <div class="col-md-12">
    <div class="host-diem"><span class="host-img"><img src="<?php echo base_url(); ?>images/host-img.png" alt=""></span></div>
  </div>
 </div>
</div>



  
 </div>
</div>
<script type="text/javascript">

$("#reg_form" ).validate({
		rules: {
			email: {
				required: true,
				email:true
			},
			f_name: {
				required: true
			},
			l_name: {
				required: true
			},
			address: {
				required: true
			},
			city: {
				required: true
			},
			zip_code: {
				required: true
			},
			phone: {
				required: true
			},
			password: {
				required: true
			},
			cpassword: {
				required: true
			},
			vat_id: {
				required: true
			}
		},
		messages: {
				email: {
					required: "Please enter your email."
				},
				password: {
					required: "Please enter your password."
				},
				f_name: {
					required: "Please enter your first name."
				},
				l_name: {
					required: "Please enter your last name."
				},
				address: {
					required: "Please enter your address."
				},
				city: {
					required: "Please enter your city"
				},
				zip_code: {
					required: "Please enter your zip code"
				},
				phone: {
					required: "Please enter your phone no."
				},
				vat_id: {
					required: "Please enter vat id"
				}
				
			}
	
});
</script>
