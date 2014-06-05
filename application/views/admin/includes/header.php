<!DOCTYPE html>
<html class="no-js">
    <head>
        <title>Admin Home Page</title>
        <!-- Bootstrap -->
		<link href="<?php echo base_url(); ?>css/admin/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>css/admin/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url(); ?>css/admin/bootstrap-responsive.min.css" rel="stylesheet" >
        <link href="<?php echo base_url(); ?>css/admin/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url(); ?>css/admin/styles.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="<?php echo base_url();?>css/admin/validationEngine.jquery.css">

	
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		
		<script type="text/javascript">
		<?php 	$language = get_cookie('language'); ?>
		var base_url = '<?php echo base_url().$language.'/';?>';
		var uri_seg = '<?php echo $this->uri->segment(3,0); ?>';
</script>
		
		<script type="text/javascript" src="<?php echo base_url();?>js/admin/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/admin/jquery.validationEngine.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/admin/jquery.validationEngine-en.js"></script>
		

		

    </head>
       <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="<?php echo base_url().$language."/admin/welcome/home" ; ?>" style="color:#114069">Admin Panel</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i><?php echo  ucfirst($this->session->userdata('name')); ?><i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url().$language; ?>/admin/admin/change_pass">Change Password</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url().$language; ?>/admin/admin/logout">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li class="active" >
                                <a href="<?php echo base_url().$language."/admin/welcome/home" ; ?>">Dashboard</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Settings <b class="caret"></b> </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li>
                                        <a href="<?php echo base_url().$language; ?>/admin/admin/settings">Manage Email <i class="icon-arrow-right"></i></a>
                                     
                                    </li>
                                    
                                 
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Content <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url().$language; ?>/admin/page">Static Pages</a>
                                    </li>
                                    
                                </ul>
                            </li>
				
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
               <div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <li class="active">
                            <a href="<?php echo base_url().$language; ?>/admin/welcome/home"><i class="icon-chevron-right"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().$language; ?>/admin/admin/settings"><i class="icon-chevron-right"></i>Settings</a>
                        </li>
						 <li>
                            <a href="<?php echo base_url().$language; ?>/admin/admin/change_pass"><i class="icon-chevron-right"></i>Change Password</a>
                        </li>	
						<li>
                            <a href="<?php echo base_url().$language; ?>/admin/news"><i class="icon-chevron-right"></i>Manage News</a>
                        </li>		
						<li>
                            <a href="<?php echo base_url().$language; ?>/admin/users"><i class="icon-chevron-right"></i>Manage User</a>
                        </li>		
								
								<li>
                            <a href="<?php echo base_url().$language; ?>/admin/invoice"><i class="icon-chevron-right"></i>Manage Invoice</a>
                        </li>	
                      
                    </ul>
                </div>
                
                <!--/span-->
                <div class="span9" id="content">
                    
