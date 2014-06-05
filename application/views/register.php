<script src="<?php echo base_url(); ?>js/jquery.validate.js" type="text/javascript"></script>

<script type="text/javascript">
<!--
	$(document).ready(function() {
	
		UserManager.validateUserForm();
		UserManager.fetchStates();

	});
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
<img src="<?php echo base_url();?>images/banner-2.png" alt="">

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
<div class="container">
 <div class="row">
  <div class="col-md-8 col-sm-8">
   <div class="registration">  
    <h1>registration <p class="required">All fields are required unless otherwise noted.</p></h1>
	
   <div class="error_message2"></div>
   <form name="reg_form" id="reg_form" method="post" action="<?php echo base_url().$language;?>/users/save_user">
   
    <div class="registration_row">
	 <p>First Name :</p>
	 <input type="text"  id="f_name" name="f_name" >
	</div>
    
    <div class="registration_row">
	 <p>Last Name :</p>
	 <input type="text" id="l_name" name="l_name" >
	</div>
    
    <div class="registration_row">
	 <p>Business Name :<br/><strong style="font-size:9px; color:#8e8c8c;">(Optional)</strong></p>
	 <input type="text"  id="business_name" name="business_name" class="required" >
	</div>
    
    <div class="registration_row">
	 <p>Country :</p>
	 <select id="country" name="country">
	 <option>Select Country</option>
	 <?php   
	 
		foreach($country as $cntry) {   ?>
	  <option value="<?php  echo $cntry['country_id'] ;  ?>"><?php  if(!empty($cntry['country_name'])){ echo $cntry['country_name'] ;} ?></option>
	  
	  <?php  }  ?>
	 </select>
	</div>
	
	 <div class="registration_row">
	 <p>State :</p>
	 <select  id="state" name="state">
	 <option value="">Please Select a State</option>
	 </select>
	</div>
    
     <div class="registration_row">
	 <p>Street Address :</p>
	 <input type="text" id="address" name="address">
	</div>
    
     <div class="registration_row">
	 <p>City :</p>
	 <input type="text"  id="city" name="city" >
	</div>
    
    <div class="registration_row">
	 <p>Zip-Code  :</p>
	 <input type="text" id="zip_code" name="zip_code" >
	</div>
    
    <div class="f_fild_address">
    <p>Phone Number :</p>
      <input type="text" placeholder="(123) 132-3658"  class="fild_n_address"  id="phone" name="phone" class="validate[required]">
      <span class="middle">Ext</span>
      <input type="text" name="textfield3" class="fild_n_address1" id="ext" name="ext" >
     <span class="text-bottom">Use an International Number</span>
     </div>
     
    <div class="registration_row">
	 <p>E-mail Address :</p>
	 <input type="text" name="email" id="email" >
      <span class="text-bottom">*Your receipt will be sent to this address</span>
	</div>
	
	<div class="registration_row">
	 <p>Password:</p>
	 <input type="password" placeholder="Password" name="password"  id="password" >
      <span class="text-bottom">*Your receipt will be sent to this address</span>
	</div>
	
	<div class="registration_row">
	 <p>Confirm Password :</p>
	 <input type="password" placeholder="Confirm Password" name="cpassword" id="cpassword" >
	 
      <span class="text-bottom">*Your receipt will be sent to this address</span>
	</div>
    
    <div class="registration_row">
	 <p>VAT ID# ::</p>
	 <input type="text " name="vat_id" id="vat_id" value="" >
	</div>
        <div class="send-btn5"><input type="image" alt="Submit"  >   </div> 
   <input type="hidden" name="user_id" id="user_id" value="0" >
</form>

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
			country: {
				required: true
			},
			state: {
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
				required: true,
				equalTo:password,
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
