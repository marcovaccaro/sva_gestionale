<?php include_once("top.php"); ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        	<h1 class="page-header">Gestione Stands</h1>
        </div><!-- /.col-lg-12 -->

<?php

	if (isset ($_REQUEST["crea_stand"]) && $_REQUEST["crea_stand"]=="crea_stand")
	{
		mysql_connect(DBURI ,DBUSER ,DBPASS);
		mysql_select_db(DBNAME);

		$query="
		INSERT INTO `Stands_".ANNO."` (`STAND`) VALUES
		('" . htmlentities($_REQUEST["nuovo_stand"], ENT_QUOTES) . "');
		";
		
		$res = mysql_query($query);
		if ($res)
		{echo"<br><br>STAND CREATO<br><br>";}
		else
		{ echo '<br><br><span style="color:red">MySQL Error: ' .mysql_error(). '</span><br><br>';}
	}

// fine creo stand

	if (isset ($_REQUEST["stand_update"]) && $_REQUEST["stand_update"]=="stand_update")
	{
		//aggiorno stands
		
		//$check_01 = isset($_POST['01']) ? $_POST['01'] : 'N';
		
		mysql_connect(DBURI ,DBUSER ,DBPASS);
		mysql_select_db(DBNAME);

		//UPDATE `svasrl_CANNAS`.`Stands_XXXX` SET
		$query="

		UPDATE `Stands_".ANNO."` SET 
		`COSTO` = '" . htmlentities($_REQUEST["costo"], ENT_QUOTES) . "',
		`1` = '" . htmlentities($_REQUEST["01"], ENT_QUOTES) . "',
		`2` = '" . htmlentities($_REQUEST["02"], ENT_QUOTES) . "',
		`3` = '" . htmlentities($_REQUEST["03"], ENT_QUOTES) . "',
		`4` = '" . htmlentities($_REQUEST["04"], ENT_QUOTES) . "',
		`5` = '" . htmlentities($_REQUEST["05"], ENT_QUOTES) . "',
		`6` = '" . htmlentities($_REQUEST["06"], ENT_QUOTES) . "',
		`7` = '" . htmlentities($_REQUEST["07"], ENT_QUOTES) . "',
		`8` = '" . htmlentities($_REQUEST["08"], ENT_QUOTES) . "',
		`9` = '" . htmlentities($_REQUEST["09"], ENT_QUOTES) . "',
		`10` = '" . htmlentities($_REQUEST["10"], ENT_QUOTES) . "',
		`11` = '" . htmlentities($_REQUEST["11"], ENT_QUOTES) . "',
		`12` = '" . htmlentities($_REQUEST["12"], ENT_QUOTES) . "',
		`13` = '" . htmlentities($_REQUEST["13"], ENT_QUOTES) . "',
		`14` = '" . htmlentities($_REQUEST["14"], ENT_QUOTES) . "',
		`15` = '" . htmlentities($_REQUEST["15"], ENT_QUOTES) . "',
		`16` = '" . htmlentities($_REQUEST["16"], ENT_QUOTES) . "',
		`17` = '" . htmlentities($_REQUEST["17"], ENT_QUOTES) . "',
		`18` = '" . htmlentities($_REQUEST["18"], ENT_QUOTES) . "',
		`19` = '" . htmlentities($_REQUEST["19"], ENT_QUOTES) . "',
		`20` = '" . htmlentities($_REQUEST["20"], ENT_QUOTES) . "',
		`21` = '" . htmlentities($_REQUEST["21"], ENT_QUOTES) . "',
		`22` = '" . htmlentities($_REQUEST["22"], ENT_QUOTES) . "',
		`23` = '" . htmlentities($_REQUEST["23"], ENT_QUOTES) . "',
		`24` = '" . htmlentities($_REQUEST["24"], ENT_QUOTES) . "',
		`25` = '" . htmlentities($_REQUEST["25"], ENT_QUOTES) . "',
		`26` = '" . htmlentities($_REQUEST["26"], ENT_QUOTES) . "',
		`27` = '" . htmlentities($_REQUEST["27"], ENT_QUOTES) . "',
		`28` = '" . htmlentities($_REQUEST["28"], ENT_QUOTES) . "',
		`29` = '" . htmlentities($_REQUEST["29"], ENT_QUOTES) . "',
		`30` = '" . htmlentities($_REQUEST["30"], ENT_QUOTES) . "',
		`31` = '" . htmlentities($_REQUEST["31"], ENT_QUOTES) . "',
		`32` = '" . htmlentities($_REQUEST["32"], ENT_QUOTES) . "',
		`33` = '" . htmlentities($_REQUEST["33"], ENT_QUOTES) . "',
		`34` = '" . htmlentities($_REQUEST["34"], ENT_QUOTES) . "',
		`35` = '" . htmlentities($_REQUEST["35"], ENT_QUOTES) . "',
		`36` = '" . htmlentities($_REQUEST["36"], ENT_QUOTES) . "',
		`37` = '" . htmlentities($_REQUEST["37"], ENT_QUOTES) . "',
		`38` = '" . htmlentities($_REQUEST["38"], ENT_QUOTES) . "',
		`39` = '" . htmlentities($_REQUEST["39"], ENT_QUOTES) . "',
		`40` = '" . htmlentities($_REQUEST["40"], ENT_QUOTES) . "',
		`41` = '" . htmlentities($_REQUEST["41"], ENT_QUOTES) . "',
		`42` = '" . htmlentities($_REQUEST["42"], ENT_QUOTES) . "',
		`43` = '" . htmlentities($_REQUEST["43"], ENT_QUOTES) . "',
		`44` = '" . htmlentities($_REQUEST["44"], ENT_QUOTES) . "',
		`45` = '" . htmlentities($_REQUEST["45"], ENT_QUOTES) . "',
		`46` = '" . htmlentities($_REQUEST["46"], ENT_QUOTES) . "',
		`47` = '" . htmlentities($_REQUEST["47"], ENT_QUOTES) . "',
		`48` = '" . htmlentities($_REQUEST["48"], ENT_QUOTES) . "',
		`49` = '" . htmlentities($_REQUEST["49"], ENT_QUOTES) . "',
		`50` = '" . htmlentities($_REQUEST["50"], ENT_QUOTES) . "',
		`51` = '" . htmlentities($_REQUEST["51"], ENT_QUOTES) . "',
		`52` = '" . htmlentities($_REQUEST["52"], ENT_QUOTES) . "',
		`53` = '" . htmlentities($_REQUEST["53"], ENT_QUOTES) . "'
		WHERE `Stands_".ANNO."`.`ID` = " . htmlentities($_REQUEST["stand_id"], ENT_QUOTES) . ";

		";

		/*echo '<br><br>';
		var_dump($query);
		echo '<br><br>';*/

		
		$res = mysql_query($query);
		if ($res)
		{echo"<br><br>STAND AGGIORNATO<br><br>";}
		else
		{ echo '<br><br><span style="color:red">MySQL Error: ' .mysql_error(). '</span><br><br>';}

	}


			if (isset($_GET["mese_calc"]))
			{ $mese_calc = $_GET["mese_calc"]; }
			else{ $mese_calc = (int)date("m"); }
			
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
                            Settimane
	
		
		
<?php
			

// ------------------------------------------

// array per i mesi il primo elemento è fittizio (1) 
$mesi = array(1, 'Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 
    'Settembre', 'Ottobre', 'Novembre', 'Dicembre'); 

// dichiaro il nome della funzione 
function settimane_nel_mese($month, $year) { 
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
    for ($i = 1; $i <= $giorni_nel_mese; $i++) { 
        // se il giorno arriva a Domenica(7) o se è l'ultima iterazione 
        if ($j == 7 || $i == $giorni_nel_mese) { 
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
			{$settimane[(int) $numero_settimana] .= '<span style="color:red"> - NO</span>';} /**/

			/**/
			
			
			
            // riporto al lunedi le varibili 
            $j = 1; 
            $giorni = 0; 
            // altrimenti 
        } else { 
            // incremento i valori 
            $j++; 
            $giorni++; 
        } 
    } 
    return $settimane;
	
} 

// valorizzo il mese 
$month = $mese_calc; // 
// valorizzo l'anno 
$year = ANNO; 
// richiamo la funzione  
$settimane = settimane_nel_mese($month, $year); 
// mostro il mese e l'anno valorizzati 
echo '
per il mese di ' . $mesi[(int) $month] . ' ' . $year . '

                        </div>
                        <div class="panel-body"><p>
'; 
// mostro l'array 
foreach ($settimane as $key => $value) { 

    echo "
	
	                            Settimana $key : $value <br/>"; 
} 

//var_dump($settimane);
echo '

							</p>
 
				
';

?>
</div><!-- ./panel body -->							
<div class="panel-footer">
							
<form action="#" method="get">
<fieldset>
<div class="form-group">
<label>Scegli mese</label>
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

                </div><!-- ./panel-footer -->
            </div><!-- ./panel panel -->
		</div><!-- ./col-lg-4 -->


<?php
if ($_SESSION["utenza"] == 0 || $_SESSION["utenza"] == 1 || $_SESSION["utenza"] == 2) { echo '
<div class="col-lg-4">
			<div class="panel panel-default">
                <div class="panel-heading">
                Inserisci Nuovo Stand
                </div>
                <div class="panel-body"> 
        
                <form action="gestione_stands.php" method="post">   
				<fieldset>
				<div class="form-group">
                <input type="text" name="nuovo_stand" class="form-control" />   
				</div>
                <input name="crea_stand" value="crea_stand" class="btn btn-default" type="submit">
				</fieldset>
				</form>

                </div><!-- ./panel body -->
            </div><!-- ./panel panel -->
		</div>';
														  }
?>

<?

			mysql_connect(DBURI ,DBUSER ,DBPASS);
			mysql_select_db(DBNAME);
			
// STANDS

			$sql = "SELECT * FROM `Stands_".ANNO."` ORDER BY `STAND` ASC";
			$result = mysql_query($sql);
			
			if (!$result) {
				echo "DB Error - ";
				echo 'MySQL Error: ' . mysql_error();
				exit;
			}
			echo '

<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Calendario Stands
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-calendario">
                                    <thead>
                                        <tr>
											<th>STAND</th>';

if ($_SESSION["utenza"] == 0 || $_SESSION["utenza"] == 1) { echo '<th>COSTO</th>'; } else { echo '<th></th>'; }
											
											echo '<th style="padding:4px;">01</th>
											<th style="padding:4px;">02</th>
											<th style="padding:4px;">03</th>
											<th style="padding:4px;">04</th>
											<th style="padding:4px;">05</th>
											<th style="padding:4px;">06</th>
											<th style="padding:4px;">07</th>
											<th style="padding:4px;">08</th>
											<th style="padding:4px;">09</th>
											<th style="padding:4px;">10</th>
											<th style="padding:4px;">11</th>
											<th style="padding:4px;">12</th>
											<th style="padding:4px;">13</th>
											<th style="padding:4px;">14</th>
											<th style="padding:4px;">15</th>
											<th style="padding:4px;">16</th>
											<th style="padding:4px;">17</th>
											<th style="padding:4px;">18</th>
											<th style="padding:4px;">19</th>
											<th style="padding:4px;">20</th>
											<th style="padding:4px;">21</th>
											<th style="padding:4px;">22</th>
											<th style="padding:4px;">23</th>
											<th style="padding:4px;">24</th>
											<th style="padding:4px;">25</th>
											<th style="padding:4px;">26</th>
											<th style="padding:4px;">27</th>
											<th style="padding:4px;">28</th>
											<th style="padding:4px;">29</th>
											<th style="padding:4px;">30</th>
											<th style="padding:4px;">31</th>
											<th style="padding:4px;">32</th>
											<th style="padding:4px;">33</th>
											<th style="padding:4px;">34</th>
											<th style="padding:4px;">35</th>
											<th style="padding:4px;">36</th>
											<th style="padding:4px;">37</th>
											<th style="padding:4px;">38</th>
											<th style="padding:4px;">39</th>
											<th style="padding:4px;">40</th>
											<th style="padding:4px;">41</th>
											<th style="padding:4px;">42</th>
											<th style="padding:4px;">43</th>
											<th style="padding:4px;">44</th>
											<th style="padding:4px;">45</th>
											<th style="padding:4px;">46</th>
											<th style="padding:4px;">47</th>
											<th style="padding:4px;">48</th>
											<th style="padding:4px;">49</th>
											<th style="padding:4px;">50</th>
											<th style="padding:4px;">51</th>
											<th style="padding:4px;">52</th>
											<th style="padding:4px;">53</th>
											<th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
';


			while ($row = mysql_fetch_assoc($result)) {
				
		echo '
		<tr>';
		
if ($_SESSION["utenza"] == 0 || $_SESSION["utenza"] == 1 || $_SESSION["utenza"] == 2)
	
{		
echo '<form action="gestione_stands.php" method="post"><fieldset>';
}
				
echo '	<td>
		<input type="hidden" name="stand_id" value="'.$row['ID'].'"/>'
			.$row['STAND'].
			'</td>';
				
if ($_SESSION["utenza"] == 0 || $_SESSION["utenza"] == 1)
{ echo '
<td>
<input type="text" name="costo" value="'.$row['COSTO'].'" class="form-control" style="width:90px"/>
</td>'; } else { echo '<td></td>'; }


		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="01" value="Y"';
		if ($row['1'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="02" value="Y"';
		if ($row['2'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';
				
		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="03" value="Y"';
		if ($row['3'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';
				

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="04" value="Y"';
		if ($row['4'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="05" value="Y"';
		if ($row['5'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="06" value="Y"';
		if ($row['6'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="07" value="Y"';
		if ($row['7'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="08" value="Y"';
		if ($row['8'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="09" value="Y"';
		if ($row['9'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="10" value="Y"';
		if ($row['10'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="11" value="Y"';
		if ($row['11'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="12" value="Y"';
		if ($row['12'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="13" value="Y"';
		if ($row['13'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="14" value="Y"';
		if ($row['14'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="15" value="Y"';
		if ($row['15'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="16" value="Y"';
		if ($row['16'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="17" value="Y"';
		if ($row['17'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="18" value="Y"';
		if ($row['18'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="19" value="Y"';
		if ($row['19'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="20" value="Y"';
		if ($row['20'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="21" value="Y"';
		if ($row['21'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="22" value="Y"';
		if ($row['22'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="23" value="Y"';
		if ($row['23'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="24" value="Y"';
		if ($row['24'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="25" value="Y"';
		if ($row['25'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="26" value="Y"';
		if ($row['26'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="27" value="Y"';
		if ($row['27'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="28" value="Y"';
		if ($row['28'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="29" value="Y"';
		if ($row['29'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="30" value="Y"';
		if ($row['30'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="31" value="Y"';
		if ($row['31'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="32" value="Y"';
		if ($row['32'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="33" value="Y"';
		if ($row['33'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="34" value="Y"';
		if ($row['34'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="35" value="Y"';
		if ($row['35'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="36" value="Y"';
		if ($row['36'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="37" value="Y"';
		if ($row['37'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="38" value="Y"';
		if ($row['38'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="39" value="Y"';
		if ($row['39'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="40" value="Y"';
		if ($row['40'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="41" value="Y"';
		if ($row['41'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="42" value="Y"';
		if ($row['42'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="43" value="Y"';
		if ($row['43'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="44" value="Y"';
		if ($row['44'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="45" value="Y"';
		if ($row['45'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="46" value="Y"';
		if ($row['46'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="47" value="Y"';
		if ($row['47'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="48" value="Y"';
		if ($row['48'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="49" value="Y"';
		if ($row['49'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="50" value="Y"';
		if ($row['50'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="51" value="Y"';
		if ($row['51'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="52" value="Y"';
		if ($row['52'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

		echo '<td style="padding: 4px 0 0 6px;"><input type="checkbox" name="53" value="Y"';
		if ($row['53'] == 'Y') {echo 'checked="checked"';}
		echo 'class="form-control" style="-webkit-box-shadow: none; box-shadow: none;"/></td>';

if ($_SESSION["utenza"] == 0 || $_SESSION["utenza"] == 1 || $_SESSION["utenza"] == 2) { echo '<td>
				<button type="submit" name="stand_update" value="stand_update" class="btn btn-default">Aggiorna</button>
				</td>
				</fieldset>
				</form>'; } else { echo '<td></td>'; }						
				
				echo '
				
				</tr>';				
						/*
				
						if ($row['login']!=='admin' & $row['login']!=='superadmin')
						{echo '<td>'.$row['login'].'</td><td><span style="';
						if ($row['password']!==$row['login']) {echo 'color:green';}
						echo '">'.$row['password'].'</span></td><td><span style="';
						if ($row['LAST_LOG']!=='0000-00-00 00:00:00') {echo 'color:green';}else{echo 'color:#fff';}
						echo '">'.$row['LAST_LOG'].'</span></td><td>'.$row['gara'].'</td><td><a href="drop_venditore.php?venditore='. $row['login'] .
						'" onclick="return confirm(\'Elimino?\')">elimina</a></td></tr>';}*/
			}

			echo '			
								</tbody>
							</table>
						</div><!-- ./table-responsive -->
					 </div><!-- ./panel body -->
				</div><!-- ./panel panel -->
			</div><!-- ./col-lg-12 -->';
			
/*/CC

			$sql = "SELECT * FROM pro_user WHERE login LIKE 'CC %' ORDER BY login";
			$result = mysql_query($sql);
			
			if (!$result) {
				echo "DB Error - ";
				echo 'MySQL Error: ' . mysql_error();
				exit;
			}
			echo '<div style="float:left;width:280px;margin-left:10px"><table border="1" width="100%"><tr>';
			echo '<th>Operatore CC</th>';
			echo '<th>Password</th><th></th>';
			echo '</tr><tr>';


			while ($row = mysql_fetch_assoc($result)) {
						if ($row['login']!=='admin' & $row['login']!=='superadmin')
						{echo '<td>'.$row['login'].'</td><td><span style="';
						if ($row['password']!==$row['login']) {echo 'color:red';}
						echo '">'.$row['password'].'</span></td><td><a href="drop_venditore.php?venditore='. $row['login'] .
						'" onclick="return confirm(\'Elimino?\')">elimina</a></td></tr>';}
			}

			echo '</table></div>';

// AG

			$sql = "SELECT * FROM pro_user WHERE login LIKE 'AG %' ORDER BY login";
			$result = mysql_query($sql);
			
			if (!$result) {
				echo "DB Error - ";
				echo 'MySQL Error: ' . mysql_error();
				exit;
			}
			echo '<div style="float:left;width:280px;margin-left:10px"><table border="1" width="100%"><tr>';
			echo '<th>Agenzia</th>';
			echo '<th>Password</th><th></th>';
			echo '</tr><tr>';


			while ($row = mysql_fetch_assoc($result)) {
						if ($row['login']!=='admin' & $row['login']!=='superadmin')
						{echo '<td>'.$row['login'].'</td><td><span style="';
						if ($row['password']!==$row['login']) {echo 'color:red';}
						echo '">'.$row['password'].'</span></td><td><a href="drop_venditore.php?venditore='. $row['login'] .
						'" onclick="return confirm(\'Elimino?\')">elimina</a></td></tr>';}
			}

			echo '</table></div><div style="clear:both"></div>';*/

?>
  
    </div><!-- /.row -->
</div><!-- /#page-wrapper -->


<?php include_once("bottom.php"); ?>
