<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'connect.php';

	$session_id	= json_encode($_SESSION);
	$session = preg_replace ( '/[^0-9]/i', '', $session_id);

if($_GET)
{
$sql="SELECT * FROM Entrys WHERE entry_nmbr = $_GET[id]";
$a = $conn->query($sql);
$b = mysqli_fetch_assoc($a);
	if($b['entry_nmbr'] == $_GET['id'])
	{
		if($b['user_id'] == $session)
		{
		var_dump($b);
		echo "Hallo Welt";
		}
		else
		{
			echo"Nur der user, der diesen Beitrag erstellt hat, kann ihn bearbeiten";
		}
	}
	else
	{
	echo "Fehler aufgetreten";
	}

}
else
{
echo "Fehler aufgetreten";
}
?>
