<?
	if (isset ($_REQUEST["inserisci"]) && $_REQUEST["inserisci"]=="inserisci")
	{
		$periodo = htmlentities($_REQUEST["periodo"], ENT_QUOTES);
		$PDA_RES = htmlentities($_REQUEST["PDA_RES"], ENT_QUOTES);
		$PDA_SHP = htmlentities($_REQUEST["PDA_SHP"], ENT_QUOTES);
		$PDA_TOT = htmlentities($_REQUEST["PDA_RES"], ENT_QUOTES) + htmlentities($_REQUEST["PDA_SHP"], ENT_QUOTES);

		// scrivo su tabella autoprodotte

		mysql_connect(DBURI ,DBUSER ,DBPASS);
		mysql_select_db(DBNAME);

		$query="INSERT into `autoprodotte` 
		(
		ID_AGENTE,
		DATA,
		TOT_PDA,
		PDA_RES,
		PDA_SHP
		)
		values
		(
		'" . htmlentities($_REQUEST["ID_AGENTE"], ENT_QUOTES) . "',
		'" . htmlentities($_REQUEST["periodo"], ENT_QUOTES) . "',
		'" . $PDA_TOT . "',
		'" . htmlentities($_REQUEST["PDA_RES"], ENT_QUOTES) . "',
		'" . htmlentities($_REQUEST["PDA_SHP"], ENT_QUOTES) . "'
		);";

		/**/
		echo '<pre>';
		var_dump($query);
		echo '</pre>';
		/**/

		$res = mysql_query($query) or die("Query non valida: " . mysql_error());


	}
	else
	{
		$periodo = date('d/m/Y');
	}

?>
