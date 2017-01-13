<?php include_once("top.php"); ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        	<h1 class="page-header">Gestione Account</h1>
        </div><!-- /.col-lg-12 -->
    
<?

				$user=$_SESSION["user"];

		if (isset ($_REQUEST["change"]) && $_REQUEST["change"]=="password")

				{$password=$_SESSION["password"]=htmlentities($_REQUEST["password"], ENT_QUOTES);}
				else
				{$password=$_SESSION["password"];}

if ($user==$password) {echo '
<div class="col-lg-12">						
<div class="alert alert-danger alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
ATTENZIONE!<br>Il tuo nome utente e la tua password sono identici: "'.$user.'/'.$password.'". Ti consigliamo di <a href="admin_venditori_resp.php" class="alert-link">modificare la password!</a>.
</div>
</div><!-- /.col-lg-12 -->	';}

	if (isset ($_REQUEST["change"]) && $_REQUEST["change"]=="password")
	{
		//creo nuovo utente
		//cambio password
		
		mysql_connect(DBURI ,DBUSER ,DBPASS);
		mysql_select_db(DBNAME);
		
		$query = " UPDATE `pro_user` SET  `password` =  '" . htmlentities($_REQUEST["password"], ENT_QUOTES) . "'
		WHERE
		`pro_user`.`login` ='" . $_SESSION["user"] . "';";
		
		/*$query="
		INSERT INTO `svasrl_CANNAS`.`pro_user` (`id`, `login`, `password`) VALUES
		(NULL,
		'" . htmlentities($_REQUEST["username"], ENT_QUOTES) . "',
		MD5('" . htmlentities($_REQUEST["password"], ENT_QUOTES) . "'));
		";*/
		
		$res = mysql_query($query);
		if ($res)
		{echo'
		
<div class="col-lg-12">						
<div class="alert alert-success alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
PASSWORD CORRETTAMENTE AGGIORNATA!</a>.
</div>
</div><!-- /.col-lg-12 -->		
		
		
		
		';
		}
		else
		{ echo '<br><br><span style="color:red">MySQL Error: ' .mysql_error(). '</span><br><br>';}
	}

?>

             <div class="col-lg-6">
			<div class="panel panel-default">
                <div class="panel-heading">
                Cambia Password - password attuale: <? echo $password;?> - inserisci nuova password:
                </div>
                <div class="panel-body">                           
<form id="" action="admin_venditori_resp.php" method="post">
<fieldset>
<div class="form-group">
<input type="text" name="password" class="form-control" />
</div>
<button type="submit" name="change" value="password" class="btn btn-default">Invia</button>
</fieldset>
</form>

                </div><!-- /.panel-body -->
            </div><!-- /.panel panel-default -->
        </div><!-- /.col-lg-6 -->   
    </div><!-- /.row -->
</div><!-- /#page-wrapper -->


<?php include_once("bottom.php"); ?>
