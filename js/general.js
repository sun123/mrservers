 var UserManager ={
 
 validateUserForm : function(){
 
	$("#email").blur(function() { //alert('kjlkj');

			var email = $(this).val();

			if ( email == "" ) {
				return false;
			}

			$('#email').data('isValid', false);

			var id = $('#user_id').val();
		//	alert(id);


			if($('#user_id').val() != ""){
			
				var id = $('#user_id').val();

			}else{

				 id = 0;

			}
		
			
			UserManager.isCustomerEmailExists(email, id);
	
		});
 
 
 
 },
 
 	isCustomerEmailExists : function(email, id ) {
			var params = "email="+email+"&user_id="+id;

			$.post(base_url + "users/check_email_exists", params, function(data) {
				
				if (data == 1) { //alert('no');
					if ( $("#email").parent().find('label[for="email"].errorLabel').length == 0 ) {
						$("#email").after('<label class="errorLabel" for="email">E-mail already exists!</label>');
						$('#email').select();
					}
					
				}
				else { //alert('yes');
					// $("#p_email").parent().find('label[for="email"]').remove();
					// $('#p_email').data('isValid', true);
					document.form.submit();
				}

			});
	},
 
 
 
  fetchStates : function() { 
	
		$("#country").change(function(){
			var val=$('#country').val();
		if(val!="") {
			var cntry_code = this.value;
//alert(cntry_code);
			$.ajax({
			
				type : "post",
				url : base_url+"users/fetch_states",
				data : "cntry_code="+cntry_code,

				success:function(msg){
				
					if(msg != ''){
						
						$("#state").html(msg);

					}
				
				}

			});
			}
			else 
			{
						$("#state").html("<option value=''>Select State</option>");
			
			}


		
		});
		
	
	
	
	},
	
	validatePassword : function(){
	
	$('#chng_pass').validate({
	
	rules:{
	
	conf_pass:{
	equalTo:new_pass,
	},

	},
	
	submitHandler: function(form) {
	
		var old_pass=$("#old_pass").val();
		var new_pass=$("#new_pass").val();
		UserManager.doChngPass(old_pass, new_pass);
	}
	});
	
	},
	
	doChngPass : function(old_pass, new_pass) {
	
		//alert(old_pass);
		var params="oldpass="+old_pass+"&newpass="+new_pass;
			
		var url=base_url+"users/changepass";
			
		$.post(url,params,function(msg){ //alert(msg);
		
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
			//location.href=base_url+"/users/change_user_pass";
		}
		
			
			
			});

		return false
	
	
	},
 
 
 
 }
 
 
 