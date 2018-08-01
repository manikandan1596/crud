<?php 
	$title="";
	$details="";
	$db=mysqli_connect('localhost','root','','crud');
	//fetch record to be updated
	if(isset($_GET['edit'])){
		$id=$_GET['edit'];
		$edit_state=true;
		$rec= mysqli_query($db,"SELECT * FROM todo WHERE id=$id");
		$record= mysqli_fetch_array($rec);
		$title=$record['title'];
		$details=$record['details'];
		$due=$record['due'];
		$id=$record['id'];
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD IN PHP</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1><center>TODO LIST</center></h1>
	<?php if (isset($_SESSION['msg'])): ?>
		<div class="msg">
			<?php echo $_SESSION['msg'];
			unset($_SESSION['msg']);
			?>
		</div>	
	<?php endif ?>
	<table>
		<thead>
			<tr>
				<th>TITLE</th>
				<th>DETAILS</th>
				<th>DUE DATE</th>
				<th colspan="2">ACTION</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
				$db=mysqli_connect('localhost','root','','crud');
				$results= mysqli_query($db,"SELECT * FROM todo");
				while($row=mysqli_fetch_array($results)) { ?>
			<tr>
				<td><?php echo $row['title']; ?></td>
				<td><?php echo $row['details']; ?></td>
				<td><?php echo $row['due']; ?></td>
				<td>
					<a class="edit_btn" href="index.php?edit=<?php echo $row['id']; ?>">UPDATE</a>
				</td>
				<td>
					<a class="del_btn" href="server.php?del=<?php echo $row['id'];?>">DELETE</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<form method="post" action="server.php">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="input-group">
			<label>TITLE</label>
			<input type="text" name="title" value="<?php echo $title; ?>">
		</div>
		<div class="input-group">
			<label>DETAILS</label>
			<input type="text" name="details" value="<?php echo $details; ?>">
		</div>
		<div class="input-group">
			<label>DUE DATE</label>
			<input type="date" name="due"value="<?php echo $due; ?>">
		</div>
		<div class="input-group">
		<?php
			$edit_state=false;
		if ($edit_state ==false): ?>
			<button type="submit" name="save" class="btn">SAVE</button>
		<?php else: ?>
			<button type="submit" name="update" class="btn">UPDATE</button>
		<?php endif ?>
				
		</div>
</body>


</html>