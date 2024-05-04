<?php
	

	if(isset($_POST['edit'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$attendees = $_POST['attendees'];
		$event_date = $_POST['event_date'];
		$club_id = $_POST['club_id'];
		$sql = "UPDATE registrations SET name = '$name', email = '$email', phone = '$phone' , attendees = '$attendees', event_date = '$event_date', club_id = '$club_id' WHERE id = '$id'";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = 'Event updated successfully';
		}
		///////////////

		//use for MySQLi Procedural
		// if(mysqli_query($conn, $sql)){
		// 	$_SESSION['success'] = 'Member updated successfully';
		// }
		///////////////
		
		else{
			$_SESSION['error'] = 'Something went wrong in updating Event';
		}
	}
	else{
		$_SESSION['error'] = 'Select member to edit first';
	}

	header('location: index.php');

?>