<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'connect.php';

	$session_id	= json_encode($_SESSION);
	$session = preg_replace ( '/[^0-9]/i', '', $session_id);

if($_GET['id'] and $_GET['name'] == 'Edit')
{

$sql="SELECT * FROM Entrys WHERE entry_nmbr = $_GET[id]";
$a = $conn->query($sql);
$b = mysqli_fetch_assoc($a);

	if($b['entry_nmbr'] == $_GET['id'])
	{
		if($b['user_id'] == $session)
		{
		$sql="SELECT titel, description, entry FROM Entrys WHERE Entrys.user_id = '$session' AND Entrys.entry_nmbr = '$_GET[id]'";
		$query = $conn->query($sql);
		$content = mysqli_fetch_assoc($query);
		}
		else
		{
			echo"Nur der User, der diesen Beitrag erstellt hat, kann ihn bearbeiten";
		}
	}
	else
	{
	echo "Fehler 2 aufgetreten";
	}

}
elseif($_POST)
{

$selectSql="SELECT titel, description, entry FROM Entrys WHERE Entrys.user_id = '$session' AND Entrys.entry_nmbr = '$_GET[id]'";
$query = $conn->query($selectSql);
$content = mysqli_fetch_assoc($query);

$updateSql = "UPDATE Entrys SET titel = '$_POST[titel]', description = '$_POST[description]', entry = '$_POST[entry]' WHERE entry_nmbr = $_GET[id]";
$query = $conn->query($updateSql);
header("Location: all_entries.php");
echo "Hallo Welt";

}
else
{
echo "Fehler 1 aufgetreten";
}
?>

<html>
<body>
	
<form action ="edit.php?id=<?php echo $_GET['id'] ?>&name=Change" method="post">	
Titel:<textarea rows="2" cols="40" name="titel" value='titel'><?php echo $content['titel']?></textarea><br>
Beschreibung:<textarea rows="3" cols="40" name="description" value='description'><?php echo $content['description']?></textarea><br>
Eintrag:<textarea rows="20" cols="60" name="entry" value='entry'><?php echo $content['entry']?></textarea><br>
<input type="submit" value="Edit">
</form>

</body>
</html>
