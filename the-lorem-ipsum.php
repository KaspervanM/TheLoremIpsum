<?php
    //Load website contents
	$jsonFile = json_decode(file_get_contents("data.json"), true);
?>

<!DOCTYPE html>
<html>
	<head lang="la">
		<title><?php echo $jsonFile[1]["title"]; ?></title>
        <meta charset="utf-8">
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <link rel="stylesheet" media="screen" href="css/css.css">
        <link rel="stylesheet" media="screen" href="css/the-lorem-ipsum.css">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <meta name="google-signin-client_id" content="940258222686-i18bes7habu60jr3cns1hovm549hrsq3.apps.googleusercontent.com">
	</head>
	<body>
		<div class="navbar nav-block">
			<nav>
				<menu>
					<menuitem id="pages">
                        <img src="Fotos/menuBars2.webp" alt="Menu">
						<menu>
							<menuitem><a href=<?php echo "'".$jsonFile[1]["navbar"]["menuitem1"]["link"]."'"; ?>><?php echo $jsonFile[1]["navbar"]["menuitem1"]["name"]; ?></a></menuitem>
							<menuitem><a href=<?php echo "'".$jsonFile[1]["navbar"]["menuitem2"]["link"]."'"; ?>><?php echo $jsonFile[1]["navbar"]["menuitem2"]["name"]; ?></a></menuitem>
							<menuitem><a href=<?php echo "'".$jsonFile[1]["navbar"]["menuitem3"]["link"]."'"; ?>><?php echo $jsonFile[1]["navbar"]["menuitem3"]["name"]; ?></a></menuitem>
							<menuitem><a href=<?php echo "'".$jsonFile[1]["navbar"]["menuitem4"]["link"]."'"; ?>><?php echo $jsonFile[1]["navbar"]["menuitem4"]["name"]; ?></a></menuitem>
							<menuitem><a id="logout" href=<?php echo "'".$jsonFile[1]["navbar"]["menuitem5"]["link"]."'"; ?> onclick=<?php echo "'".$jsonFile[1]["navbar"]["menuitem5"]["action"]."'"; ?>><?php echo $jsonFile[1]["navbar"]["menuitem5"]["name"]; ?></a></menuitem>
						</menu>
					</menuitem>
				</menu>
			</nav>
			<div class="cont"><p><?php echo $jsonFile[1]["navbar"]["header"]; ?></p></div>
			<div class="cont_google">
    			<div class="g-signin2" data-onsuccess="onSuccess" data-onfailure="onFailure" data-theme="dark"></div>
    			<img id="profile-picture">
			</div>
            <script async defer>
                function onSuccess(googleUser) {
                    var profile = googleUser.getBasicProfile();
                    var profPic = document.getElementById("profile-picture");
                    profPic.style.visibility = "visible";
                    profPic.src = profile.getImageUrl();
                    profPic.width = "50"
                    profPic.height = "50";
                    var logOut = document.getElementById("logout");
                    logOut.style.display = "block";
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
		<div class="parallax PG"></div>
		<section class="quote-container">
			<div class="quote">
				<div class="quote-text"><?php echo $jsonFile[1]["quotetext1"]; ?></div>
			</div>
		</section>
		<div class="parallax PE1"></div>
		<section class="quote-container">
			<div class="quote">
				<div class="quote-text"><?php echo $jsonFile[1]["quotetext2"]; ?></div>
			</div>
		</section>
		<div class="parallax PK"></div>
		<section class="quote-container">
			<div class="quote">
				<div class="quote-text"><?php echo $jsonFile[1]["quotetext3"]; ?></div>
			</div>
		</section>
		<div class="parallax PE2"></div><section class="preFooter" id="ext-links">
			<p class="header"><?php echo $jsonFile[0]["section4"]["text"]; ?></p>
			<a href=<?php echo "\"".$jsonFile[0]["section4"]["link1"]["link"]."\" title=\"".$jsonFile[0]["section4"]["link1"]["title"]."\""; ?>><?php echo $jsonFile[0]["section4"]["link1"]["text"]; ?></a>
			<a href=<?php echo "\"".$jsonFile[0]["section4"]["link2"]["link"]."\" title=\"".$jsonFile[0]["section4"]["link2"]["title"]."\""; ?>><?php echo $jsonFile[0]["section4"]["link2"]["text"]; ?></a>
		</section>
		<footer>
			<p><?php echo $jsonFile[0]["footer"]; ?></p><p>©Esper VOF 2019</p>
		</footer>
	</body>
</html>
