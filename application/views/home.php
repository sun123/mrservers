<script src="<?php echo base_url(); ?>js/jquery.validate.js" type="text/javascript"></script>
<?php $language = $this->lang->lang(); ?>
<?php 

	$user_id = $this->session->userdata('user_id');
	
?>

<div class="container">
 <div class="row">
  <div class="col-md-8 col-sm-8">
   <div class="business-online">
    <h1 class="domain">Save on the domain that's right for you</h1>
    <h2 class="online-today">Get your business online today!</h2>
	
		<div class="mid-right1">
			<input type="text" class="seacrh-field1" value="Mr-Start your domain search"><a href="#"><img src="<?php echo base_url(); ?>images/go.jpg" alt=""></a>
		</div>
      
      <div class="domain-pricing">
       <ul>
       <li style="padding-left:0px;" class="no_background"><a href="#">All Domain Pricing</a></li>
       <li style=" padding-right:0px;"><a href="exchange.html">Risk-Free Domain Transfers</a></li>
      </ul>
      </div>
      
      <div class="service-heading">
       <h1 class="main-heading">services Heading</h1>
       <img src="<?php echo base_url(); ?>images/heading-img-1.jpg" alt="">
       <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been a the indus y text ever since the 1500s, when an is on unknown printer took a galley of type and scram bled it. Lorem Ipsum is simply.</p>
       <span class="more-info"><a href="#">MORE INFO</a></span>
      </div>
      
      <div class="service-heading1">
       <h1 class="main-heading1">services Heading</h1>
       <img src="<?php echo base_url(); ?>images/heading-img-2.jpg" alt="">
       <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been a the indus y text ever since the 1500s, when an is on unknown printer took a galley of type and scram bled it. Lorem Ipsum is simply.</p>
       <span class="more-info1"><a href="#">MORE INFO</a></span>
      </div>
      
      
   </div>
  </div>
  
  <div class="col-md-4 col-sm-4">
   <div class="side-bar">
	<?php if(empty($user_id)){ ?>
    <form name="customer_login" id="customer_login" action="<?php echo base_url().$language; ?>/users/check_login" method="post">
    <div class="login">
			<h1 class="login-heading">Login</h1>	
			   <?php  if($this->session->userdata("error_message")!=""){ ?>
							<div class="alert-error">
					
							<?php echo $this->session->userdata("error_message");
									$this->session->unset_userdata("error_message");	?>
							</div>
						<?php } ?>
		  <input type="text" class="login-search" name="email" id="email" placeholder="Email">
		  <input type="password" class="login-search" name="password" id="password" placeholder="Password">
    </div>
    <div class="login-icon">
	<!--<a href="#"><img src="<?php echo base_url(); ?>images/login-fb-icon.png" alt=""></a>
		 <a href="#"><img src="<?php echo base_url(); ?>images/login-google-icon.png" alt=""></a>
     <span class="forgot-password"><a href="#">Forgot your password?</a></span>-->
      <div class="send-btn1"><a href="javascript:void(0);"><input type="image" alt="Submit"  ></a>   </div> 
    </div>
	  </form>
    <?php } ?>

    <div class="news">
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
<script type="text/javascript">

$("#customer_login" ).validate({
		rules: {
			email: {
				required: true,
				email:true
			},
			password: {
				required: true
			}
		},
		messages: {
				email: {
					required: "Please enter your email."
				},
				password: {
					required: "Please enter your password."
				}
				
			}
	
});
</script>
