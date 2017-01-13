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
	$periodo= '31';
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
<option value="tutti" <? if ($agente == '') echo 'selected="selected"'; ?>>Tutti</option>

<!--
1 leggo dalla tabella 'pro_user' gli utenti con 'JOIN_CRM' VALORIZZATO
2 finchè ce n'è
> creo >
<option value="XXX" <? //if ($agente == 'XXX') echo 'selected="selected"'; ?>>XXX</option>
-->

<option value="a_recall" <? if ($agente == 'a_recall') echo 'selected="selected"'; ?>>a_recall</option>
<option value="berni_sva_ge" <? if ($agente == 'berni_sva_ge') echo 'selected="selected"'; ?>>berni_sva_ge</option>
<option value="agente_sva_to_01" <? if ($agente == 'agente_sva_to_01') echo 'selected="selected"'; ?>>agente_sva_to_01</option>
<option value="garabello_sva_ge" <? if ($agente == 'garabello_sva_ge') echo 'selected="selected"'; ?>>garabello_sva_ge</option>
</select>
</div>
<div class="form-group">
Ultimi <select name="periodo" id="periodo" class="form-control">
<option value="1" <? if ($periodo == '1') echo 'selected="selected"'; ?>>1</option>
<option value="2" <? if ($periodo == '2') echo 'selected="selected"'; ?>>2</option>
<option value="3" <? if ($periodo == '3') echo 'selected="selected"'; ?>>3</option>
<option value="4" <? if ($periodo == '4') echo 'selected="selected"'; ?>>4</option>
<option value="5" <? if ($periodo == '5') echo 'selected="selected"'; ?>>5</option>
<option value="6" <? if ($periodo == '6') echo 'selected="selected"'; ?>>6</option>
<option value="7" <? if ($periodo == '7') echo 'selected="selected"'; ?>>7</option>
<option value="8" <? if ($periodo == '8') echo 'selected="selected"'; ?>>8</option>
<option value="9" <? if ($periodo == '9') echo 'selected="selected"'; ?>>9</option>
<option value="10" <? if ($periodo == '10') echo 'selected="selected"'; ?>>10</option>
<option value="11" <? if ($periodo == '12') echo 'selected="selected"'; ?>>11</option>
<option value="12" <? if ($periodo == '12') echo 'selected="selected"'; ?>>12</option>
<option value="13" <? if ($periodo == '13') echo 'selected="selected"'; ?>>13</option>
<option value="14" <? if ($periodo == '14') echo 'selected="selected"'; ?>>14</option>
<option value="15" <? if ($periodo == '15') echo 'selected="selected"'; ?>>15</option>
<option value="16" <? if ($periodo == '16') echo 'selected="selected"'; ?>>16</option>
<option value="17" <? if ($periodo == '17') echo 'selected="selected"'; ?>>17</option>
<option value="18" <? if ($periodo == '18') echo 'selected="selected"'; ?>>18</option>
<option value="19" <? if ($periodo == '19') echo 'selected="selected"'; ?>>19</option>
<option value="20" <? if ($periodo == '20') echo 'selected="selected"'; ?>>20</option>
<option value="21" <? if ($periodo == '22') echo 'selected="selected"'; ?>>21</option>
<option value="22" <? if ($periodo == '22') echo 'selected="selected"'; ?>>22</option>
<option value="23" <? if ($periodo == '23') echo 'selected="selected"'; ?>>23</option>
<option value="24" <? if ($periodo == '24') echo 'selected="selected"'; ?>>24</option>
<option value="25" <? if ($periodo == '25') echo 'selected="selected"'; ?>>25</option>
<option value="26" <? if ($periodo == '26') echo 'selected="selected"'; ?>>26</option>
<option value="27" <? if ($periodo == '27') echo 'selected="selected"'; ?>>27</option>
<option value="28" <? if ($periodo == '28') echo 'selected="selected"'; ?>>28</option>
<option value="29" <? if ($periodo == '29') echo 'selected="selected"'; ?>>29</option>
<option value="30" <? if ($periodo == '30') echo 'selected="selected"'; ?>>30</option>
<option value="31" <? if ($periodo == '31') echo 'selected="selected"'; ?>>31</option>
</select> giorni
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

echo '<span class="developp">' . $query . '</span><BR><BR>';

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
//echo '<th style="background:aliceblue">FEEDBACK DEL</th>';
echo '<th style="background:aliceblue">STATO</th>';
echo '<th style="background:aliceblue">SOTTO/STATO</th>';
//echo '<th>SVA_SEGMENTO</th>';
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
				
				if ($row['FEEDBACK'] != 'Y') { echo ' style="background-color:red!important"';}
								
				echo '><td>' . $row['ID_AGENTE'] . '</td>';
				echo '<td>' . $row['DATA'] . ' - ' . $row['ORA_INIZIO'] . '</td>';
				echo '<td>' . $row['ID_APPUNTAMENTO'] . '</td>';
				echo '<td>' . $row['OPERATORE_FRONT'] . '</td>';
				echo '<td>' . $row['ID_CLIENTE'] . '</td>';
				echo '<td>' . substr($row['INFO_CLIENTE'],0,50) . '...</td>';

				//echo '<td style="background:aliceblue">' . $row['SVA_TIMESTAMP'] . '</td>';
				echo '<td style="background:aliceblue">' . $row['SVA_STATO'] . '</td>';
				echo '<td style="background:aliceblue">' . $row['SVA_SOTTO_STATO'] . '</td>';
				
				echo '<td style="background:aliceblue">' . $row['PDA_RES'] . '</td>';
				echo '<td style="background:aliceblue">' . $row['PDA_SHP'] . '</td>';
				echo '<td style="background:aliceblue">' . $row['TOT_PDA'] . '</td>';
				echo '<td style="background:aliceblue">' . $row['SVA_SIM'] . '</td>';
				echo '<td style="background:aliceblue">' . $row['SVA_NOTE'] . '</td>';
				echo '<td style="background:aliceblue">';
/*modal*/
if ($row['FEEDBACK'] == 'Y') { echo '

<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal'.$row['ID'].'">Modifica</button>

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
								
     
     </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->


<?php include_once("bottom.php"); ?>