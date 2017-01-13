<?php include_once("top.php"); ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        	<h1 class="page-header">Situazione pda</h1>
        </div>

		<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
						<? echo $mese; ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">

<?


mysql_connect(DBURI ,DBUSER ,DBPASS);
mysql_select_db(DBNAME);

$query="select
VENDITORE,
DATA,
PACCHETTO_TECNOLOGIA,
RAG_SOC,
Nome_Cliente,
Cognome_Cliente,
PROVINCIA,
RECAPITO1,
RECAPITO2,
ORIGINE,
STAND,
OPERATORE_CC,
PORTAB,
DETTAGLI,
NOTE,
NOTE2,
CODICE_INSERIMENTO
from ".$mese."
WHERE VENDITORE = '".$_SESSION["user"]."'
OR OPERATORE_CC = '".$_SESSION["user"]."';";

echo '
<table class="table table-bordered">
	<thead>
		<tr>
';
echo '<th>PDA n</th>';
echo '<th>DATA</th>';
echo '<th>VENDITORE</th>';
echo '<th>OPERATORE CC</th>';
echo '<th>PACK</th>';
echo '<th>RAG_SOC</th>';
echo '<th>NOME</th>';
echo '<th>COGNOME</th>';
echo '<th>PROV</th>';
echo '<th>ORIG</th>';
echo '<th>REC 1</th>';
echo '<th>REC 2</th>';
echo '<th>STAND</th>';
echo '<th>LINEA</th>';
echo '<th>DETTAGLI</th>';
echo '<th>NOTE</th>';
echo '<th>NOTE2</th>';
echo '<th>CODICE_INSERIMENTO</th>';
echo "</tr>
</thead>
<tbody>
";

		$res = mysql_query($query);
		if ($res && mysql_num_rows($res)>0)
		{
			$pda=0;
			$pda_ok=0;
			$pda_forse=0;
		while($row=mysql_fetch_assoc($res))
			{
				$pda=$pda+1;

				if
				($row['CODICE_INSERIMENTO'] != '' && $row['PORTAB'] == 'lna'
				&& $row['DETTAGLI'] == "gia&#039; presente")
				{
				$pda_forse=$pda_forse+1;
				echo '<tr style="background-color:yellow"><td>' . $pda . '</td>';
				echo '<td>' . $row['DATA'] . '</td>';
				echo '<td>' . $row['VENDITORE'] . '</td>';
				echo '<td>' . $row['OPERATORE_CC'] . '</td>';
				echo '<td>' . $row['PACCHETTO_TECNOLOGIA'] . '</td>';
				echo '<td>' . $row['RAG_SOC'] . '</td>';
				echo '<td>' . $row['Nome_Cliente'] . '</td>';
				echo '<td>' . $row['Cognome_Cliente'] . '</td>';
				echo '<td>' . $row['PROVINCIA'] . '</td>';
				echo '<td>' . $row['ORIGINE'] . '</td>';
				echo '<td>' . $row['RECAPITO1'] . '</td>';
				echo '<td>' . $row['RECAPITO2'] . '</td>';
				echo '<td>' . $row['STAND'] . '</td>';
				echo '<td>' . $row['PORTAB'] . '</td>';
				echo '<td>' . $row['DETTAGLI'] . '</td>';
				echo '<td>' . $row['NOTE'] . '</td>';
				echo '<td>' . $row['NOTE2'] . '</td>';
				echo '<td>' . $row['CODICE_INSERIMENTO'] . '</td></tr>';
				}
				else if ($row['CODICE_INSERIMENTO'] =='')
				{
				echo '<tr style="background-color:#FF6A6A"><td>' . $pda . '</td>';
				echo '<td>' . $row['DATA'] . '</td>';
				echo '<td>' . $row['VENDITORE'] . '</td>';
				echo '<td>' . $row['OPERATORE_CC'] . '</td>';
				echo '<td>' . $row['PACCHETTO_TECNOLOGIA'] . '</td>';
				echo '<td>' . $row['RAG_SOC'] . '</td>';
				echo '<td>' . $row['Nome_Cliente'] . '</td>';
				echo '<td>' . $row['Cognome_Cliente'] . '</td>';
				echo '<td>' . $row['PROVINCIA'] . '</td>';
				echo '<td>' . $row['ORIGINE'] . '</td>';
				echo '<td>' . $row['RECAPITO1'] . '</td>';
				echo '<td>' . $row['RECAPITO2'] . '</td>';
				echo '<td>' . $row['STAND'] . '</td>';
				echo '<td>' . $row['PORTAB'] . '</td>';
				echo '<td>' . $row['DETTAGLI'] . '</td>';
				echo '<td>' . $row['NOTE'] . '</td>';
				echo '<td>' . $row['NOTE2'] . '</td>';
				echo '<td>' . $row['CODICE_INSERIMENTO'] . '</td></tr>';
				}
				else
				{
				$pda_ok=$pda_ok+1;
				echo '<tr><td>' . $pda . '</td>';
				echo '<td>' . $row['DATA'] . '</td>';
				echo '<td>' . $row['VENDITORE'] . '</td>';
				echo '<td>' . $row['OPERATORE_CC'] . '</td>';
				echo '<td>' . $row['PACCHETTO_TECNOLOGIA'] . '</td>';
				echo '<td>' . $row['RAG_SOC'] . '</td>';
				echo '<td>' . $row['Nome_Cliente'] . '</td>';
				echo '<td>' . $row['Cognome_Cliente'] . '</td>';
				echo '<td>' . $row['PROVINCIA'] . '</td>';
				echo '<td>' . $row['ORIGINE'] . '</td>';
				echo '<td>' . $row['RECAPITO1'] . '</td>';
				echo '<td>' . $row['RECAPITO2'] . '</td>';
				echo '<td>' . $row['STAND'] . '</td>';
				echo '<td>' . $row['PORTAB'] . '</td>';
				echo '<td>' . $row['DETTAGLI'] . '</td>';
				echo '<td>' . $row['NOTE'] . '</td>';
				echo '<td>' . $row['NOTE2'] . '</td>';
				echo '<td>' . $row['CODICE_INSERIMENTO'] . '</td></tr>';
				}
			}
		}
		$pda_ko = $pda - $pda_ok - $pda_forse;
		
		echo '
		                            </tbody>
                                </table>
								</div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>		
		';
		
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
				
				if ($month != MESE )
				{goto next1;}
				
				$pda_mancanti1=$gara1-$pda_ok;
				$pda_mancanti2=$gara2-$pda_ok;
				$pda_mancanti3=$gara3-$pda_ok;
								
				$str = date("d");
		   		$num = (int)$str;
				$giorni_rimasti=$giorni-$num;
				$media1=number_format($pda_mancanti1/$giorni_rimasti, 1);
				$media2=number_format($pda_mancanti2/$giorni_rimasti, 1);
				$media3=number_format($pda_mancanti3/$giorni_rimasti, 1);


		next1:
		echo '

<div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
Pda Totali: '.$pda.' | 
<span style="color:rgb(189, 189, 4);">Pda FORSE: '.$pda_forse.'</span> |
<span style="color:red">Pda KO: '.$pda_ko.'</span> |
<span style="color:green">Pda OK: '.$pda_ok.'</span>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						
<!--
'.date("F j, Y, g:i a", time()).' - '.$giorni.' - '.date("d").' - '.$giorni_rimasti.'
-->						
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
										<tr>
										<th>Scaglioni</th>
										<th>PDA Mancanti</th>
										<th>Giorni Rimasti</th>
										<th>Media Giornaliera</th>
										<th>Esito</th>
										</tr>
                                    </thead>
                                    <tbody>
		<tr><td>'.$gara1.'</td><td>'.$pda_mancanti1.'</td><td>'.$giorni_rimasti.'</td><td>'.$media1.'</td><td>';
		if ($pda_ok >= $gara1) {echo ' <span style="color:green">[RAGGIUNTA]</span>';} else {echo ' <span style="color:red">[NIENTE]</span>';}
		echo '</td></tr>
		<tr><td>'.$gara2.'</td><td>'.$pda_mancanti2.'</td><td>'.$giorni_rimasti.'</td><td>'.$media2.'</td><td>';
		if ($pda_ok >= $gara2) {echo ' <span style="color:green">[RAGGIUNTA]</span>';} else {echo ' <span style="color:red">[NIENTE]</span>';}
		echo '</td></tr>
		<tr><td>'.$gara3.'</td><td>'.$pda_mancanti3.'</td><td>'.$giorni_rimasti.'</td><td>'.$media3.'</td><td>';
		if ($pda_ok >= $gara3) {echo ' <span style="color:green">[RAGGIUNTA]</span>';} else {echo ' <span style="color:red">[NIENTE]</span>';}
		echo '</td></tr>';
		}
?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
   	 
             <div class="col-lg-4">
			<div class="panel panel-default">
                <div class="panel-heading">
                Scegli il mese
                </div>
                <div class="panel-body">                           
<form action="#" method="get">
<fieldset>
<div class="form-group">
<select name="mese" id="mese" class="form-control">
<option value="gennaio" <? if ($mese == 'gennaio_'.ANNO) echo 'selected="selected"'; ?>>gennaio</option>
<option value="febbraio" <? if ($mese == 'febbraio_'.ANNO) echo 'selected="selected"'; ?>>febbraio</option>
<option value="marzo" <? if ($mese == 'marzo_'.ANNO) echo 'selected="selected"'; ?>>marzo</option>
<option value="aprile" <? if ($mese == 'aprile_'.ANNO) echo 'selected="selected"'; ?>>aprile</option>
<option value="maggio" <? if ($mese == 'maggio_'.ANNO) echo 'selected="selected"'; ?>>maggio</option>
<option value="giugno" <? if ($mese == 'giugno_'.ANNO) echo 'selected="selected"'; ?>>giugno</option>
<option value="luglio" <? if ($mese == 'luglio_'.ANNO) echo 'selected="selected"'; ?>>luglio</option>
<option value="agosto" <? if ($mese == 'agosto_'.ANNO) echo 'selected="selected"'; ?>>agosto</option>
<option value="settembre" <? if ($mese == 'settembre_'.ANNO) echo 'selected="selected"'; ?>>settembre</option>
<option value="ottobre" <? if ($mese == 'ottobre_'.ANNO) echo 'selected="selected"'; ?>>ottobre</option>
<option value="novembre" <? if ($mese == 'novembre_'.ANNO) echo 'selected="selected"'; ?>>novembre</option>
<option value="dicembre" <? if ($mese == 'dicembre_'.ANNO) echo 'selected="selected"'; ?>>dicembre</option>
</select>
</div>
<input type="submit" name="scegli" value="scegli" class="btn btn-default">
</fieldset>
</form>

                </div>
            </div>
        </div>
     
     </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->


<?php include_once("bottom.php"); ?>