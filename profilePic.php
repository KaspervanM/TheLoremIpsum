<?php $jsonFile = json_decode(file_get_contents("data.json"), true);
session_start();
if (!isset($_SESSION['id'])) header("Location: https://thenewlorem.000webhostapp.com/");
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $jsonFile[6]["title"]; ?></title>
		<meta charset="utf-8">
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
							<menuitem><a href=<?php echo "'".$jsonFile[6]["navbar"]["menuitem1"]["link"]."'"; ?>><?php echo $jsonFile[6]["navbar"]["menuitem1"]["name"]; ?></a></menuitem>
							<menuitem><a href=<?php echo "'".$jsonFile[6]["navbar"]["menuitem2"]["link"]."'"; ?>><?php echo $jsonFile[6]["navbar"]["menuitem2"]["name"]; ?></a></menuitem>
							<menuitem><a href=<?php echo "'".$jsonFile[6]["navbar"]["menuitem3"]["link"]."'"; ?>><?php echo $jsonFile[6]["navbar"]["menuitem3"]["name"]; ?></a></menuitem>
							<menuitem><a href=<?php echo "'".$jsonFile[6]["navbar"]["menuitem4"]["link"]."'"; ?>><?php echo $jsonFile[6]["navbar"]["menuitem4"]["name"]; ?></a></menuitem>
							<menuitem><a id="logout"href=<?php echo "'".$jsonFile[6]["navbar"]["menuitem5"]["link"]."'"; ?> onclick=<?php echo "'".$jsonFile[6]["navbar"]["menuitem5"]["action"]."'"; ?>><?php echo $jsonFile[6]["navbar"]["menuitem5"]["name"]; ?></a></menuitem>
						</menu>
					</menuitem>
				</menu>
			</nav>
			<div class="cont"><p><?php echo $jsonFile[6]["navbar"]["header"]; ?></p></div>
			<div class="nav_box">
    			<img id="profile-picture">
			</div>
			<script async defer>
                function setPic(){
                    var profPic = document.getElementById("profile-picture");
                    var dir = " <?php session_start(); if(isset($_SESSION['id'])) { $dir = "Users/".$_SESSION['id']."/"; if (file_exists($dir . "pp.jpg")) {echo $dir . "pp.jpg";} else {echo "Users/Default/pp.jpg";} echo "?".rand(0,10000000);} ?>";
                    profPic.style.visibility = "visible";
                    profPic.src = dir;
                }
                function start(){
                    if(<?php session_start(); if(isset($_SESSION['id'])) echo 'true'; else echo "false"; ?>) {
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
                    $.post("destroySession.php", {session:"destroy"}, function success(e) {;;});
					location.reload();
                  }
            </script>
		</div>
		<img class="img" src="Fotos/contact-1.webp" alt="Lorem Ipsum">
		<section class="formcont"> 
    		<form action="return false" class="contactForm">
    		    <p class="header" style="color: white;"><?php echo $jsonFile[6]["uploadpp"]["header"]; ?></p>
    			<input name="pp" type="file" required/>
    			<input type="hidden" name="DB_interface" value="changePP"/>
    			<br/>
    			<button action="submit"><span>Add</span></button>
    		</form><br/>
    		<p id="timer"></p>
    	</section>
		<script>
		function countDown(count){
                var timer = document.getElementById("timer");
                if(count > 0){
                    count--;
                    timer.innerHTML = "Changed profile picture successfully. This page will redirect in "+count+" seconds.";
                    setTimeout("countDown("+count+")", 1000);
                }else{
                    window.location.href = "http://thenewlorem.000webhostapp.com/";
                }
            }
            
			$("form").submit(function(event){
				event.preventDefault();
				$("#timer").text("Uploading PP, please be patient...");
				$.ajax({
                    url: "DB_interface.php",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(e){
                        if (e.slice(0,7) == "SUCCESS") {
                            countDown(5);
                        } else if (e.slice(0,8) == "STOPNOTE") $('#timer').text(e.slice(10));
						  else if (e.slice(0,5) == "ERROR") $('#timer').text(e);
                    },
                    error: function(){} 	        
                });
			});
		</script>
	</body>
</html>
