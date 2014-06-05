<?php
/**
*	Query Ananlyzer for codeigniter
*	Version 1.0
*/
	ob_start();
	session_start();
	
	@$db = mysql_connect("localhost","root","sunsoft");
	// if(! $db){
		// echo "<b>Error1</b> : ".mysql_error(); die();
	// }
	
	@$dbn = mysql_select_db("db_mrserver", $db);
	// if(! $dbn){
		// echo "<b>Error</b> : ".mysql_error(); die();
	// }
	$language = get_cookie('language');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>QUERY ANALYZER</title>
<style type="text/css">
	body{color:#2F2F2F;width:100%;margin:0px;background-color:#f8f8f8;color:#4D4D4D;}
		#forum{width:900px;margin:30px auto;padding:20px;border:1px solid #AfAfAf;background-color:#efefef;}
		#buttons{float:left;padding:5px;border:1px solid #d8d8d8;background-color:#e8e8e8;}
		
		.firstTD{vertical-align:top;padding-left:10px;width:18%;text-align:left;}
		.secondTD{vertical-align:top;width:7%;}
		.thirdTD{vertical-align:top;width:33%;text-align:left;}
		.required{height:20px;width:280px;}
		.error{width:300px;}
		.SQLerror{color:red;}
		.prows{margin-top:0px;margin-bottom:0px;}
		
		#main_box{border:0px solid #d8d8d8;background-color:#efefef;padding:15px 20px;margin:20px auto;width:900px;}
		#box2{border:1px solid #d8d8d8;background-color:#efefef;padding:5px 5px;margin:20px auto;width:900px;}
		
	#Tarea{max-width:500px;min-width:400px;max-height:200px;min-height:150px;}
		#input_query{width:900px;margin:5px auto;color:#000080;}
		#label_query{color:green;font-weight:bold;}
		#continue{background-color:#ff2626;color:#e8e8e8;padding:7px 15px;font-size:14px;border:none;}
		#continue:hover{background-color:#d80000;cursor:pointer;}
		.submit{width:110px;}
	</style>
	<SCRIPT type="text/javascript">
		function Verify()
		{	
			if(frmQuery.query.value=="")
			{
				alert("Enter The Query");
				frmQuery.query.focus();
				return false;
			}
			return true;
		}
		
		function submitValue(n){
		alert(n);
			document.getElementById('predefined').value = n;
			return true;
		}
	</SCRIPT>
</head>

<body>
	<div id="forum">
	
	<table id="main_box" align="center" border=0 >
	<marquee behavior="alternate" scrollamount="3"><b><u><font color="navy">MY QUERY ANALYZER</font></u></b></marquee>
		
		<tr bgColor="#CCCCFF">		
		<?php
/* pre defined queries START */
if(isset($_POST['predefined']))
{
	if(isset($_POST['showTables'])){
		$_POST['query'] = "Show tables;";
	}
	if(isset($_POST['selectAll'])){
		$tn = $_POST['tablename'];
		$_POST['query'] = "Select * FROM $tn ;";
	}
	if(isset($_POST['descTable'])){
		$tn = $_POST['tablename'];
		$_POST['query'] = "DESC $tn ;";
	}
	if(isset($_POST['emptyTable'])){
		$tn = $_POST['tablename'];
		$_POST['query'] = "TRUNCATE TABLE $tn ;";
	}
	if(isset($_POST['dropTable'])){
		$tn = $_POST['tablename'];
		$_POST['query'] = "DROP TABLE $tn ;";
	}
	
	
		$query=stripslashes(trim($_POST['query']));
		echo "<div id='input_query'><span id='label_query'>Your Query Was : </span>". $query ."</div>";
		$result=mysql_query($query);
		// echo "$result";
		$numFields = 0;
		
	if(mysql_errno()) //if there is an error in sql query(result=0)
		{
		?>
			<tr bgColor=#CCCCCC>
				<td colspan="<?php echo $numFields; ?>" class="SQLerror" align="left">ERROR:<?php echo mysql_error(); ?></td>
			</tr>
		<?php  } elseif($result!=1 && mysql_affected_rows())
		{	
			$numFields=mysql_num_fields($result);
			$numRows=mysql_num_rows($result);
			
			while(($field=mysql_fetch_field($result)))
			{
			?>
				<td><? echo $field->name ;?></td>	
		<?php }
			?>
			</tr>
			<?php		
			while(($row = mysql_fetch_row($result)))
			{
				?>
				<tr bgColor="#FFCC99"><?php
				for($i=0;$i<$numFields;$i++)	
				{?>				
				<td><?php echo $row[$i]; ?></td><?php
				}?>
				</tr>
				<?php
			} //close while	
		} //close if of resultset
		?>
		<tr bgColor=#CCCCFF>
		<td colspan="<?php echo $numFields; ?>" align="left"><b><font color="Navy" size="3">Total Rows:<?php echo mysql_affected_rows();?></font></b></td>
		</tr>
<?php $_POST['query'] = '';} 
/* pre defined queries END */
			if(isset($_POST['query'])&& strlen(trim($_POST['query']))>0)
			{
				$numFields = 0;
				$query=stripslashes(trim($_POST['query']));
				echo "<div id='input_query'><span id='label_query'>Your Query Was : </span>". $query ."</div>";
				$result=mysql_query($query);
				
				if($result && mysql_affected_rows())
				{	
					$numFields=mysql_num_fields($result);
					$numRows=mysql_num_rows($result);
					
					while(($field=mysql_fetch_field($result)))
					{
					?>
						<td><? echo $field->name ;?></td>	
				<?php }
					?>
					</tr>
					<?php		
					while(($row = mysql_fetch_row($result)))
					{
						?>
						<tr bgColor="#FFCC99"><?php
						for($i=0;$i<$numFields;$i++)	
						{?>				
						<td><?php echo $row[$i]; ?></td><?php
						}?>
						</tr>
						<?php
					} //close while	
				} //close if of resultset
				if(mysql_errno()) //if there is an error in sql query(result=0)
				{
				?>
					<tr bgColor=#CCCCCC>
						<td colspan="<?php echo $numFields; ?>" class="SQLerror" align="left">ERROR:<?php echo mysql_error(); ?></td>
					</tr>
				<?php  
				}
				?>
				<tr bgColor=#CCCCFF>
				<td colspan="<?php echo $numFields; ?>" align="left"><b><font color="Navy" size="3">Total Rows : <?php echo mysql_affected_rows();?></font></b></td>
				</tr>
	  <?php }
		else
		{ 
			$numFields = 1;
		}
		?>
	</table>
	<table id="box2">
		<tr>
			<td width="40%" style="vertical-align:top;">
				<div id="buttons">
				<?php //show different buttons for sql actions ?>
				<?php // 1. show tables form ?>
				
				<p class="prows"><form name="frmQuery" action="<?php echo base_url();?>index.php/<?php echo $language; ?>/query/analyzer" method="POST">
					<input type="hidden" value="1" name="predefined" />
					<input type="submit" value="Show Tables" name="showTables"/>
				</form></p>
				<?php // 2. show all data from a table/ operations on a table ?>
				<p class="prows"><form name="frmQuery" action="<?php echo base_url();?>index.php/<?php echo $language; ?>/query/analyzer" method="POST">
					<label>Table name: </label><input type="text" name="tablename" style="width:110px;" />
					<input type="hidden" value="1" name="predefined" /><br/>
					<input type="submit" value="Select All" name="selectAll"  class="submit"/>
					<input type="submit" value="Desc Table" name="descTable"  class="submit"/>
					<input type="submit" value="Empty Table" name="emptyTable"  class="submit"/>
					<input type="submit" value="Drop Table" name="dropTable"  class="submit"/>
				</form></p>
				<?php // 3. Describe table structure ?>
				<!--<p class="prows"><form name="frmQuery" action="<?php echo base_url();?>index.php/query/analyzer" method="POST">
					<label>Table name: </label><input type="text" name="tablename" style="width:110px;" />
					<input type="hidden" value="1" name="predefined" />
					<input type="submit" value="Desc Table" name="descTable"  class="submit"/>
				</form></p>
				<?php // 4. Empty table ?>
				<p class="prows"><form name="frmQuery" action="<?php echo base_url();?>index.php/query/analyzer" method="POST">
					<label>Table name: </label><input type="text" name="tablename" style="width:110px;" />
					<input type="hidden" value="1" name="predefined" />
					<input type="submit" value="Empty Table" name="emptyTable"  class="submit"/>
				</form></p>
				<?php // 5. Empty table ?>
				<p class="prows"><form name="frmQuery" action="<?php echo base_url();?>index.php/query/analyzer" method="POST">
					<label>Table name: </label><input type="text" name="tablename" style="width:110px;" />
					<input type="hidden" value="1" name="predefined" />
					<input type="submit" value="Drop Table" name="dropTable"  class="submit"/>
				</form></p>-->
				<?php //show different buttons for sql actions ENDS here ?>
				</div>
			</td>
			
			<td width="60%">
				<table>
					<tr>
						<th><b>PLEASE SUBMIT YOUR QUERY......</b></th>
					</tr>
					<tr>
						<td align="center" colspan="<? echo $numFields; ?>">
						<form name="frmQuery" action="<?php echo base_url();?>index.php/<?php echo $language; ?>/query/analyzer" method="POST" onSubmit="return Verify()">
						<table  align="center" border=0>
						<tr>
						<td  align="left">
						<textarea id="Tarea" name="query" rows="4" cols="100"></textarea>
						</td>
						</tr>
						<tr>
						<td align="center"><input type="submit" id="continue" value="Submit"></td>
						</tr>
						</table>
						</form>
						</td>
					</tr>
				</table>
			</td>
		<!--<td colspan="<?php //echo $numFields; ?>"></td>-->
		</tr>
	</table>
	</div>
</body>
</html>
