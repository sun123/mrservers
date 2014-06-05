<script type="text/javascript">
	var jq = jQuery.noConflict(); 
	jq(document).ready(function($) {

			jq("#reg_form").validationEngine();			

	});
	
	function submit_reg_frm(){
		
			jq("#reg_form").submit();
	
	}
</script>

<div class="container">
 <div class="row">
  <div class="col-md-8 col-sm-8">
   <div class="registration">  
    <h1>registration <p class="required">All fields are required unless otherwise noted.</p></h1>
	
   <div class="error_message2"></div>
   <form name="reg_form" id="reg_form" method="post" action="<?php echo base_url();?>users/save_user">
   
    <div class="registration_row">
	 <p>First Name :</p>
	 <input type="text"  id="fname" name="fname" class="validate[required],custom[onlyLetterSp]">
	</div>
    
    <div class="registration_row">
	 <p>Last Name :</p>
	 <input type="text" id="lname" name="lname" class="validate[required],custom[onlyLetterSp]">
	</div>
    
    <div class="registration_row">
	 <p>Business Name :<br/><strong style="font-size:9px; color:#8e8c8c;">(Optional)</strong></p>
	 <input type="text"  id="bname" name="bname" class="validate[required]">
	</div>
    
    <div class="registration_row">
	 <p>Country :</p>
	 <select id="country" name="country" class="validate[required]"><option>United States</option></select>
	</div>
    
     <div class="registration_row">
	 <p>Street Address :</p>
	 <input type="text" id="saddress1" name="saddress1" class="validate[required]">
	</div>
    
     <div class="registration_row">
	 <p>City :</p>
	 <input type="text"  id="city" name="city" class="validate[required]">
	</div>
    
    <div class="registration_row">
	 <p>State :</p>
	 <select  id="state" name="state" class="validate[required]"><option>Please Select a State</option></select>
	</div>
    
    <div class="registration_row">
	 <p>Zip-Code  :</p>
	 <input type="text" id="zip" name="zip" class="validate[required]">
	</div>
    
    <div class="f_fild_address">
    <p>Phone Number :</p>
      <input type="text" placeholder="(123) 132-3658"  class="fild_n_address"  id="phone" name="phone" class="validate[required]">
      <span class="middle">Ext</span>
      <input type="text" name="textfield3" class="fild_n_address1" id="phone" name="phone" class="validate[required]">
     <span class="text-bottom">Use an International Number</span>
     </div>
     
    <div class="registration_row">
	 <p>E-mail Address :</p>
	 <input type="text" name="email" id="email" class="validate[required,custom[email]],ajax[ajaxEmailCall]">
      <span class="text-bottom">*Your receipt will be sent to this address</span>
	</div>
	
	<div class="registration_row">
	 <p>Password:</p>
	 <input type="password" placeholder="Password" name="password"  id="password" class="validate[required],minSize[6]">
      <span class="text-bottom">*Your receipt will be sent to this address</span>
	</div>
	
	<div class="registration_row">
	 <p>Confirm Password :</p>
	 <input type="password" placeholder="Confirm Password" name="cpassword" id="cpassword" class="validate[required],equals[password]">
	 
      <span class="text-bottom">*Your receipt will be sent to this address</span>
	</div>
    
    <div class="registration_row">
	 <p>VAT ID# ::</p>
	 <input type="text " name="vatId" id="vatId" value="" class="validate[required]">
	</div>
   <div class="send-btn5"><a  href="javascript:void(0);" onclick="submit_reg_frm();">Submit</a></div>
   
</form>

   </div>
  </div>
  
  <div class="clear1"></div>
  
  <div class="col-md-4 col-sm-4">
   <div class="side-bar">
    
    <div class="news1">
     <h1 class="news-heading">news</h1>
     <span class="heading-strong">10-5-2014 Lorem Ipsum is simply</span>
     <p class="news-matter">
      dummy text of the printing and typesetting industry. Lorem Ipsum has been a the indus y text ever since the 1500s, when an is on unknown.
     </p>
     
     <span class="heading-strong1">10-5-2014 Lorem Ipsum is simply</span>
     <p class="news-matter1">
      dummy text of the printing and typesetting industry. the 1500s, when an is on unknown.

     </p>
     
     <span class="heading-strong1">10-5-2014 Lorem Ipsum is simply</span>
     <p class="news-matter1">
      dummy text of the printing and typesetting industry. Lorem Ipsum has been a the indus y text ever since the 1500s, when an is on unknown.
     </p>
     
      <span class="more-info1"><a href="#">MORE INFO</a></span>
    </div>
    
   </div>
  </div>
  
 </div>
</div>