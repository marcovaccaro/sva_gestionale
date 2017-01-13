<?php include_once("top.php"); ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        	<h1 class="page-header">Gara interna</h1>
        </div>
        <!-- /.col-lg-12 -->
    
<?

mysql_connect(DBURI ,DBUSER ,DBPASS);
mysql_select_db(DBNAME);

	switch ($mese)
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

			$query2="select * from garette WHERE mese_anno = '$mese';";
			$res2 = mysql_query($query2);
			if ($res2 && mysql_num_rows($res2)>0)
			{
				$row2=mysql_fetch_assoc($res2);
				$gara1=$row2['gara1'];
				$gara2=$row2['gara2'];
				$gara3=$row2['gara3'];
				$giorni = cal_days_in_month(CAL_GREGORIAN, $month , ANNO);	
			}

/*
SELECT * FROM `agosto_XXXX`
WHERE (`CODICE_INSERIMENTO` != ''
       AND (`PORTAB` != 'LNA' AND `DETTAGLI` != 'gia&#039; presente'))
AND `VENDITORE` = 'Ripepi'

ripepi tot = 43
ripepi ok = 35
ripepi ok _ già presente = 25
ripepi ok _ lna = 15
ripepi ok _ già presente _ lna = 9
ripepi ok _ già presente _ !lna = 16 WHERE `CODICE_INSERIMENTO` != '' AND `PORTAB` != 'LNA' AND `DETTAGLI` != 'gia\' presente'
= 6
*/




	$query="
	SELECT `VENDITORE`,
	COUNT(`ID`) FROM $mese
	WHERE `CODICE_INSERIMENTO` != ''
	AND `VENDITORE` NOT LIKE 'cc %'
	AND `VENDITORE` NOT LIKE 'ag %'
	GROUP BY `VENDITORE`
	ORDER BY COUNT(`ID`) DESC;
	";
		$res = mysql_query($query);
		if ($res && mysql_num_rows($res)>0)
		{
		echo '
<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            '.$mese.'
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
											<th>Venditore</th>
											<th>Pda ok</th>
											<th style="width:116px!important;white-space: inherit!important;">Gare</th>
										</tr>
                                    </thead>
                                    <tbody>';
		while($row=mysql_fetch_assoc($res))
			{
				
// mod
					
	$result = mysql_query("SELECT COUNT(`ID`) as total FROM $mese
	WHERE `CODICE_INSERIMENTO` != '' AND `PORTAB` = 'LNA' AND `DETTAGLI` = 'gia&#039; presente'
	AND `VENDITORE` = '".$row['VENDITORE']."';");
	$data = mysql_fetch_assoc($result);
	$lenght_forse = $data['total']*1;
	//var_dump($lenght_forse);
	$lenght_forse_pixel = $data['total']*2;
	//var_dump($lenght_forse_pixel);
	
//mod				
				
				$lenght=$row['COUNT(`ID`)']*2 - $lenght_forse_pixel;	//
				$pippo=$row['COUNT(`ID`)']*1-$lenght_forse;				//
				
				if ($lenght > 0 && $lenght < 39) {$span_bar = 'red';}
				else if ($lenght > 39 && $lenght < 59) {$span_bar = 'yellow';}
				else if ($lenght > 59 && $lenght < 99) {$span_bar = 'yellowgreen';}
				else if ($lenght > 99) {$span_bar = 'green';}
				$pixel1=$gara1*2-1;
				$pixel2=($gara2-$gara1)*2-1;
				$pixel3=($gara3-$gara2)*2-1;
				echo '<tr><td>'.ucfirst($row['VENDITORE']).'</td><td>'.$pippo.'</td><td>
				<div style="height:14px;padding-right:1px;width:'.$pixel1.'px;border-right:1px solid black;border-bottom:1px solid grey;float:left;text-align:right;font-size: 10px;">20</div>
				<div style="height:14px;padding-right:1px;width:'.$pixel2.'px;border-right:1px solid black;border-bottom:1px solid grey;float:left;text-align:right;font-size: 10px;">30</div>
				<div style="height:14px;padding-right:1px;width:'.$pixel3.'px;border-right:1px solid black;border-bottom:1px solid grey;float:left;text-align:right;font-size: 10px;">50</div>
				<div style="clear:both"></div>
				<div style="height:12px;width:'.$lenght.'px;background:'.$span_bar.'"></div>
				</td></tr>';	
			}
			
			// venditori a zero
			$query="
SELECT login FROM pro_user as o LEFT JOIN $mese as c ON o.login = c.VENDITORE
WHERE c.VENDITORE IS NULL
AND o.login NOT LIKE 'cc %'
AND o.login NOT LIKE 'ag %'
AND o.login NOT LIKE 'admin'
AND o.login NOT LIKE 'superadmin'
AND o.login NOT LIKE 'CANNAS'
AND o.login NOT LIKE 'HUBER';
";
			$res = mysql_query($query);
			if ($res && mysql_num_rows($res)>0)
				{
				while($row=mysql_fetch_assoc($res))
					{
					echo "<tr><td>".ucfirst(strtolower($row['login']))."</td><td>0</td><td>0</td></tr>";	
					}
				}
			// fine venditori a zero
					
			echo '                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
';
		}
		
?>
    
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->


<?php include_once("bottom.php"); ?>