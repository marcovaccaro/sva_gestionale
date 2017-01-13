<?php
include_once("top.php");
include_once("libreria_php/allowed_1.php");
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        	<h1 class="page-header">Vedi Appuntamenti</h1>
        </div>

		<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
						<!--? echo $mese; ?-->
                        Apputamenti (tutti gli insert)
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">

<?


mysql_connect(DBURI ,DBUSER ,DBPASS);
mysql_select_db(DBNAME);

$query="SELECT * FROM `appuntamenti` WHERE `FEEDBACK`='Y' ORDER BY `appuntamenti`.`SVA_TIMESTAMP` ASC;";

echo '
<table class="table table-bordered" id="dataTables-appuntamenti" >
	<thead>
		<tr>
';

echo '<th>ID_AGENTE</th>';
echo '<th>ID_APPUNTAMENTO</th>';
echo '<th>OPERATORE_FRONT</th>';
echo '<th>DATA</th>';
echo '<th>ORA_INIZIO</th>';
echo '<th>ID_CLIENTE</th>';
echo '<th>INFO_CLIENTE</th>';
echo '<th>DESCRIZIONE_SGU</th>';
echo '<th>MACRO_ATTIVITA</th>';
echo '<th>CAMPAGNA</th>';
echo '<th>STATO</th>';
echo '<th>ESITO</th>';
echo '<th>NOTE</th>';
echo '<th>SVA_TIMESTAMP</th>';
echo '<th>SVA_STATO</th>';
echo '<th>	SVA_SOTTO_STATO</th>';
//echo '<th>SVA_SEGMENTO</th>';
echo '<th>SVA_SIM</th>';


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
				echo '<tr><td>' . $row['ID_AGENTE'] . '</td>';
				echo '<td>' . $row['ID_APPUNTAMENTO'] . '</td>';
				echo '<td>' . $row['OPERATORE_FRONT'] . '</td>';
				echo '<td>' . $row['DATA'] . '</td>';
				echo '<td>' . $row['ORA_INIZIO'] . '</td>';
				echo '<td>' . $row['ID_CLIENTE'] . '</td>';
				echo '<td>' . $row['INFO_CLIENTE'] . '</td>';
				echo '<td>' . $row['DESCRIZIONE_SGU'] . '</td>';
				echo '<td>' . $row['MACRO_ATTIVITA'] . '</td>';
				echo '<td>' . $row['CAMPAGNA'] . '</td>';
				echo '<td>' . $row['STATO'] . '</td>';
				echo '<td>' . $row['ESITO'] . '</td>';
				echo '<td>' . substr($row['NOTE'],0,100) . '...</td>';
				echo '<td>' . $row['SVA_TIMESTAMP'] . '</td>';
				echo '<td>' . $row['SVA_STATO'] . '</td>';
				echo '<td>' . $row['SVA_SOTTO_STATO'] . '</td>';
				//echo '<td>' . $row['SVA_SEGMENTO'] . '</td>';
				echo '<td>' . $row['SVA_SIM'] . '</td></tr>';
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
								
<!--<div class="col-lg-4">
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
        </div> -->
     
     </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->


<?php include_once("bottom.php"); ?>