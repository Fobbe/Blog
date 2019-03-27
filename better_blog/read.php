<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connect.php';

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

/*	
	<form action='eintrag_delete.php?id="<?php echo $ergebnis['entry_nmbr']; ?>"' method="post">
        <input type="hidden" name="id" value="<?php echo $ergebnis['entry_nmbr']; ?>">
        <input type="submit" name="name" value="Delete">
    </form>
*/

?>

<html>
<body>

	<form>
	<input type="button" value="Zurück zum Blog" onclick="parent.location='blog.php'">
	</form>
	
	<form action='edit.php?id="<?php echo $ergebnis['entry_nmbr']; ?>"' method="get">
        <input type="hidden" name="id" value="<?php echo $ergebnis['entry_nmbr']; ?>">
        <input type="submit" name="name" value="Edit">

</body>
</html>
