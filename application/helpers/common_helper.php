<?php
	/*
		Generate Random String
		@param	INT		Length of the string to be generated
	*/

	function random_str($length = "8") {
		srand((double)microtime()*1000000);
		$vowels = array("a", "e", "i", "o", "u");
		$cons = array("b", "c", "d", "g", "h", "j", "k", "l", "m", "n", "p", "r", "s", "t", "u", "v", "w", "tr",
		"cr", "br", "fr", "th", "dr", "ch", "ph", "wr", "st", "sp", "sw", "pr", "sl", "cl");
		$num_vowels = count($vowels);
		$num_cons = count($cons);
		$password = "";
		for($i = 0; $i < $length; $i++){
			$password .= $cons[rand(0, $num_cons - 1)] . $vowels[rand(0, $num_vowels - 1)];
		}

		return substr($password, 0, $length);
	}
	
	function get_us_states_list() {
	
		$states_list = array(
					'AL'=>"Alabama",  
					'AK'=>"Alaska",  
					'AZ'=>"Arizona",  
					'AR'=>"Arkansas",  
					'CA'=>"California",  
					'CO'=>"Colorado",  
					'CT'=>"Connecticut",  
					'DE'=>"Delaware",  
					'DC'=>"District Of Columbia",  
					'FL'=>"Florida",  
					'GA'=>"Georgia",  
					'HI'=>"Hawaii",  
					'ID'=>"Idaho",  
					'IL'=>"Illinois",  
					'IN'=>"Indiana",  
					'IA'=>"Iowa",  
					'KS'=>"Kansas",  
					'KY'=>"Kentucky",  
					'LA'=>"Louisiana",  
					'ME'=>"Maine",  
					'MD'=>"Maryland",  
					'MA'=>"Massachusetts",  
					'MI'=>"Michigan",  
					'MN'=>"Minnesota",  
					'MS'=>"Mississippi",  
					'MO'=>"Missouri",  
					'MT'=>"Montana",
					'NE'=>"Nebraska",
					'NV'=>"Nevada",
					'NH'=>"New Hampshire",
					'NJ'=>"New Jersey",
					'NM'=>"New Mexico",
					'NY'=>"New York",
					'NC'=>"North Carolina",
					'ND'=>"North Dakota",
					'OH'=>"Ohio",  
					'OK'=>"Oklahoma",  
					'OR'=>"Oregon",  
					'PA'=>"Pennsylvania",  
					'RI'=>"Rhode Island",  
					'SC'=>"South Carolina",  
					'SD'=>"South Dakota",
					'TN'=>"Tennessee",  
					'TX'=>"Texas",  
					'UT'=>"Utah",  
					'VT'=>"Vermont",  
					'VA'=>"Virginia",  
					'WA'=>"Washington",  
					'WV'=>"West Virginia",  
					'WI'=>"Wisconsin",  
					'WY'=>"Wyoming"
				);
		
		return $states_list;

	}

	function clean_filename($str = "") {
		$filters = array("!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "-", "+", "|", "\\", "/", "[", "]", "~", " ", "'");
		
		$str = str_replace($filters, "_", $str);
		
		return $str;
	}

	
	function UnixTime($datetime = "0000-00-00 00:00:00") {

		
		$datetime_exlode = explode(" ", $datetime);

		$date_part = $datetime_exlode[0];
		
		$date_arr = explode("-", $date_part);


		$time_part = $datetime_exlode[1];
		$time_arr = explode(":", $time_part);

//echo "<br /> $datetime <br/> $time_arr[0], $time_arr[1], $time_arr[2], $date_arr[1], $date_arr[0], $date_arr[2] <br/>";

		return mktime($time_arr[0], $time_arr[1], $time_arr[2], $date_arr[1], $date_arr[2], $date_arr[0]);

	}
	
	function RelativeTime($timestamp)
	{
		$difference = time() - $timestamp;
		$periods = array("sec", "min", "hour", "day", "week", "month", "years", "decade");
		$lengths = array("60","60","24","7","4.35","12","10");

		if ($difference > 0)
		{
			$ending = "ago";
		}
		else
		{
			 $difference = -$difference;
			 $ending = "to go";
		}

		for($j = 0; $difference >= $lengths[$j]; $j++)
		{
			$difference /= $lengths[$j];
		}

		$difference = round($difference);

		if($difference != 1)
		{
			 $periods[$j].= "s";
		}
		return $difference . $periods[$j] . $ending;
	}
	
	function get_advert_content()
	{
		$CI =& get_instance();

		$CI->load->model("pages_model");
		
		$result = $CI->pages_model->get_advert();
		
		return $result['content'];
	}
		
	function get_day($day = 0) {
		
		switch($day) {
			
			case 1 : 
				return "Monday";
				break;

			case 2 : 
				return "Tuesday";
				break;
			case 3 : 
				return "Wednesday";
				break;
			case 4 : 
				return "Thrusday";
				break;
			case 5 : 
				return "Friday";
				break;
			case 6 : 
				return "Saturday";
				break;
			case 7 : 
				return "Sunday";
				break;	
		}

	}
	


	function categorize_array( $categories = array(), $parent_category_id = 0) {
		$tempArr = array();
		
		foreach( $categories as $key => $catg ) {
			if ( $catg->parent_id == $parent_category_id ) {
				$tempArr[ $catg->category_id ] = $catg;
			}
		}

		$finalArr = $tempArr;

		foreach ( $tempArr as $key => $arr ) {
			
			foreach ( $categories as $cat ) {
				
				if ( $arr->category_id == $cat->parent_id ) {
					$cat->sub_categories = array();

					$cat->sub_categories = categorize_array( $categories, $cat->category_id);
					
					if ( !isset($finalArr[$key]->sub_categories) ) {
						$finalArr[$key]->sub_categories = array();
					}

					$finalArr[$key]->sub_categories[] = $cat;
				}
			}

		}
		
	//	debug($finalArr);

		return $finalArr;

	}
	
	function generate_selectbox_from_array($categories, $checked_id = -1) {
		$str = "";
		
		if ( isset($categories->sub_categories) ) {
			foreach( $categories->sub_categories as $sub_catg ) {
				
				if ( $sub_catg->is_category == 1 ) {
					$str .= '<optgroup label="'.$sub_catg->category_name.'">';
				}
				else {
					$sel = "";
					if ( $checked_id == $sub_catg->category_id ) {
						$sel = 'selected="selected"';
					}
						
					$str .= '<option '.$sel.' value="'.$sub_catg->category_id.'">' . $sub_catg->category_name . '</option>';
				}
				
				if ( isset($sub_catg->sub_categories) && !empty($sub_catg->sub_categories) ) {
					foreach ($sub_catg->sub_categories as $subCat) {
						$sel = "";
						if ( $checked_id == $subCat->category_id ) {
							$sel = 'selected="selected"';
						}
						$str .= '<option '.$sel.' value="'. $subCat->category_id.'">' . $subCat->category_name . '</option>';	
					}
				}

				if ( $sub_catg->is_category == 1 ) {
					$str .= '</optgroup>';
				}

			}
		}

		return $str;

	}
	
	function generate_selectbox_from_array_side($categories, $checked_id = -1) {
		$str = "";
		
		if ( isset($categories->sub_categories) ) {
			foreach( $categories->sub_categories as $sub_catg ) {
			
			
				
				if ( $sub_catg->is_category == 1 ) {
					$str .= '<optgroup label="'.$sub_catg->category_name.'">';
				}
				else {
					$sel = "";
					/*if ( $checked_id == $sub_catg->category_id ) {
						$sel = 'selected="selected"';
					}*/
						if(isset($_GET['category_'.$categories->category_id]) && $_GET['category_'.$categories->category_id] == $sub_catg->category_id)
							{
								
								
								$sel = 'selected="selected"';
							}
					$str .= '<option '.$sel.' value="'.$sub_catg->category_id.'">' . $sub_catg->category_name . '</option>';
				}
				
				if ( isset($sub_catg->sub_categories) && !empty($sub_catg->sub_categories) ) {
					foreach ($sub_catg->sub_categories as $subCat) {
						$sel = "";
						if ( $checked_id == $subCat->category_id ) {
							$sel = 'selected="selected"';
						}
						
						$str .= '<option '.$sel.' value="'. $subCat->category_id.'">' . $subCat->category_name . '</option>';	
					}
				}

				if ( $sub_catg->is_category == 1 ) {
					$str .= '</optgroup>';
				}

			}
		}

		return $str;

	}

	/*
	* Generate Pagination
	*/

	function generate_pagination($total_rows, $url, $limit, $page, $extraparams = "") {


		$adjacents = 3;
		$total_pages = $total_rows;
		$targetpage = $url;
		$pre_str = '?';
	
		if( strpos($targetpage, '?') ) {
			$pre_str = '&';
		}
		
		//$limit = 2; 								//how many items to show per page
		$params = "";
		
		if ( $extraparams != "" ) {
			$params = $extraparams;
		}

		//if no page var is given, default to 1.
		$prev = $page - 1;							//previous page is page - 1
		$next = $page + 1;							//next page is page + 1
		$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
		
		$lpm1 = $lastpage - 1;	

		$pagination = "";

		if($lastpage > 1) {
			$pagination .= '<ul class="forum-page-list2" style="width: 100%;">';
			//previous button
			if ($page > 1)
				$pagination.= "<li><a href='".$targetpage.$pre_str."page=".$prev.$params."'><i class='fa fa-angle-double-left' ></i> Prev</a></li>";
			else
				$pagination.= "<li><a class=\"disabled\"><i class='fa fa-angle-double-left' ></i>Prev</a></li>";

			//pages

			//not enough pages to bother breaking it up
			if ( $lastpage < 7 + ($adjacents * 2) )	{
				for ($counter = 1; $counter <= $lastpage; $counter++) {
					if ($counter == $page)
						$pagination.= "<li class='active'><a>$counter</a></li>";
					else
						$pagination.= "<li><a href='".$targetpage.$pre_str."page=".$counter.$params."'>$counter</a></li>";
				}
			}
			
			//enough pages to hide some 
			elseif($lastpage > 5 + ($adjacents * 2)) {
				//close to beginning; only hide later pages
				if ( $page < 1 + ($adjacents * 2) ) {
					for($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
						if ($counter == $page)
							$pagination.= "<li class='active'><a href='".$targetpage.$pre_str."page=".$prev.$params."'>$counter</a></li>";
						else
							$pagination.= "<li><a href='".$targetpage.$pre_str."page=".$counter.$params."'>$counter</a></li>";
					}
			
					$pagination.= "<li style='background-color: #fff;border: 0px solid #fff;'>...</li>";
					$pagination.= "<li><a href='".$targetpage.$pre_str."page=".$lpm1.$params."'>$lpm1</a></li>";
					$pagination.= "<li><a href='".$targetpage.$pre_str."page=".$lastpage.$params."'>$lastpage</a></li>";
				}
		
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
					$pagination.= "<li><a href='".$targetpage.$pre_str."page=1".$params."'>1</a></li>";
					$pagination.= "<li><a href='".$targetpage.$pre_str."page=2".$params."'>2</a></li>";
					//$pagination.= "<li style='background-color: #fff;border: 0px solid #fff;'>...</li>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
						if ($counter == $page)
							$pagination.= "<li class='active'><a class=\"current\">$counter</a></li>";
						else
							$pagination.= "<li><a href='".$targetpage.$pre_str."page=".$counter.$params."'>$counter</a></li>";
					}

					$pagination.= "<li style='background-color: #fff;border: 0px solid #fff;'>...</li>";
					$pagination.= "<li><a href='".$targetpage.$pre_str."page=".$lpm1.$params."'>$lpm1</a></li>";
					$pagination.= "<li><a href='".$targetpage.$pre_str."page=".$lastpage.$params."'>$lastpage</a></li>";
				}
				
				//close to end; only hide early pages
				else {
					$pagination.= "<li><a href='".$targetpage.$pre_str."page=1".$params."'>1</a></li>";
					$pagination.= "<li><a href='".$targetpage.$pre_str."page=2".$params."'>2</a></li>";
					$pagination.= "<li style='background-color: #fff;border: 0px solid #fff;'>...</li>";
					
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
						if ($counter == $page)
							$pagination.= "<li class='active'><a class=\"current\">$counter</a></li>";
						else
							$pagination.= "<li><a href='".$targetpage.$pre_str."page=".$counter.$params."'>$counter</a></li>";
					}
				}
			}

			//next button
			
			if ($page < $counter - 1)
				$pagination.= "<li><a href='".$targetpage.$pre_str."page=".$next.$params."'>Next <i class='fa fa-angle-double-right' ></i></a></li>";
			else
				$pagination.= "<li><a class=\"disabled\">Next <i class='fa fa-angle-double-right' ></i></a></li>";
			
			$pagination.= "</ul>\n";
		}

		echo $pagination;

	}


 
function distance_haversine($lat1, $lon1, $lat2, $lon2) {
  $delta_lat = $lat2 - $lat1 ;
  $delta_lon = $lon2 - $lon1 ;
  $earth_radius = 3960.00; # in miles
  $alpha    = $delta_lat/2;
  $beta     = $delta_lon/2;
  $a        = sin(deg2rad($alpha)) * sin(deg2rad($alpha)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin(deg2rad($beta)) * sin(deg2rad($beta)) ;
  $c        = asin(min(1, sqrt($a)));
  $distance = 2*$earth_radius * $c;
  $distance = round($distance, 4);
 
  return $distance;
}
 
function get_values($p_id,$sp_id,$att_id,$counter)
{
	//echo $counter;
	$CI=&get_Instance();
	$CI->load->model("admin/admin_model");
	$result=$CI->admin_model->get_values($p_id,$sp_id,$att_id);
	$str='';
	$str.='<select name="value_array[]"   id="value_array_'.$counter.'"   class="input-xlarge text">';
	if($result)
	{
		foreach($result as $r)
		{
				$str.= "<option value=".$r['val_id'].">".$r['value_name']."</option>";
		
		}
}
	else {
				
	  $str.='<option value="0">No Value Assigned</option>';
	}
	$str.='</select>';
	echo $str;

} 


	function get_attr_pricing($qty=0,$p_id=0,$sp_id=0,$comb=""){

		$CI=&get_Instance();
		$CI->load->model("admin/common_model");
		$result=$CI->common_model->get_attr_pricing($qty,$p_id,$sp_id,$comb);
		$str="";
		foreach ($result as $row)
		{
				$str.='<td><a href="'.base_url().'cart/basket/'.$row["pricing_id"].'" class="price">'.CURRENCY.$row["price"].'</a></td>';

		}
		return  $str;

	}
	
	
	function get_credit_card() {
	
		$credit_card_list = array (
					"vis"  =>"Visa",
					"mcd"  =>"Mastercard",
					"dis" =>"Discover",
			        "amx" =>"AMEX",
				
					);
		
		return $credit_card_list;

	}
	
	
	function get_month_list() {
	
		$months = array (
					"1"  =>"01-Jan",
					"2"  =>"02-Feb",
					"3" =>"03-Mar",
			        "4" =>"04-Apr",
			        "5"  =>"05-May",
					"6"  =>"06-Jun",
					"7" =>"07-Jul",
			        "8" =>"08-Aug",
			        "9"  =>"09-Sep",
					"10"  =>"10-Oct",
					"11" =>"11-Nov",
			        "12" =>"12-Dec"	
			);
		
		return $months;

	}
	function get_date_list() {
	
		$date = array();
		for($i=1; $i<=31; $i++){
			$date[$i] = $i;	
		}
		return $date;
		

	}
	function get_year_list() {
	
		$year = array();
		for($i=2013; $i<=2030; $i++){
			$year[$i] = $i;	
		}
		return $year;
		

	}

	function is_membership_expires(){
		$CI = &get_instance();
		$user_id=($CI->session->userdata('user_id') && $CI->session->userdata('user_logged_in'))?$CI->session->userdata('user_id'):NULL;
		if($user_id)
		{
			$response=$CI->db->query("select tbl_transaction.* from tbl_users left join tbl_transaction on tbl_users.user_id=tbl_transaction.user_id where tbl_users.user_id={$user_id} AND tbl_users.user_mship_status='Active' AND ack='Success' AND timestampdiff(minute,timestamp,now())<(60*24*30) order by timestamp desc limit 1")->row_array();
			return (is_array($response) && !empty($response)) ? false : true;
		}
		else return true;
	}
	
	function get_user_plan($user_id=False)
	{
	  if($user_id)
	  {
		$CI = &get_instance();
		$response=$CI->db->query("select tbl_transaction.*, tbl_users.user_mship_id from tbl_users left join tbl_transaction on tbl_users.user_id=tbl_transaction.user_id where tbl_users.user_id={$user_id} AND tbl_users.user_mship_status='Active' AND ack='Success' AND timestampdiff(minute,timestamp,now())<(60*24*30) order by timestamp desc limit 1")->row_array();
		if(isset($response['user_mship_id']) && $response['user_mship_id']=='2')
			return 'Rookie';
		else if(isset($response['user_mship_id']) && $response['user_mship_id']=='3')
			return 'All American';
		else
			return 'Prospect Free';
	  }
	  else return 'Prospect Free';
	}

?>
