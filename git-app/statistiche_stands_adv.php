<?php include_once("top.php"); ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        	<h1 class="page-header">Report Stands</h1>
        </div><!-- /.col-lg-12 -->
<?php

			if (isset($_GET["mese_calc"]))
			{ $mese_calc = $_GET["mese_calc"]; }
			else
			{ $mese_calc = (int)date("m"); }
			
			switch ($mese_calc) {
									
						case '01':
						$mese='gennaio_'.ANNO.'_stand';
						break;
									
						case '02':
						$mese='febbraio_'.ANNO.'_stand';
						break;
									
						case '03':
						$mese='marzo_'.ANNO.'_stand';
						break;
									
						case '04':
						$mese='aprile_'.ANNO.'_stand';
						break;
									
						case '05':
						$mese='maggio_'.ANNO.'_stand';
						break;
									
						case '06':
						$mese='giugno_'.ANNO.'_stand';
						break;
									
						case '07':
						$mese='luglio_'.ANNO.'_stand';
						break;
									
						case '08':
						$mese='agosto_'.ANNO.'_stand';
						break;
									
						case '09':
						$mese='settembre_'.ANNO.'_stand';
						break;
									
						case '10':
						$mese='ottobre_'.ANNO.'_stand';
						break;
									
						case '11':
						$mese='novembre_'.ANNO.'_stand';
						break;
									
						case '12':
						$mese='dicembre_'.ANNO.'_stand';
						break;

						default:
						$mese = MESE_CORRENTE_STAND;
						break;

						}
?>
		
				<div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Settimane da computare
	
		
		
<?php

// ------------------------------------------ funzione calcolo settimane / anno

// array per i mesi il primo elemento è fittizio (1) 

$mesi = array(1, 'Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 
    'Settembre', 'Ottobre', 'Novembre', 'Dicembre'); 

// dichiaro il nome della funzione

function settimane_nel_mese($month, $year)
{ 
	
// array per i giorni della settimana il primo elemento è fittizio (1) 
   
	$giorni_settimana = array(1, "Lun", "Mar", "Mer", "Gio", "Ven", "Sab", "Dom"); 
    
	// recupero il timestamp del primo giorno del mese 
    
	$time_primo_del_mese = mktime(0, 0, 0, $month, 1, $year); 
    
	// recupero il numero per il giorno della settimana (0->Dom 6->Sab) 
    
	$primo_del_mese = date('w', $time_primo_del_mese); 
    
	// conto i giorni del mese 
    
	$giorni_nel_mese = cal_days_in_month(CAL_GREGORIAN, $month, $year); 
    
	// inizializzo un array che conterra i dati delle settimane 
    
	$settimane = array(); 
    
	// dichiaro una variabile che mi servirà per tenere il conto dei giorni da 0 a 6 
    
	$giorni = 0; 
    
	// assegno ad una variabile il numero per il giorno della settimana 
    
	$j = $primo_del_mese; 
    
	// inizio il ciclo 
    
	for ($i = 1; $i <= $giorni_nel_mese; $i++)
	{ 
        
		// se il giorno arriva a Domenica(7) o se è l'ultima iterazione 
       
		if ($j == 7 || $i == $giorni_nel_mese)
		{ 
            
			// recupero il timestamp del giorno 
            
			$time_giorno = mktime(0, 0, 0, $month, $i, $year); 
            
			// recupero il numero della settimana nell'anno 
            
			$numero_settimana = date('W', $time_giorno); 
            
			// calcolo la partenza della settimana girono e numero 
            
			$giorno_partenza = $j - $giorni; 
            $numero_partenza = $i - $giorni; 
            
			// popolo l'array che come indice avrà il numero della settimana 
            // come valore ho calcolato il giorno e il numero di partenza e di fine della settimana 
            //$settimane[(int) $numero_settimana] = "da $giorni_settimana[$giorno_partenza] $numero_partenza a $giorni_settimana[$j] $i "; 
			// $pale = var_dump($giorni_settimana[$giorno_partenza]);
            
			$settimane[(int) $numero_settimana] = "da ".$giorni_settimana[$giorno_partenza]." ".$numero_partenza." a ".$giorni_settimana[$j]." ".$i . $pale; 
			
			if ($giorni_settimana[$giorno_partenza] == 'Lun' || $giorni_settimana[$giorno_partenza] == 1)
			{$settimane[(int) $numero_settimana] .= '<span style="color:green"> - SI</span>';}
			else
			{$settimane[(int) $numero_settimana] .= '<span style="color:red"> - NO</span>';}

			// riporto al lunedi le varibili 
			
            $j = 1; 
            $giorni = 0; 
			
            // altrimenti 
			
        }
		else
		{ 
            // incremento i valori
			
            $j++; 
            $giorni++; 
        } 
    } 
	
    return $settimane;
}

// ------------------------------------------ fine funzione calcolo settimane / anno

// valorizzo il mese 

$month = $mese_calc;

// valorizzo l'anno 

$year = ANNO;

// richiamo la funzione  

$settimane = settimane_nel_mese($month, $year); 

// mostro il mese e l'anno valorizzati 

echo '							per il mese di ' . $mesi[(int) $month] . ' ' . $year . '
								</div>
                        	<div class="panel-body"><p>
';

// mostro l'array 

	foreach ($settimane as $key => $value)
	{ 
	 echo "					Settimana $key : $value <br/>"; 
	} 

	echo '
								</p>
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
					</div>	

	<div class="col-lg-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								Cambia mese
					</div>
					<div class="panel-body">				
	';

?>
							
<script src="SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>
<link href="SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />


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
        <div class="col-lg-12">
		
		
<?
		mysql_connect(DBURI ,DBUSER ,DBPASS);
		mysql_select_db(DBNAME);

//trovo tutti gli stand nella tabella

		$query_stand = "SELECT DISTINCT STAND FROM  ".$mese;
		$res_stand = mysql_query($query_stand);
		if ($res_stand && mysql_num_rows($res_stand)>0)
		{
		$name=0;
		$tab=1;
		$jtab=1;
		$vtab=1;
		$xtab=1;
		while($row_stand=mysql_fetch_assoc($res_stand))
		{

//per ogni stand trovato (se ne trovo) assegno il costo settimanale

				if ($row_stand['STAND']!=='')
				{
				$name=$name+1;

				$STAND = $row_stand['STAND'];
				/*switch ($STAND) {

							case strtolower('8 GALLERY'):
							$COSTO=544 ;
							break;

							case strtolower('AQUILONE'):
							$COSTO=374 ;
							break;

							case strtolower('BENNET CARMAGNOLA'):
							$COSTO=500 ;
							break;

							case strtolower('CASELLE'):
							$COSTO=500 ;
							break;

							case strtolower('FIUMARA'):
							$COSTO=721.5 ;
							break;

							case strtolower('MONTECUCCO'):
							$COSTO=471.75 ;
							break;

							case strtolower('ROMANIA'):
							$COSTO=846.37 ;
							break;

							case strtolower('VENARIA'):
							$COSTO=846.38 ;
							break;

							case strtolower('MILLECITY TORINO'):
							$COSTO=600;
							break;

							case strtolower('CENTRO LUNA'):
							$COSTO=333 ;
							break;

							case strtolower('CARREFOUR NICHELINO'):
							$COSTO=500 ;
							break;

							case strtolower('METRO TORINO'):
							$COSTO=1000 ;
							break;

							case strtolower('CONAD CARRARA'):
							$COSTO=400 ;
							break;

							case strtolower('la fabbrica-leclerc santo stefano di magra'):
							$COSTO=600 ;
							break;

							default:
							$COSTO=0 ;
							break;

							}*/

//interrogo la tabella per lo stand del ciclo

				$query = "SELECT * FROM  ".$mese."  WHERE STAND = '".$row_stand['STAND']."' AND CODICE_INSERIMENTO !='' ORDER BY DATA ASC;";
				$res = mysql_query($query);

				if ($res && mysql_num_rows($res)>0)
				{

//stampo intestazioni tabella

?>

			<div id="CollapsiblePanel<? echo $tab++; ?>" class="CollapsiblePanel">
			<div class="CollapsiblePanelTab" tabindex="0"><? echo strtoupper($STAND); ?></div>
			<div class="CollapsiblePanelContent">

						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>PDA</th>
										<th>DATA</th>
										<th>STAND</th>
										<th>PACCHETTO_TECNOLOGIA</th>

<?php
					if ($_SESSION["utenza"] == 0 || $_SESSION["utenza"] == 1) {echo '

										<th>GETTONE</th>
										<th>PROVVIGIONE</th>
										<th>NETTO</th>

										';}
?>
									</tr>
								</thead>
								<tbody>
<?
							$TOTALE=0;
							$PDA=0;

//stampo ogni riga trovata (while nel while)

							while($row=mysql_fetch_assoc($res))
								{

								$PDA=$PDA+1;
								echo '

									<tr>
										<td>'.$PDA.'</td>
										<td>'.$row['DATA'].'</td>
										<td>'.$row['STAND'].'</td>
										<td>'.$row['PACCHETTO_TECNOLOGIA'].'</td>';
								
					if ($_SESSION["utenza"] == 0 || $_SESSION["utenza"] == 1) {echo '

										
										<td>'.$row['GETTONE'].'</td>
										<td>'.$row['PROVVIGIONE'].'</td>
										<td>'.$row['NETTO'].'</td>

										';}	

							echo '</tr>';

								$TOTALE += $row['NETTO'];
								$STAND = $row['STAND'];
								}	

							echo '<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>';

					if ($_SESSION["utenza"] == 0 || $_SESSION["utenza"] == 1) {echo '

									<td></td>
									<td></td>
									<td><span style="color:green; font-size:16px"><b>'.$TOTALE.'</b></span></td>

										';}	

							echo '</tr>
									</tbody>
			</table>
			';

?>
						</div><!-- div table resp -->
					<div style="margin: -10px 0 0 8px;" onclick="CollapsiblePanel<? echo $xtab++; ?>.close();">Chiudi</div>
				</div>
			</div>

			<script type="text/javascript">
			var CollapsiblePanel<? echo $jtab++; ?> = new Spry.Widget.CollapsiblePanel("CollapsiblePanel<? echo $vtab++; ?>", { contentIsOpen: false });
			</script>

<?
					$arr_settimane = array();

					foreach ( $settimane as $chiave => $valore)
					{

					if (substr($valore, -9, 2) == 'SI')
						{
						array_push($arr_settimane,$chiave);
						}

					}

					$query_calcolo_costi = 'SELECT ';

					foreach ( $arr_settimane as $chiave => $valore)
						{
						$query_calcolo_costi .= '`'.$valore.'`, ';
						}

					$query_calcolo_costi .= '`COSTO` FROM `Stands_'.ANNO.'` WHERE `STAND` = \''.$STAND.'\';';

					mysql_connect(DBURI ,DBUSER ,DBPASS);
					mysql_select_db(DBNAME);
					$result = mysql_query($query_calcolo_costi);
					$sett = 0;
					$costo_stand = '<span style="color:red">STAND NON PRESENTE!</span>';	//resetto la variabile ad ogni giro

					if (!$result)
					{
						echo "DB Error - ";
						echo 'MySQL Error: ' . mysql_error();
						//exit;
					}
					while ($row = mysql_fetch_assoc($result))
					{
						foreach ( $row as $chiave => $valore)
							{
							if ($valore == 'Y') {$sett++;}
							}
						$costo_stand = $row['COSTO'];
					}

					if ($_SESSION["utenza"] == 0 || $_SESSION["utenza"] == 1)
					{
					echo '<br>totale incasso al netto delle provvigioni: ' . $TOTALE;
					echo '<br>settimanale da calcolare: ' . $sett . '<br>';		
					echo 'costo settimanale stand: ' . $costo_stand . '<br>';
					echo 'costo totale mese: ' . $costo_stand*$sett . '<br>';
					$netto = $TOTALE - ($costo_stand*$sett);
					echo 'netto: ' . $netto;
					echo '<br>';
					}
					echo '<br>';
				} //352 ca
			} //278 ca
		} //273 ca
	} //266 ca

?>
        </div><!-- /.col-lg-12 -->   
    </div><!-- /.row -->
</div><!-- /#page-wrapper -->


<?php include_once("bottom.php"); ?>