jQuery("document").ready(function(){
/*	var validate = true;
	if(isNaN($(#fname).value()) || isNaN($(#lname).value()) || isNaN($(#email).value()) || isNaN($(#comments).value()))
	{
		validate = false;
	}*/
	$("#contact").submit(function(){
			$.ajax({url:"../contact.php",data : {
			fname:$("#fname").val(),
			lname:$("#lname").val(),
			email:$("#email").val(),
			comments:$("#comments").val()
			},
			type : "post"
			})
			alert("hi");
			.done(function(data){
			alert("I am in done");
			$("#message").html(data);
			});
			return(false);
		}
		else
		{
			$("#message").html("Please Enter Valid input");
		}
	});	
});