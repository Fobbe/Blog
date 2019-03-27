<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'connect.php';
include 'design.css';

	$sql="SELECT Entrys.titel, Entrys.description, Entrys.date, Userdata.UName 
		  FROM Entrys, Userdata WHERE Entrys.user_id = Userdata.user_id ORDER BY date DESC";
	$result = $conn->query($sql);
			
	if($_GET)
	{
		$sql="SELECT Entrys.entry_nmbr FROM Entrys WHERE entry_nmbr ='$_GET[id]'";
		$a = $conn->query($sql);
		$ergebnis = mysqli_fetch_assoc($a);
		$id = $ergebnis['entry_nmbr'];
		if($_GET["id"] == $id)
		{
			$sql = "SELECT Entrys.titel, Entrys.description, Entrys.entry, Entrys.date, Entrys.user_id, Userdata.user_id, Userdata.UName FROM Entrys, Userdata 
					WHERE entry_nmbr = '$id' AND Entrys.user_id = Userdata.user_id";
			$inhalt = $conn->query($sql);
			$content = mysqli_fetch_assoc($inhalt);
			echo $content["titel"] . "<br>" . $content["description"] . "<br>" . $content["entry"] . "<br>" . $content["date"] . "<br>" . $content["user_id"];		
		}
		else
		{
			die("Es funktioniert gar nicht");
		}
	}	
		
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

<html>
<body>
	<form>
	<input type="button" value="Eintrag erstellen" onclick="parent.location='eintraege_erstellen.php'">
	</form>
	<form>
	<input type="button" value="Zurück zum Blog" onclick="parent.location='blog.php'">
	</form>
</body>
</html>
