<?php
    //Load website contents
	$jsonFile = json_decode(file_get_contents("data.json"), true);
?>

<!DOCTYPE html>
<html>
	<head lang="la">
		<title><?php echo $jsonFile[1]["title"]; ?></title>
        <meta charset="utf-8">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <link rel="stylesheet" media="screen" href="css/css.css">
        <link rel="stylesheet" media="screen" href="css/the-lorem-ipsum.css">
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
			<div class="nav_box">
			    <button class="loginButton" onclick="window.location.href = 'http://thenewlorem.000webhostapp.com/login';">Login</button>
    			<img id="profile-picture">
    			<button id="changePic" onclick="window.location.href = 'http://thenewlorem.000webhostapp.com/profilePic';">Change profile pic</button>
			</div>
            <script async defer>
                function setPic(){
                    var profPic = document.getElementById("profile-picture");
                    var dir = " <?php session_start(); if(isset($_SESSION['Email'])) { $dir = "Users/".$_SESSION["Email"]."/"; if (file_exists($dir . "pp.jpg")) {echo $dir . "pp.jpg";} else {echo "Users/Default/pp.jpg";} echo "?".rand(0,10000000);} ?>";
                    console.log(dir);
                    profPic.style.visibility = "visible";
                    profPic.src = dir;
                }
                function start(){
                    <?php if(isset($SESSION['reload'])) {unset($SESSION['reload']); echo "location.reload(true);";} ?>
                    if(<?php session_start(); if(isset($_SESSION['Email'])) echo 'true'; else echo "false"; ?>) {
                        $(".nav_box").addClass('nav_box_logged-in')
                        $("#changePic").css("display","block");
                        $("#logout").css("display","block");
                        $(".loginButton").css("display","none");
                        setPic();
                    }else{
                        $(".loginButton").css("display","block");
                    }
                }
                $(document).ready(start());
                  function signOut() {
                    $.post("destroySession.php", {session:"destroy"}, 
					function success(e) {
						console.log(e);
					});
					location.reload();
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
