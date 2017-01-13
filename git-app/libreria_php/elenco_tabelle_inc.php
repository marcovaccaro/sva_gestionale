<?
			//elenco tabelle

			echo '<h3>Elenco tabelle</h3>';
			echo "NOW: " . date('Y-m-d H:i:s') . "<br><br>";
			$dbname = DBNAME;
			
			if (!mysql_connect(DBURI,DBUSER,DBPASS)) {
				echo 'Could not connect to mysql';
				exit;
			}
			
			$sql = "SHOW TABLES FROM $dbname";
			$result = mysql_query($sql);
			
			if (!$result) {
				echo "DB Error, could not list tables\n";
				echo 'MySQL Error: ' . mysql_error();
				exit;
			}
			
			while ($row = mysql_fetch_row($result)) {
				echo "<strong>Table</strong>: {$row[0]}\n";
						if (	$row[0] != 'rendicontazioni' &
								$row[0] != 'provvigioni'&
								$row[0] != 'provvigioni_b2'&
								$row[0] != 'provvigioni_backup'&
								$row[0] != 'sva_inseriti_2013') 
						{echo ' <a href="drop_table.php?table='. $row[0] .
						'" onclick="return confirm(\'Elimino?\')">elimina</a> | <a href="rendicontazioni.php?tab='. $row[0] .'" target="_blank">vedi tabella</a>';}
						elseif ($row[0] == 'sva_inseriti_2013')
						{echo ' <a href="rendicontazioni.php?tab='. $row[0] .'" target="_blank">vedi tabella</a>';}
						echo '<br>';
			}
			
			mysql_free_result($result);
			//fine elenco tabelle

?>