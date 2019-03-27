<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connect.php';


if($_POST)
{
	$vorname = $_POST['vorname'];
	$nachname = $_POST['nachname'];
	$UName = $_POST['UName'];
	$PW = $_POST['PW'];
	
	$sql = "SELECT * FROM Userdata";
	$sql = "INSERT INTO Userdata (vorname, nachname, UName, PW)
	VALUES ('$vorname', '$nachname', '$UName', '$PW')";	
	$conn->query($sql);	
	$sql = "SELECT * FROM Userdata WHERE UName = '$UName'";
	$query = $conn->query($sql);
	$result = mysqli_num_rows($query);
		
		if($result > 1)	
		{				
			$sql = "DELETE FROM Userdata ORDER BY user_id DESC LIMIT 1";
			$conn->query($sql);
			echo"Dieser Benutzername existiert bereits";
		}
		else
		{
			echo "Account erfolgreich erstellt";
			header('Location: hello_new_user.php');
			exit;
		}	
}
?>

<!DOCTYPE html>
<html>
<body>

	<form  action="register.php" method="post">
	Vorname:<input type="text" name="vorname" values="<?php echo $_POST['vorname']?>" required><br>	
	Nachname:<input type="text" name="nachname" values="<?php echo $_POST['nachname']?>" required><br>	
	Username:<input type="text" name="UName" values="<?php echo $_POST['UName']?>" required><br>
	Passwort:<input type="text" name="PW" values="<?php echo $_POST['PW']?>" required><br>
	<input type="submit" value="Registrieren">
	</form>	
</body>
</html>





