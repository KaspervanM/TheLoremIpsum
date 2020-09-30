<?php
	if (!isset($_POST["DB_interface"])) die();
	$servername = "localhost:3306";
	$username = "loremipsum";
	$password = "password";
	$DBname = "LoremIpsumDB";

	$conn = new mysqli($servername, $username, $password, $DBname);

	if ($conn->connect_error){
		die("ERROR: Unable to connect: $conn->connect_error");
	}

	function insertUser($username, $password, $firstname, $infix, $lastname, $email){
		global $conn;

		$query = "SELECT 1 FROM Users WHERE username = '$username' OR email = '$email'";
		if ($conn->query($query)->fetch_assoc()) {
			die("STOPNOTE: User already exists.");
		}

		$query = "INSERT INTO Users (username, password, firstname, infix, lastname, email) VALUES ('$username', '$password', '$firstname', '$infix', '$lastname', '$email')";
		if ($conn->query($query) === TRUE) {
			die("SUCCESS: New record created successfully");
		} else {
			die("ERROR: $query <br> $conn->error");
		}
	}

	function getUserData($user, $select = "*"){
		global $conn;

		$query = "SELECT $select FROM Users WHERE username = '$user' OR email = '$user'";
		if ($result = $conn->query($query)) {
			var_dump($result->fetch_assoc());
			die();
		}
	}

	function UserVerification($user, $password){
		global $conn;

		$query = "SELECT $select FROM Users WHERE username = '$user' OR email = '$user'";
		if ($result = $conn->query($query)) {
			var_dump($result->fetch_assoc());
			die("STOPNOTE: User does not exist.");
		}
		
		$query = "SELECT $select FROM Users WHERE (username = '$user' OR email = '$user') AND password='$password'";
		if ($result = $conn->query($query)) {
			var_dump($result->fetch_assoc());
			die("SUCCESS: User verified.");
		}
		
	}

	switch (strtolower($_POST["DB_interface"])){
		case "insertuser":
				insertUser($_POST["username"], $_POST["password"], $_POST["firstname"], $_POST["infix"], $_POST["lastname"], $_POST["email"]);
				break;
		case "getuserdata":
				getUserData($_POST["user"]);
				break;
		case "userverification":
				UserVerification($_POST["user"], $_POST["password"]);
				break;
		default:
				die();
	}
?>
