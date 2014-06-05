<?php
$this->load->helper('language');		// load language file
$this->load->helper('cookie');		// load language file
$this->lang->load('header');
$this->lang->load('top');
$this->lang->load('nav');
$lang = $this->lang->lang();
$expire=time()+60*60*24*30;
set_cookie('language',$lang,$expire);
$language = get_cookie('language');

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>MR-SERVERS :: Home</title>
<script>
	var base_url="<?php  echo base_url().$language.'/'; ?>";
</script>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>images/favicon.ico">
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/responsive.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet">

<script src="<?php echo base_url(); ?>js/jquery-1.11.0.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>js/bootstrap.js" type="text/javascript"></script>


<!---Slider Jquery-->

<!-- Important Owl stylesheet -->
<link rel="stylesheet" href="<?php echo base_url(); ?>owl-carousel/owl.carousel.css">
 
<!-- Default Theme -->
<link rel="stylesheet" href="<?php echo base_url(); ?>owl-carousel/owl.theme.css">
 
<!-- jQuery 1.7+ -->
<script src="<?php echo base_url(); ?>owl-carousel/jquery-1.9.1.min.js"></script>
 
<!-- Include js plugin -->
<script src="<?php echo base_url(); ?>owl-carousel/owl.carousel.js"></script>
<script src="<?php echo base_url(); ?>js/general.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function($){

	/* prepend menu icon */
	$('#nav-wrap').prepend('<div id="menu-icon">Menu</div>');
	
	/* toggle nav */
	$("#menu-icon").on("click", function(){
		$("#nav").slideToggle();
		$(this).toggleClass("active");
	});
	
	 $("#slider").owlCarousel({
 
			navigation : true, // Show next and prev buttons
			slideSpeed : 300,
			paginationSpeed : 400,
			singleItem:true
			 
			// "singleItem:true" is a shortcut for:
			// items : 1,
			// itemsDesktop : false,
			// itemsDesktopSmall : false,
			// itemsTablet: false,
			// itemsMobile : false
		 
		});

});

function move_prev(){
		$("#slider").trigger('owl.prev');
}

function move_next(){
	$("#slider").trigger('owl.next');
}

</script>
<style>
.owl-controls{
	display:none !important;
}
.slide_img{
	float:right;
}

input.inputbox-error { border: 1px solid #c04848 !important; }

.error_message2 {
    background-color: #c04848;
   /* border: 1px solid #FFF !important;*/
    color: #FFF !important;
    font-family: Arial,helvetica !important;
    font-size: 12px !important;
	font-weight: normal !important;
	font-style:italic!important;
    padding-bottom: 10px !important;
    padding-left: 10px !important;
    padding-right: 10px !important;
    padding-top: 10px !important;
	display:none;
	border:2px solid;
	border-radius:12px;
}

</style>




</head>


<body>




<!--header start here-->
<!--<div class="chat-box"><a href="#">Chat now</a></div>-->
<header class="header">
  <div class="container">
    <div class="row">
     <div class="col-md-4 col-sm-4">
     <?php $user_id = $this->session->userdata('user_id'); ?>
     <?php $u_name = $this->session->userdata('user_name'); ?>
      <div class="quick-links">
       <ul>
       <li style="padding-left:0px;" class="no_background"><a href="#"><?=  lang('header.currency') ?> - English <img src="<?php echo base_url(); ?>images/down-arrow.png" alt="">
       </a></li>
       <li><a href="exchange.html"><?=  lang('header.currency') ?> - USD <img src="<?php echo base_url(); ?>images/down-arrow.png" alt=""></a></li>
      </ul>
      </div>
      
      </div>
      <div class="col-md-8 col-sm-8">
       
       <div class="quick-links1">
       <ul>
       <li style="padding-left:0px;" class="no_background"><a href="#"><?=lang('top.addr')?></a></li>
       <!--<li><a href="exchange.html"> A. Ul Majkowskiego 5A</a></li>
       <li><a href="exchange.html">83-400 Koscierzyna</a></li>
       <li style="padding-right:0px;"><a href="exchange.html">NIP: 591-147-12-21</a></li>-->
      </ul>
      </div>
        
      </div>
    </div>
  </div>
</header>

<div class="container">
   <div class="row">
    <div class="col-md-4 col-sm-4">
     <div class="logo">
      <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/logo.jpg" alt=""></a>
     </div>
    </div>
    
    <div class="col-md-8 col-sm-8">
     <div class="sign-register-search">
      <div class="sign-register">
       <ul>
			<?php if(!empty($user_id)){ ?>	
				<li style="padding-left:0px;" class="no_background"><a href="<?php echo base_url().$language; ?>/users/my_account"><?=lang('header.welcome')?>:<?php echo $u_name; ?></a></li>
				<li style="padding-left:0px;" class="no_background"><a href="<?php echo base_url().$language; ?>/users/logout"><?=lang('header.logout')?></a></li>
				
			<?php }else{ ?>
			   <li style="padding-left:0px;" class="no_background"><a href="<?php echo base_url().$language; ?>"><?=lang('header.signin')?></a></li>
			   <li style="padding-right:0px;"><a href="<?php echo base_url().$language; ?>/users/register"><?=lang('header.reg')?></a></li>
		   <?php } ?>
	   </ul>
      </div>
      
     
      <div class="mid-right">
         <input type="text" class="seacrh-field" value="" placeholder="<?= lang('header.search') ?>"><a href="#"><img src="<?php echo base_url(); ?>images/search-img.jpg" alt=""></a>
      </div>
     
    </div>
    </div>
   </div>
  </div>


<!--header end here--> 
