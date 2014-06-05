     <h1 class="news-heading">news</h1>
	 <?php 	

		$CI = get_instance();
		$CI->load->model('welcome_model');
	 $news=$CI->welcome_model->get_data("tbl_news");
	 //debug($news);
	if(!empty($news)){	
	 foreach($news as $nw){ 
		$d = strtotime($nw['news_time']);
		$date = date('d-m-Y',$d);
	 ?>
     <p class="news-matter">
     <strong style="color:#F65B0A;"><?php echo $date.'  '.$nw['news_title']; ?> </strong><br/>
     <?php echo $nw['news_content']; ?>
     </p>
     <?php }} ?>
     <span class="more-info1"><a href="#">MORE INFO</a></span>

    