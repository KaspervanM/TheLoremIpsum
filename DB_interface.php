<?php
	if (isset($_POST["DB_interface"])){
		$username = "id15005338_loremipsum";//"loremipsum";
        $password = "Lipsum12345!";
        $dbName = "id15005338_loremipsumdb";//"LoremIpsumDB";
        $servername = "localhost";

		$conn = new mysqli($servername, $username, $password, $dbName);

        if ($conn->connect_error) {
          die("ERROR: Unable to connect: ".$conn->connect_error);
        }

		function insertUser($username, $password, $firstname, $infix, $lastname, $email){
			global $conn;

			$query = "SELECT 1 FROM Users WHERE username = '$username' OR email = '$email'";
			if ($conn->query($query)->fetch_assoc()) {
				die("STOPNOTE: User already exists.");
			}

			$query = "INSERT INTO Users (username, password, firstname, infix, lastname, email) VALUES ('$username', '$password', '$firstname', '$infix', '$lastname', '$email')";
			if ($conn->query($query) === true) {
			    $dir = 'Users/'.$email;
			    if(is_dir($dir) === false)  mkdir($dir);
			    if(isset($_POST["google"])){
			        file_put_contents($dir.'/pp.jpg', file_get_contents($_POST['pp']));
			    }
			    
				die("SUCCESS: New record created successfully");
			} else die("ERROR: $query <br> $conn->error");
		}

		function getUserData($user, $select = "*"){
			global $conn;

			$query = "SELECT $select FROM Users WHERE username = '$user' OR email = '$user'";
			if ($conn->query($query)) {
				return($conn->query($query)->fetch_assoc()[$select]);
			}
		}

		function removeUser($user){
			global $conn;
			$query = "SELECT 1 FROM Users WHERE username = '$user' OR email = '$user'";
			if ($conn->query($query)->fetch_assoc()) {
			    $dir = "Users/".getUserData($user, "email")."/";
				$query = "DELETE FROM Users WHERE username = '$user' OR email = '$user'";
    			if ($conn->query($query)) {
    			    if(is_dir($dir)) {array_map('unlink', glob($dir."*")); rmdir($dir);}
    				die("SUCCESS: User removed successfully.");
    			}else die("ERROR: $query <br> $conn->error");
			}else die("STOPNOTE: User does not exist.");
		}

		function UserVerification($user, $password){
			global $conn;

			$query = "SELECT 1 FROM Users WHERE username = '$user' OR email = '$user'";
			if (!$conn->query($query)->fetch_assoc()) {
				die("STOPNOTE: User does not exist.");
			}

			$query = "SELECT 1 FROM Users WHERE (username = '$user' OR email = '$user') AND password='$password'";
			if (isset($_POST["google"]) || $conn->query($query)->fetch_assoc()) {
			    session_start();
			    $_SESSION["User"] = getUserData($user, "username");
			    $_SESSION["Email"] = getUserData($user, "email");
			    session_write_close();
				die("SUCCESS: User verified: ".getUserData($user, "username"));
			}else die("ERROR: Wrong credentials.");
		}

		switch (strtolower($_POST["DB_interface"])){
			case "insertuser":
					insertUser($_POST["username"], $_POST["password"], $_POST["firstname"], $_POST["infix"], $_POST["lastname"], $_POST["email"]);
					break;
			case "getuserdata":
					getUserData($_POST["user"]);
					break;
			case "removeuser":
					removeUser($_POST["user"]);
					break;
			case "userverification":
					UserVerification($_POST["user"], $_POST["password"]);
					break;
			default:
					die();
		}
	}else die("dead");
?>
