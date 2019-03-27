<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'connect.php';

//Morgen hier weitermachen

	$session_id	= json_encode($_SESSION);
	$final_keks = preg_replace ( '/[^0-9]/i', '', $session_id);		
		
	if($_GET)
	{
		$sql = "SELECT Entrys.user_id FROM Entrys WHERE entry_nmbr = $_GET['id']";
		$query = $conn->query($sql);
		$result = mysqli_fetch_assoc($query);
		
		if($final_keks == $result['user_id'])
		{
			$sql = "SELECT titel, description, entry FROM Entrys WHERE entry_nmbr = $_GET['id']";
			$alpha = $conn->query($sql);
			$inhalt = mysqli_fetch_assoc($alpha);
			
			if(isset($_POST['edit']))
			{
				$sql = "UPDATE Entrys SET titel = $_POST['titel'], description = $_POST['description'], entry = $_POST['entry'] WHERE entry_nmbr = $_GET['id']";	//SQL Statement funktioniert
				$beta = $conn->query($sql);
			}
		}
	}	

?>

<html>
<body>

</body>
</html>
