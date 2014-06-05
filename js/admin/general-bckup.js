function validation(){
	$("#login_button").validate({
	rules: {
		username: {required:true},
		password: {required: true}
	},
	submitHandler: function(form) {
	//alert("a");
	var username=$("#username").val();	
	var password=$("#password").val();

	ajax_mail(username,password);
	}
	});
}
function ajax_mail(username,password)
{
//alert(base_url);
  url=base_url+"admin/admin/check_user";
  $.ajax({
     type: "POST",
	 url: url,
	 data: "username="+username+"&password="+password,
	 success: function(msg)
	 {
	// alert(msg);
	 
	if(msg==1)
	{
	//alert("hi");
			location.href=base_url+"admin/welcome/home";
			//document.l_form.submit();
	}
	else
	{
				 alert('username and password is Incorrect.');
				// $('#username').select();
	}
	}
	});
}

function chngPass(e){

 e.preventDefault();

		var old_pass=$("#old_id").val();
		var new_pass=$("#new_id").val();
		var con_pass=$("#con_id").val();
		
		
			var errorMsg="";
		
		if($.trim(old_pass)=="")
		{
		errorMsg+="Please Enter Old Password!!!</br>";
		}
		
		if($.trim(new_pass)=="")
		{
		errorMsg+="Please Enter New Password!!!</br>";
		}
		
		if($.trim(con_pass)=="")
		{
		errorMsg+="Please Re-Enter New Password!!!</br> ";
		}
		else if(new_pass!=con_pass){
		
		errorMsg+="Password Do Not Match!!!</br>";
		}
		
		if(errorMsg!="")
		{
			$("#errormsg").html(errorMsg);
			return false;
		}
		
			var params="oldpass="+old_pass+"&newpass="+new_pass;
			
			var url=base_url+"admin/changepass";
			
			$.post(url,params,function(msg){
			
				
		//alert(msg);
		
		if(msg==0)
		{
			$("#errormsg").html("Old Password Is Incorrect!!!");
		}
		if(msg == 1)
		{
		    $("#errormsg").html("Password has been Changed!!!");
		}
		if(msg==2)
		{
			$("#errormsg").html("Error changing password. Please try later!!!");
		}
		
			
			
			});

		return false

}



/**
 * Function to change status of records 
 *
*/
function changeStatus(table, column, value, uniqueNameCol, uniqueColValue)
{
	//alert(value);

	$.ajax({
		type: "POST",
		url: base_url+"admin/page/change_status",
		data: "table="+table+"&column="+column+"&value="+value+"&uniqueNameCol="+uniqueNameCol+"&uniqueColValue="+uniqueColValue,
		async: true,
        success: function(msg)
        { 
		//alert(msg);
			window.location.reload();
		},
		error: function(jqXHR, textStatus, errorThrown)
		{
			//alert(errorThrown);
			alert("Error occured. Please try again later.");
		}
	 });	
	
}

