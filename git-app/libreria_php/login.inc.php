<?php
		
	session_start();
	ob_start();
	include("config.php");
	include("connett_db.php");
	if (isset ($_REQUEST["login"]) && $_REQUEST["login"]=="accedi")
	{
		echo 'username'.htmlentities($_REQUEST["username"], ENT_QUOTES);		
		echo '<br><br>';
		echo 'password'.htmlentities($_REQUEST["password"], ENT_QUOTES);

		mysql_connect(DBURI ,DBUSER ,DBPASS);
		mysql_select_db(DBNAME);

$query='SELECT * 
FROM  `pro_user` 
WHERE  `login` =  "' . htmlentities($_REQUEST["username"], ENT_QUOTES) . '"
AND  `password` =  "' . htmlentities($_REQUEST["password"], ENT_QUOTES) . '";';

		/*$query='
		Select 
		a.login, a.password, a.id
		from pro_user a
		where a.login="' . htmlentities($_REQUEST["username"], ENT_QUOTES) . 
		'" and a.password="' . htmlentities($_REQUEST["password"], ENT_QUOTES) . '";';*/
		var_dump($query);
		$res = mysql_query($query);
		//include("controllo_res_query.php");
		//$conn->close();
		if ($res && mysql_num_rows($res)===0)
			{
				echo '	
				<fieldset><legend>Attenzione</legend>
				<p>Login o password errati ...</p>
				</fieldset>
				<p class="piccolo"><a class="bottoncini" href="logout.php">Riprova</a></p>';
				//break;
			}
			else
			{
								
				//metto in sessione l'utente
				
				$riga=mysql_fetch_assoc($res);
				$user=$_SESSION["user"]=$riga["login"];
				$password=$_SESSION["password"]=$riga["password"];
				$utenza=$_SESSION["utenza"]=$riga["LEVEL"];
				$crm_id=$_SESSION["crm_id"]=$riga["JOIN_CRM"];

				//sovrascrivo in tabella utenti data ora login
				
				
				$query_log="
				UPDATE `pro_user` SET `LAST_LOG` = NOW() WHERE `login` = '".$user."';";
				$log=mysql_query($query_log);
				
				if($log) {echo "<br><br>go on";}				
				/**/

				//reindirizzo alla pagina in funzione dell'utente

					//if ($user == 'admin' or $user == 'superadmin')
					if ($utenza == 0 or $utenza == 1)
					{
						header('location: ../form_upload_produzione_sva.php');
					}
					else
					{
						if ($user==$password)
						{header('location: ../admin_venditori_resp.php');}
						else
						{header('location: ../venditori_garetta_resp.php');}
					}
			}
	}
	
	else {echo 'no request';}
?>
