<?php
	
	function debug($var, $kill = false) {
		echo '<div style="clear:both;"></div><pre style="background-color:#FFAD2F;color:#000;padding:20px;">';print_r($var);echo '</pre>';
		if ($kill === true) {
			exit;
		}
	}


?>