<?php
include_once("top.php");
include_once("libreria_php/allowed_1.php");
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        	<h1 class="page-header">Risultato inserimento</h1>
        </div><!-- /.col-lg-12 -->

<?php  

/*
---- serviva per definire il mese (estensione della tabella)
if (isset($_POST["mese"]))
{
$mese = $_POST["mese"].'_'.ANNO;
$mese_stand = $mese.'_stand';
}else{
	echo 'che vuoi?';
	exit;
}

echo $mese;
echo "<br>".$mese_stand;
*/

 if(isset($_FILES['filename']))   

 { 
    	$file = $_FILES['filename'];
if($file['error'] == UPLOAD_ERR_OK and is_uploaded_file($file['tmp_name'])) 
{ 
if ($file["size"] > 0) { 
 	if (move_uploaded_file($file['tmp_name'], $UPLOAD_DIR.$file['name'])) { 
 		echo "<div style=\"/*display:none;visibility:hidden*/\"><span style=\"color:green;\"><b>Upload:</b> Operazione effettuata con successo! File \"".$file['name']."\" correttamente caricato.<br>";
 		/*echo "<div style=\"\\*display:none;visibility:hidden*\\\"><span style=\"color:green;\"><b>Upload:</b> Operazione effettuata con successo! File \"".$file['name']."\" correttamente caricato.<br>";*/
		
		//pale

// inserimento APPUNTAMENTI

require_once 'Excel/reader.php';
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP1251');
$data->read('upload/'.$file['name']);

// lettura file xls
	
	echo 'Lo leggo:</p>';
			
	echo "<table border='1'>";
	$numero=0;
	for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
			echo "<tr><td>".$numero++."</td>";
		for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
			echo "<td>".$data->sheets[0]['cells'][$i][$j]."</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
	
$num=1;
for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++)

	{
	$ID_AGENTE=			strtolower("".htmlentities($data->sheets[0]['cells'][$i][1], ENT_QUOTES)."");
	$ID_APPUNTAMENTO=	strtolower("".htmlentities($data->sheets[0]['cells'][$i][2], ENT_QUOTES)."");
	$OPERATORE_FRONT=	strtolower("".htmlentities($data->sheets[0]['cells'][$i][3], ENT_QUOTES)."");
	$DATA=				strtolower("".htmlentities($data->sheets[0]['cells'][$i][4], ENT_QUOTES)."");
	$ORA_INIZIO=		strtolower("".htmlentities($data->sheets[0]['cells'][$i][5], ENT_QUOTES)."");
	$ID_CLIENTE=		strtolower("".htmlentities($data->sheets[0]['cells'][$i][6], ENT_QUOTES)."");
	$INFO_CLIENTE=		strtolower("".htmlentities($data->sheets[0]['cells'][$i][7], ENT_QUOTES)."");
	$DESCRIZIONE_SGU=	strtolower("".htmlentities($data->sheets[0]['cells'][$i][8], ENT_QUOTES)."");
	$MACRO_ATTIVITA=	strtolower("".htmlentities($data->sheets[0]['cells'][$i][9], ENT_QUOTES)."");
	$CAMPAGNA=			strtolower("".htmlentities($data->sheets[0]['cells'][$i][10], ENT_QUOTES)."");
	$STATO=				strtolower("".htmlentities($data->sheets[0]['cells'][$i][11], ENT_QUOTES)."");
	$ESITO=				strtolower("".htmlentities($data->sheets[0]['cells'][$i][12], ENT_QUOTES)."");
	$NOTE=				strtolower("".htmlentities($data->sheets[0]['cells'][$i][13], ENT_QUOTES)."");
	//$SVA_TIMESTAMP=
	$SVA_STATO= "LORDO";
	$SVA_SOTTO_STATO= "ASSEGNATO";
	//$SVA_SEGMENTO= "NULL";
	//$TOT_PDA=
	//$PDA_RES=
	//$PDA_SHP=
	$SVA_SIM= "0";
	//$FEEDBACK=


mysql_connect(DBURI ,DBUSER ,DBPASS);
mysql_select_db(DBNAME);
			
	$query="INSERT into `appuntamenti` 
	(
	ID_AGENTE,
	ID_APPUNTAMENTO,
	OPERATORE_FRONT,
	DATA,
	ORA_INIZIO,
	ID_CLIENTE,
	INFO_CLIENTE,
	DESCRIZIONE_SGU,
	MACRO_ATTIVITA,
	CAMPAGNA,
	STATO,
	ESITO,
	NOTE,
	SVA_TIMESTAMP,
	SVA_STATO,
	SVA_SOTTO_STATO,
	SVA_SIM
	)
	values
	(
	'$ID_AGENTE',
	'$ID_APPUNTAMENTO',
	'$OPERATORE_FRONT',
	'$DATA',
	'$ORA_INIZIO',
	'$ID_CLIENTE',
	'$INFO_CLIENTE',
	'$DESCRIZIONE_SGU',
	'$MACRO_ATTIVITA',
	'$CAMPAGNA',
	'$STATO',
	'$ESITO',
	'$NOTE',
	NOW(),
	'$SVA_STATO',
	'$SVA_SOTTO_STATO',
	'$SVA_SIM'
	);";

	var_dump($query);
	$dati=mysql_query($query) or die("Query non valida: " . mysql_error());
	echo "<br><br>";
	var_dump($dati);
	echo "<br><br>";
	echo $num++;
	if($dati)echo" successo ";
	else echo" <strong>fallimento</strong> ";
	}
		//pale
		
		
		} else { 
                echo "<p><b>Upload:</b> Si è verificato un errore</p>"; 
        } 
 		} else { 
         		echo "<p><b>Upload:</b> Si è verificato un errore</p>"; 
 		}   

 	}   

 }
 /*
	$query_trunc="DROP table  ".$mese_stand ;
	$trunc=mysql_query($query_trunc);
	if($trunc)echo"<br><br> ".$mese_stand."  TRONCATA<br><br>";

	$query_duplica="CREATE TABLE  ".$mese_stand."  AS SELECT DATA, CODICE_INSERIMENTO, STAND, PACCHETTO, TECNOLOGIA, PORTAB, PACCHETTO_TECNOLOGIA, GETTONE, PROVVIGIONE, NETTO FROM  ".$mese." ;";
	$duplica=mysql_query($query_duplica);
	if($duplica)echo"<br><br> ".$mese_stand."  TABELLA COPIATA<br><br>";
	
	$query_trunc="DELETE FROM ` ".$mese_stand." ` WHERE `CODICE_INSERIMENTO` = \"\";";
	$trunc=mysql_query($query_trunc);
	if($trunc)echo"<br><br> ".$mese."  ELIMINATI CODICI INSERIMENTO VUOTI<br><br>";

	*/
	
	
	echo "</div><!-- invisibbbole --><br><br>";
?>  

<span style="color:green;">OK</span><br><br>
			<!--div id="">
			<a href="statistiche_stands.php" class="bottoncini">vedi report</a></div-->
            
        </div><!-- /.col-lg-12 -->   
    </div><!-- /.row -->
</div><!-- /#page-wrapper -->

<?php
include_once("bottom.php");
?>