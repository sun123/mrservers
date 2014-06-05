<?php $language = get_cookie('language'); ?>
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
<div class="container">
	<div class="row">
	  <div class="col-md-8 col-sm-8">
	   <div class="registration">
		<h1>Browse Your Invoices</h1>
		<?php //debug($invo_pdf); ?>
		<aside style="margin-top:5px;" class="transactions_history">
							<div class="transactions_status_history">
							
									<div style="overflow-y:hidden; height:auto;" class="table_scroll_history">
										<table>
									   
										
										<tbody>
										<?php  
											if(!empty($invo_pdf)){
											foreach($invo_pdf as $pdf){
											$d =	strtotime($pdf['date_created']);
											$date = date('d-m-y',$d);
											?>
										  <tr>
											<td><img src="<?php echo base_url(); ?>images/pdf-icon.png" alt=""></td>
											<td><strong><?php echo $date; ?></strong></td>
											<td><strong><?php echo $pdf['pdf_title']; ?></strong></td>
											<td><div class="checkout-btn"><a href="<?php echo base_url().$language; ?>/invoice/download_pdf/<?php echo $pdf['id']; ?>">DOWNLOAD</a></div></td>
											
										  </tr>
										  <?php } }?>
										  
										 </tbody>
									</table>
									</div>
									
									
									
									
								   </div>
								</aside>   
	   
	   </div>
	  </div>
	  
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
