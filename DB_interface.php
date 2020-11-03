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
			    }else file_put_contents($dir.'/pp.jpg', file_get_contents('Users/Default/pp.jpg'));
			    
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

		function removeUser($user, $pass){
		    if (hash("sha256", $pass) != "9983ac69c4a003452620c01f51b991912ac6f4cb899e36e795faa2a7c7f38603") die("STOPNOTE: Admin password is wrong.");
		    
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
			}else die("STOPNOTE: Wrong credentials.");
		}
		
		function changePP() {
		    session_start();
		    
			if (!isset($_SESSION['Email'])) {
				die("STOPNOTE: User does not exist.");
			}
			
		    $dir = "Users/".$_SESSION["Email"]."/";
	        // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if (
                !isset($_FILES['pp']['error']) ||
                is_array($_FILES['pp']['error'])
            ) {
                die('STOPNOTE: Invalid parameters.');
            }
        
            // Check $_FILES['upfile']['error'] value.
            switch ($_FILES['pp']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    die('STOPNOTE: No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    die('STOPNOTE: Exceeded filesize limit.');
                default:
                    die('STOPNOTE: Unknown errors.');
            }
        
            // You should also check filesize here.
            if ($_FILES['pp']['size'] > 10000000) {
                die('STOPNOTE: Exceeded filesize limit.');
            }
        
            // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
            // Check MIME Type by yourself.
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                $finfo->file($_FILES['pp']['tmp_name']),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                ),
                true
            )) {
                die('STOPNOTE: Invalid file format.');
            }
            //Delete old pic
            array_map('unlink', glob($dir."*"));
            // Compress image
            if ($finfo->file($_FILES['pp']['tmp_name']) == 'image/jpeg') $image = imagecreatefromjpeg($_FILES['pp']['tmp_name']);
            elseif ($finfo->file($_FILES['pp']['tmp_name']) == 'image/png') $image = imagecreatefrompng($_FILES['pp']['tmp_name']);
            if (!imagejpeg($image, $dir."pp.jpg", 60)) die('Failed to move uploaded file.');
            $_SESSION['reload'] = "true";
            die('SUCCESS: File is uploaded successfully.');
        }

		switch (strtolower($_POST["DB_interface"])){
			case "insertuser":
					insertUser($_POST["username"], $_POST["password"], $_POST["firstname"], $_POST["infix"], $_POST["lastname"], $_POST["email"]);
					break;
			case "getuserdata":
					getUserData($_POST["user"]);
					break;
			case "removeuser":
					removeUser($_POST["user"], $_POST["pass"]);
					break;
			case "userverification":
					UserVerification($_POST["user"], $_POST["password"]);
					break;
			case "changepp":
					changePP();
					break;
			default:
					die();
		}
	}else die("dead");
?>
