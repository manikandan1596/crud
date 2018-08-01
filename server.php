<?php 
	session_start();
	$edit_state=false;
	//database connectivity
	$db=mysqli_connect('localhost','root','','crud');
	
	//if save button is clicked
	
		$title=$_POST['title'];
		$details=$_POST['details'];
		$due=$_POST['due'];
		
		$query= "INSERT INTO todo(title,details,due) VALUES('$title','$details','$due')";
		if(!mysqli_query($db,$query))
	 {
		 echo '"<h1>" <Details you entered not inserted into the database"<h1>"';
	 }
	 {
		 echo '"<h1>"Details are inserted successfully"</h1>"';
	 }
		$_SESSION['msg']="Task added";
		header("refresh:2; url=index.php");
	
	//update database
	if(isset($_POST['update'])) {
		$title=mysql_real_escape_string($_POST['title']);
		$details=mysql_real_escape_string($_POST['details']);
		$due=mysql_real_escape_string($_POST['due']);
		$id=mysql_real_escape_string($_POST['id']);
		
		mysqli_query($db,"UPDATE todo SET title='title',details='details',due='due' WHERE id=$id");
		$_SESSION['msg']="Task updated";
		
		header("refresh:0; url=index.php");
	}
	if(isset($_GET['del'])){
		$id=$_GET['del'];
		mysqli_query($db,"DELETE FROM todo WHERE id=$id");
		$_SESSION['msg']="Task deleted";
		
		header("refresh:0; url=index.php");
	}

?>