<?php

		include_once("libreria_php/auth.inc.php");
		include("libreria_php/config.php");

		include_once("libreria_php/allowed_0.php");

		include("libreria_php/connett_db.php");
		$table = $_GET["table"];
		
		$conn = connettidb();
		$query = 'DROP TABLE `' . $table . '`;';
		$res = @$conn->query($query);
		include("libreria_php/controllo_res_query.php");
		$conn->close();
		header('Location: elenco_tabelle.php');

?>