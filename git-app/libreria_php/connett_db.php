<?php


		function connettidb()
			{
					// connette al data base
					
			$cn = new mysqli(DBURI,DBUSER,DBPASS,DBNAME);
					// controlla se la connessione è andata a buon fine
	
			if (mysqli_connect_errno() != 0)
			
				{
				$message = mysqli_connect_error();
				echo '<br />' . 'errore:' . $message;
				}
				
			else
			
					// imposta il set di caratteri utf8
			
			$cn->query("SET NAMES 'utf8'");
		
			return $cn;
		
			}
?>	