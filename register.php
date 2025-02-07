<?php 
$jsonFile = json_decode(file_get_contents("data.json"), true);
session_start();
if (isset($_SESSION['id'])) header("Location: https://thenewlorem.000webhostapp.com/");
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $jsonFile[5]["title"]; ?></title>
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
							<menuitem><a href=<?php echo "'".$jsonFile[5]["navbar"]["menuitem1"]["link"]."'"; ?>><?php echo $jsonFile[5]["navbar"]["menuitem1"]["name"]; ?></a></menuitem>
							<menuitem><a href=<?php echo "'".$jsonFile[5]["navbar"]["menuitem2"]["link"]."'"; ?>><?php echo $jsonFile[5]["navbar"]["menuitem2"]["name"]; ?></a></menuitem>
							<menuitem><a href=<?php echo "'".$jsonFile[5]["navbar"]["menuitem3"]["link"]."'"; ?>><?php echo $jsonFile[5]["navbar"]["menuitem3"]["name"]; ?></a></menuitem>
							<menuitem><a href=<?php echo "'".$jsonFile[5]["navbar"]["menuitem4"]["link"]."'"; ?>><?php echo $jsonFile[5]["navbar"]["menuitem4"]["name"]; ?></a></menuitem>
							<menuitem><a id="logout"href=<?php echo "'".$jsonFile[5]["navbar"]["menuitem5"]["link"]."'"; ?> onclick=<?php echo "'".$jsonFile[5]["navbar"]["menuitem5"]["action"]."'"; ?>><?php echo $jsonFile[5]["navbar"]["menuitem5"]["name"]; ?></a></menuitem>
						</menu>
					</menuitem>
				</menu>
			</nav>
			<div class="cont"><p><?php echo $jsonFile[5]["navbar"]["header"]; ?></p></div>
            <script async defer>
                
                function onSuccess(googleUser) {
                    var profile = googleUser.getBasicProfile();
                    var auth2 = gapi.auth2.getAuthInstance();
                    auth2.signOut();
                    var iname = profile.getFamilyName().split(" ");
                    var lastname = iname.pop();
                    $.post("DB_interface.php", {DB_interface:"insertuser", firstname:profile.getGivenName(), infix:iname.join(), lastname:lastname, username:profile.getEmail(), password:"", email:profile.getEmail(), google:"true", pp:profile.getImageUrl()},
			            function success(e){
			    	        $.post("DB_interface.php", {DB_interface:"userverification", password:"", user:profile.getEmail(), google:"true"}, 
					            function success(e) {
						            if (e.slice(0,7) == "SUCCESS") {
						                countDown(5);
						            } else if (e.slice(0,8) == "STOPNOTE") $('#timer').text(e.slice(10));
						            else if (e.slice(0,5) == "ERROR") $('#timer').text(e);
					        });
	                });
                }
                function onFailure(error) {
                    console.log(error);
                }
                  function signOut() {
                    var auth2 = gapi.auth2.getAuthInstance();
                    auth2.signOut();
                    $.post("destroySession.php", {session:"destroy"}, function success(e) {;;});
					location.reload();
                  }
            </script>
		</div>
		<img class="img" src="Fotos/contact-1.webp" alt="Lorem Ipsum">
		<section class="formcont">
    		<form action="return false"  class="contactForm">
    		    <p class="header" style="color: white;"><?php echo $jsonFile[5]["loginform"]["header"]; ?></p>
    			<input name="firstname" id="firstname" type="text" required autocomplete="given-name" placeholder="Name"/> <input name="infix" id="infix" type="text" size="3" value="" autocomplete="additional-name" placeholder="infix"/> <input name="lastname" id="lastname" type="text" required autocomplete="family-name" placeholder="Surname"/>
    			<br/>
    			<br/>
    			<input name="username" type="text" pattern="^[a-zA-Z0-9]*$" required autocomplete="username" placeholder="Username"/>
    			<br/>
    			<br/>
    			<input name="password" type="password" required autocomplete="new-password" placeholder="Password"/>
    			<br/>
    			<br/>
    			<input name="email" id="email" type="email" required placeholder="E-mail address"/>
    			<input type="hidden" name="DB_interface" value="insertUser"/>
    			<br/>
    			<button action="submit"><span>Register</span></button>
    			<div id="loginButton" class="g-signin2" data-onsuccess="onSuccess" data-onfailure="onFailure" data-theme="dark"></div>
    	    	<p id="timer"></p>
    		</form><br/>
		</section>
		<script>
		    function countDown(count){
                var timer = document.getElementById("timer");
                if(count > 0){
                    count--;
                    timer.innerHTML = "Account registered successfully. This page will redirect in "+count+" seconds.";
                    setTimeout("countDown("+count+")", 1000);
                }else{
                    window.location.href = "http://thenewlorem.000webhostapp.com/login";
                }
            }
			$("form").submit(function(event){
				event.preventDefault();
				var arr = $(this).serializeArray();
				$.post("DB_interface", {DB_interface:arr[6]["value"], firstname:arr[0]["value"], infix:arr[1]["value"], lastname:arr[2]["value"], username:arr[3]["value"], password:arr[4]["value"], email:arr[5]["value"]},
					function success(e){
						if (e.slice(0,7) == "SUCCESS") countDown(5);
						else if (e.slice(0,8) == "STOPNOTE") $('#timer').text(e.slice(10));
						else if (e.slice(0,5) == "ERROR") $('#timer').text(e);
				});
			});
		</script>
		<footer>
			<p><?php echo $jsonFile[0]["footer"]; ?></p><p>©Esper VOF 2020</p>
		</footer>
	</body>
</html>

