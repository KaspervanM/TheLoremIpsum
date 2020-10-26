<?php
    //Load website contents
	$jsonFile = json_decode(file_get_contents("data.json"), true);
?>

<!DOCTYPE html>
<html>
	<head lang="la">
        <title><?php echo $jsonFile[0]["title"]; ?></title>
        <meta charset="utf-8">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <link rel="stylesheet" media="screen" href="css/css.css">
        <link rel="stylesheet" media="screen" href="css/index.css">
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
							<menuitem><a href=<?php echo "'".$jsonFile[0]["navbar"]["menuitem1"]["link"]."'"; ?>><?php echo $jsonFile[0]["navbar"]["menuitem1"]["name"]; ?></a></menuitem>
							<menuitem><a href=<?php echo "'".$jsonFile[0]["navbar"]["menuitem2"]["link"]."'"; ?>><?php echo $jsonFile[0]["navbar"]["menuitem2"]["name"]; ?></a></menuitem>
							<menuitem><a href=<?php echo "'".$jsonFile[0]["navbar"]["menuitem3"]["link"]."'"; ?>><?php echo $jsonFile[0]["navbar"]["menuitem3"]["name"]; ?></a></menuitem>
							<menuitem><a href=<?php echo "'".$jsonFile[0]["navbar"]["menuitem4"]["link"]."'"; ?>><?php echo $jsonFile[0]["navbar"]["menuitem4"]["name"]; ?></a></menuitem>
							<menuitem><a id="logout"href=<?php echo "'".$jsonFile[0]["navbar"]["menuitem5"]["link"]."'"; ?> onclick=<?php echo "'".$jsonFile[0]["navbar"]["menuitem5"]["action"]."'"; ?>><?php echo $jsonFile[0]["navbar"]["menuitem5"]["name"]; ?></a></menuitem>
						</menu>
					</menuitem>
				</menu>
			</nav>
			<div class="cont"><p><?php echo $jsonFile[0]["navbar"]["header"]; ?></p></div>
			<div class="cont_google">
    			<div class="g-signin2" data-onsuccess="onSuccess" data-onfailure="onFailure" data-theme="dark"></div>
    			<img id="profile-picture">
			</div>
            <script async defer>
                function setPic(){
                    var profPic = document.getElementById("profile-picture");
                    var dir = "/Users/".concat(<?php session_start(); if(isset($_SESSION['Email'])) echo '"'.$_SESSION['Email'].'"'; ?>).concat("/pp.jpg");
                    console.log(dir);
                    profPic.style.visibility = "visible";
                    profPic.src = dir;
                    profPic.width = "50"
                    profPic.height = "50";
                }$(document).ready(setPic());
                function onSuccess(googleUser) {
                    setPic();
                    var logOut = document.getElementById("logout");
                    logOut.style.display = "block";
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
					});
		    });
                }
                function onFailure(error) {
                    console.log(error);
                }
                  function signOut() {
                    var auth2 = gapi.auth2.getAuthInstance();
                    auth2.signOut().then(function () {
                        var profPic = document.getElementById("profile-picture");
                        profPic.style.visibility = "hidden";
                        var logOut = document.getElementById("logout");
                        logOut.style.display = "none";
                    });
                  }
            </script>
		</div>
        <img class="img" src="Fotos/lorem-ipsum.webp" alt="Lorem Ipsum">
		<p class="BrOnStreroids">.</p>
        <section class="about">
        	<div class="about-text">
        		<p class="header"><?php echo $jsonFile[0]["section1"]["header1"]; ?></p>
        		<p class="header2"><?php echo $jsonFile[0]["section1"]["header2.1"]; ?></p>
        	<?php echo $jsonFile[0]["section1"]["text1"]; ?>
        		<p class="header2"><?php echo $jsonFile[0]["section1"]["header2.2"]; ?></p>
        	<?php echo $jsonFile[0]["section1"]["text2"]; ?>
        		<p class="header2"><?php echo $jsonFile[0]["section1"]["header2.3"]; ?></p>
        	<?php echo $jsonFile[0]["section1"]["text3"]; ?>
        	</div>
        	<div class="Lorem-container">
                <img class="Lorem-ipsum" src="Fotos/lorem-ipsum21.jpg" alt="Lorem Ipsum">
        	</div>
        </section>

		<p class="BrOnStreroids">.</p>

		<div class="fullLorem-container">
			<section class="fullLorem">
				<div class="fullLorem-text">
				    <p class="header" style="color: white;"><?php echo $jsonFile[0]["section2"]["header1.1"]; ?></p><p class="header2" style="color: white; font-size: 1.4em;"><?php echo $jsonFile[0]["section2"]["header2.1"]; ?></p>
<p class="header" style="color: white;"><?php echo $jsonFile[0]["section2"]["header1.2"]; ?></p><p class="header2" style="color: white; font-size: 1.4em;"><?php echo $jsonFile[0]["section2"]["header2.2"]; ?></p>
<?php echo $jsonFile[0]["section2"]["text1"]; ?><br>
				    <p class="header" style="color: white;"><?php echo $jsonFile[0]["section2"]["header1.3"]; ?></p><p class="header2" style="color: white; font-size: 1.4em;"><?php echo $jsonFile[0]["section2"]["header2.3"]; ?></p>
<?php echo $jsonFile[0]["section2"]["text2"]; ?><br>
				    <p class="header" style="color: white;"><?php echo $jsonFile[0]["section2"]["header1.4"]; ?></p><p class="header2" style="color: white; font-size: 1.4em;"><?php echo $jsonFile[0]["section2"]["header2.4"]; ?></p>
<?php echo $jsonFile[0]["section2"]["text3"]; ?><br>
				    <p class="header" style="color: white;"><?php echo $jsonFile[0]["section2"]["header1.5"]; ?></p><p class="header2" style="color: white; font-size: 1.4em;"><?php echo $jsonFile[0]["section2"]["header2.5"]; ?></p>
<?php echo $jsonFile[0]["section2"]["text4"]; ?><br>
				    <p class="header" style="color: white;"><?php echo $jsonFile[0]["section2"]["header1.6"]; ?></p><p class="header2" style="color: white; font-size: 1.4em;"><?php echo $jsonFile[0]["section2"]["header2.6"]; ?></p>
<?php echo $jsonFile[0]["section2"]["text5"]; ?><br>
				    <p class="header" style="color: white;"><?php echo $jsonFile[0]["section2"]["header1.7"]; ?></p><p class="header2" style="color: white; font-size: 1.4em;"><?php echo $jsonFile[0]["section2"]["header2.7"]; ?></p>
<?php echo $jsonFile[0]["section2"]["text6"]; ?><br>
				    <p class="header" style="color: white;"><?php echo $jsonFile[0]["section2"]["header1.8"]; ?></p><p class="header2" style="color: white; font-size: 1.4em;"><?php echo $jsonFile[0]["section2"]["header2.8"]; ?></p>
<?php echo $jsonFile[0]["section2"]["text7"]; ?><br>
				    <p class="header" style="color: white;"><?php echo $jsonFile[0]["section2"]["header1.9"]; ?></p><p class="header2" style="color: white; font-size: 1.4em;"><?php echo $jsonFile[0]["section2"]["header2.9"]; ?></p>
<?php echo $jsonFile[0]["section2"]["text8"]; ?><br>
				    <p class="header" style="color: white;"><?php echo $jsonFile[0]["section2"]["header1.10"]; ?></p><p class="header2" style="color: white; font-size: 1.4em;"><?php echo $jsonFile[0]["section2"]["header2.10"]; ?></p>
<?php echo $jsonFile[0]["section2"]["text9"]; ?><br>
                    <p class="header" style="color: white;"><?php echo $jsonFile[0]["section2"]["header1.11"]; ?></p><?php echo $jsonFile[0]["section2"]["text10"]; ?><br>
				</div>
			</section>
		</div>
		<p class="BrOnStreroids">.</p>
		<section class="team">
				<div class="person">
                    <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="Fotos/E2.webp" alt="Evan Pacini">
					<div>
						<p class="header"><?php echo $jsonFile[0]["section3"][0]["header1"]; ?></p>
						<p class="header2" style="color: #50a7c2;"><?php echo $jsonFile[0]["section3"][0]["header2"]; ?></p>
						<p><?php echo $jsonFile[0]["section3"][0]["text"]; ?></p>
					</div>
				</div>
				<div class="person">
                    <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="Fotos/K2.webp" alt="Kasper van Maadam">
					<div>
						<p class="header"><?php echo $jsonFile[0]["section3"][1]["header1"]; ?></p>
						<p class="header2" style="color: #50a7c2;"><?php echo $jsonFile[0]["section3"][1]["header2"]; ?></p>
						<p><?php echo $jsonFile[0]["section3"][1]["text"]; ?></p>
					</div>
				</div>
		</section>
		<p class="BrOnStreroids">.</p>
		<section class="preFooter" id="ext-links">
			<p class="header"><?php echo $jsonFile[0]["section4"]["text"]; ?></p>
			<a href=<?php echo "\"".$jsonFile[0]["section4"]["link1"]["link"]."\" title=\"".$jsonFile[0]["section4"]["link1"]["title"]."\""; ?>><?php echo $jsonFile[0]["section4"]["link1"]["text"]; ?></a>
			<a href=<?php echo "\"".$jsonFile[0]["section4"]["link2"]["link"]."\" title=\"".$jsonFile[0]["section4"]["link2"]["title"]."\""; ?>><?php echo $jsonFile[0]["section4"]["link2"]["text"]; ?></a>
		</section>
		<footer>
			<p><?php echo $jsonFile[0]["footer"]; ?></p><p>©Esper VOF 2019</p>
		</footer>
		<script async>
		    //Load images and videos only after this script was loaded
		    var youtube = document.getElementsByClassName("youtube")[0];
    		var image = new Image();
			image.setAttribute('src','Fotos/loremsong.webp');
			image.addEventListener( "load", function() {
				youtube.appendChild( image );
			}( i ) );
			youtube.addEventListener( "click", function() {

				var iframe = document.createElement( "iframe" );
				iframe.setAttribute( "frameborder", "0" );
				iframe.setAttribute( "allowfullscreen", "" );
				iframe.setAttribute( "src", "https://www.youtube.com/embed/"+ this.dataset.embed +"?rel=0&showinfo=0&autoplay=1" );
				iframe.setAttribute("allow","accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture");
				this.innerHTML = "";
				this.appendChild( iframe );
			} );
	    var imgDefer = document.getElementsByTagName('img');
        for (var i=0; i<imgDefer.length; i++) {
            if(imgDefer[i].getAttribute('data-src')) {
                imgDefer[i].setAttribute('src',imgDefer[i].getAttribute('data-src'));
            }
        }
      $.getScript('https://cdn.jsdelivr.net/npm/simple-parallax-js@5.0.2/dist/simpleParallax.min.js', function()
        {
            //Create parallax effect
			var image = document.getElementsByClassName('Lorem-ipsum');
			new simpleParallax(image, {
				orientation: 	'down',
				scale: 2,
				delay: 0,
				transition: 'linear'
			});
        });

			function offset(el) {
		    var rect = el.getBoundingClientRect();
		    scrollBottom = window.pageYOffset || document.documentElement.scrollBottom;
		    scrollTop = window.pageYOffset || document.documentElement.scrollTop;
		    return { top: rect.top + scrollTop, bottom: rect.bottom + scrollBottom };
			}

            //Dynamic navbar
			$(window).on("scroll load", function(){
				if($(window).scrollTop() <= $('.img').height()/4){
					$('.nav-block').hide();
					$('.navbar').removeClass( "nav-block" ).addClass( "nav-img" );
					$('.navbar').fadeIn();
				}else{
					$('.nav-img').hide();
					$('.navbar').removeClass( "nav-img" ).addClass( "nav-block" );
					$('.navbar').fadeIn();
				}

				var element1 = document.querySelector(".about-text");
				var element2 = document.querySelector(".Lorem-container");
				var rect1 = offset(element1);
				var rect2 = offset(element2);
				if(rect1.bottom <= rect2.top){
					element1.style.width = "100%";
					if($(window).width()*0.8 >= 1000){
					    element1.style.width = "50%";
					}
				}
			});
            //Resize team pictures to squares
			$(window).on("resize load", function(){
				$(".person img").height($(".person img").width());
			});

		</script>
	</body>
</html>
