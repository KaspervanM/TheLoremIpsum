<?php
$username = "id15005338_loremipsum";//"loremipsum";
$password = "Lipsum12345!";
$dbName = "id15005338_loremipsumdb";//"LoremIpsumDB";
$servername = "localhost";

/*
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
  die("Connection failed: ".$conn->connect_error);
}
echo "Connected successfully<br/>";

$conn->query("DROP DATABASE $dbName;");

$query = "SHOW DATABASES LIKE '$dbName';";
if (!$conn->query($query)->fetch_assoc()) {

	$query = "CREATE DATABASE $dbName";

	if ($conn->query($query)) {

		echo "Database created successfully<br/>";
	}else {
		echo "Error creating database: " . $conn->error;
	}
} else {
	echo "db exists!<br/>";
}

$conn->close();
*/

$conn = new mysqli($servername, $username, $password, $dbName);

if ($conn->connect_error) {
  die("Connection failed: ".$conn->connect_error);
}

/*$query = "SHOW TABLES LIKE 'Users'";
if (!$conn->query($query)->fetch_assoc()) {

	$query = "CREATE TABLE Users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(30),
password VARCHAR(30),
firstname VARCHAR(30) NOT NULL,
infix VARCHAR(30),
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

	if ($conn->query($query)) {

		echo "Table 'Users' created successfully<br/>";
	}else {
		echo "Error creating table 'Users': " . $conn->error;
	}
} else {
	echo "Table 'Users' exists!";
}*/

$sql = "select * from Users";
$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
	print_r($row);
}
?>
