<?php
include_once("top.php");
include_once("libreria_php/allowed_1.php");
?>

<?php

// scelta mese di consultazione

			if (isset($_GET["mese_calc"]))
			{ $mese_calc = $_GET["mese_calc"]; }
			else
			{ $mese_calc = (int)date("m"); }
			
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
        	<h1 class="page-header">Report Agenti <? echo $mese; ?> <span style="color:red">??</style></h1>
        </div><!-- /.col-lg-12 -->

<div class="col-lg-4">
			<div class="panel panel-default">
                <div class="panel-heading">
                Scegli Mese
                </div>
                <div class="panel-body"> 
        
                <form action="#" method="get">
                <fieldset>
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
                Residenziali
                </div>
                <div class="panel-body">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
			<thead>
			<tr>
			<th>Venditore</th>
			<th>App. TOT</th>
			<th>App. Non Gestiti</th>
			<th>App. Lordi</th>
			<th>App. Netti</th>
			<th>App. PDA</th>
			<th></th>
			<th><em>PDA Tot</em></th>
			<th><em>PDA Recupero PNG<em></th>
			<th>PDA Auto</th>
			<th>PDA TOT</th>
			<th>Chiusura Lordo</th>
			<th>Chiusura Netto</th>
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
			
					echo '
					<td>'.$row['COUNT(ID_APPUNTAMENTO)'].'</td>';					

					//	NON GESTITI

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
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
			
					echo '
					<td style="color:red">'.$row['COUNT(ID_APPUNTAMENTO)'].'</td>';

					//	LORDI

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
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
			
					echo '
					<td style="color: yellow">'.$row['COUNT(ID_APPUNTAMENTO)'].'</td>';

					//	NETTI

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
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
			
					echo '
					<td style="color:blue">'.$row['COUNT(ID_APPUNTAMENTO)'].'</td>';

					//	APPUNTAMENTI CHE DIVENTANO PDA

					$sql = "SELECT COUNT(ID_APPUNTAMENTO) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
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
					
					echo '
					<td style="color:green">'.$row['COUNT(ID_APPUNTAMENTO)'].'</td>
					<td></td>';

					//
					//	TOTALE PDA RES

					$sql = "SELECT SUM(PDA_RES) FROM `appuntamenti` WHERE MONTH(DATA) = ".$mese_calc."
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
					$sega = $row['SUM(PDA_RES)'];
					echo '
					<td>'.$sega.'</td>';

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
					$pippa=$row['SUM(PDA_RES)'];
					echo '
					<td>'.$pippa.'</td>';
					
echo'
					<td>3</td>';
					
					$suca=3;
					$fellazio=$sega+$suca;

echo'					
					<td>'.$fellazio.'</td>
					<td>XX</td>
					<td>XX</td>
					</tr>';

				
				}

							echo '
							</tbody>
							<tfoot>
							<tr>
							<td><strong>TOT</strong></td>
							<td><strong>TOT</strong></td>
							<td><strong>TOT</strong></td>
							<td><strong>TOT</strong></td>
							<td><strong>TOT</strong></td>
							<td><strong>TOT</strong></td>
							<td><strong></strong></td>
							<td><strong>TOT</strong></td>
							<td><strong>TOT</strong></td>
							<td><strong>CALC</strong></td>
							<td><strong>CALC</strong></td>
							<td><strong>CALC</strong></td>
							<td><strong>CALC</strong></td>

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
</div><!-- /#page-wrapper -->


<?php include_once("bottom.php"); ?>
