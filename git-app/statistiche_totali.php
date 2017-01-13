<?php include_once("top.php"); ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        	<h1 class="page-header">Report totale PDA <small><? echo $mese; ?></small></h1>
        </div><!-- /.col-lg-12 -->

		<div class="col-lg-4">
			<div class="panel panel-default">
                <div class="panel-heading">
                <? echo $mese; ?>
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
<input name="scegli" value="scegli" class="btn btn-default" type="submit">
</fieldset>
</form>

                </div><!-- ./panel body -->
            </div><!-- ./panel panel -->
		</div><!-- ./col-lg-4 -->
    </div><!-- /.row -->		
    <div class="row">
			
<?
		mysql_connect(DBURI ,DBUSER ,DBPASS);
		mysql_select_db(DBNAME);

		//SELECT * FROM $mese WHERE `PACCHETTO` = 'cluster 1' AND `CODICE_INSERIMENTO` != '';
		//SELECT `PACCHETTO`, COUNT(`ID`) FROM marzo_XXXX WHERE `CODICE_INSERIMENTO` != '' GROUP BY `PACCHETTO`
		//SELECT `PACCHETTO`, COUNT(`SEGMENTO`) FROM marzo_XXXX GROUP BY `PACCHETTO`
		//SELECT `PACCHETTO`, COUNT(name) FROM $mese GROUP BY `PACCHETTO`
		//SELECT COUNT(DISTINCT column_name) FROM table_name;
		
		//SELECT `PACCHETTO`, COUNT(`ID`) FROM marzo_XXXX WHERE `CODICE_INSERIMENTO` != '' AND `SEGMENTO` = 'SHP' GROUP BY `PACCHETTO`
		//SELECT `PACCHETTO`, COUNT(`ID`) FROM marzo_XXXX WHERE `CODICE_INSERIMENTO` != '' AND `SEGMENTO` = 'RES' GROUP BY `PACCHETTO`


		//$query = "SELECT type, MIN(price) FROM products GROUP BY type"; 
	
		$query = "SELECT `PACCHETTO`, COUNT(`ID`) FROM $mese WHERE `CODICE_INSERIMENTO` != '' AND `SEGMENTO` = 'RES' GROUP BY `PACCHETTO`"; 
			 
		$result = mysql_query($query) or die(mysql_error());
		
		// Print out result
		echo '
<div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
RES
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
										<tr>
										<th>Pacchetto</th>
										<th>PDA</th>
										</tr>
                                    </thead>
                                    <tbody>
';
		$TOTALE=0;
		while($row = mysql_fetch_array($result)){
			echo '<tr><td>'.$row['PACCHETTO'].'</td><td>'.$row['COUNT(`ID`)'].'</td></tr>';
			$TOTALE += $row['COUNT(`ID`)'];
		}
		
		echo '
		<tr class="success">
		<td></td>
		<td>'.$TOTALE.'</td>
		</tr>
		</tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                </div><!-- ./panel body -->
            </div><!-- ./panel panel -->
		</div><!-- ./col-lg-4 -->
		
		';
	
	
		$query = "SELECT `PACCHETTO`, COUNT(`ID`) FROM $mese WHERE `CODICE_INSERIMENTO` != '' AND `SEGMENTO` = 'SHP' GROUP BY `PACCHETTO`"; 
			 
		$result = mysql_query($query) or die(mysql_error());
		
		// Print out result
		echo '
<div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
SHP
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
										<tr>
										<th>Pacchetto</th>
										<th>PDA</th>
										</tr>
                                    </thead>
                                    <tbody>
';
		$TOTALE=0;
		while($row = mysql_fetch_array($result)){
			echo '<tr><td>'.$row['PACCHETTO'].'</td><td>'.$row['COUNT(`ID`)'].'</td></tr>';
			$TOTALE += $row['COUNT(`ID`)'];
		}
		
		echo '
		<tr class="success">
		<td></td>
		<td>'.$TOTALE.'</td>
		</tr>
		</tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                </div><!-- ./panel body -->
            </div><!-- ./panel panel -->
		</div><!-- ./col-lg-4 -->
		
		';


		$query = "SELECT `PACCHETTO`, COUNT(`ID`) FROM $mese WHERE `CODICE_INSERIMENTO` != '' AND `SEGMENTO` = 'SMALL' GROUP BY `PACCHETTO`"; 
			 
		$result = mysql_query($query) or die(mysql_error());
		
		// Print out result
		echo '
<div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
SMALL
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
										<tr>
										<th>Pacchetto</th>
										<th>PDA</th>
										</tr>
                                    </thead>
                                    <tbody>
';
		$TOTALE=0;
		while($row = mysql_fetch_array($result)){
			echo '<tr><td>'.$row['PACCHETTO'].'</td><td>'.$row['COUNT(`ID`)'].'</td></tr>';
			$TOTALE += $row['COUNT(`ID`)'];
		}
		
		echo '
		<tr class="success">
		<td></td>
		<td>'.$TOTALE.'</td>
		</tr>
		</tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                </div><!-- ./panel body -->
            </div><!-- ./panel panel -->
		</div><!-- ./col-lg-4 -->
				';
?>
        <!--/div><!-- /.col-lg-12 -->   
    </div><!-- /.row -->
</div><!-- /#page-wrapper -->


<?php include_once("bottom.php"); ?>