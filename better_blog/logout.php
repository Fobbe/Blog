<?php
session_start();

session_unset();

session_destroy();
	$session_id	= json_encode($_SESSION);
	$end_session = preg_replace ( '/[^0-9]/i', '', $session_id);
	$a = print_r($end_session);

?>


<html>
<head>
	<meta http-equiv="refresh" content="3; 
	URL=blog.php">
</head>
	
<body>

Sie haben sich erfolgreich abgemeldet<br>

</body>
</html>
