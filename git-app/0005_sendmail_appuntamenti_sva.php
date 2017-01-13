<?php
include_once("top.php");
include_once("libreria_php/allowed_1.php");
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">Mail Appuntamenti</h1>
<?
	if (isset ($_REQUEST["mail"]) && $_REQUEST["mail"]=="mail")
	{		

		$agente_mail = htmlentities($_REQUEST["agente"], ENT_QUOTES);
		$arr = explode("/", $agente_mail);
		$agente = $arr[0];
		$mail = $arr[1];

		$periodo = htmlentities($_REQUEST["periodo"], ENT_QUOTES);
		/*if ($agente == "tutti") {$queryFiltraAgente = "";}
		else {$queryFiltraAgente = " `ID_AGENTE` = '".$agente."' AND ";}*/
		mysql_connect(DBURI ,DBUSER ,DBPASS);
		mysql_select_db(DBNAME);
				
		$query =
		"
		SELECT * FROM `appuntamenti`
		WHERE
		`ID_AGENTE` = '".$agente."' 
		AND SVA_STATO = 'LORDO'
		AND SVA_SOTTO_STATO = 'ASSEGNATO'
		
		AND 
		DATE_ADD(CURDATE(),INTERVAL ".$periodo." DAY) <= DATA 
		
		AND ID IN (
		SELECT MAX(ID)
		FROM `appuntamenti`
		GROUP BY ID_APPUNTAMENTO
		)
		ORDER BY `appuntamenti`.`DATA` ASC
		;
		";
		echo '<pre>';
		var_dump($query);
		echo '</pre>';
		/**/

		$res = mysql_query($query) or die("Query non valida: " . mysql_error());

		if ($res && mysql_num_rows($res)>0)
		{
		while($row=mysql_fetch_assoc($res))
			{
				$message = '<div style="text-transform: uppercase;">';
				$message .= '<h3><b>DATA:</b> ' . $row['DATA'] . ' ';
				$message .= '<b>ORA:</b> ' . $row['ORA_INIZIO'] . '</h3>';
				$message .= '<b>ID_AGENTE:</b> ' . $row['ID_AGENTE'] . '<br><br>';
				//$message .= '<b>ID_APPUNTAMENTO:</b> ' . $row['ID_APPUNTAMENTO'] . '<br>';
				//$message .= '<b>ID_CLIENTE:</b> ' . $row['ID_CLIENTE'] . '<br><br>';
				$message .= '<b>INFO_CLIENTE:</b> ' . $row['INFO_CLIENTE'] . '<br>';
				$message .= '<b>DESCRIZIONE_SGU:</b> ' . $row['DESCRIZIONE_SGU'] . '<br>';
				$message .= '<b>MACRO_ATTIVITA:</b> ' . $row['MACRO_ATTIVITA'] . '<br>';
				$message .= '<b>CAMPAGNA:</b> ' . $row['CAMPAGNA'] . '<br><br>';
				$message .= '<b>STATO:</b> ' . $row['STATO'] . '<br>';
				$message .= '<b>NOTE:</b> ' . $row['NOTE'] . '<br><br>';
				$message .= '</div>';
				//echo $message;
				$valori_array[] = $message;
			}
			//echo '<pre>';
			//var_dump($valori_array);
			//print_r($valori_array);
			/*foreach ($valori_array as &$value) {
			echo $value;
			}*/
			$corpo_mail = implode($valori_array);
			//echo '</pre>';
			
			/* ho il corpo della mail a questo punto posso costruire e spedire*/
			//echo 'corpo mail (array)<br><br>';
			//echo $corpo_mail;
			
			$to = $mail;
			$subject = "Appuntamenti SVA - ";
			
			
			if ($periodo == 0)
			{$subject .= date('d/m/Y');}
			else if ($periodo == 1)
			{$subject .= date('d/m/Y', strtotime('+1 day'));} 
			/**/
			
			$msg = $corpo_mail;
			
			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			
			// More headers
			$headers .= 'From: <oksana.dracheva@svasrl.eu>' . "\r\n";
			$headers .= 'Cc: oksana.dracheva@svasrl.eu' . "\r\n";
			$headers .= 'Cc: m4rcopale@gmail.com' . "\r\n";
			$headers .= 'Cc: carlo.huber@svasrl.eu' . "\r\n";
			
			$resultmail = mail($to,$subject,$msg,$headers);		
			
			if(!$resultmail)
			{ echo '<p style="color:red">Error: mail non inviata</p>'; }
			else
			{echo '<p style="color:green">Mail inviata a: '.$agente.' ('.$mail.')</p>';}
		
		}
		else {echo '<p style="color:red">Nessun appuntamento da inviare</p>';}
	}
	else
	{
	
	$agente= '';
	$periodo= '0';
	//$queryFiltraAgente = '';
echo '<p style="color:#333">Invia mail</p>';
	}
?>
        
        </div>
    
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                Filtra
                </div>
                <div class="panel-body">                             
                <form action="#" method="get">
                <fieldset>
                <div class="form-group">
                <label class="control-label" for="agente">Agente - mail</label>
                <select name="agente" id="agente" class="form-control">
                
                <!--
                1 leggo dalla tabella 'pro_user' gli utenti con 'JOIN_CRM' VALORIZZATO
                2 finchè ce n'è
                > creo >
                -->
                
                <?
                
                mysql_connect(DBURI ,DBUSER ,DBPASS);
                mysql_select_db(DBNAME);
                
                $sql = "SELECT JOIN_CRM, MAIL
                FROM pro_user
                WHERE JOIN_CRM != '' 
                ORDER BY  `pro_user`.`JOIN_CRM` ASC";
                $result = mysql_query($sql);
                
                if (!$result) {
                echo "DB Error - ";
                echo 'MySQL Error: ' . mysql_error();
                //exit;
                }
                
                while ($row = mysql_fetch_assoc($result))
                {
                echo '<option value="' . $row['JOIN_CRM'] . '/' . $row['MAIL'] . '"';
                
                if ($agente == $row['JOIN_CRM']) echo ' selected="selected"';
                echo '>' . $row['JOIN_CRM'] . ' - ' . $row['MAIL'] . "</option>\n";
                }
                
                ?>
                </select>
                </div>
                <div class="form-group">
                <label class="control-label" for="periodo">Periodo (dalla data selezionata in avanti):</label>
                <select name="periodo" id="periodo" class="form-control">
                <option value="7">
                <? echo date('d/m/Y', strtotime('+7 day')); ?></option>
                <option value="6">
                <? echo date('d/m/Y', strtotime('+6 day')); ?></option>
                <option value="5">
                <? echo date('d/m/Y', strtotime('+5 day')); ?></option>
                <option value="4">
                <? echo date('d/m/Y', strtotime('+4 day')); ?></option>
                <option value="3">
                <? echo date('d/m/Y', strtotime('+3 day')); ?></option>
                <option value="2">
                <? echo date('d/m/Y', strtotime('+2 day')); ?></option>
                <option value="1" selected="selected">
                <? echo date('d/m/Y', strtotime('+1 day')); ?> (domani)</option>
                <option value="0">
                <? echo date('d/m/Y'); ?> (oggi)</option>
                </select>
                </div>
                <input type="submit" name="mail" value="mail" class="btn btn-default">
                </fieldset>
                </form>
                </div>
            </div>
        </div>
    </div><!-- /.row -->
</div><!-- /#page-wrapper -->

<?php
include_once("bottom.php");
?>