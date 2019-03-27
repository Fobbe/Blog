<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'connect.php';

if($_POST)
{
	$UName = $_POST['UName'];

	$PW = $_POST['PW'];

	$sql = "SELECT * FROM Userdata";	
	$conn->query($sql);
	$sql = "SELECT UName FROM Userdata WHERE UName = '$UName'";	
	$query = $conn->query($sql);
	$result = mysqli_num_rows($query);
	if($result == 1)	
		{
		$sql = "SELECT UName, PW FROM Userdata 
				WHERE UName = '$UName'
				AND PW = '$PW'";
		$query = $conn->query($sql);
		$result = mysqli_num_rows($query);
		
			if($result == 1)
			{
				$sql = "SELECT user_id FROM Userdata WHERE UName = '$UName'";
				$keks = $conn->query($sql);
				$echterkeks = mysqli_fetch_all($keks);
				$_SESSION["session_id"] = $echterkeks;
				
				header('Location: hello_known_user.php');
				exit;
			}
			else
			{
				echo"Username und Passwort stimmen nicht überein";
			}
			
		}
		else
		{
			echo "Dieser Username existiert nicht";
		}
}
?>

<!DOCTYPE html>
<html>
<body>
		
	<form  action="login.php" method="post">
	Username:<input type="text" name="UName" values="<?php echo $_POST['UName']?>" required><br>
	Passwort:<input type="text" name="PW" values="<?php echo $_POST['PW']?>" required><br>
	<input type="submit" value="Log In">
	</form>	
	<br>
	Noch keinen Account?
	<br>
	Hier erstellen
	<form action="register.php" method="post">
	<input type="submit" value="Registrieren">
	</form>
	
</body>
</html>
