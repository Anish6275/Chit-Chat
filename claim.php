<?php
$room = $_POST['room'];

if(strlen($room)>20 or strlen($room)<2)
{
	$message = "Please choose a name between 2 to 20 characters";
	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost/Chit-Chat";';
	echo '</script>';
}
else if(!ctype_alnum($room))
{
	$message = "Please choose a alphanumeric name";
	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost/Chit-Chat";';
	echo '</script>';
}
else
{
	include 'db_connect.php';
}


$sql = "SELECT * FROM `rooms` WHERE `roomname` LIKE '$room'";
$result = mysqli_query($conn, $sql);

if($result){
	if(mysqli_num_rows($result)>0){
		$message = "Please choose a different room name";
		echo '<script language="javascript">';
		echo 'alert("'.$message.'");';
		echo 'window.location="http://localhost/Chit-Chat";';
		echo '</script>';
	}
	else{
		$sql = "INSERT INTO `rooms` (`roomname`, `stime`) VALUES ('$room', CURRENT_TIMESTAMP);";
		if(mysqli_query($conn, $sql)){
			$message = "Your room is ready!! Have fun!! ";
			echo '<script language="javascript">';
			echo 'alert("'.$message.'");';
			echo 'window.location="http://localhost:8080/Chit-Chat/rooms.php?roomname='.$room.'";';
			echo '</script>';
		}
	}
}
else{
	echo "Error: ". mysqli_error($conn);
}


?>
