<?php

if ($res === FALSE)
{
	echo '<br />inserimento dati fallito:' . $conn->error;
	$conn->close();
	exit;
}
?>