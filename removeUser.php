<!DOCTYPE html>
<html>
	<head>
		<title>Remove User</title>
		<meta charset="utf-8">
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
		<link rel="stylesheet" media="screen" href="css/css.css">
		<link rel="stylesheet" media="screen" href="css/contact.css">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		<meta name="google-signin-client_id" content="967580510442-4fpfl1b3u31jmkki8df96g5r9ff5rqv9.apps.googleusercontent.com">
	</head>
	<body>
		<form action="return false">
			<input name="user" type="text" required placeholder="Username or E-mail address"/>
			<input type="hidden" name="DB_interface" value="removeUser"/>
			<br/>
			<button action="submit"><span>Remove</span></button>
		</form><br/>
		<p id="output"></p>
		<script>
		    var output = document.getElementById("output");
			$("form").submit(function(event){
				event.preventDefault();
				var arr = $(this).serializeArray();
				console.log(arr);
				$.post("DB_interface", {DB_interface:arr[1]["value"], user:arr[0]["value"]},
					function success(e){
						console.log(e);
						output.innerHTML = e;
				});
			});
		</script>
	</body>
</html>
