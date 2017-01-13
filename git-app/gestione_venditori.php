<?php
include_once("top.php");
include_once("libreria_php/allowed_1.php");

?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        	<h1 class="page-header">Gestione Utenti</h1>
        </div><!-- /.col-lg-12 -->

<?php

	if (isset ($_REQUEST["login"]) && $_REQUEST["login"]=="accedi")
	{
		//creo nuovo utente

		mysql_connect(DBURI ,DBUSER ,DBPASS);
		mysql_select_db(DBNAME);


		$query="
		INSERT INTO pro_user (`id`, `login`, `password`, `LEVEL`, `JOIN_CRM`, `MAIL`) VALUES
		(NULL,
		'" . htmlentities($_REQUEST["username"], ENT_QUOTES) . "',
		'" . htmlentities($_REQUEST["password"], ENT_QUOTES) . "',
		'" . htmlentities($_REQUEST["level"], ENT_QUOTES) . "',
		'" . htmlentities($_REQUEST["crm_id"], ENT_QUOTES) . "',
		'" . htmlentities($_REQUEST["mail"], ENT_QUOTES) . "');
		";
		
		$res = mysql_query($query);
		if ($res)
		{echo"<br><br>UTENTE CREATO<br><br>";}
		else
		{ echo '<br><br><span style="color:red">MySQL Error: ' .mysql_error(). '</span><br><br>';}

		//header('location: ../venditori.php');
	}



?>

<div class="col-lg-4">
			<div class="panel panel-default">
                <div class="panel-heading">
                Crea Utente
                </div>
                <div class="panel-body"> 
        
                <form action="gestione_venditori.php" method="post">   
				<fieldset>
				<div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" required />
				</div>
                <div class="form-group">
                <input type="text" name="password" class="form-control" placeholder="Password" required />
                </div>
                <div class="form-group">
                <select name="level" id="level" class="form-control">
                <option value="4">* Operatore CallCenter</option>
                <option value="4">* Venditore</option>
                <option value="3">** Sotto Collaboratore</option>
                <option value="2">*** Collaboratore</option>
                </select>
        		</div>
                <div class="form-group">
                <input type="text" name="crm_id" class="form-control" placeholder="CRM id"  />
                </div>
                <div class="form-group">
                <input type="text" name="mail" class="form-control" placeholder="mail"  />
                </div>
				<button type="submit" name="login" value="accedi" class="btn btn-default">Crea</button>
				</fieldset>
				</form>

                </div><!-- ./panel body -->
            </div><!-- ./panel panel -->
		</div><!-- ./col-lg-4 -->
	</div><!-- ./row -->
    <div class="row">
        <div class="col-lg-12">
        	<h1 class="page-header">Elenco Utenti</h1>
        </div><!-- /.col-lg-12 -->
	</div><!-- ./row -->
    <div class="row">

<?

			mysql_connect(DBURI ,DBUSER ,DBPASS);
			mysql_select_db(DBNAME);
			
// VEND

			$sql = "SELECT * FROM pro_user WHERE login NOT LIKE 'AG %' AND login NOT LIKE 'CC %' ORDER BY login";
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
                Venditori / Sotto Collaboratori / Collaboratori
                </div>
                <div class="panel-body">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
			<thead>
			<tr>
			<th>n</th>
			<th>Utente</th>
			<th>Password</th>
			<th>Ultimo log</th>
			<th>Livello</th>
			<th>CRM_id</th>
			<th>Mail</th>
			<th></th>
			</tr>
			</thead>
			<tbody>
			
';

			$conta=1;
			while ($row = mysql_fetch_assoc($result))
			{
				if ($row['LEVEL']!=='1' & $row['LEVEL']!=='0')
				{
					echo '
					<tr>
					<td>'.$conta++.'</td>
					<td>'.$row['login'].'</td>
					<td>'.$row['password'].'</span></td>
					
					<td><span style="';
					
					if ($row['LAST_LOG']=='0000-00-00 00:00:00')
					{echo 'color:red';}
					
					echo '">'.$row['LAST_LOG'].'</span></td>
					
					<td>'.$row['LEVEL'].'</td>
					<td>'.$row['JOIN_CRM'].'</td>
					<td>'.$row['MAIL'].'</td>
					<td><a href="drop_venditore.php?venditore='. $row['login'] .
					'" onclick="return confirm(\'Elimino?\')">elimina</a></td>
					</tr>';
				}
			}

			echo '
							</tbody>
						</table>
					</div>
			     </div><!-- ./panel body -->
            </div><!-- ./panel panel -->
		</div><!-- ./col-lg-4 -->
	';
			
//CC

			$sql = "SELECT * FROM pro_user WHERE login LIKE 'CC %' ORDER BY login";
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
                Operatori CC
                </div>
                <div class="panel-body">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
			<thead>
			<tr>
			<th>n</th>
			<th>Utente</th>
			<th>Password</th>
			<th>Ultimo log</th>
			<th>Livello</th>
			<th>CRM_id</th>
			<th>Mail</th>
			<th></th>
			</tr>
			</thead>
			<tbody>
';

			$conta=1;
			while ($row = mysql_fetch_assoc($result))
			{
				if ($row['LEVEL']!=='1' & $row['LEVEL']!=='0')
				{
					echo '
					<tr>
					<td>'.$conta++.'</td>
					<td>'.$row['login'].'</td>
					<td>'.$row['password'].'</span></td>
					
					<td><span style="';
					
					if ($row['LAST_LOG']=='0000-00-00 00:00:00')
					{echo 'color:red';}
					
					echo '">'.$row['LAST_LOG'].'</span></td>
					
					<td>'.$row['LEVEL'].'</td>
					<td>'.$row['JOIN_CRM'].'</td>
					<td>'.$row['MAIL'].'</td>
					<td><a href="drop_venditore.php?venditore='. $row['login'] .
					'" onclick="return confirm(\'Elimino?\')">elimina</a></td>
					</tr>';
				}
			}

			echo '
							</tbody>
						</table>
					</div>
			     </div><!-- ./panel body -->
            </div><!-- ./panel panel -->
		</div><!-- ./col-lg-4 -->
	';
// AG

			$sql = "SELECT * FROM pro_user WHERE login LIKE 'AG %' ORDER BY login";
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
                Agenzie
                </div>
                <div class="panel-body">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
			<thead>
			<tr>
			<th>n</th>
			<th>Utente</th>
			<th>Password</th>
			<th>Ultimo log</th>
			<th>Livello</th>
			<th>CRM_id</th>
			<th>Mail</th>
			<th></th>
			</tr>
			</thead>
			<tbody>
';

			$conta=1;
			while ($row = mysql_fetch_assoc($result))
			{
				if ($row['LEVEL']!=='1' & $row['LEVEL']!=='0')
				{
					echo '
					<tr>
					<td>'.$conta++.'</td>
					<td>'.$row['login'].'</td>
					<td>'.$row['password'].'</span></td>
					
					<td><span style="';
					
					if ($row['LAST_LOG']=='0000-00-00 00:00:00')
					{echo 'color:red';}
					
					echo '">'.$row['LAST_LOG'].'</span></td>
					
					<td>'.$row['LEVEL'].'</td>
					<td>'.$row['JOIN_CRM'].'</td>
					<td>'.$row['MAIL'].'</td>
					<td><a href="drop_venditore.php?venditore='. $row['login'] .
					'" onclick="return confirm(\'Elimino?\')">elimina</a></td>
					</tr>';
				}
			}

			echo '
							</tbody>
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
