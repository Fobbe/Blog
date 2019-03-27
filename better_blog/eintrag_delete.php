<?php
include 'connect.php';
	
		if($_GET)
	{
		$sql="SELECT Entrys.entry_nmbr FROM Entrys WHERE entry_nmbr ='$_GET[id]'";
		$a = $conn->query($sql);
		$ergebnis = mysqli_fetch_assoc($a);
		$id = $ergebnis['entry_nmbr'];
		
		if($_GET["id"] == $id)
		{
			$sql = "DELETE FROM Entrys WHERE entry_nmbr = $id";
			$inhalt = $conn->query($sql);
			header('Location: all_entries.php');
			exit;
		}
		else
		{
			die("Es ist ein Fehler aufgetreten");
		}
	}

?>
<html>
<body>

</body>
</html>
