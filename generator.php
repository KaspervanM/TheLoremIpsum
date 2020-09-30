<?php
    //Load website contents
	$jsonFile = json_decode(file_get_contents("data.json"), true);

	//Execute python command
	if(isset($_POST['num'])){
		$out = shell_exec('python generator.py '.$_POST['project'].' '.$_POST['num']);
	}
?>

<!DOCTYPE html>
<html>
	<head lang="la">
		<title><?php echo $jsonFile[2]["title"]; ?></title>
		<meta charset="utf-8">
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <link rel="stylesheet" media="screen" href="css/css.css">
        <link rel="stylesheet" media="screen" href="css/generator.css">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <meta name="google-signin-client_id" content="967580510442-4fpfl1b3u31jmkki8df96g5r9ff5rqv9.apps.googleusercontent.com">
	</head>
	<body>
		<div class="navbar nav-block">
			<nav>
				<menu>
					<menuitem id="pages">
                        <img src="Fotos/menuBars2.webp" alt="Menu">
						<menu>
							<menuitem><a href=<?php echo "'".$jsonFile[2]["navbar"]["menuitem1"]["link"]."'"; ?>><?php echo $jsonFile[2]["navbar"]["menuitem1"]["name"]; ?></a></menuitem>
							<menuitem><a href=<?php echo "'".$jsonFile[2]["navbar"]["menuitem2"]["link"]."'"; ?>><?php echo $jsonFile[2]["navbar"]["menuitem2"]["name"]; ?></a></menuitem>
							<menuitem><a href=<?php echo "'".$jsonFile[2]["navbar"]["menuitem3"]["link"]."'"; ?>><?php echo $jsonFile[2]["navbar"]["menuitem3"]["name"]; ?></a></menuitem>
							<menuitem><a href=<?php echo "'".$jsonFile[2]["navbar"]["menuitem4"]["link"]."'"; ?>><?php echo $jsonFile[2]["navbar"]["menuitem4"]["name"]; ?></a></menuitem>
							<menuitem><a id="logout"href=<?php echo "'".$jsonFile[2]["navbar"]["menuitem5"]["link"]."'"; ?> onclick=<?php echo "'".$jsonFile[2]["navbar"]["menuitem5"]["action"]."'"; ?>><?php echo $jsonFile[2]["navbar"]["menuitem5"]["name"]; ?></a></menuitem>
						</menu>
					</menuitem>
				</menu>
			</nav>
			<div class="cont"><p><?php echo $jsonFile[2]["navbar"]["header"]; ?></p></div>
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
		<section class="table">
			<div class="cell re">
		        <p class="header"><?php echo $jsonFile[2]["section1"]; ?>
				<form method="post" name="form" class="form1" onsubmit="$('#output').text('Your text is being generated, please be patient.');">
					<p>How many words do you want your string to be?</p><input type="number" name="num" id="numbers" required>
					<br>
					<select name="project" required>
	                    <option value="loremipsum" selected>Lorem ipsum</option>
	                </select>
					<button action="submit" id="submit" style="font-size: 12px; padding: 2px;"><span>Generate</span></button>
				</form>
			</div>
			<div class="cell"><textarea readonly class="o" id="output"><?php if(isset($_POST['num'])){echo $out;} ?></textarea></div>
		</section>
		<p class="BrOnStreroids">.</p>
		<div class="fullLoremgen-container">
			<section class="fullLoremgen">
				<div class="fullLoremgen-text">
<p class="header" style="color: white;"><?php echo $jsonFile[2]["section2"]["header1.1"]; ?></p><?php echo $jsonFile[2]["section2"]["text1"]; ?><p class="header2" style="color: white; font-size: 1.4em;"><?php echo $jsonFile[2]["section2"]["header2.1"]; ?></p><?php echo $jsonFile[2]["section2"]["text2"]; ?><p class="header2" style="color: white; font-size: 1.4em;"><?php echo $jsonFile[2]["section2"]["header2.2"]; ?></p><?php echo $jsonFile[2]["section2"]["text3"]; ?>
<br>
				</div>
			</section>
		</div>
		<section class="preFooter" id="ext-links">
			<p class="header"><?php echo $jsonFile[0]["section4"]["text"]; ?></p>
			<a href=<?php echo "\"".$jsonFile[0]["section4"]["link1"]["link"]."\" title=\"".$jsonFile[0]["section4"]["link1"]["title"]."\""; ?>><?php echo $jsonFile[0]["section4"]["link1"]["text"]; ?></a>
			<a href=<?php echo "\"".$jsonFile[0]["section4"]["link2"]["link"]."\" title=\"".$jsonFile[0]["section4"]["link2"]["title"]."\""; ?>><?php echo $jsonFile[0]["section4"]["link2"]["text"]; ?></a>
		</section>
		<footer>
			<p><?php echo $jsonFile[0]["footer"]; ?></p><p>©Esper VOF 2019</p>
		</footer>
		</body>
</html>
