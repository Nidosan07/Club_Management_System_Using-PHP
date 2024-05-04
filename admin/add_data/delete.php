<?php
	session_start();
	include_once('connection.php');

	if(isset($_GET['id'])){
		$sql = "DELETE FROM registrations WHERE id = '".$_GET['id']."'";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = 'Event deleted successfully';
		}
		////////////////

		//use for MySQLi Procedural
		// if(mysqli_query($conn, $sql)){
		// 	$_SESSION['success'] = 'Member deleted successfully';
		// }
		/////////////////
		
		else{
			$_SESSION['error'] = 'Something went wrong in deleting event';
		}
	}
	else{
		$_SESSION['error'] = 'Select member to delete first';
	}

	header('location: index.php');
?>