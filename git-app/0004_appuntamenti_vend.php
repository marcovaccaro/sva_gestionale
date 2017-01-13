<?php
include_once("top.php");
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        	<h1 class="page-header">Gestione Appuntamenti</h1>
        </div>

		<div class="col-lg-12">

<?php
// request autoprodotte
include("0004_appuntamenti_vend_request_autoprodotte.php");
?>


<?php
// request feedback
include("0004_appuntamenti_vend_request_feedback.php");
?>

<?php
// request feedback pending
include("0004_appuntamenti_vend_request_feedback_pending.php");
?>

<div class="panel panel-default">
<div class="panel-heading">
Riepilogo Pending (Da Richiamare)</div><div class="panel-body">

<?
		// mostro i pending:
		
		mysql_connect(DBURI ,DBUSER ,DBPASS);
		mysql_select_db(DBNAME);
		
		$query="
SELECT * FROM `appuntamenti_png` 
WHERE 
ID_AGENTE = '".$_SESSION["crm_id"]. "' 
AND ID IN ( SELECT MAX(ID) FROM `appuntamenti_png` GROUP BY ID_APPUNTAMENTO ) 
AND `SVA_SOTTO_STATO`='PENDING_DA_RICHIAMARE' 
AND `FEEDBACK`='Y' 
ORDER BY `appuntamenti_png`.`SVA_TIMESTAMP` DESC ;
		";
		
		// INTERVAL 1 DAY = VEDO OGGI E IERI
		
		echo '
		<pre>' . $query . '</pre>
		<!--/div>
		<div class="panel-body"-->
		';

		$res = mysql_query($query);
		if ($res && mysql_num_rows($res)>0)
		{

		$displayP = 0;
		while($row=mysql_fetch_assoc($res))
			{
				$displayP=$displayP+1;

				echo '
				<i><b>FEEDBACK DEL: </b>' . $row['SVA_TIMESTAMP'] . '</i></br>
				<b>APPUNTAMENTO DEL: </b>' . $row['DATA'] . ' - ' . $row['ORA_INIZIO'] . ' // 
				<b>ID_APPUNTAMENTO: </b>' . $row['ID_APPUNTAMENTO'] . ' //
				<b>ID_CLIENTE: </b>' . $row['ID_CLIENTE'] . '</br>
				<b>INFO_CLIENTE</th>: </b>' . substr($row['INFO_CLIENTE'],0,50) . '... 
				</br>
				<p style="margin-top: 10px;"><b>STATO: <span style="color:red">' . $row['SVA_SOTTO_STATO'] . '</b></span> il <span style="color:red"><b>' . $row['SVA_DATA_RIFIX'] . '</b></span> //
				<b>NOTE: </b>' . substr($row['SVA_NOTE'],0,50) . '...</p>';

				/*modal*/
				if ($row['FEEDBACK'] == 'Y') { echo '
				
				<!-- Trigger the modal with a button -->
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal'.$row['ID'].'">Gestisci</button>
				
				<!-- Modal -->
				<div id="myModal'.$row['ID'].'" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				
					<!-- Modal content-->
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Gestione Pending</h4>
						<!--p>se da richiamare di nuovo scrivo altra riga su \'app_png\' e aggiorno solo la data</p>
						<p>diversamente aggiorno lo stato sia su \'app_png\' (in modo da non tirarlo più fuori) che su \'app\' (in modo da darne visibilità ad OX)</p-->
					  </div>
					  <div class="modal-body">
				
				<!--div class="col-lg-5"-->
				
				<script language="javascript"> 
					function toggleMe(obj, a){ 
					  var e=document.getElementById(a); 
					  if(obj=="NETTO-PENDING_DA_RICHIAMARE" || obj=="NETTO-PENDING_GIA_FISSATO"){ 
						e.style.display="block"; 
					  }else{ 
					e.style.display="none"; 
				} 
					} 
				</script>
				
				<form name="myFormP" class="form-horizontal" role="form" action="#" method="GET">
				<fieldset>
				
				<input type="hidden" name="ID_AGENTE" value="'. $row['ID_AGENTE'] .'">
				<input type="hidden" name="ID_APPUNTAMENTO" value="'. $row['ID_APPUNTAMENTO'] .'">
				<input type="hidden" name="OPERATORE_FRONT" value="'. $row['OPERATORE_FRONT'] .'">
				<input type="hidden" name="DATA" value="'. $row['DATA'] .'">
				<input type="hidden" name="ORA_INIZIO" value="'. $row['ORA_INIZIO'] .'">
				<input type="hidden" name="ID_CLIENTE" value="'. $row['ID_CLIENTE'] .'">
				<input type="hidden" name="INFO_CLIENTE" value="'. $row['INFO_CLIENTE'] .'">
				<input type="hidden" name="DESCRIZIONE_SGU" value="'. $row['DESCRIZIONE_SGU'] .'">
				<input type="hidden" name="MACRO_ATTIVITA" value="'. $row['MACRO_ATTIVITA'] .'">
				<input type="hidden" name="CAMPAGNA" value="'. $row['CAMPAGNA'] .'">
				<input type="hidden" name="STATO" value="'. $row['STATO'] .'">
				<input type="hidden" name="ESITO" value="'. $row['ESITO'] .'">
				<input type="hidden" name="NOTE" value="'. $row['NOTE'] .'">
				
				<div class="form-group">
					<label class="control-label col-sm-3" for="Stato">Esito:</label>
					<div class="col-sm-9">
					<select name="SOTTO_STATO" id="SOTTO_STATO" class="form-control" onchange="toggleMe(this.options[this.selectedIndex].value, \'display'.$displayP.'\')">
					<option value="">Seleziona</option>
					<option value="NETTO-PENDING_DA_RICHIAMARE">NETTO-PENDING (Da Richiamare)</option>
					<option value="NETTO-PENDING_GIA_FISSATO">NETTO-PENDING (Fissato)</option>
					<option value="NETTO-NON_INTERESSATO">NETTO-NON INTERESSATO</option>
					<option value="PDA-">PDA</option>
					</select>
					</div>
				</div>
				
<!--div class="form-group">
<label class="control-label col-sm-3" for="DATA_RIFIX"><i style="color:red">DATA/ORA:</i></label>
<div class="col-sm-9">
<input type="datetime-local" name="DATA_RIFIX" id="DATA_RIFIX" class="form-control">
</div>
</div-->

<!-- mio -->
            <div class="form-group" id="display'.$displayP.'" style="display: none;">
                <label for="DATA_RIFIXp" class="control-label col-sm-3"><i style="color:red">DATA/ORA:</i></label>
                <div class="input-group date form_datetime col-md-6" data-date="" data-date-format="dd MM yyyy - HH:ii" data-link-field="DATA_RIFIXp'.$displayP.'" data-link-format="yyyy-mm-ddThh:ii">
                    <input class="form-control" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="DATA_RIFIXp'.$displayP.'" name="DATA_RIFIX" value="" /><br/>
            </div>
<!-- /mio -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="PDA RES">PDA RES:</label>
					<div class="col-sm-9">
					<select name="PDA_RES" id="PDA_RES" class="form-control">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-3" for="PDA SHP">PDA SHP:</label>
					<div class="col-sm-9">
					<select name="PDA_SHP" id="PDA_SHP" class="form-control">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-3" for="SIM">SIM:</label>
					<div class="col-sm-9">
					<select name="SVA_SIM" id="SVA_SIM" class="form-control">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-3" for="Note">Note:</label>
					<div class="col-sm-9">
					<textarea class="form-control" rows="5" name="SVA_NOTE" id="SVA_NOTE"></textarea>
					</div>
				</div>
				
				<div class="form-group"> 
					<div class="col-sm-offset-3 col-sm-9">
					<input type="submit" name="feedbackP" value="feedbackP" class="btn btn-default"
					onclick="return(confirm(\'Confermi il feedback?\'))">
					<!--button type="submit" name="feedback" value="feedback" class="btn btn-default">Aggiorna</button-->
					</div>
				</div>
				
				</fieldset>
				</form>
				<!--/div-->
				
				<!--p>update</br>
				</br>SVA_STATO: '. $row['SVA_STATO'] . '
				</br>SVA_SOTTO_STATO: '. $row['SVA_SOTTO_STATO'] . '
				</br>PDA_RES: '. $row['PDA_RES'] . '
				</br>PDA_SHP: '. $row['PDA_SHP'] . '
				</br>SVA_SIM: '. $row['SVA_SIM'] . '
				</br>SVA_NOTE: '. $row['SVA_NOTE'] . '</br></br>
				
				where id riga = '. $row['ID'] . ' (campo hidden del form)
				</p-->
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					  </div>
					</div>
				
				  </div>
				</div>
				';
				}
				/*modal*/
				echo '<hr/>
				';
			}
		}

		// fine mostro i pending:

?>

        </div>
        <div class="panel-footer">
        </div>
    </div>

<div class="row">
<div class="col-lg-5">
<div class="panel panel-default">
    <div class="panel-heading">
    Autoprodotte</div><div class="panel-body">

<form action="#" method="get" class="form-horizontal">
<fieldset>
<input type="hidden" name="ID_AGENTE" value="<? echo $_SESSION['crm_id']; ?>">
<div class="form-group">
	<label class="control-label col-sm-3" for="DATA">DATA:</label>
	<div class="col-sm-9">
<select name="periodo" id="periodo" class="form-control">
<option value="<? echo date('Y/m/d'); ?>" <? if ($periodo == date('Y/m/d')) echo 'selected="selected"'; ?>>
<? echo date('d/m/Y'); ?></option>
<option value="<? echo date('Y/m/d', strtotime('-1 day')); ?>"
<? if ($periodo == date('Y/m/d', strtotime('-1 day'))) echo 'selected="selected"'; ?>>
<? echo date('d/m/Y', strtotime('-1 day')); ?></option>

<option value="<? echo date('Y/m/d', strtotime('-2 day')); ?>"
<? if ($periodo == date('Y/m/d', strtotime('-2 day'))) echo 'selected="selected"'; ?>>
<? echo date('d/m/Y', strtotime('-2 day')); ?></option>

<option value="<? echo date('Y/m/d', strtotime('-3 day')); ?>"
<? if ($periodo == date('Y/m/d', strtotime('-3 day'))) echo 'selected="selected"'; ?>>
<? echo date('d/m/Y', strtotime('-3 day')); ?></option>

<option value="<? echo date('Y/m/d', strtotime('-4 day')); ?>"
<? if ($periodo == date('Y/m/d', strtotime('-4 day'))) echo 'selected="selected"'; ?>>
<? echo date('d/m/Y', strtotime('-4 day')); ?></option>

<option value="<? echo date('Y/m/d', strtotime('-5 day')); ?>"
<? if ($periodo == date('Y/m/d', strtotime('-5 day'))) echo 'selected="selected"'; ?>>
<? echo date('d/m/Y', strtotime('-5 day')); ?></option>

<option value="<? echo date('Y/m/d', strtotime('-6 day')); ?>"
<? if ($periodo == date('Y/m/d', strtotime('-6 day'))) echo 'selected="selected"'; ?>>
<? echo date('d/m/Y', strtotime('-6 day')); ?></option>

<option value="<? echo date('Y/m/d', strtotime('-7 day')); ?>"
<? if ($periodo == date('Y/m/d', strtotime('-7 day'))) echo 'selected="selected"'; ?>>
<? echo date('d/m/Y', strtotime('-7 day')); ?></option>

<option value="<? echo date('Y/m/d', strtotime('-8 day')); ?>"
<? if ($periodo == date('Y/m/d', strtotime('-8 day'))) echo 'selected="selected"'; ?>>
<? echo date('d/m/Y', strtotime('-8 day')); ?></option>

<option value="<? echo date('Y/m/d', strtotime('-9 day')); ?>"
<? if ($periodo == date('Y/m/d', strtotime('-9 day'))) echo 'selected="selected"'; ?>>
<? echo date('d/m/Y', strtotime('-9 day')); ?></option>

<option value="<? echo date('Y/m/d', strtotime('-10 day')); ?>"
<? if ($periodo == date('Y/m/d', strtotime('-10 day'))) echo 'selected="selected"'; ?>>
<? echo date('d/m/Y', strtotime('-10 day')); ?></option>

</select>
</div>
</div>
<div class="form-group">
	<label class="control-label col-sm-3" for="PDA RES">PDA RES:</label>
	<div class="col-sm-9">
	<select name="PDA_RES" id="PDA_RES" class="form-control">
	<option value="0">0</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	</select>
	</div>
</div>

<div class="form-group">
	<label class="control-label col-sm-3" for="PDA SHP">PDA SHP:</label>
	<div class="col-sm-9">
	<select name="PDA_SHP" id="PDA_SHP" class="form-control">
	<option value="0">0</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	</select>
	</div>
</div>
<div class="form-group"> 
    <div class="col-sm-offset-3 col-sm-9">
	<input type="submit" name="inserisci" value="inserisci" class="btn btn-default">
	</div>
</div>
</fieldset>
</form>

    </div>
    <div class="panel-footer">
    </div>
    </div>
    
    </div>
    <div class="col-lg-7">
    <h4>AUTOPRODOTTE: <? echo MESEP.' '.ANNO; ?></h4>

<?
$query="
SELECT * FROM `autoprodotte`
WHERE
ID_AGENTE = '".$_SESSION["crm_id"]. "'
AND MONTH(DATA) = ".(int)date("m")."
AND YEAR(DATA) = ".ANNO."
ORDER BY DATA DESC;
";
		/**/
		echo '<pre>';
		var_dump($query);
		echo '</pre>';
		/**/

		$res = mysql_query($query) or die("Query non valida: " . mysql_error());

		if ($res && mysql_num_rows($res)>0)
		{
		while($row=mysql_fetch_assoc($res))
			{
				echo '' . $row['DATA'] . ': ' . $row['PDA_RES'] . ' RES - ' . $row['PDA_SHP'] . ' SHP<br>';
			}
		}
?>

    </div>
    </div>



<!-- tabs -->
<div class="panel panel-default">
                        <div class="panel-heading">
                            Appuntamenti
                        </div>
                        <!-- .panel-heading -->

<div class="panel-body">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Da Gestire</a></li>
    <li><a data-toggle="tab" href="#menu1">Già gestiti (Oggi)</a></li>
    <!--li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
    <li><a data-toggle="tab" href="#menu3">Menu 3</a></li-->
  </ul>

  <div class="tab-content" style="margin-top:20px">
    <div id="home" class="tab-pane fade in active">

<?
// mostro tutti quelli ancora da feedbackare

mysql_connect(DBURI ,DBUSER ,DBPASS);
mysql_select_db(DBNAME);

/* V1
$query="
SELECT * FROM `appuntamenti`
GROUP BY ID_APPUNTAMENTO
WHERE
ID_AGENTE = '".$_SESSION["crm_id"]. "'
AND SVA_STATO = 'LORDO'
ORDER BY `appuntamenti`.`SVA_TIMESTAMP` ASC;";
*/

/*
questa è ok ma tira fuori il primo record che trova (il più vecchio invece dell'ultimo)

$query="
SELECT * FROM `appuntamenti`
WHERE
ID_AGENTE = '".$_SESSION["crm_id"]. "'
AND SVA_STATO = 'LORDO'
GROUP BY ID_APPUNTAMENTO
";
*/

/*
forse ci siamo: https://paulund.co.uk/get-last-record-in-each-mysql-group

SELECT id, category_id, post_title
FROM posts
WHERE id IN (
    SELECT MAX(id)
    FROM posts
    GROUP BY category_id
);
*/

//QUESTA è ok tira fuori l'ultimo (da controllare)

$query="
SELECT * FROM `appuntamenti`
WHERE
ID_AGENTE = '".$_SESSION["crm_id"]. "'
AND SVA_STATO = 'LORDO'
AND SVA_SOTTO_STATO = 'ASSEGNATO'
AND ID IN (
    SELECT MAX(ID)
    FROM `appuntamenti`
    GROUP BY ID_APPUNTAMENTO
);
";

		/**/
		echo '<pre>';
		var_dump($query);
		echo '</pre>';
		/**/

		$res = mysql_query($query) or die("Query non valida: " . mysql_error());

		if ($res && mysql_num_rows($res)>0)
		{
		$display = 0;
		while($row=mysql_fetch_assoc($res))
			{
				$display=$display+1;
				echo '<div class="row"> <div class="col-lg-7" style="text-transform: uppercase;">';
				/*echo '<span style="color:red"><b>SVA_TIMESTAMP:</b> ' . $row['SVA_TIMESTAMP'] . '</br>';
				echo '<b>SVA_STATO:</b> ' . $row['SVA_STATO'] . '</br>';
				echo '<b>SVA_SOTTO_STATO:</b> ' . $row['SVA_SOTTO_STATO'] . '</span>';*/
				echo '<h3><b>DATA:</b> ' . $row['DATA'] . ' ';
				echo '<b>ORA:</b> ' . $row['ORA_INIZIO'] . '</h3>';
				//echo '<tr><td>' . $row['ID'] . '</td>';
				//echo 'ID:</b> ' . $row['ID'] . '</br>';
				//echo '<span style="color:red"><b>ID_AGENTE:</b> ' . $row['ID_AGENTE'] . '</span></br>';
				echo '<b>ID_APPUNTAMENTO:</b> ' . $row['ID_APPUNTAMENTO'] . '</br>';
				//echo 'OPERATORE_FRONT:</b> ' . $row['OPERATORE_FRONT'] . '</br>';
				echo '<b>ID_CLIENTE:</b> ' . $row['ID_CLIENTE'] . '</br></br>';
				echo '<b>INFO_CLIENTE:</b> ' . $row['INFO_CLIENTE'] . '</br>';
				echo '<b>DESCRIZIONE_SGU:</b> ' . $row['DESCRIZIONE_SGU'] . '</br>';
				echo '<b>MACRO_ATTIVITA:</b> ' . $row['MACRO_ATTIVITA'] . '</br>';
				echo '<b>CAMPAGNA:</b> ' . $row['CAMPAGNA'] . '</br></br>';
				echo '<b>STATO:</b> ' . $row['STATO'] . '</br>';
				//echo '<b>ESITO:</b> ' . $row['ESITO'] . '</br></br>';
				//echo '<b>NOTE:</b> ' . substr($row['NOTE'],0,100) . '...</br></br>';
				echo '<b>NOTE:</b> ' . $row['NOTE'] . '</br></br>';
				//echo '<b>SVA_SEGMENTO:</b> ' . $row['SVA_SEGMENTO'] . '</br>';
				//echo '<b>SVA_SIM:</b> ' . $row['SVA_SIM'] . '</br></br>';
				echo '</div>';

				echo '<div class="col-lg-5">

<script language="javascript"> 
    function toggleMeFeed(obj, a){ 
      var d=document.getElementById(a); 
      if(obj=="LORDO-SPOSTATO" || obj=="NETTO-PENDING_DA_RICHIAMARE" || obj=="NETTO-PENDING_GIA_FISSATO"){ 
        d.style.display="block"; 
      }else{ 
    d.style.display="none"; 
} 
    } 
</script>

<form name="myForm" class="form-horizontal" role="form" action="#" method="GET">
<fieldset>

<input type="hidden" name="ID_AGENTE" value="'. $row['ID_AGENTE'] .'">
<input type="hidden" name="ID_APPUNTAMENTO" value="'. $row['ID_APPUNTAMENTO'] .'">
<input type="hidden" name="OPERATORE_FRONT" value="'. $row['OPERATORE_FRONT'] .'">
<input type="hidden" name="DATA" value="'. $row['DATA'] .'">
<input type="hidden" name="ORA_INIZIO" value="'. $row['ORA_INIZIO'] .'">
<input type="hidden" name="ID_CLIENTE" value="'. $row['ID_CLIENTE'] .'">
<input type="hidden" name="INFO_CLIENTE" value="'. $row['INFO_CLIENTE'] .'">
<input type="hidden" name="DESCRIZIONE_SGU" value="'. $row['DESCRIZIONE_SGU'] .'">
<input type="hidden" name="MACRO_ATTIVITA" value="'. $row['MACRO_ATTIVITA'] .'">
<input type="hidden" name="CAMPAGNA" value="'. $row['CAMPAGNA'] .'">
<input type="hidden" name="STATO" value="'. $row['STATO'] .'">
<input type="hidden" name="ESITO" value="'. $row['ESITO'] .'">
<input type="hidden" name="NOTE" value="'. $row['NOTE'] .'">

<div class="form-group">
	<label class="control-label col-sm-3" for="Stato">Esito:</label>
	<div class="col-sm-9">
	<select name="SOTTO_STATO" id="SOTTO_STATO" class="form-control" onchange="toggleMeFeed(this.options[this.selectedIndex].value, \'displayFeed'.$display.'\')">
	<option value="">Seleziona</option>
	<option value="LORDO-RIFIX">LORDO-DA RIFISSARE</option>
	<option value="LORDO-SPOSTATO">LORDO-SPOSTATO</option>
	<option value="LORDO-ASSENTE">LORDO-ASSENTE</option>
	<option value="LORDO-DISDETTO">LORDO-DISDETTO</option>
	<option value="LORDO-DISDETTO_DA_UFFICIO">LORDO-DISDETTO DALL\'UFFICIO</option>
	<option value="LORDO-NON_RICEVUTO">LORDO-NON RICEVUTO</option>
	<option value="NETTO-PENDING_DA_RICHIAMARE">NETTO-PENDING (Da Richiamare)</option>
	<option value="NETTO-PENDING_GIA_FISSATO">NETTO-PENDING (Gia Fissato)</option>
	<option value="NETTO-NON_INTERESSATO">NETTO-NON INTERESSATO</option>
	<option value="NETTO-ET_VINCOLATO">NETTO-ERRORE TELEMARKETING (Vincolato)</option>
	<option value="NETTO-ET_BASSOSPEND">NETTO-ERRORE TELEMARKETING (Basso Spendente)</option>
	<option value="PDA-">PDA</option>
	</select>
	</div>
</div>

<!--div class="form-group" id="displayFeed'.$display.'" style="display: none;">
	<label class="control-label col-sm-3" for="DATA_RIFIX"><i style="color:red">DATA/ORA:</i></label>
	<div class="col-sm-9">
	<input type="datetime-local" name="DATA_RIFIX" id="DATA_RIFIX" class="form-control">
	</div>
</div-->

<!-- mio -->
            <div class="form-group" id="displayFeed'.$display.'" style="display: none;">
                <label for="DATA_RIFIX" class="control-label col-sm-3"><i style="color:red">DATA/ORA:</i></label>
                <div class="input-group date form_datetime col-md-6" data-date="" data-date-format="dd MM yyyy - HH:ii" data-link-field="DATA_RIFIX'.$display.'" data-link-format="yyyy-mm-ddThh:ii">
                    <input class="form-control" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="DATA_RIFIX'.$display.'" name="DATA_RIFIX" value="" /><br/>
            </div>
<!-- /mio -->

<div class="form-group">
	<label class="control-label col-sm-3" for="PDA RES">PDA RES:</label>
	<div class="col-sm-9">
	<select name="PDA_RES" id="PDA_RES" class="form-control">
	<option value="0">0</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	</select>
	</div>
</div>

<div class="form-group">
	<label class="control-label col-sm-3" for="PDA SHP">PDA SHP:</label>
	<div class="col-sm-9">
	<select name="PDA_SHP" id="PDA_SHP" class="form-control">
	<option value="0">0</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	</select>
	</div>
</div>

<div class="form-group">
	<label class="control-label col-sm-3" for="SIM">SIM:</label>
	<div class="col-sm-9">
	<select name="SVA_SIM" id="SVA_SIM" class="form-control">
	<option value="0">0</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	</select>
	</div>
</div>

<!--div class="form-group">
	<label class="control-label col-sm-3" for="Segmento">Seg:</label>
	<div class="col-sm-9">
	<select name="segmento" id="segmento" class="form-control">
	<option value="seleziona">Seleziona</option>
	<option value="1">SHP</option>
	<option value="2">RES</option>
	</select>
	</div>
</div-->

<div class="form-group">
	<label class="control-label col-sm-3" for="Note">Note:</label>
	<div class="col-sm-9">
	<textarea class="form-control" rows="5" name="SVA_NOTE" id="SVA_NOTE"></textarea>
	</div>
</div>

<div class="form-group"> 
    <div class="col-sm-offset-3 col-sm-9">
	<input type="submit" name="feedback" value="feedback" class="btn btn-default"
	onclick="return(confirm(\'Confermi il feedback?\'))">
	<!--button type="submit" name="feedback" value="feedback" class="btn btn-default">Aggiorna</button-->
	</div>
</div>

</fieldset>
</form>
				</div>
</div>
<hr style="clear:both;"/>

';

			}
		}
?>
    </div>
    <div id="menu1" class="tab-pane fade">
<?

// mostro gli appuntamenti feedbackati oggi:

mysql_connect(DBURI ,DBUSER ,DBPASS);
mysql_select_db(DBNAME);

$query="
SELECT * FROM `appuntamenti` 
WHERE 
ID_AGENTE = '".$_SESSION["crm_id"]. "' 
AND DATE_SUB(CURDATE(),INTERVAL 0 DAY) <= SVA_TIMESTAMP 
AND ID IN ( SELECT MAX(ID) FROM `appuntamenti` GROUP BY ID_APPUNTAMENTO ) 
AND `FEEDBACK`='Y' 
ORDER BY `appuntamenti`.`SVA_TIMESTAMP` DESC ;
";

// INTERVAL 1 DAY = VEDO OGGI E IERI

echo '<pre>' . $query . '</pre>';


		$res = mysql_query($query);
		if ($res && mysql_num_rows($res)>0)
		{
		while($row=mysql_fetch_assoc($res))
			{
				echo '
				<i><b>FEEDBACK DEL: </b>' . $row['SVA_TIMESTAMP'] . '</i></br>
				<b>DATA/ORA: </b>' . $row['DATA'] . ' - ' . $row['ORA_INIZIO'] . ' // 
				<b>ID_APPUNTAMENTO: </b>' . $row['ID_APPUNTAMENTO'] . ' //
				<b>ID_CLIENTE: </b>' . $row['ID_CLIENTE'] . '</br>
				<b>INFO_CLIENTE</th>: </b>' . substr($row['INFO_CLIENTE'],0,50) . '... 
				</br>
				<p style="margin-top: 10px; color:green"><b>STATO: </b>' . $row['SVA_STATO'] . ' //
				<b>SOTTO/STATO: </b>' . $row['SVA_SOTTO_STATO'] . ' //
				<b>PDA_RES: </b>' . $row['PDA_RES'] . ' //
				<b>PDA_SHP: </b>' . $row['PDA_SHP'] . ' //
				<b>PDA_TOT: </b>' . $row['TOT_PDA'] . ' //
				<b>SIM: </b>' . $row['SVA_SIM'] . ' //
				<b>NOTE: </b>' . substr($row['SVA_NOTE'],0,50) . '...</p>
				<hr/>
				';
			}
		}

?>

    </div>
    <!--div id="menu2" class="tab-pane fade">
    </div>
    <div id="menu3" class="tab-pane fade">
    </div-->
  </div>
</div>
   <div class="panel-footer">
                    </div>                     
                        
                        </div>
                        <!--/div-->
                        <!-- .panel-body -->
                        
                    <!--/div-->
<!-- /tabs -->


     
     </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->


<?php include_once("bottom.php"); ?>