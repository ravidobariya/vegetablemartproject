$(document).ready(function(){
	jQuery("#contact").submit(function(){
		alert("submit Preseed");
		var data = {
		fname : $('fname').val(),
		lname : $('lname').val(),
		email : $('email').val(),
		comments : $('comments').val()
		}
		alert("hello");
		$.get('../contact.php',data,function response(data,status){
			$('#message').html("entered");
			if(data=='success')
				$('#message').html("Request Processed Successfully, we will contact you soon.");
			else
				$('#message').html("Sorry we can not process your request now, Please try again letter.");
		});
		return false;
		)};
});