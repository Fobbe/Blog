<?php
session_start();
include 'connect.php';
include 'design.css';

	$session_id	= json_encode($_SESSION);
	$end_session = preg_replace ( '/[^0-9]/i', '', $session_id);
	if($end_session != "")
	{
		header('Location: blog_2.php');
		exit;
	}
	
	$sql="SELECT Entrys.titel, Entrys.description, Entrys.date, Userdata.UName 
		  FROM Entrys, Userdata WHERE Entrys.user_id = Userdata.user_id ORDER BY date DESC LIMIT 10";
	$result = $conn->query($sql);
	
	echo "<table id='t1'>";
	echo"<tr><th>Titel</th><th>Description</th><th>Date</th><th>User</th></tr>";
	while ($row = mysqli_fetch_assoc($result))
	   {
			echo "<tr>";	
			foreach ($row as $key => $article)
			{
				if($key == 'titel')
				{
					$sql = "SELECT Entrys.entry_nmbr FROM Entrys WHERE titel = '$article'";
					$query = $conn->query($sql);
					$entry_nmbr = mysqli_fetch_assoc($query);
					$id = $entry_nmbr['entry_nmbr'];
					echo "<td><a href='read.php?id=". $id ."'>". $article ."</a></td>";
				}
				else
				{
					echo "<td>". $article ."</td>";								
				}
			}	
			echo "</tr>";
	   }
		echo "</table>";
?>

<!DOCTYPE html>
<html>
	<head>
	<link href="design.css" rel="stylesheet">
	<title>Besserer Blog</title>
	</head>
	<body>
		<form>
		<input type="button" value="Zum Login" onclick="parent.location='login.php'">
		</form>
		<h1>Mein Blog</h1>									<!-- header -->
		<p>Hier kann man lustige Einträge finden</p><br>	<!-- paragraph -->
		<h2>Aktuelle Einträge</h2><br>
	</body>
</html>
