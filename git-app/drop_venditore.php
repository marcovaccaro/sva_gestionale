<?php

		include_once("libreria_php/auth.inc.php");
		include("libreria_php/config.php");

		include_once("libreria_php/allowed_1.php");

		include("libreria_php/connett_db.php");
		$venditore = htmlentities($_GET["venditore"], ENT_QUOTES);
		//echo $venditore;
		
		$conn = connettidb();
		$query = "DELETE FROM pro_user WHERE login = \"".$venditore."\";";
		//echo '<br>'.$query;
		$res = @$conn->query($query);
		include("libreria_php/controllo_res_query.php");
		$conn->close();
		header('Location: gestione_venditori.php');

?>