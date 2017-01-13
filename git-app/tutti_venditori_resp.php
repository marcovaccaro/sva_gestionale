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
PORTAB,
OPERATORE_CC,
DETTAGLI,
NOTE,
NOTE2,
CODICE_INSERIMENTO
from ".$mese." WHERE PROVINCIA != '';";

echo '
<table class="table table-bordered" id="dataTables-venditori" >
	<thead>
		<tr>
';
echo '<th>PDA n</th>';
echo '<th>VENDITORE</th>';

if ($_SESSION["utenza"] == 0 || $_SESSION["utenza"] == 1)
{
	echo '<th>OPERATORE</th>';
}

echo '<th>DATA</th>';
echo '<th>PACK</th>';

if ($_SESSION["utenza"] == 0 || $_SESSION["utenza"] == 1)
{
	echo '<th>RAG_SOC</th>';
	echo '<th>NOME</th>';
	echo '<th>COGNOME</th>';
	echo '<th>PROV</th>';
}

echo '<th>ORIG</th>';

if ($_SESSION["utenza"] == 0 || $_SESSION["utenza"] == 1)
{
	echo '<th>REC 1</th>';
	echo '<th>REC 2</th>';
}

echo '<th>STAND</th>';
echo '<th>LINEA</th>';

if ($_SESSION["utenza"] == 0 || $_SESSION["utenza"] == 1)
{
	echo '<th>DETTAGLI</th>';
	echo '<th>NOTE</th>';
	echo '<th>NOTE2</th>';
}

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
					echo '<tr style="background-color:yellow">';
					}
				else if ($row['CODICE_INSERIMENTO'] =='')
					{
					echo '<tr style="background-color:#FF6A6A">';
					}
				else
					{
					$pda_ok=$pda_ok+1;
					echo '<tr>';
					}
				echo '<td>' . $pda . '</td>';
				echo '<td>' . $row['VENDITORE'] . '</td>';
				
				if ($_SESSION["utenza"] == 0 || $_SESSION["utenza"] == 1)
				{
					//
					echo '<td>' . $row['OPERATORE_CC'] . '</td>';
				}
				
				echo '<td>' . $row['DATA'] . '</td>';
				echo '<td>' . $row['PACCHETTO_TECNOLOGIA'] . '</td>';
				
				if ($_SESSION["utenza"] == 0 || $_SESSION["utenza"] == 1)
				{
					//
					echo '<td>' . $row['RAG_SOC'] . '</td>';
					echo '<td>' . $row['Nome_Cliente'] . '</td>';
					echo '<td>' . $row['Cognome_Cliente'] . '</td>';
					echo '<td>' . $row['PROVINCIA'] . '</td>';
				}
				
				echo '<td>' . $row['ORIGINE'] . '</td>';
				
				if ($_SESSION["utenza"] == 0 || $_SESSION["utenza"] == 1)
				{
					//
					echo '<td>' . $row['RECAPITO1'] . '</td>';
					echo '<td>' . $row['RECAPITO2'] . '</td>';
				}
				
				echo '<td>' . $row['STAND'] . '</td>';
				echo '<td>' . $row['PORTAB'] . '</td>';
				
				if ($_SESSION["utenza"] == 0 || $_SESSION["utenza"] == 1)
				{
					//
					echo '<td>' . $row['DETTAGLI'] . '</td>';
					echo '<td>' . $row['NOTE'] . '</td>';
					echo '<td>' . $row['NOTE2'] . '</td>';
				}
				
				echo '</tr>';
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
						
						<div class="panel-footer">
						Pda Totali: '.$pda.' | 
						<span style="color:rgb(189, 189, 4);">Pda FORSE: '.$pda_forse.'</span> |
						<span style="color:red">Pda KO: '.$pda_ko.'</span> |
						<span style="color:green">Pda OK: '.$pda_ok.'</span>
						</div>					
												
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


?>
								
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