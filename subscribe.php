<?php

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

$nullValueFound = False; //This variable will keep track of the fact whether we found any null value or not
$noDuplicatesFound = True; //This variable will keep track of whether the email is already present in the database or not

$DBHOST="localhost";
$DBNAME="newsletter_subscribers";
$DBUSER="b1fe2544046193677e21c7e3b5dc56ac";
$DBPASS="535c4d30ade59baeab5411f3902f0732";

if($_SERVER['REQUEST_METHOD'] === 'POST') {

	$email = $_POST["email"];

	$email = filter_var($email,FILTER_SANITIZE_STRING);

	$email = preg_replace("/\s+/", "", $email);

	if($email == NULL OR $email == "") {
		$nullValueFound = True;
	}

	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

		if($nullValueFound) {
			$response->success = "False";
			$response->message = "Please Enter Valid Email Address.";
			echo (json_encode($response));
		} else {

			//Opening the connection to the database
			try {

				$conn = new PDO("mysql:host=$DBHOST;dbname=$DBNAME", $DBUSER, $DBPASS);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				/*$pdo = new PDO("pgsql:" . sprintf(
					"host=%s;port=%s;user=%s;password=%s;dbname=%s",
					$db["host"],
					$db["port"],
					$db["user"],
					$db["pass"],
					ltrim($db["path"], "/")
				));

				// set the PDO error mode to exception
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/
				$response->success = "True";
				$response->message = "Connection Successful.";
			} catch(PDOException $e) {
				$response->success = "False";
				$response->message = "Error. Please Try Again.";
			}

			//Checking for duplicate username
			$stmt = $conn->prepare('SELECT * FROM subscribers WHERE email = :email');
			$stmt->bindParam(':email',$email);
			if($stmt->execute()) {
				if($stmt->rowCount() > 0) {
					$response->success = "False";
					$response->message = "You Are Already Subscribed.";
					$noDuplicatesFound = False;
				}
			} else {
				$response->success = "False";
				$response->message = "Error. Please Try Again.";
				$noDuplicatesFound = False;
			}

			if($noDuplicatesFound) {
				$stmt = $conn->prepare('INSERT INTO subscribers (email) VALUES (:email)');
				$stmt->bindParam(':email', $email);
				if($stmt->execute()) {
					$response->success = "True";
					$response->message = "Thank You For Subscribing.";
				} else {
					$response->success = "False";
					$response->message = "Error. Please Try Again.";
				}
			}

			echo (json_encode($response));

		}

	} else {
		$response->success = "False";
		$response->message = "Please Enter Valid Email Address.";
		echo (json_encode($response));
	}
} else {
	$response->success = "False";
	$response->message = "Please Enter Valid Email Address.";
	echo (json_encode($response));
}



?>
