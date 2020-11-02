<?php 
$jsonFile = json_decode(file_get_contents("data.json"), true);
session_start();
if (isset($_SESSION['User'])) header("Location: https://thenewlorem.000webhostapp.com/");
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $jsonFile[4]["title"]; ?></title>
		<meta charset="utf-8">
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
		<link rel="stylesheet" media="screen" href="css/css.css">
		<link rel="stylesheet" media="screen" href="css/contact.css">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
        <meta name="google-signin-client_id" content="967580510442-4fpfl1b3u31jmkki8df96g5r9ff5rqv9.apps.googleusercontent.com">
	    <meta name="google-site-verification" content="-pYbAikNl8lYD08ythOkJN-D0f0ipkJOF9cHXtwumyY" />
	</head>
	<body>
	    <div class="navbar nav-block">
			<nav>
				<menu>
					<menuitem id="pages">
                        <img src="Fotos/menuBars2.webp" alt="Menu">
						<menu>
							<menuitem><a href=<?php echo "'".$jsonFile[4]["navbar"]["menuitem1"]["link"]."'"; ?>><?php echo $jsonFile[4]["navbar"]["menuitem1"]["name"]; ?></a></menuitem>
							<menuitem><a href=<?php echo "'".$jsonFile[4]["navbar"]["menuitem2"]["link"]."'"; ?>><?php echo $jsonFile[4]["navbar"]["menuitem2"]["name"]; ?></a></menuitem>
							<menuitem><a href=<?php echo "'".$jsonFile[4]["navbar"]["menuitem3"]["link"]."'"; ?>><?php echo $jsonFile[4]["navbar"]["menuitem3"]["name"]; ?></a></menuitem>
							<menuitem><a href=<?php echo "'".$jsonFile[4]["navbar"]["menuitem4"]["link"]."'"; ?>><?php echo $jsonFile[4]["navbar"]["menuitem4"]["name"]; ?></a></menuitem>
							<menuitem><a id="logout"href=<?php echo "'".$jsonFile[4]["navbar"]["menuitem5"]["link"]."'"; ?> onclick=<?php echo "'".$jsonFile[4]["navbar"]["menuitem5"]["action"]."'"; ?>><?php echo $jsonFile[4]["navbar"]["menuitem5"]["name"]; ?></a></menuitem>
						</menu>
					</menuitem>
				</menu>
			</nav>
			<div class="cont"><p><?php echo $jsonFile[4]["navbar"]["header"]; ?></p></div>
            <script async defer>
                
                function onSuccess(googleUser) {
                    var profile = googleUser.getBasicProfile();
                    var iname = profile.getFamilyName().split(" ");
                    var lastname = iname.pop();
                    $.post("DB_interface.php", {DB_interface:"insertuser", firstname:profile.getGivenName(), infix:iname.join(), lastname:lastname, username:profile.getEmail(), password:"", email:profile.getEmail(), google:"true", pp:profile.getImageUrl()},
			            function success(e){
			   	            console.log("Sent request to server successfully! (1)");
			    	        console.log(e);
			    	        $.post("DB_interface.php", {DB_interface:"userverification", password:"", user:profile.getEmail(), google:"true"}, 
					            function success(e) {
						            console.log("Sent request to server successfully! (2)"); 
						            console.log(e);
						            if (e.slice(0,7) == "SUCCESS") {
						                var auth2 = gapi.auth2.getAuthInstance();
                                        auth2.signOut().then(function () {
                                          console.log('Login sucessful on SQL, google logged out.');
                                        });
						                countDown(5);
						            }
					        });
	                });
                }
                function onFailure(error) {
                    console.log(error);
                }
                  function signOut() {
                    var auth2 = gapi.auth2.getAuthInstance();
                    auth2.signOut().then(function () {});
                    $.post("destroySession.php", {session:"destroy"}, 
					function success(e) {
						console.log("hi");
						console.log(e);
					});
					location.reload();
                  }
            </script>
		</div>
		<img class="img" src="Fotos/contact-1.webp" alt="Lorem Ipsum">
		<section class="formcont">
    		<form action="return false"  class="contactForm">
    		    <p class="header" style="color: white;"><?php echo $jsonFile[4]["loginform"]["header"]; ?></p>
    			<input name="user" type="text" required autocomplete="username" placeholder="Username or E-mail address"/>
    			<br/>
    			<br/>
    			<input name="password" type="password" required autocomplete="current-password" placeholder="Password"/>
    			<input type="hidden" name="DB_interface" value="userVerification"/>
    			<br/>
    			<button id="loginbutton" action="submit"><span>Login</span></button>
    			<a href="http://thenewlorem.000webhostapp.com/register">Register</a>
    		    <div id="loginButton" class="g-signin2" data-onsuccess="onSuccess" data-onfailure="onFailure" data-theme="dark"></div>
    		</form><br/>
    		<p id="timer"></p>
		</section>
		<script>
		function countDown(count){
                var timer = document.getElementById("timer");
                if(count > 0){
                    count--;
                    timer.innerHTML = "Login successful. This page will redirect in "+count+" seconds.";
                    setTimeout("countDown("+count+")", 1000);
                }else{
                    window.location.href = "http://thenewlorem.000webhostapp.com/";
                }
            }
			$("form").submit(function(event){
				event.preventDefault();
				var arr = $(this).serializeArray();
				$.post("DB_interface", {DB_interface:arr[2]["value"], user:arr[0]["value"], password:arr[1]["value"]},
					function success(e){
						console.log(e);
						if (e.slice(0,7) == "SUCCESS") countDown(5);
				});
			});
		</script>
	</body>
</html>
