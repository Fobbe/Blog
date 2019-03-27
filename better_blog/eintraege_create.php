<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'connect.php';

if($_POST)
{
	$titel = $_POST['titel'];
	$description = $_POST['description'];
	$entry = $_POST['entry'];
	$session_id	= json_encode($_SESSION);
	$final_keks = preg_replace ( '/[^0-9]/i', '', $session_id);
	$sql = "INSERT INTO Entrys(titel, description, entry, user_id)
			VALUES('$titel','$description','$entry','$final_keks')";	
	$conn->query($sql);

	$sql = "SELECT * FROM Entrys WHERE titel ='$titel' AND description = '$description'
			AND entry = '$entry' AND user_id = '$final_keks'";
	$query = $conn->query($sql);
	$result = mysqli_num_rows($query);
		
		if($result > 1)	
		{
				
			$sql = "DELETE FROM Entrys WHERE titel ='$titel' AND description = '$description'
					AND entry = '$entry' AND user_id = '$final_keks' ORDER BY date DESC LIMIT 1";
			$ergebnis = $conn->query($sql);
			echo"Dieser Beitrag existiert bereits";
		}
		else
		{
			echo "Beitrag erfolgreich erstellt";
			header('Location: blog_2.php');
			exit;
		}	
}

?>

<!DOCTYPE html>
<html>
	<header>
		
	</header>
<body>
	
	<h1>Einträge</h1><br>
	<p>Hier können Sie Einträge erstellen</p>
	<br>
	<form>
	<input type="button" value="Zurück zum Blog" onclick="parent.location='blog_2.php'">
	</form>
	<br>
	<form  action="eintraege_create.php" method="post">
	Titel:<input type="text" style="width:400px;" name="titel" values="<?php echo $_POST['titel']; ?>" required><br>
	Beschreibung:<textarea rows="3" cols="40" name="description" values="<?php echo $_POST['description']; ?>" required></textarea><br>
	Eintrag:<textarea rows="20" cols="60" name="entry" values="<?php echo $_POST['entry']; ?>" required></textarea><br>
	<input type="submit">
	</form>	
	
</body>
</html>
