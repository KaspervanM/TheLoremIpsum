<?php
    //Load website contents
	$jsonFile = json_decode(file_get_contents("data.json"), true);
	if (isset($_POST["subject"])){
	    ini_set('SMTP', 'smtp.gmail.com');
	    ini_set('smtp_port', '587');
	    ini_set('auth_username', 'anon.bg.anon@gmail.com');
	    ini_set('auth_password', 'Haha1234!');
	    ini_set('sendmail_from', 'anon.bg.anon@gmail.com');
	    $infix = " ";
	    if($_POST["Iname"] != ""){
	        $infix = " ".$_POST["Iname"]." ";
	    }
	    $name = $_POST["Fname"].$infix.$_POST["Sname"];
	    $r = mail("dumpmail2003@gmail.com",$_POST["subject"]." - The Lorem Ipsum",$_POST["message"]."\n\n-".$name."\n".$_POST["returnMail"]);
	}
?>

<!DOCTYPE html>
<html>
	<head lang="la">
		<title><?php echo $jsonFile[3]["title"]; ?></title>
		<meta charset="utf-8">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
        <link rel="stylesheet" media="screen" href="css/css.css">
        <link rel="stylesheet" media="screen" href="css/contact.css">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
	</head>
	<body>
		<div class="navbar nav-block">
			<nav>
				<menu>
					<menuitem id="pages">
                        <img src="Fotos/menuBars2.webp" alt="Menu">
						<menu>
							<menuitem><a href=<?php echo "'".$jsonFile[3]["navbar"]["menuitem1"]["link"]."'"; ?>><?php echo $jsonFile[3]["navbar"]["menuitem1"]["name"]; ?></a></menuitem>
							<menuitem><a href=<?php echo "'".$jsonFile[3]["navbar"]["menuitem2"]["link"]."'"; ?>><?php echo $jsonFile[3]["navbar"]["menuitem2"]["name"]; ?></a></menuitem>
							<menuitem><a href=<?php echo "'".$jsonFile[3]["navbar"]["menuitem3"]["link"]."'"; ?>><?php echo $jsonFile[3]["navbar"]["menuitem3"]["name"]; ?></a></menuitem>
							<menuitem><a id="logout"href=<?php echo "'".$jsonFile[3]["navbar"]["menuitem4"]["link"]."'"; ?> onclick=<?php echo "'".$jsonFile[3]["navbar"]["menuitem4"]["action"]."'"; ?>><?php echo $jsonFile[3]["navbar"]["menuitem4"]["name"]; ?></a></menuitem>
						</menu>
					</menuitem>
				</menu>
			</nav>
			<div class="cont"><p><?php echo $jsonFile[3]["navbar"]["header"]; ?></p></div>
			<div class="nav_box">
			    <button class="loginButton" onclick="window.location.href = 'http://thenewlorem.000webhostapp.com/login';">Login</button>
    			<img id="profile-picture">
    			<button id="changePic" onclick="window.location.href = 'http://thenewlorem.000webhostapp.com/profilePic';">Change profile pic</button>
			</div>
			<script async defer>
                function setPic(){
                    var profPic = document.getElementById("profile-picture");
                    var dir = " <?php session_start(); if(isset($_SESSION['Email'])) { $dir = "Users/".$_SESSION["id"]."/"; if (file_exists($dir . "pp.jpg")) {echo $dir . "pp.jpg";} else {echo "Users/Default/pp.jpg";} echo "?".rand(0,10000000);} ?>";
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
                        $.post("DB_interface.php", {DB_interface:"getuserdata", user: <?php echo '"'.$_SESSION['User'].'"'; ?>, select:"firstname, infix, lastname, email"}, 
    					function success(e) {
    					    p = JSON.parse(e);
    						console.log(p);
    						var fname = document.getElementById('Fname');
    						var Iname = document.getElementById('Iname');
    						var Sname = document.getElementById('Sname');
    						var returnMail = document.getElementById('returnMail');
    						fname.value = p.firstname;
    						Iname.value = p.infix;
    						Sname.value = p.lastname;
    						returnMail.value = p.email;
    					});
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
        <img class="img" src="Fotos/contact-1.webp" alt="Lorem Ipsum">
		<section class="formcont">
    		<form method="post" class="contactForm">
		        <p class="header" style="color: white;"><?php echo $jsonFile[3]["contactform"]["header"]; ?></p>
    		    <input name="Fname" id="Fname" type="text" required placeholder="Name"/> <input name="Iname" id="Iname" type="text" size="3" placeholder="infix"/> <input name="Sname" id="Sname" type="text" required placeholder="Surname"/>
    		    <br>
    		    <br>
    		    <input name="returnMail" id="returnMail" type="text" required placeholder="E-mail address"/>
    		    <br>
    		    <br>
    		    <input name="subject" type="text" required placeholder="Subject"/>
    		    <br>
    		    <br>
    		    <textarea style="width:100%; height:150px; resize: none;" name="message" required placeholder="Message"></textarea>
    		    <br>
    		    <button action="submit"><span>Send</span></button>
    	        <?php if (isset($r)) {if (!$r){
    	        echo '<span class="failure"><span style="font-size:2em;">😭</span><br>Oh no, somethin went wrong, the message was sent unsuccessfully.<br>Please check your internet connection or try again later.</span>';} else {
    	        echo '<span class="success"><span style="font-size:2em;">😀</span><br>The message was sent successfully!</span>';}} ?>
    		</form>
		</section>
		<br>
		<section class="imgEnlarge">
		    <p class="header"><?php echo $jsonFile[3]["images"]["header"]; ?></p>
		    <div class="imgEnlargeCont">
                <img class="eImg" src="Fotos/resizeableImage1.webp" alt="Enlargeable image1">
                <img class="eImg" src="Fotos/resizeableImage2.webp" alt="Enlargeable image2">
                <img class="eImg" src="Fotos/resizeableImage3.webp" alt="Enlargeable image3">
                <img class="eImg" src="Fotos/resizeableImage4.webp" alt="Enlargeable image4">
                <img class="eImg" src="Fotos/resizeableImage5.webp" alt="Enlargeable image5">
        	</div>
		</section>
		<footer>
			<p><?php echo $jsonFile[0]["footer"]; ?></p><p>©Esper VOF 2019</p>
		</footer>
        <script async defer>
			$(".eImg").hover(function(){$(this).height("100%");$(this).width("auto");},function(){$(this).height("50%");$(this).width("20%");});
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
			});
		</script>
	</body>
</html>
