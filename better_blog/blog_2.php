<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'connect.php';

    $sql="SELECT Entrys.titel, Entrys.description, Entrys.date, Userdata.UName 
		  FROM Entrys, Userdata WHERE Entrys.user_id = Userdata.user_id ORDER BY date DESC LIMIT 10";
	$result = $conn->query($sql);
echo "<table border=\"1\">\n";
    while ($row = mysqli_fetch_assoc($result))
    {
        echo "<tr>";
        foreach ($row as $article)
     
        echo "<td>$article</td>";
        echo "</tr>\n";
        echo "<br<";
    }
    
echo "</table>\n";
?>

<html>
	<header>
		<title>Besserer Blog</title>
	</header>
<body>
	<h1>Mein Blog</h1>

	<form>
	<input type="button" value="Eintrag erstellen" onclick="parent.location='eintraege_create.php'">
	</form>
	<br>
	<form>
	<input type="button" value="Abmelden" onclick="parent.location='logout.php'">
	</form>
	<br>
	<h2>Aktuelle Einträge</h2><br>
	<form>
	<input type="button" value="Alle Einträge lesen" onclick="parent.location='all_entries.php'">
	</form>
	<br>
</body>
</html>
