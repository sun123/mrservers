<link rel="stylesheet" type="text/css" href="css/jquery.tooltip.css" />
<script src="js/lib/jquery.bgiframe.js" type="text/javascript"></script>
<script src="js/jquery.tooltip.js" type="text/javascript"></script>

<script type="text/javascript">
<!--
	$(document).ready(function() {
		

	});
//-->
</script>

<!--contant start-->
	<div class="containerBox">
		
		<h1>Site Settings</h1>
		<div class="submenus">
			<span><a href="<?php echo base_url();?>admin/admin/change_password">Change Password</a></span>
		</div>
		<div id="message_container">
		<?php
			if ( $this->session->userdata("success_message")) { 
				echo $this->session->userdata("success_message"); 
				$this->session->unset_userdata("success_message");
			}
		?>
		</div>
		<form action="<?php echo base_url();?>admin/site_settings/save_settings" method="post">
			<table width="100%">

				<?php 

						foreach ($site_settings as $setting) { //debug($setting);



									$str = ucfirst(str_replace("_"," ",$setting->setting_name));

					?>

					<tr>

						<td class="top" align="right">

								<span title="<?php echo $setting->setting_description; ?>"><?php echo $str; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>

						</td>

						<td>
						
						<?php if($setting->setting_id == 3){ ?>
						
								<select  class=" top setting" name="setting_<?php echo $setting->setting_id; ?>" id="setting_<?php echo $setting->setting_id; ?>" style="width:92px;">

										<option value="live" <?php if($setting->setting_value == 'live'){ echo "selected";} ?>>Live </option>

										<option value="sandbox" <?php if($setting->setting_value == 'sandbox'){ echo "selected";} ?>>Test</option>

								</select>

						<?php } else if($setting->setting_id == 7){ ?>
						
								<select  class=" top setting" name="setting_<?php echo $setting->setting_id; ?>" id="setting_<?php echo $setting->setting_id; ?>" style="width:92px;">

										<option value="Open" <?php if($setting->setting_value == 'Open'){ echo "selected";} ?>>Open </option>

										<option value="Close" <?php if($setting->setting_value == 'Close'){ echo "selected";} ?>>Close</option>

								</select>

						<?php } else { ?>

						<input type="text" name="setting_<?php echo $setting->setting_id; ?>"  class="inputInfoIn setting" value="<?php echo $setting->setting_value; ?>"/>

						<?php } ?>



						</td>

					</tr>

					<tr>

						<td>&nbsp;</td>

						<td>&nbsp;</td>

						<td>&nbsp;</td>

					</tr>

				<?php	} ?>

				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="left"><input type="image" id="save_settings" src="<?php echo base_url();?>images/admin/submit.png"></td>
				</tr>

			</table>
		</form>


	</div>
	<!--contant end-->
</div>
