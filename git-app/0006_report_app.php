<?php
include_once("top.php");
include_once("libreria_php/allowed_1.php");
?>

<style>
tfoot tr td {
	color:#333!important;
	background-color: yellow!important;
	font-weight:bold!important;
	}
</style>

<?php

// scelta mese di consultazione

			if (isset($_GET["mese_calc"]))
			{ 	$mese_calc = $_GET["mese_calc"];
				$anno_calc = $_GET["anno_calc"]; 
			}
			else
			{	$mese_calc = (int)date("m"); 
				$anno_calc = ANNO;
				//$anno_calc = (int)date("Y");
			} 

			switch ($mese_calc) {
									
				case '01':
				$mese='gennaio';
				break;
							
				case '02':
				$mese='febbraio';
				break;
							
				case '03':
				$mese='marzo';
				break;
							
				case '04':
				$mese='aprile';
				break;
							
				case '05':
				$mese='maggio';
				break;
							
				case '06':
				$mese='giugno';
				break;
							
				case '07':
				$mese='luglio';
				break;
							
				case '08':
				$mese='agosto';
				break;
							
				case '09':
				$mese='settembre';
				break;
							
				case '10':
				$mese='ottobre';
				break;
							
				case '11':
				$mese='novembre';
				break;
							
				case '12':
				$mese='dicembre';
				break;

				default:
				$mese = MESEP;
				break;

				}

?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        	<h1 class="page-header">Report Agenti - <? echo $mese.' '.$anno_calc; ?></h1>
        </div><!-- /.col-lg-12 -->

<div class="col-lg-4">
			<div class="panel panel-default">
                <div class="panel-heading">
                Scegli Periodo (<? echo $mese_calc.'/'.$anno_calc; ?>)
                </div>
                <div class="panel-body"> 
        
                <form action="#" method="get">
                <fieldset>
                <div class="form-group">
                <select name="anno_calc" id="anno_calc" class="form-control">
                <option value="2015" <? if ($anno_calc == '2015') echo 'selected="selected"'; ?>>2015</option>
                <option value="2016" <? if ($anno_calc == '2016') echo 'selected="selected"'; ?>>2016</option>
                <option value="2017" <? if ($anno_calc == '2017') echo 'selected="selected"'; ?>>2017</option>
                <option value="2018" <? if ($anno_calc == '2018') echo 'selected="selected"'; ?>>2018</option>
                <option value="2019" <? if ($anno_calc == '2019') echo 'selected="selected"'; ?>>2019</option>
                <option value="2020" <? if ($anno_calc == '2020') echo 'selected="selected"'; ?>>2020</option>
                </select>
                </div>
                <div class="form-group">
                <select name="mese_calc" id="mese_calc" class="form-control">
                <option value="01" <? if ($mese_calc == '01') echo 'selected="selected"'; ?>>gennaio</option>
                <option value="02" <? if ($mese_calc == '02') echo 'selected="selected"'; ?>>febbraio</option>
                <option value="03" <? if ($mese_calc == '03') echo 'selected="selected"'; ?>>marzo</option>
                <option value="04" <? if ($mese_calc == '04') echo 'selected="selected"'; ?>>aprile</option>
                <option value="05" <? if ($mese_calc == '05') echo 'selected="selected"'; ?>>maggio</option>
                <option value="06" <? if ($mese_calc == '06') echo 'selected="selected"'; ?>>giugno</option>
                <option value="07" <? if ($mese_calc == '07') echo 'selected="selected"'; ?>>luglio</option>
                <option value="08" <? if ($mese_calc == '08') echo 'selected="selected"'; ?>>agosto</option>
                <option value="09" <? if ($mese_calc == '09') echo 'selected="selected"'; ?>>settembre</option>
                <option value="10" <? if ($mese_calc == '10') echo 'selected="selected"'; ?>>ottobre</option>
                <option value="11" <? if ($mese_calc == '11') echo 'selected="selected"'; ?>>novembre</option>
                <option value="12" <? if ($mese_calc == '12') echo 'selected="selected"'; ?>>dicembre</option>
                </select>
                </div>
                <input name="scegli" value="scegli" class="btn btn-default" type="submit">
                </fieldset>
                </form>

                </div><!-- ./panel body -->
            </div><!-- ./panel panel -->
		</div><!-- ./col-lg-4 -->
	</div><!-- ./row -->
    
<!-- res+shp -->
    <div class="row">

<?

			mysql_connect(DBURI ,DBUSER ,DBPASS);
			mysql_select_db(DBNAME);
			
// VEND
/*
SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = 7
AND `SVA_STATO` = 'LORDO'
AND `ID_AGENTE` = 'agente_sva_to_01'
AND ID IN (
    SELECT MAX(ID)
    FROM `appuntamenti`
    GROUP BY ID_APPUNTAMENTO
)


*/

			echo '
			
			<div class="col-lg-12">
			<div class="panel panel-default">
                <div class="panel-heading">
                Residenziali + SHP
                </div>
                <div class="panel-body">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
			<thead>
			<tr>
			<th colspan="6" style=""><em>Utilizzo Console</em></th>
			<th></th>
			<th colspan="8"><em>Report</em></th>
			<th></th>
			<th colspan="2"><em>Percent</em></th>
			</tr>
			<tr>
			<th>Venditore</th>
			<th>App. TOT</th>
			<th>App. Non Gestiti</th>
			<th>App. Lordi</th>
			<th>App. Netti</th>
			<th>App. PDA</th>
			<th></th>
			<th>LORDI</th>
			<th>NETTI</th>
			<th></th>
			<th><em>PDA da App</em></th>
			<th><em>PDA Rec PNG</em></th>
			<th>TOT1</th>
			<th><em>PDA Auto</em></th>
			<th>TOT2</th>
			<th></th>
			<th>Chiusura Lordo<br>(T1 su Lordi)</th>
			<th>Chiusura Netto<br>(T1 su Netti)</th>
			</tr>
			<tr>
			<th colspan="18"></th>
			</tr>
			</thead>
			<tbody>';
			
                             
                $sqlq = "SELECT JOIN_CRM
                FROM pro_user
                WHERE JOIN_CRM != '' 
                ORDER BY  `pro_user`.`JOIN_CRM` ASC";
                $risultato = mysql_query($sqlq);
                
                if (!$risultato) {
                echo "DB Error - ";
                echo 'MySQL Error: ' . mysql_error();
                //exit;
                }
                
                while ($riga = mysql_fetch_assoc($risultato))
                {
/*					echo'<tr><td colspan="5">'.$row['JOIN_CRM'].'</td>';
					echo'<td colspan="5">'.$row['JOIN_CRM'].'</td></tr>';
*/
					echo'

					<tr>
					<td>'.$riga['JOIN_CRM'].'</td>';

					//	TOT

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_totali = $row['COUNT(ID_APPUNTAMENTO)'];
					echo '
					<td>'.$appuntamenti_totali.'</td>';					

					//	NON GESTITI

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'LORDO'
					AND `SVA_SOTTO_STATO` = 'ASSEGNATO'
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_non_gestiti = $row['COUNT(ID_APPUNTAMENTO)'];

					echo '
					<td style="color:red">'.$appuntamenti_non_gestiti.'</td>';

					//	LORDI

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'LORDO'
					AND `SVA_SOTTO_STATO` != 'ASSEGNATO'
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_lordi = $row['COUNT(ID_APPUNTAMENTO)'];
					$appuntamenti_lordi_non_gestiti = $appuntamenti_non_gestiti + $appuntamenti_lordi;
					echo '
					<td style="color: orange">'.$appuntamenti_lordi.'</td>';

					//	NETTI

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'NETTO'
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_netti = $row['COUNT(ID_APPUNTAMENTO)'];
			
					echo '
					<td style="color:blue">'.$appuntamenti_netti.'</td>';

					//	APPUNTAMENTI CHE DIVENTANO PDA

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'PDA'
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_pda = $row['COUNT(ID_APPUNTAMENTO)'];
					$appuntamenti_netti_pda = $appuntamenti_netti+$appuntamenti_pda;

					echo '
					<td style="color:green">'.$row['COUNT(ID_APPUNTAMENTO)'].'</td>
					<td></td>
					<td><strong>'.$appuntamenti_lordi_non_gestiti.'</strong></td>
					<td><strong>'.$appuntamenti_netti_pda.'</strong></td>
					<td></td>';

					//
					//	TOTALE PDA (RES)

					$sql = "SELECT SUM(TOT_PDA) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$pda_tot = $row['SUM(TOT_PDA)'];
					/*echo '
					<td>'.$pda_tot.'---</td>';*/

					//	APPUNTAMENTI CHE DIVENTANO PDA rec Pending
					/*
					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti_png` WHERE MONTH(DATA) = ".$mese_calc."
					AND `SVA_STATO` = 'PDA'
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND `MACRO_ATTIVITA` = 'res'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti_png`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
			
					echo '
					<td><em>'.$row['COUNT(ID_APPUNTAMENTO)'].'</em></td>';
					*/
					
					//	TOTALE PDA RES DA rec Pending

					$sql = "SELECT SUM(TOT_PDA) FROM `appuntamenti_png` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti_png`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$pda_da_png=$row['SUM(TOT_PDA)'];
					$pda_scarto = $pda_tot - $pda_da_png;

					//	AUTOPRODOTTE

					$sql = "SELECT SUM(TOT_PDA) FROM `autoprodotte` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$autoprodotte = $row['SUM(TOT_PDA)'];
			
					echo '
					<td><strong>'.$pda_scarto.'</strong></td>
					<td><strong>'.$pda_da_png.'</strong></td>
					<td style="background-color:yellow"><strong>'.$pda_tot.'</strong></td>';
					
echo'
					<td style="background-color:orange">'.$autoprodotte.'</td>';
					
					$pda_tot_autoprodotte = $pda_tot + $autoprodotte;

echo'					
					<td style="background-color:orange">'.$pda_tot_autoprodotte.'</td>
					<td></td>';
					@$percent_lordo = $pda_tot*100/$appuntamenti_lordi_non_gestiti;
					@$percent_netto = $pda_tot*100/$appuntamenti_netti_pda;
echo'					
					<td>'.number_format($percent_lordo, 2).'%</td>
					<td>'.number_format($percent_netto, 2).'%</td>
					</tr>';

				
				}

							echo '
					<tr><td colspan="19"></td></tr>
					</tbody>
					<tfoot>';

/*					echo'<tr><td colspan="5">'.$row['JOIN_CRM'].'</td>';
					echo'<td colspan="5">'.$row['JOIN_CRM'].'</td></tr>';
*/
					echo'
					
					<tr>
					<td>Tot Outbound</td>';

					//	TOT

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_totali = $row['COUNT(ID_APPUNTAMENTO)'];
					echo '
					<td>'.$appuntamenti_totali.'</td>';					

					//	NON GESTITI

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'LORDO'
					AND `SVA_SOTTO_STATO` = 'ASSEGNATO'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_non_gestiti = $row['COUNT(ID_APPUNTAMENTO)'];

					echo '
					<td style="color:red">'.$appuntamenti_non_gestiti.'</td>';

					//	LORDI

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'LORDO'
					AND `SVA_SOTTO_STATO` != 'ASSEGNATO'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_lordi = $row['COUNT(ID_APPUNTAMENTO)'];
					$appuntamenti_lordi_non_gestiti = $appuntamenti_non_gestiti + $appuntamenti_lordi;
					echo '
					<td style="color: orange">'.$appuntamenti_lordi.'</td>';

					//	NETTI

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'NETTO'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_netti = $row['COUNT(ID_APPUNTAMENTO)'];
			
					echo '
					<td style="color:blue">'.$appuntamenti_netti.'</td>';

					//	APPUNTAMENTI CHE DIVENTANO PDA

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'PDA'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_pda = $row['COUNT(ID_APPUNTAMENTO)'];
					$appuntamenti_netti_pda = $appuntamenti_netti+$appuntamenti_pda;

					echo '
					<td style="color:green">'.$row['COUNT(ID_APPUNTAMENTO)'].'</td>
					<td></td>
					<td><strong>'.$appuntamenti_lordi_non_gestiti.'</strong></td>
					<td><strong>'.$appuntamenti_netti_pda.'</strong></td>
					<td></td>';

					//
					//	TOTALE PDA (RES)

					$sql = "SELECT SUM(TOT_PDA) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$pda_tot = $row['SUM(TOT_PDA)'];
					
					//	TOTALE PDA RES DA rec Pending

					$sql = "SELECT SUM(TOT_PDA) FROM `appuntamenti_png` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti_png`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$pda_da_png=$row['SUM(TOT_PDA)'];
					$pda_scarto = $pda_tot - $pda_da_png;
					
					//	AUTOPRODOTTE

					$sql = "SELECT SUM(TOT_PDA) FROM `autoprodotte` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$autoprodotte = $row['SUM(TOT_PDA)'];
					
					echo '
					<td><strong>'.$pda_scarto.'</strong></td>
					<td><strong>'.$pda_da_png.'</strong></td>
					<td style="background-color:yellow"><strong>'.$pda_tot.'</strong></td>';
					
echo'
					<td style="background-color:orange">'.$autoprodotte.'</td>';
					
					$pda_tot_autoprodotte = $pda_tot + $autoprodotte;

echo'					
					<td style="background-color:orange">'.$pda_tot_autoprodotte.'</td>
					<td></td>';
					@$percent_lordo = $pda_tot*100/$appuntamenti_lordi_non_gestiti;
					@$percent_netto = $pda_tot*100/$appuntamenti_netti_pda;
echo'					
					<td>'.number_format($percent_lordo, 2).'%</td>
					<td>'.number_format($percent_netto, 2).'%</td>
					</tr>

				
											</tfoot>
						
						</table>
					</div>
			     </div><!-- ./panel body -->
            </div><!-- ./panel panel -->
		</div><!-- ./col-lg-4 -->
	';
			
?>
   
    </div><!-- /.row -->
<!-- /res+shp -->

<!-- res -->
    <div class="row">

<?
			echo '
			
			<div class="col-lg-12">
			<div class="panel panel-default">
                <div class="panel-heading">
                Residenziali
                </div>
                <div class="panel-body">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
			<thead>
			<tr>
			<th colspan="6" style=""><em>Utilizzo Console</em></th>
			<th></th>
			<th colspan="8"><em>Report</em></th>
			<th></th>
			<th colspan="2"><em>Percent</em></th>
			</tr>
			<tr>
			<th>Venditore</th>
			<th>App. TOT</th>
			<th>App. Non Gestiti</th>
			<th>App. Lordi</th>
			<th>App. Netti</th>
			<th>App. PDA</th>
			<th></th>
			<th>LORDI</th>
			<th>NETTI</th>
			<th></th>
			<th><em>PDA da App</em></th>
			<th><em>PDA Rec PNG</em></th>
			<th>TOT1</th>
			<th><em>PDA Auto</em></th>
			<th>TOT2</th>
			<th></th>
			<th>Chiusura Lordo<br>(T1 su Lordi)</th>
			<th>Chiusura Netto<br>(T1 su Netti)</th>
			</tr>
			<tr>
			<th colspan="18"></th>
			</tr>
			</thead>
			<tbody>';
			
                             
                $sqlq = "SELECT JOIN_CRM
                FROM pro_user
                WHERE JOIN_CRM != '' 
                ORDER BY  `pro_user`.`JOIN_CRM` ASC";
                $risultato = mysql_query($sqlq);
                
                if (!$risultato) {
                echo "DB Error - ";
                echo 'MySQL Error: ' . mysql_error();
                //exit;
                }
                
                while ($riga = mysql_fetch_assoc($risultato))
                {
/*					echo'<tr><td colspan="5">'.$row['JOIN_CRM'].'</td>';
					echo'<td colspan="5">'.$row['JOIN_CRM'].'</td></tr>';
*/
					echo'

					<tr>
					<td>'.$riga['JOIN_CRM'].'</td>';

					//	TOT

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND `MACRO_ATTIVITA` = 'res'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_totali = $row['COUNT(ID_APPUNTAMENTO)'];
					echo '
					<td>'.$appuntamenti_totali.'</td>';					

					//	NON GESTITI

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'LORDO'
					AND `SVA_SOTTO_STATO` = 'ASSEGNATO'
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND `MACRO_ATTIVITA` = 'res'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_non_gestiti = $row['COUNT(ID_APPUNTAMENTO)'];

					echo '
					<td style="color:red">'.$appuntamenti_non_gestiti.'</td>';

					//	LORDI

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'LORDO'
					AND `SVA_SOTTO_STATO` != 'ASSEGNATO'
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND `MACRO_ATTIVITA` = 'res'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_lordi = $row['COUNT(ID_APPUNTAMENTO)'];
					$appuntamenti_lordi_non_gestiti = $appuntamenti_non_gestiti + $appuntamenti_lordi;
					echo '
					<td style="color: orange">'.$appuntamenti_lordi.'</td>';

					//	NETTI

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'NETTO'
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND `MACRO_ATTIVITA` = 'res'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_netti = $row['COUNT(ID_APPUNTAMENTO)'];
			
					echo '
					<td style="color:blue">'.$appuntamenti_netti.'</td>';

					//	APPUNTAMENTI CHE DIVENTANO PDA

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'PDA'
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND `MACRO_ATTIVITA` = 'res'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_pda = $row['COUNT(ID_APPUNTAMENTO)'];
					$appuntamenti_netti_pda = $appuntamenti_netti+$appuntamenti_pda;

					echo '
					<td style="color:green">'.$row['COUNT(ID_APPUNTAMENTO)'].'</td>
					<td></td>
					<td><strong>'.$appuntamenti_lordi_non_gestiti.'</strong></td>
					<td><strong>'.$appuntamenti_netti_pda.'</strong></td>
					<td></td>';

					//
					//	TOTALE PDA (RES)

					$sql = "SELECT SUM(PDA_RES) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$pda_tot = $row['SUM(PDA_RES)'];
					/*echo '
					<td>'.$pda_tot.'---</td>';*/

					//	APPUNTAMENTI CHE DIVENTANO PDA rec Pending
					/*
					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti_png` WHERE MONTH(DATA) = ".$mese_calc."
					AND `SVA_STATO` = 'PDA'
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND `MACRO_ATTIVITA` = 'res'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti_png`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
			
					echo '
					<td><em>'.$row['COUNT(ID_APPUNTAMENTO)'].'</em></td>';
					*/
					
					//	TOTALE PDA RES DA rec Pending

					$sql = "SELECT SUM(PDA_RES) FROM `appuntamenti_png` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti_png`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$pda_da_png=$row['SUM(PDA_RES)'];
					$pda_scarto = $pda_tot - $pda_da_png;
					
					//	AUTOPRODOTTE

					$sql = "SELECT SUM(PDA_RES) FROM `autoprodotte` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$autoprodotte = $row['SUM(PDA_RES)'];
					
					echo '
					<td><strong>'.$pda_scarto.'</strong></td>
					<td><strong>'.$pda_da_png.'</strong></td>
					<td style="background-color:yellow"><strong>'.$pda_tot.'</strong></td>';
					
echo'
					<td style="background-color:orange">'.$autoprodotte.'</td>';
					
					$pda_tot_autoprodotte = $pda_tot + $autoprodotte;

echo'					
					<td style="background-color:orange">'.$pda_tot_autoprodotte.'</td>
					<td></td>';
					@$percent_lordo = $pda_tot*100/$appuntamenti_lordi_non_gestiti;
					@$percent_netto = $pda_tot*100/$appuntamenti_netti_pda;
echo'					
					<td>'.number_format($percent_lordo, 2).'%</td>
					<td>'.number_format($percent_netto, 2).'%</td>
					</tr>';

				
				}

							echo '
					<tr><td colspan="19"></td></tr>
					</tbody>
					<tfoot>';

/*					echo'<tr><td colspan="5">'.$row['JOIN_CRM'].'</td>';
					echo'<td colspan="5">'.$row['JOIN_CRM'].'</td></tr>';
*/
					echo'
					
					<tr>
					<td>Tot Outbound</td>';

					//	TOT

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `MACRO_ATTIVITA` = 'res'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_totali = $row['COUNT(ID_APPUNTAMENTO)'];
					echo '
					<td>'.$appuntamenti_totali.'</td>';					

					//	NON GESTITI

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'LORDO'
					AND `SVA_SOTTO_STATO` = 'ASSEGNATO'
					AND `MACRO_ATTIVITA` = 'res'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_non_gestiti = $row['COUNT(ID_APPUNTAMENTO)'];

					echo '
					<td style="color:red">'.$appuntamenti_non_gestiti.'</td>';

					//	LORDI

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'LORDO'
					AND `SVA_SOTTO_STATO` != 'ASSEGNATO'
					AND `MACRO_ATTIVITA` = 'res'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_lordi = $row['COUNT(ID_APPUNTAMENTO)'];
					$appuntamenti_lordi_non_gestiti = $appuntamenti_non_gestiti + $appuntamenti_lordi;
					echo '
					<td style="color: orange">'.$appuntamenti_lordi.'</td>';

					//	NETTI

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'NETTO'
					AND `MACRO_ATTIVITA` = 'res'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_netti = $row['COUNT(ID_APPUNTAMENTO)'];
			
					echo '
					<td style="color:blue">'.$appuntamenti_netti.'</td>';

					//	APPUNTAMENTI CHE DIVENTANO PDA

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'PDA'
					AND `MACRO_ATTIVITA` = 'res'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_pda = $row['COUNT(ID_APPUNTAMENTO)'];
					$appuntamenti_netti_pda = $appuntamenti_netti+$appuntamenti_pda;

					echo '
					<td style="color:green">'.$row['COUNT(ID_APPUNTAMENTO)'].'</td>
					<td></td>
					<td><strong>'.$appuntamenti_lordi_non_gestiti.'</strong></td>
					<td><strong>'.$appuntamenti_netti_pda.'</strong></td>
					<td></td>';

					//
					//	TOTALE PDA (RES)

					$sql = "SELECT SUM(PDA_RES) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$pda_tot = $row['SUM(PDA_RES)'];
					
					//	TOTALE PDA RES DA rec Pending

					$sql = "SELECT SUM(PDA_RES) FROM `appuntamenti_png` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti_png`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$pda_da_png=$row['SUM(PDA_RES)'];
					$pda_scarto = $pda_tot - $pda_da_png;
					
					//	AUTOPRODOTTE

					$sql = "SELECT SUM(PDA_RES) FROM `autoprodotte` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$autoprodotte = $row['SUM(PDA_RES)'];
					
					echo '
					<td><strong>'.$pda_scarto.'</strong></td>
					<td><strong>'.$pda_da_png.'</strong></td>
					<td style="background-color:yellow"><strong>'.$pda_tot.'</strong></td>';
					
echo'
					<td style="background-color:orange">'.$autoprodotte.'</td>';
					
					$pda_tot_autoprodotte = $pda_tot + $autoprodotte;

echo'					
					<td style="background-color:orange">'.$pda_tot_autoprodotte.'</td>
					<td></td>';
					@$percent_lordo = $pda_tot*100/$appuntamenti_lordi_non_gestiti;
					@$percent_netto = $pda_tot*100/$appuntamenti_netti_pda;
echo'					
					<td>'.number_format($percent_lordo, 2).'%</td>
					<td>'.number_format($percent_netto, 2).'%</td>
					</tr>

				
											</tfoot>
						
						</table>
					</div>
			     </div><!-- ./panel body -->
            </div><!-- ./panel panel -->
		</div><!-- ./col-lg-4 -->
	';
			
?>
   
    </div><!-- /.row -->
<!-- /res -->

<!-- shp -->
    <div class="row">

<?
			echo '
			
			<div class="col-lg-12">
			<div class="panel panel-default">
                <div class="panel-heading">
                Shp
                </div>
                <div class="panel-body">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
			<thead>
			<tr>
			<th colspan="6" style=""><em>Utilizzo Console</em></th>
			<th></th>
			<th colspan="8"><em>Report</em></th>
			<th></th>
			<th colspan="2"><em>Percent</em></th>
			</tr>
			<tr>
			<th>Venditore</th>
			<th>App. TOT</th>
			<th>App. Non Gestiti</th>
			<th>App. Lordi</th>
			<th>App. Netti</th>
			<th>App. PDA</th>
			<th></th>
			<th>LORDI</th>
			<th>NETTI</th>
			<th></th>
			<th><em>PDA da App</em></th>
			<th><em>PDA Rec PNG</em></th>
			<th>TOT1</th>
			<th><em>PDA Auto</em></th>
			<th>TOT2</th>
			<th></th>
			<th>Chiusura Lordo<br>(T1 su Lordi)</th>
			<th>Chiusura Netto<br>(T1 su Netti)</th>
			</tr>
			<tr>
			<th colspan="18"></th>
			</tr>
			</thead>
			<tbody>';
			
                             
                $sqlq = "SELECT JOIN_CRM
                FROM pro_user
                WHERE JOIN_CRM != '' 
                ORDER BY  `pro_user`.`JOIN_CRM` ASC";
                $risultato = mysql_query($sqlq);
                
                if (!$risultato) {
                echo "DB Error - ";
                echo 'MySQL Error: ' . mysql_error();
                //exit;
                }
                
                while ($riga = mysql_fetch_assoc($risultato))
                {
/*					echo'<tr><td colspan="5">'.$row['JOIN_CRM'].'</td>';
					echo'<td colspan="5">'.$row['JOIN_CRM'].'</td></tr>';
*/
					echo'

					<tr>
					<td>'.$riga['JOIN_CRM'].'</td>';

					//	TOT

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND `MACRO_ATTIVITA` = 'shp'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_totali = $row['COUNT(ID_APPUNTAMENTO)'];
					echo '
					<td>'.$appuntamenti_totali.'</td>';					

					//	NON GESTITI

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'LORDO'
					AND `SVA_SOTTO_STATO` = 'ASSEGNATO'
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND `MACRO_ATTIVITA` = 'shp'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_non_gestiti = $row['COUNT(ID_APPUNTAMENTO)'];

					echo '
					<td style="color:red">'.$appuntamenti_non_gestiti.'</td>';

					//	LORDI

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'LORDO'
					AND `SVA_SOTTO_STATO` != 'ASSEGNATO'
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND `MACRO_ATTIVITA` = 'shp'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_lordi = $row['COUNT(ID_APPUNTAMENTO)'];
					$appuntamenti_lordi_non_gestiti = $appuntamenti_non_gestiti + $appuntamenti_lordi;
					echo '
					<td style="color: orange">'.$appuntamenti_lordi.'</td>';

					//	NETTI

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'NETTO'
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND `MACRO_ATTIVITA` = 'shp'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_netti = $row['COUNT(ID_APPUNTAMENTO)'];
			
					echo '
					<td style="color:blue">'.$appuntamenti_netti.'</td>';

					//	APPUNTAMENTI CHE DIVENTANO PDA

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'PDA'
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND `MACRO_ATTIVITA` = 'shp'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_pda = $row['COUNT(ID_APPUNTAMENTO)'];
					$appuntamenti_netti_pda = $appuntamenti_netti+$appuntamenti_pda;

					echo '
					<td style="color:green">'.$row['COUNT(ID_APPUNTAMENTO)'].'</td>
					<td></td>
					<td><strong>'.$appuntamenti_lordi_non_gestiti.'</strong></td>
					<td><strong>'.$appuntamenti_netti_pda.'</strong></td>
					<td></td>';

					//
					//	TOTALE PDA (RES)

					$sql = "SELECT SUM(PDA_SHP) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$pda_tot = $row['SUM(PDA_SHP)'];
					/*echo '
					<td>'.$pda_tot.'---</td>';*/

					//	APPUNTAMENTI CHE DIVENTANO PDA rec Pending
					/*
					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti_png` WHERE MONTH(DATA) = ".$mese_calc."
					AND `SVA_STATO` = 'PDA'
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND `MACRO_ATTIVITA` = 'shp'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti_png`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
			
					echo '
					<td><em>'.$row['COUNT(ID_APPUNTAMENTO)'].'</em></td>';
					*/
					
					//	TOTALE PDA RES DA rec Pending

					$sql = "SELECT SUM(PDA_SHP) FROM `appuntamenti_png` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti_png`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$pda_da_png=$row['SUM(PDA_SHP)'];
					$pda_scarto = $pda_tot - $pda_da_png;
					
					//	AUTOPRODOTTE

					$sql = "SELECT SUM(PDA_SHP) FROM `autoprodotte` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `ID_AGENTE` = '".$riga['JOIN_CRM']."'
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$autoprodotte = $row['SUM(PDA_SHP)'];
					
					echo '
					<td><strong>'.$pda_scarto.'</strong></td>
					<td><strong>'.$pda_da_png.'</strong></td>
					<td style="background-color:yellow"><strong>'.$pda_tot.'</strong></td>';
					
echo'
					<td style="background-color:orange">'.$autoprodotte.'</td>';
					
					$pda_tot_autoprodotte = $pda_tot + $autoprodotte;

echo'					
					<td style="background-color:orange">'.$pda_tot_autoprodotte.'</td>
					<td></td>';
					@$percent_lordo = $pda_tot*100/$appuntamenti_lordi_non_gestiti;
					@$percent_netto = $pda_tot*100/$appuntamenti_netti_pda;
echo'					
					<td>'.number_format($percent_lordo, 2).'%</td>
					<td>'.number_format($percent_netto, 2).'%</td>
					</tr>';

				
				}

							echo '
					<tr><td colspan="19"></td></tr>
					</tbody>
					<tfoot>';

/*					echo'<tr><td colspan="5">'.$row['JOIN_CRM'].'</td>';
					echo'<td colspan="5">'.$row['JOIN_CRM'].'</td></tr>';
*/
					echo'
					
					<tr>
					<td>Tot Outbound</td>';

					//	TOT

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `MACRO_ATTIVITA` = 'shp'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_totali = $row['COUNT(ID_APPUNTAMENTO)'];
					echo '
					<td>'.$appuntamenti_totali.'</td>';					

					//	NON GESTITI

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'LORDO'
					AND `SVA_SOTTO_STATO` = 'ASSEGNATO'
					AND `MACRO_ATTIVITA` = 'shp'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_non_gestiti = $row['COUNT(ID_APPUNTAMENTO)'];

					echo '
					<td style="color:red">'.$appuntamenti_non_gestiti.'</td>';

					//	LORDI

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'LORDO'
					AND `SVA_SOTTO_STATO` != 'ASSEGNATO'
					AND `MACRO_ATTIVITA` = 'shp'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_lordi = $row['COUNT(ID_APPUNTAMENTO)'];
					$appuntamenti_lordi_non_gestiti = $appuntamenti_non_gestiti + $appuntamenti_lordi;
					echo '
					<td style="color: orange">'.$appuntamenti_lordi.'</td>';

					//	NETTI

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'NETTO'
					AND `MACRO_ATTIVITA` = 'shp'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_netti = $row['COUNT(ID_APPUNTAMENTO)'];
			
					echo '
					<td style="color:blue">'.$appuntamenti_netti.'</td>';

					//	APPUNTAMENTI CHE DIVENTANO PDA

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND `SVA_STATO` = 'PDA'
					AND `MACRO_ATTIVITA` = 'shp'
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$appuntamenti_pda = $row['COUNT(ID_APPUNTAMENTO)'];
					$appuntamenti_netti_pda = $appuntamenti_netti+$appuntamenti_pda;

					echo '
					<td style="color:green">'.$row['COUNT(ID_APPUNTAMENTO)'].'</td>
					<td></td>
					<td><strong>'.$appuntamenti_lordi_non_gestiti.'</strong></td>
					<td><strong>'.$appuntamenti_netti_pda.'</strong></td>
					<td></td>';

					//
					//	TOTALE PDA (RES)

					$sql = "SELECT SUM(PDA_SHP) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$pda_tot = $row['SUM(PDA_SHP)'];
					
					//	TOTALE PDA RES DA rec Pending

					$sql = "SELECT SUM(PDA_SHP) FROM `appuntamenti_png` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					AND ID IN (
					SELECT MAX(ID)
					FROM `appuntamenti_png`
					GROUP BY ID_APPUNTAMENTO
					)
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$pda_da_png=$row['SUM(PDA_SHP)'];
					$pda_scarto = $pda_tot - $pda_da_png;
					
					//	AUTOPRODOTTE

					$sql = "SELECT SUM(PDA_SHP) FROM `autoprodotte` WHERE MONTH(DATA) = ".$mese_calc."
					AND YEAR(DATA) = ".$anno_calc."
					";
					$result = mysql_query($sql);
					
					if (!$result) {
					echo "DB Error - ";
					echo 'MySQL Error: ' . mysql_error();
					exit;
					}
					
					$row = mysql_fetch_assoc($result);
					$autoprodotte = $row['SUM(PDA_SHP)'];
					
					echo '
					<td><strong>'.$pda_scarto.'</strong></td>
					<td><strong>'.$pda_da_png.'</strong></td>
					<td style="background-color:yellow"><strong>'.$pda_tot.'</strong></td>';
					
echo'
					<td style="background-color:orange">'.$autoprodotte.'</td>';
					
					$pda_tot_autoprodotte = $pda_tot + $autoprodotte;

echo'					
					<td style="background-color:orange">'.$pda_tot_autoprodotte.'</td>
					<td></td>';
					@$percent_lordo = $pda_tot*100/$appuntamenti_lordi_non_gestiti;
					@$percent_netto = $pda_tot*100/$appuntamenti_netti_pda;
echo'					
					<td>'.number_format($percent_lordo, 2).'%</td>
					<td>'.number_format($percent_netto, 2).'%</td>
					</tr>

				
											</tfoot>
						
						</table>
					</div>
			     </div><!-- ./panel body -->
            </div><!-- ./panel panel -->
		</div><!-- ./col-lg-4 -->
	';
			
?>
   
    </div><!-- /.row -->
    <!-- /shp -->

</div><!-- /#page-wrapper -->


<?php include_once("bottom.php"); ?>
