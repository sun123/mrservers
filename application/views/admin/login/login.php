<!DOCTYPE html>
<html lang="en">
<head>
<?php 

$this->load->helper('language');		
$this->load->helper('cookie');	
$lang = $this->lang->lang();
$expire=time()+60*60*24*30;
set_cookie('language',$lang,$expire);
$language = get_cookie('language');

?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<!-- disable iPhone inital scale -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GraphTK :: Login</title>
<link href="<?php echo base_url();?>css/admin/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>css/media-queries.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico" type="image/x-icon" />

<!-- html5.js for IE less than 9 -->
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- css3-mediaqueries.js for IE less than 9 -->
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<!--[if lt IE 9]><script src="scripts/html5shiv.js"></script><![endif]-->
<script type="text/javascript" src="<?php echo base_url();?>js/admin/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/admin/general.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/admin/jquery.validate.js"></script>

 
</head>
<script type="text/javascript">
$(document).ready(function(){
  validation();
})  
</script>
 <script>
 base_url='<?php echo base_url(); ?>';
 </script>
 <style>
 .btn {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #F5F5F5;
    background-image: linear-gradient(to bottom, #FFFFFF, #E6E6E6);
    background-repeat: repeat-x;
    border-bottom-color: #B3B3B3;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    border-bottom-style: solid;
    border-bottom-width: 1px;
    border-image-outset: 0 0 0 0;
    border-image-repeat: stretch stretch;
    border-image-slice: 100% 100% 100% 100%;
    border-image-source: none;
    border-image-width: 1 1 1 1;
    border-left-color-ltr-source: physical;
    border-left-color-rtl-source: physical;
    border-left-color-value: rgba(0, 0, 0, 0.1);
    border-left-style-ltr-source: physical;
    border-left-style-rtl-source: physical;
    border-left-style-value: solid;
    border-left-width-ltr-source: physical;
    border-left-width-rtl-source: physical;
    border-left-width-value: 1px;
    border-right-color-ltr-source: physical;
    border-right-color-rtl-source: physical;
    border-right-color-value: rgba(0, 0, 0, 0.1);
    border-right-style-ltr-source: physical;
    border-right-style-rtl-source: physical;
    border-right-style-value: solid;
    border-right-width-ltr-source: physical;
    border-right-width-rtl-source: physical;
    border-right-width-value: 1px;
    border-top-color: rgba(0, 0, 0, 0.1);
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-top-style: solid;
    border-top-width: 1px;
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.2) inset, 0 1px 2px rgba(0, 0, 0, 0.05);
    color: #333333;
    cursor: pointer;
    display: inline-block;
    font-size: 14px;
    line-height: 20px;
    margin-bottom: 0;
    padding-bottom: 4px;
    padding-left: 12px;
    padding-right: 12px;
    padding-top: 4px;
    text-align: center;
    text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
    vertical-align: middle;
}
.btn-primary{
color:#fff;text-shadow:0 -1px 0 rgba(0,0,0,0.25);background-color:#1C1713;*background-color:#04c;background-image:-moz-linear-gradient(top,#1C1713,#1C1713);background-image:-webkit-gradient(linear,0 0,0 100%,from(#1C1713),to(#1C1713));background-image:-webkit-linear-gradient(top,#1C1713,#1C1713);background-image:-o-linear-gradient(top,#1C1713,#1C1713);background-image:linear-gradient(to bottom,#1C1713,#1C1713);background-repeat:repeat-x;border-color:#04c #04c #002a80;border-color:rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff0088cc',endColorstr='#ff0044cc',GradientType=0);filter:progid:DXImageTransform.Microsoft.gradient(enabled=false)
}
 label.error
{
color:red;
}
 </style>
 <body>	
		<div class="header">
			<div id="header_wrapper">
				<div class="logo"><a href="<?php echo base_url();?>admin"><img style="margin-left:390px;" src="<?php echo base_url();?>images/logo.png" alt=""></a></div>
			</div>
		</div>
		<div class="body_main">
			<div id="body_wrapper">			
					<div class="featured_phone_bg">					
						<form class="form-signin" id="login_button" method="post">
							<h2 class="form-signin-heading">Please sign in</h2>
							<input type="text" name="username" id="username" class="input-block-level" placeholder="Username">
							<input type="password" name="password" id="password" class="input-block-level" placeholder="Password"/></br>				
							<button class="btn-primary btn"  type="submit">Sign in</button>
						</form>		
					</div>
			</div>
		</div>
</body>
</html>