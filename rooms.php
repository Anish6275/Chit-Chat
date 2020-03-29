<?php 

$roomname = $_GET['roomname'];

include 'db_connect.php';

$sql="SELECT * FROM `rooms` WHERE `roomname` LIKE '$roomname'";
$result= mysqli_query($conn, $sql);
if($result){
	if(mysqli_num_rows($result)==0){
		$message = "This room does not exist!!";
		echo '<script language="javascript">';
		echo 'alert("'.$message.'");';
		echo 'window.location="http://localhost/Chit-Chat";';
		echo '</script>';
	}

}
else{
	echo "Error : ".mysqli_error($conn);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
  background: linear-gradient(to right, rgb(195, 55, 100), rgb(29, 38, 113));
}
h3{
	color: #fff;
}

.container {
  border: 1px solid #FFB600;
  color: #fff;
  background-color: rgba(0,0,0,0);
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #fff;
  background-color: #FFB600;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  height: 60px;                                                             
  width: 90%;
  padding-bottom: 5px; 
  margin-right: 20px;                                       
  border-radius: 50%;
  
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
.anyClass{
	height: 360px;
	overflow-y: scroll;
	overflow: auto;

}
.sendd{
	display:block;
	margin: auto;
}
#usermsg{
	border: 3px solid #FFB600;
	background-color: rgba(0,0,0,0);
	width: 70%;
	font-weight: 200;
	color: #fff;
	border-radius: 8px;
	padding: 10px;
	margin: 10px 0;
}
#usermsg::placeholder{
	color: #fff;
	font-size: 20px;
}
#submitmsg{
	border: 2px solid #FFB600;
	background-color: rgba(0,0,0,0);
	font-size: 18px;
	color: #fff;
	border-radius: 20%;
	padding: 8px;
	padding-top: 10px;

	margin: 10px 0;
}
</style>
</head>
<body>

<h3>Chat Room - <?php echo $roomname; ?> </h3>

<div class="container">
<div class="anyClass"></div>

</div>


<div id="sendd">
<input type="text" class = "form-control" name="usermsg" id="usermsg" placeholder= "Add message">
<button class="btn bbtn-default" name="submitmsg" id="submitmsg"> Send </button>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script type="text/javascript">
// new messages
setInterval(runFunction, 1000);
function runFunction(){
	$.post("htcon.php", {room: '<?php echo $roomname ?>'},
	function(data, status){
		document.getElementsByClassName('anyClass')[0].innerHTML = data;
	}
	)
	
}




	// Get the input field
var input = document.getElementById("usermsg");

// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("submitmsg").click();
  }
});

	//submit form
	var clientmsg = $("usermsg").val();
	$("#submitmsg").click(function(){
		var clientmsg = $("#usermsg").val();
  	$.post("postmsg.php", {text: clientmsg, room: '<?php echo $roomname ?>', ip: '<?php echo $_SERVER['REMOTE_ADDR'] ?>'},
  	function(data, status){
  		document.getElementByClassName('anyClass')[0].innerHTML = data;});
  	$("#usermsg").val("");
  	return false;
  	
});
</script>
</body>
</html>
