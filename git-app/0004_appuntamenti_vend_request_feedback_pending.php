<?
	if (isset ($_REQUEST["feedbackP"]) && $_REQUEST["feedbackP"]=="feedbackP")
	{

		// controllo i campi
		
		if (htmlentities($_REQUEST["SOTTO_STATO"], ENT_QUOTES) == '')
		{
			die('Feedback errato.<br>
			Devi selezionare un esito.<br>
			<a href="0004_appuntamenti_vend.php" style="color:red">Ricarica</a>');
		}
		/*else if (htmlentities($_REQUEST["SOTTO_STATO"], ENT_QUOTES) == 'LORDO-SPOSTATO' && htmlentities($_REQUEST["DATA_RIFIX"], ENT_QUOTES) == '')
		{
			die('Feedback errato.<br>
			APPUNTAMENTO SPOSTATO. Devi comunicare data e ora.<br>
			<a href="0004_appuntamenti_vend.php" style="color:red">Ricarica</a>');
		}*/
		else if (htmlentities($_REQUEST["SOTTO_STATO"], ENT_QUOTES) == 'NETTO-PENDING_DA_RICHIAMARE' && htmlentities($_REQUEST["DATA_RIFIX"], ENT_QUOTES) == '')
		{
			die('Feedback errato.<br>
			APPUNTAMENTO PENDING. Devi comunicare data e ora.<br>
			<a href="0004_appuntamenti_vend.php" style="color:red">Ricarica</a>');
		}
		else if (htmlentities($_REQUEST["SOTTO_STATO"], ENT_QUOTES) == 'NETTO-PENDING_GIA_FISSATO' && htmlentities($_REQUEST["DATA_RIFIX"], ENT_QUOTES) == '')
		{
			die('Feedback errato.<br>
			APPUNTAMENTO PENDING. Devi comunicare data e ora.<br>
			<a href="0004_appuntamenti_vend.php" style="color:red">Ricarica</a>');
		}

		// definisco le variabili

		$sva_stato_sottostato = htmlentities($_REQUEST["SOTTO_STATO"], ENT_QUOTES);
		$arr = explode("-", $sva_stato_sottostato);
		$SVA_STATO = $arr[0];
		$SVA_SOTTO_STATO = $arr[1];
		$PDA_TOT = htmlentities($_REQUEST["PDA_RES"], ENT_QUOTES) + htmlentities($_REQUEST["PDA_SHP"], ENT_QUOTES);
		if (isset ($_REQUEST["DATA_RIFIX"]))
		{$RIFIX = htmlentities($_REQUEST["DATA_RIFIX"], ENT_QUOTES);}
		else
		{$RIFIX = 0;}

		mysql_connect(DBURI ,DBUSER ,DBPASS);
		mysql_select_db(DBNAME);

		/*
		???????????????????????????????????????????????????????????????????????????????????
		se da richiamare di nuovo scrivo altra riga su 'app_png' e aggiorno solo la data
		???????????????????????????????????????????????????????????????????????????????????
		*/
		
		if ($SVA_SOTTO_STATO == 'PENDING_DA_RICHIAMARE')
		{
		
		//SCRIVO SOLO SU APP_PNG
			
		$queryP="INSERT into `appuntamenti_png` 
		(
		ID_AGENTE,
		ID_APPUNTAMENTO,
		OPERATORE_FRONT,
		DATA,
		ORA_INIZIO,
		ID_CLIENTE,
		INFO_CLIENTE,
		DESCRIZIONE_SGU,
		MACRO_ATTIVITA,
		CAMPAGNA,
		STATO,
		ESITO,
		NOTE,
		SVA_TIMESTAMP,
		SVA_STATO,
		SVA_SOTTO_STATO,
		SVA_DATA_RIFIX,
		TOT_PDA,
		PDA_RES,
		PDA_SHP,
		SVA_SIM,
		SVA_NOTE,
		FEEDBACK
		)
		values
		(
		'" . htmlentities($_REQUEST["ID_AGENTE"], ENT_QUOTES) . "',
		'" . htmlentities($_REQUEST["ID_APPUNTAMENTO"], ENT_QUOTES) . "',
		'" . htmlentities($_REQUEST["OPERATORE_FRONT"], ENT_QUOTES) . "',
		'" . htmlentities($_REQUEST["DATA"], ENT_QUOTES) . "',
		'" . htmlentities($_REQUEST["ORA_INIZIO"], ENT_QUOTES) . "',
		'" . htmlentities($_REQUEST["ID_CLIENTE"], ENT_QUOTES) . "',
		'" . htmlentities($_REQUEST["INFO_CLIENTE"], ENT_QUOTES) . "',
		'" . htmlentities($_REQUEST["DESCRIZIONE_SGU"], ENT_QUOTES) . "',
		'" . htmlentities($_REQUEST["MACRO_ATTIVITA"], ENT_QUOTES) . "',
		'" . htmlentities($_REQUEST["CAMPAGNA"], ENT_QUOTES) . "',
		'" . htmlentities($_REQUEST["STATO"], ENT_QUOTES) . "',
		'" . htmlentities($_REQUEST["ESITO"], ENT_QUOTES) . "',
		'" . htmlentities($_REQUEST["NOTE"], ENT_QUOTES) . "',
		NOW(),
		'" . $SVA_STATO . "',
		'" . $SVA_SOTTO_STATO . "',
		'" . $RIFIX . "',
		'" . $PDA_TOT . "',
		'" . htmlentities($_REQUEST["PDA_RES"], ENT_QUOTES) . "',
		'" . htmlentities($_REQUEST["PDA_SHP"], ENT_QUOTES) . "',
		'" . htmlentities($_REQUEST["SVA_SIM"], ENT_QUOTES) . "',
		'" . htmlentities($_REQUEST["SVA_NOTE"], ENT_QUOTES) . "',
		'Y'
		);";

		/**/
		echo '<pre>';
		var_dump($queryP);
		echo '</pre>';
		/**/

		$res = mysql_query($queryP) or die("Query non valida: " . mysql_error());

		/*
		if ($res)
		{echo"<br><br>FEEDBACK OK<br><br>";}
		else
		{ echo '<br><br><span style="color:red">MySQL Error: ' .mysql_error(). '</span><br><br>';}
		*/
		
		}		
		
		/*
		???????????????????????????????????????????????????????????????????????????????????
		diversamente aggiorno lo stato sia su 'appunt_png' (in modo da non tirarlo più fuori)
		che su 'appunt' (in modo da darne visibilità ad OX)
		???????????????????????????????????????????????????????????????????????????????????
		*/
		
		else
		{	
			// SCRIVO SU APP_PNG
			
			$queryP2="INSERT into `appuntamenti_png` 
			(
			ID_AGENTE,
			ID_APPUNTAMENTO,
			OPERATORE_FRONT,
			DATA,
			ORA_INIZIO,
			ID_CLIENTE,
			INFO_CLIENTE,
			DESCRIZIONE_SGU,
			MACRO_ATTIVITA,
			CAMPAGNA,
			STATO,
			ESITO,
			NOTE,
			SVA_TIMESTAMP,
			SVA_STATO,
			SVA_SOTTO_STATO,
			SVA_DATA_RIFIX,
			TOT_PDA,
			PDA_RES,
			PDA_SHP,
			SVA_SIM,
			SVA_NOTE,
			FEEDBACK
			)
			values
			(
			'" . htmlentities($_REQUEST["ID_AGENTE"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["ID_APPUNTAMENTO"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["OPERATORE_FRONT"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["DATA"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["ORA_INIZIO"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["ID_CLIENTE"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["INFO_CLIENTE"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["DESCRIZIONE_SGU"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["MACRO_ATTIVITA"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["CAMPAGNA"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["STATO"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["ESITO"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["NOTE"], ENT_QUOTES) . "',
			NOW(),
			'" . $SVA_STATO . "',
			'" . $SVA_SOTTO_STATO . "',
			'" . $RIFIX . "',
			'" . $PDA_TOT . "',
			'" . htmlentities($_REQUEST["PDA_RES"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["PDA_SHP"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["SVA_SIM"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["SVA_NOTE"], ENT_QUOTES) . "',
			'Y'
			);";
	
			/**/
			echo '<pre>queryP2: ';
			var_dump($queryP2);
			echo '</pre>';
			/**/
	
			$res = mysql_query($queryP2) or die("Query non valida: " . mysql_error());
			
			/*
			if ($res)
			{echo"<br><br>FEEDBACK OK<br><br>";}
			else
			{ echo '<br><br><span style="color:red">MySQL Error: ' .mysql_error(). '</span><br><br>';}
			*/

			// SCRIVO SU APP

			$queryP3="INSERT into `appuntamenti` 
			(
			ID_AGENTE,
			ID_APPUNTAMENTO,
			OPERATORE_FRONT,
			DATA,
			ORA_INIZIO,
			ID_CLIENTE,
			INFO_CLIENTE,
			DESCRIZIONE_SGU,
			MACRO_ATTIVITA,
			CAMPAGNA,
			STATO,
			ESITO,
			NOTE,
			SVA_TIMESTAMP,
			SVA_STATO,
			SVA_SOTTO_STATO,
			SVA_DATA_RIFIX,
			TOT_PDA,
			PDA_RES,
			PDA_SHP,
			SVA_SIM,
			SVA_NOTE,
			FEEDBACK
			)
			values
			(
			'" . htmlentities($_REQUEST["ID_AGENTE"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["ID_APPUNTAMENTO"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["OPERATORE_FRONT"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["DATA"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["ORA_INIZIO"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["ID_CLIENTE"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["INFO_CLIENTE"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["DESCRIZIONE_SGU"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["MACRO_ATTIVITA"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["CAMPAGNA"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["STATO"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["ESITO"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["NOTE"], ENT_QUOTES) . "',
			NOW(),
			'" . $SVA_STATO . "',
			'" . $SVA_SOTTO_STATO . "',
			'" . $RIFIX . "',
			'" . $PDA_TOT . "',
			'" . htmlentities($_REQUEST["PDA_RES"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["PDA_SHP"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["SVA_SIM"], ENT_QUOTES) . "',
			'" . htmlentities($_REQUEST["SVA_NOTE"], ENT_QUOTES) . "',
			'Y'
			);";
	
			/**/
			echo '<pre>queryP3: ';
			var_dump($queryP3);
			echo '</pre>';
			/**/
	
			$res = mysql_query($queryP3) or die("Query non valida: " . mysql_error());

			/*
			if ($res)
			{echo"<br><br>FEEDBACK OK<br><br>";}
			else
			{ echo '<br><br><span style="color:red">MySQL Error: ' .mysql_error(). '</span><br><br>';}
			*/

		}	// chiudo pending
	}		// chiudo if request feedback
?>
