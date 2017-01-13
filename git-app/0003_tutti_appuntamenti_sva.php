<?php
include_once("top.php");
include_once("libreria_php/allowed_1.php");
?>

<?
	if (isset ($_REQUEST["filtra"]) && $_REQUEST["filtra"]=="filtra")
	{

		/* ?????????????????? 
		if (htmlentities($_REQUEST["SOTTO_STATO"], ENT_QUOTES) == 'seleziona')
		{
			die('Feedback errato: <a href="0004_appuntamenti_vend.php" style="color:red">Ricarica</a>');
		}*/
		
		$agente = htmlentities($_REQUEST["agente"], ENT_QUOTES);
		$periodo = htmlentities($_REQUEST["periodo"], ENT_QUOTES);
		if ($agente == "tutti") {$queryFiltraAgente = "";}
		else {$queryFiltraAgente = " `ID_AGENTE` = '".$agente."' AND ";}
	}
	else
	{
	$agente= '';
	$periodo= '0';
	$queryFiltraAgente = '';
	}

/*
modifica feedback per OX da fare
if (isset ($_REQUEST["modal"]) && $_REQUEST["modal"]=="modal") {modifica riga}
*/

?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        	<h1 class="page-header">Vedi Appuntamenti</h1>
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
<select name="agente" id="agente" class="form-control">
<option value="tutti" <? if ($agente == '') echo 'selected="selected"'; ?>>Tutti gli Agenti</option>

<!--
1 leggo dalla tabella 'pro_user' gli utenti con 'JOIN_CRM' VALORIZZATO
2 finchè ce n'è
> creo >
-->

<?

mysql_connect(DBURI ,DBUSER ,DBPASS);
mysql_select_db(DBNAME);

$sql = "SELECT DISTINCT JOIN_CRM
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
echo '<option value="' . $row['JOIN_CRM'] . '"';

if ($agente == $row['JOIN_CRM']) echo ' selected="selected"';
echo '>' . $row['JOIN_CRM'] . "</option>\n";
}

?>

<!--option value="a_recall" <? if ($agente == 'a_recall') echo 'selected="selected"'; ?>>a_recall</option>
<option value="berni_sva_ge" <? if ($agente == 'berni_sva_ge') echo 'selected="selected"'; ?>>berni_sva_ge</option>
<option value="agente_sva_to_01" <? if ($agente == 'agente_sva_to_01') echo 'selected="selected"'; ?>>agente_sva_to_01</option>
<option value="garabello_sva_ge" <? if ($agente == 'garabello_sva_ge') echo 'selected="selected"'; ?>>garabello_sva_ge</option-->
</select>
</div>
<div class="form-group">
<label class="control-label" for="periodo">Periodo (dalla data selezionata in avanti):</label>
<select name="periodo" id="periodo" class="form-control">
<option value="0" <? if ($periodo == '0') echo 'selected="selected"'; ?>>
-00) <? echo date('d/m/Y'); ?></option>
<option value="1" <? if ($periodo == '1') echo 'selected="selected"'; ?>>
-01) <? echo date('d/m/Y', strtotime('-1 day')); ?></option>
<option value="2" <? if ($periodo == '2') echo 'selected="selected"'; ?>>
-02) <? echo date('d/m/Y', strtotime('-2 day')); ?></option>
<option value="3" <? if ($periodo == '3') echo 'selected="selected"'; ?>>
-03) <? echo date('d/m/Y', strtotime('-3 day')); ?></option>
<option value="4" <? if ($periodo == '4') echo 'selected="selected"'; ?>>
-04) <? echo date('d/m/Y', strtotime('-4 day')); ?></option>
<option value="5" <? if ($periodo == '5') echo 'selected="selected"'; ?>>
-05) <? echo date('d/m/Y', strtotime('-5 day')); ?></option>
<option value="6" <? if ($periodo == '6') echo 'selected="selected"'; ?>>
-06) <? echo date('d/m/Y', strtotime('-6 day')); ?></option>
<option value="7" <? if ($periodo == '7') echo 'selected="selected"'; ?>>
-07) <? echo date('d/m/Y', strtotime('-7 day')); ?></option>
<option value="8" <? if ($periodo == '8') echo 'selected="selected"'; ?>>
-08) <? echo date('d/m/Y', strtotime('-8 day')); ?></option>
<option value="9" <? if ($periodo == '9') echo 'selected="selected"'; ?>>
-09) <? echo date('d/m/Y', strtotime('-9 day')); ?></option>
<option value="10" <? if ($periodo == '10') echo 'selected="selected"'; ?>>
-10) <? echo date('d/m/Y', strtotime('-10 day')); ?></option>
<option value="11" <? if ($periodo == '11') echo 'selected="selected"'; ?>>
-11) <? echo date('d/m/Y', strtotime('-11 day')); ?></option>
<option value="12" <? if ($periodo == '12') echo 'selected="selected"'; ?>>
-12) <? echo date('d/m/Y', strtotime('-12 day')); ?></option>
<option value="13" <? if ($periodo == '13') echo 'selected="selected"'; ?>>
-13) <? echo date('d/m/Y', strtotime('-13 day')); ?></option>
<option value="14" <? if ($periodo == '14') echo 'selected="selected"'; ?>>
-14) <? echo date('d/m/Y', strtotime('-14 day')); ?></option>
<option value="15" <? if ($periodo == '15') echo 'selected="selected"'; ?>>
-15) <? echo date('d/m/Y', strtotime('-15 day')); ?></option>
<option value="16" <? if ($periodo == '16') echo 'selected="selected"'; ?>>
-16) <? echo date('d/m/Y', strtotime('-16 day')); ?></option>
<option value="17" <? if ($periodo == '17') echo 'selected="selected"'; ?>>
-17) <? echo date('d/m/Y', strtotime('-17 day')); ?></option>
<option value="18" <? if ($periodo == '18') echo 'selected="selected"'; ?>>
-18) <? echo date('d/m/Y', strtotime('-18 day')); ?></option>
<option value="19" <? if ($periodo == '19') echo 'selected="selected"'; ?>>
-19) <? echo date('d/m/Y', strtotime('-19 day')); ?></option>
<option value="20" <? if ($periodo == '20') echo 'selected="selected"'; ?>>
-20) <? echo date('d/m/Y', strtotime('-20 day')); ?></option>
<option value="21" <? if ($periodo == '21') echo 'selected="selected"'; ?>>
-21) <? echo date('d/m/Y', strtotime('-21 day')); ?></option>
<option value="22" <? if ($periodo == '22') echo 'selected="selected"'; ?>>
-22) <? echo date('d/m/Y', strtotime('-22 day')); ?></option>
<option value="23" <? if ($periodo == '23') echo 'selected="selected"'; ?>>
-23) <? echo date('d/m/Y', strtotime('-23 day')); ?></option>
<option value="24" <? if ($periodo == '24') echo 'selected="selected"'; ?>>
-24) <? echo date('d/m/Y', strtotime('-24 day')); ?></option>
<option value="25" <? if ($periodo == '25') echo 'selected="selected"'; ?>>
-25) <? echo date('d/m/Y', strtotime('-25 day')); ?></option>
<option value="26" <? if ($periodo == '26') echo 'selected="selected"'; ?>>
-26) <? echo date('d/m/Y', strtotime('-26 day')); ?></option>
<option value="27" <? if ($periodo == '27') echo 'selected="selected"'; ?>>
-27) <? echo date('d/m/Y', strtotime('-27 day')); ?></option>
<option value="28" <? if ($periodo == '28') echo 'selected="selected"'; ?>>
-28) <? echo date('d/m/Y', strtotime('-28 day')); ?></option>
<option value="29" <? if ($periodo == '29') echo 'selected="selected"'; ?>>
-29) <? echo date('d/m/Y', strtotime('-29 day')); ?></option>
<option value="30" <? if ($periodo == '30') echo 'selected="selected"'; ?>>
-30) <? echo date('d/m/Y', strtotime('-30 day')); ?></option>
<option value="31" <? if ($periodo == '31') echo 'selected="selected"'; ?>>
-31) <? echo date('d/m/Y', strtotime('-31 day')); ?></option>
</select>
</div>
<input type="submit" name="filtra" value="filtra" class="btn btn-default">
</fieldset>
</form>

                </div>
            </div>
        </div>

		<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
						<!--? echo $mese; ?-->
                        <b>Appuntamenti di:</b> <? echo $agente; ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">

<?

mysql_connect(DBURI ,DBUSER ,DBPASS);
mysql_select_db(DBNAME);

/*
$query="SELECT * FROM `appuntamenti`
WHERE
`FEEDBACK`='Y'

ORDER BY `appuntamenti`.`SVA_TIMESTAMP` ASC;";
*/

/*
$query="SELECT * FROM `appuntamenti`
WHERE
`ID_AGENTE` = 'agente_sva_to_01'
`DATA` = CURDATE() /// subdate(currentDate, 1) /// CURDATE()-1

ORDER BY `appuntamenti`.`SVA_TIMESTAMP` ASC;";
*/

/*
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
*/

$query="SELECT * FROM `appuntamenti`
WHERE
".$queryFiltraAgente."
DATE_SUB(CURDATE(),INTERVAL ".$periodo." DAY) <= DATA 
AND ID IN (
    SELECT MAX(ID)
    FROM `appuntamenti`
    GROUP BY ID_APPUNTAMENTO
)
ORDER BY `appuntamenti`.`DATA` DESC
;";

echo '<pre>' . $query . '</pre>';

//ORDER BY `appuntamenti`.`DATA` ASC;";

echo '
<table class="table table-bordered" id="dataTables-appuntamenti" >
	<thead>
		<tr>
';

echo '<th>ID_AGENTE</th>';
echo '<th><b>DATA/ORA</b></th>';
echo '<th>ID_APPUNTAMENTO</th>';
echo '<th>OPERATORE_FRONT</th>';
echo '<th>ID_CLIENTE</th>';
echo '<th>INFO_CLIENTE</th>';
//echo '<th>DESCRIZIONE_SGU</th>';
//echo '<th>MACRO_ATTIVITA</th>';
//echo '<th>CAMPAGNA</th>';
//echo '<th>STATO</th>';
//echo '<th>ESITO</th>';
//echo '<th>NOTE</th>';
echo '<th style="background:aliceblue">INSERITO/AGGIORNATO IL</th>';
echo '<th style="background:aliceblue">STATO</th>';
echo '<th style="background:aliceblue">SOTTO/STATO</th>';
echo '<th style="background:aliceblue">DATA</th>';
echo '<th style="background:aliceblue">PDA_RES</th>';
echo '<th style="background:aliceblue">PDA_SHP</th>';
echo '<th style="background:aliceblue">PDA_TOT</th>';
echo '<th style="background:aliceblue">SIM</th>';
echo '<th style="background:aliceblue">NOTE</th>';
echo '<th style="background:aliceblue"></th>';

echo "</tr>
</thead>
<tbody>
";

		$res = mysql_query($query);
		if ($res && mysql_num_rows($res)>0)
		{
		while($row=mysql_fetch_assoc($res))
			{
				//echo '<tr><td>' . $row['ID'] . '</td>';


				echo '<tr';
				
				if ($row['FEEDBACK'] != 'Y') { echo ' style="background-color:red!important; text-transform: uppercase;"';}
								
				echo ' style="text-transform: uppercase;"><td>' . $row['ID_AGENTE'] . '</td>';
				echo '<td>' . $row['DATA'] . ' - ' . $row['ORA_INIZIO'] . '</td>';
				echo '<td>' . $row['ID_APPUNTAMENTO'] . '</td>';
				echo '<td>' . $row['OPERATORE_FRONT'] . '</td>';
				echo '<td>' . $row['ID_CLIENTE'] . '</td>';
				echo '<td>' . substr($row['INFO_CLIENTE'],0,50) . '...</td>';

				echo '<td style="background:aliceblue">' . $row['SVA_TIMESTAMP'] . '</td>';
				echo '<td style="background:aliceblue">' . $row['SVA_STATO'] . '</td>';
				
				echo '<td style="background:aliceblue">';
				if ($row['SVA_SOTTO_STATO'] == 'PENDING_DA_RICHIAMARE')
				{echo '<span style="color:red; font-weight: bold">';
				$span = '</span>';} else { $span = '';}
				echo $row['SVA_SOTTO_STATO'] . $span . '</td>';
				
				if ($row['SVA_SOTTO_STATO'] == 'PENDING_DA_RICHIAMARE' || $row['SVA_SOTTO_STATO'] == 'PENDING_GIA_FISSATO' || $row['SVA_SOTTO_STATO'] == 'SPOSTATO' )
				{echo '<td style="background:aliceblue">' . $row['SVA_DATA_RIFIX'] . '</td>';}
				
				else {echo '<td style="background:aliceblue"></td>';}
				echo '<td style="background:aliceblue">' . $row['PDA_RES'] . '</td>';
				echo '<td style="background:aliceblue">' . $row['PDA_SHP'] . '</td>';
				echo '<td style="background:aliceblue">' . $row['TOT_PDA'] . '</td>';
				echo '<td style="background:aliceblue">' . $row['SVA_SIM'] . '</td>';
				echo '<td style="background:aliceblue">' . $row['SVA_NOTE'] . '</td>';
				echo '<td style="background:aliceblue">';

/*modal*/

// Modifico anche i pending or not?
// if ($row['FEEDBACK'] == 'Y' && $row['SVA_SOTTO_STATO'] != 'PENDING_DA_RICHIAMARE') { echo '

if ($row['FEEDBACK'] == 'Y') { echo '

<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal'.$row['ID'].'">Modifica</button>

<!-- Modal -->
<div id="myModal'.$row['ID'].'" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
<p>Qui ci va il form di modifica!!!<br>
form action self<br>
update</br>
</br>SVA_STATO: '. $row['SVA_STATO'] . '
</br>SVA_SOTTO_STATO: '. $row['SVA_SOTTO_STATO'] . '
</br>PDA_RES: '. $row['PDA_RES'] . '
</br>PDA_SHP: '. $row['PDA_SHP'] . '
</br>SVA_SIM: '. $row['SVA_SIM'] . '
</br>SVA_NOTE: '. $row['SVA_NOTE'] . '</br></br>

where id riga = '. $row['ID'] . ' (campo hidden del form)
</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
						</div>					

';
/*modal*/
}
				echo '</td></tr>
	';



				
			}
		}
		
		echo '
		                            </tbody>
                                </table>
								</div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
						
						<div class="panel-footer">
						footer
												
                     </div>
                    <!-- /.panel -->
                </div>		
		';
		
	/*switch ($mese)
	{
		case 'gennaio_'.ANNO:
		$month = 1;
		break;

		case 'febbraio_'.ANNO:
		$month = 2;
		break;

		case 'marzo_'.ANNO:
		$month = 3;
		break;

		case 'aprile_'.ANNO:
		$month = 4;
		break;

		case 'maggio_'.ANNO:
		$month = 5;
		break;

		case 'giugno_'.ANNO:
		$month = 6;
		break;

		case 'luglio_'.ANNO:
		$month = 7;
		break;

		case 'agosto_'.ANNO:
		$month = 8;
		break;

		case 'settembre_'.ANNO:
		$month = 9;
		break;

		case 'ottobre_'.ANNO:
		$month = 10;
		break;

		case 'novembre_'.ANNO:
		$month = 11;
		break;

		case 'dicembre_'.ANNO:
		$month = 12;
		break;

		default:
		$month = 0;
		break;
	}
*/

?>
								
<div class="panel panel-default">
<div class="panel-heading">
<b style="color:red">Tutti i Pending (Da richiamare)</b></div><div class="panel-body">

<?

// mostro i pending:

mysql_connect(DBURI ,DBUSER ,DBPASS);
mysql_select_db(DBNAME);

$query="
SELECT * FROM `appuntamenti_png` 
WHERE 
ID IN ( SELECT MAX(ID) FROM `appuntamenti_png` GROUP BY ID_APPUNTAMENTO ) 
AND `SVA_SOTTO_STATO`='PENDING_DA_RICHIAMARE' 
AND `FEEDBACK`='Y' 
ORDER BY `appuntamenti_png`.`SVA_TIMESTAMP` DESC ;
";

// INTERVAL 1 DAY = VEDO OGGI E IERI
// ID_AGENTE = '".$_SESSION["crm_id"]. "' 

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
				<i><b><span style="color:red">' . $row['ID_AGENTE'] . '</b></span><br>
				<b>FEEDBACK DEL: </b>' . $row['SVA_TIMESTAMP'] . '</i></br>
				<b>APPUNTAMENTO DEL: </b>' . $row['DATA'] . ' - ' . $row['ORA_INIZIO'] . ' // 
				<b>ID_APPUNTAMENTO: </b>' . $row['ID_APPUNTAMENTO'] . ' //
				<b>ID_CLIENTE: </b>' . $row['ID_CLIENTE'] . '</br>
				<b>INFO_CLIENTE</th>: </b>' . substr($row['INFO_CLIENTE'],0,50) . '... 
				</br>
				<p style="margin-top: 10px;"><b>STATO: <span style="color:red">' . $row['SVA_SOTTO_STATO'] . '</b></span> il <span style="color:red"><b>' . $row['SVA_DATA_RIFIX'] . '</b></span> //
				<b>NOTE: </b>' . substr($row['SVA_NOTE'],0,50) . '...</p>';

/*modal
if ($row['FEEDBACK'] == 'Y') { echo '

<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal'.$row['ID'].'">Gestisci</button>

<!-- Modal -->
<div id="myModal'.$row['ID'].'" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Gestione Pending <small>form action self</small></h4>
		<p>se da richiamare di nuovo scrivo altra riga su \'app_png\' e aggiorno solo la data</p>
		<p>diversamente aggiorno lo stato sia su \'app_png\' (in modo da non tirarlo più fuori) che su \'app\' (in modo da darne visibilità ad OX)</p>
      </div>
      <div class="modal-body">

<!--div class="col-lg-5"-->

<script language="javascript"> 
    function toggleMe(obj, a){ 
      var e=document.getElementById(a); 
      if(obj=="obj=="NETTO-PENDING_DA_RICHIAMARE" || obj=="NETTO-PENDING_GIA_FISSATO"){ 
        e.style.display="block"; 
      }else{ 
    e.style.display="none"; 
} 
    } 
</script>

<form name="myFormP" class="form-horizontal" role="form" action="#" method="POST">
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

<div class="form-group" id="display'.$displayP.'" style="display: none;">
	<label class="control-label col-sm-3" for="DATA_RIFIX"><i style="color:red">DATA/ORA:</i></label>
	<div class="col-sm-9">
	<select name="DATA_RIFIX" id="DATA_RIFIX" class="form-control">
	<option value="">Seleziona</option>
	<option value="2017-01-01 23:00:00">2017-01-01 23:00:00</option>
	<option value="2017-01-01 23:00:00">2017-01-01 23:00:00</option>
	<option value="2017-01-01 23:00:00">2017-01-01 23:00:00</option>
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

?>

					</div>
                    <div class="panel-footer">
                    </div>
                    </div>



     </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->


<?php include_once("bottom.php"); ?>