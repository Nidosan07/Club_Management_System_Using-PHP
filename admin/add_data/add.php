<?php
	session_start();
	include_once('connection.php');

	$club_result = $conn->query("SELECT id, name FROM club_list WHERE delete_flag = 0");
	$clubs = [];
	while ($row = $club_result->fetch_assoc()) {
		$clubs[] = $row;
	}
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$attendees = $_POST['attendees'];
		$event_date = $_POST['event_date'];
		$club_id = $_POST['club_id'];

    // Insert data into the event_registrations table
    $sql = "INSERT INTO registrations (name, email, phone, attendees, event_date, club_id)
            VALUES ('$name', '$email', '$phone', '$attendees', $event_date, $club_id )";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = 'Event added successfully';
		}
		///////////////

		//use for MySQLi Procedural
		// if(mysqli_query($conn, $sql)){
		// 	$_SESSION['success'] = 'Member added successfully';
		// }
		//////////////
		
		else{
			$_SESSION['error'] = 'Something went wrong while adding';
		}
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: index.php');
?>