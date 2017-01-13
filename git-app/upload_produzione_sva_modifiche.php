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

 if(isset($_FILES['filename']))   

 { 
    	$file = $_FILES['filename'];
if($file['error'] == UPLOAD_ERR_OK and is_uploaded_file($file['tmp_name'])) 
{ 
if ($file["size"] > 0) { 
 	if (move_uploaded_file($file['tmp_name'], $UPLOAD_DIR.$file['name'])) { 
 		echo "<div style=\"display:/*none;visibility:hidden*/\"><span style=\"color:green;\"><b>Upload:</b> Operazione effettuata con successo! File \"".$file['name']."\" correttamente caricato.<br>";
 		/*echo "<div style=\"\\*display:none;visibility:hidden*\\\"><span style=\"color:green;\"><b>Upload:</b> Operazione effettuata con successo! File \"".$file['name']."\" correttamente caricato.<br>";*/
		
		//pale

// inserimento FISSO

require_once 'Excel/reader.php';
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP1251');
//$data->read('upload/fastweb_fisso.xls');
$data->read('upload/'.$file['name']);
//$data->read('upload/sva_res_shp_marzo.xls');

// lettura file xls
	
	/*echo 'Lo leggo:</p>';
			
	echo "<table border='1'>";
	$numero=0;
	for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
			echo "<tr><td>".$numero++."</td>";
		for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
			echo "<td>".$data->sheets[0]['cells'][$i][$j]."</td>";
		}
		echo "</tr>";
	
	}
	echo "</table>";*/
	

echo '<br>Inserisco i dati sopra nella tabella  "'.$mese.'"  al momento arbitrariamente creata. (TRUNCATE POI INSERT)<br><br>';

/*mysql_connect("mysql.netsons.com" ,"hsvblokd_SVA" ,"Luc4_C4nn4s!");
mysql_select_db("hsvblokd_SVA");*/

/*mysql_connect("localhost" ,"svasrl_svasrl" ,"C4nn4s!");
mysql_select_db("svasrl_CANNAS");*/

mysql_connect(DBURI ,DBUSER ,DBPASS);
mysql_select_db(DBNAME);


	$query_trunc="TRUNCATE table ".$mese;
	$trunc=mysql_query($query_trunc);
	if($trunc)echo"<br><br>TRONCATA<br><br>";

$num=1;
for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++)
	{
	$DATA= 				strtolower("".htmlentities($data->sheets[0]['cells'][$i][1], ENT_QUOTES)."");
	$SEGMENTO= 			strtolower("".htmlentities($data->sheets[0]['cells'][$i][2], ENT_QUOTES)."");
	$RAG_SOC= 			strtolower("".htmlentities($data->sheets[0]['cells'][$i][3], ENT_QUOTES)."");
	$Nome_Cliente= 		strtolower("".htmlentities($data->sheets[0]['cells'][$i][4], ENT_QUOTES)."");
	$Cognome_Cliente= 	strtolower("".htmlentities($data->sheets[0]['cells'][$i][5], ENT_QUOTES)."");
	$CF= 				strtolower("".htmlentities($data->sheets[0]['cells'][$i][6], ENT_QUOTES)."");
	$PIVA= 				strtolower("".htmlentities($data->sheets[0]['cells'][$i][7], ENT_QUOTES)."");
	$PROVINCIA= 		strtolower("".htmlentities($data->sheets[0]['cells'][$i][8], ENT_QUOTES)."");
	$RECAPITO1= 		strtolower("".htmlentities($data->sheets[0]['cells'][$i][9], ENT_QUOTES)."");
	$RECAPITO2= 		strtolower("".htmlentities($data->sheets[0]['cells'][$i][10], ENT_QUOTES)."");
	$PACCHETTO= 		strtolower("".htmlentities($data->sheets[0]['cells'][$i][11], ENT_QUOTES)."");
	$PACCHETTO_MOBILE=	strtolower("".htmlentities($data->sheets[0]['cells'][$i][12], ENT_QUOTES)."");
	$TECNOLOGIA=		strtolower("".htmlentities($data->sheets[0]['cells'][$i][13], ENT_QUOTES)."");
	$PORTAB=			strtolower("".htmlentities($data->sheets[0]['cells'][$i][14], ENT_QUOTES)."");
	$VENDITORE=			strtolower("".htmlentities($data->sheets[0]['cells'][$i][15], ENT_QUOTES)."");
	$ORIGINE= 			strtolower("".htmlentities($data->sheets[0]['cells'][$i][16], ENT_QUOTES)."");
	$STAND= 			strtolower("".htmlentities($data->sheets[0]['cells'][$i][17], ENT_QUOTES)."");
	$OPERATORE_CC= 		strtolower("".htmlentities($data->sheets[0]['cells'][$i][18], ENT_QUOTES)."");
	$CODICE_INSERIMENTO=strtolower("".htmlentities($data->sheets[0]['cells'][$i][19], ENT_QUOTES)."");
	$DETTAGLI= 			strtolower("".htmlentities($data->sheets[0]['cells'][$i][20], ENT_QUOTES)."");
	$PACCHETTO_TECNOLOGIA= $PACCHETTO."_".$TECNOLOGIA;
	$NOTE= 				strtolower("".htmlentities($data->sheets[0]['cells'][$i][21], ENT_QUOTES)."");
	$NOTE2= 			strtolower("".htmlentities($data->sheets[0]['cells'][$i][22], ENT_QUOTES)."");
	
	if ($TECNOLOGIA == 'fibra' OR $TECNOLOGIA == 'ftts' OR $TECNOLOGIA == 'adsl ull')
	{switch ($PACCHETTO) {
							
				case 'joy':
				$GETTONE=100;
				$PROVVIGIONE=15;
				break;
							
				case 'cluster 1':
				$GETTONE=160;
				$PROVVIGIONE=60;
				break;
							
				case 'cluster 2':
				$GETTONE=100;
				$PROVVIGIONE=42;
				break;
							
				case 'jet':
				$GETTONE=100;
				$PROVVIGIONE=32;
				break;
							
				case 'superjet':
				$GETTONE=120;
				$PROVVIGIONE=42;
				break;
							
				case 'pi_joy':
				$GETTONE=145;
				$PROVVIGIONE=20;
				break;
							
				case 'pi_jet':
				$GETTONE=165;
				$PROVVIGIONE=55;
				break;
							
				case 'pi_superjet':
				$GETTONE=195;
				$PROVVIGIONE=80;
				break;
							
				case 'pi_superjet x2':
				$GETTONE=115;
				$PROVVIGIONE=80;
				break;

				case 'business class':
				$GETTONE=195;
				$PROVVIGIONE=80;
				break;
							
				case 'business class x2':
				$GETTONE=115;
				$PROVVIGIONE=80;
				break;
				
				default:
				$GETTONE=0;
				$PROVVIGIONE=0;
				break;

				}
	}
	else if ($TECNOLOGIA == 'adsl whs')
	{switch ($PACCHETTO) {
							
				case 'joy':
				$GETTONE=100;
				$PROVVIGIONE=32;
				break;
							
				case 'cluster 1':
				$GETTONE=160;
				$PROVVIGIONE=60;
				break;
							
				case 'cluster 2':
				$GETTONE=100;
				$PROVVIGIONE=32;
				break;
							
				case 'jet':
				$GETTONE=100;
				$PROVVIGIONE=32;
				break;
							
				case 'superjet':
				$GETTONE=120;
				$PROVVIGIONE=42;
				break;
							
				case 'pi_joy':
				$GETTONE=145;
				$PROVVIGIONE=20;
				break;
							
				case 'pi_jet':
				$GETTONE=165;
				$PROVVIGIONE=55;
				break;
							
				case 'pi_superjet':
				$GETTONE=195;
				$PROVVIGIONE=80;
				break;
							
				case 'pi_superjet x2':
				$GETTONE=115;
				$PROVVIGIONE=80;
				break;
							
				case 'business class':
				$GETTONE=195;
				$PROVVIGIONE=80;
				break;
							
				case 'business class x2':
				$GETTONE=115;
				$PROVVIGIONE=80;
				break;

				default:
				$GETTONE=0;
				$PROVVIGIONE=0;
				break;

				}
	}

	$NETTO=$GETTONE-$PROVVIGIONE;
			
	$query="insert into  ".$mese." 
	(
	DATA,
	SEGMENTO,
	RAG_SOC,
	Nome_Cliente,
	Cognome_Cliente,
	CF,
	PIVA,
	PROVINCIA,
	RECAPITO1,
	RECAPITO2,
	PACCHETTO,
	PACCHETTO_MOBILE,
	TECNOLOGIA,
	VENDITORE,
	PORTAB,
	ORIGINE,
	STAND,
	OPERATORE_CC,
	CODICE_INSERIMENTO,
	DETTAGLI,
	PACCHETTO_TECNOLOGIA,
	NOTE,
	NOTE2,
	GETTONE,
	PROVVIGIONE,
	NETTO
	)
	values
	(
	'$DATA',
	'$SEGMENTO',
	'$RAG_SOC',
	'$Nome_Cliente',
	'$Cognome_Cliente',
	'$CF',
	'$PIVA',
	'$PROVINCIA',
	'$RECAPITO1',
	'$RECAPITO2',
	'$PACCHETTO',
	'$PACCHETTO_MOBILE',
	'$TECNOLOGIA',
	'$VENDITORE',
	'$PORTAB',
	'$ORIGINE',
	'$STAND',
	'$OPERATORE_CC',
	'$CODICE_INSERIMENTO',
	'$DETTAGLI',
	'$PACCHETTO_TECNOLOGIA',
	'$NOTE',
	'$NOTE2',
	'$GETTONE',
	'$PROVVIGIONE',
	'$NETTO'
	);";	
	var_dump($query);
	$dati=mysql_query($query);
	//var_dump($dati);
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



	/*$query_trunc="DELETE FROM `febbraio_XXXX` WHERE `CODICE_INSERIMENTO` = \"\";";
	$trunc=mysql_query($query_trunc);
	if($trunc)echo"<br><br>febbraio_XXXX ELIMINATI CODICI INSERIMENTO VUOTI<br><br>";*/

	$query_trunc="DROP table  ".$mese_stand ;
	$trunc=mysql_query($query_trunc);
	if($trunc)echo"<br><br> ".$mese_stand."  TRONCATA<br><br>";

	$query_duplica="CREATE TABLE  ".$mese_stand."  AS SELECT DATA, CODICE_INSERIMENTO, STAND, PACCHETTO, TECNOLOGIA, PORTAB, PACCHETTO_TECNOLOGIA, GETTONE, PROVVIGIONE, NETTO FROM  ".$mese." ;";
	$duplica=mysql_query($query_duplica);
	if($duplica)echo"<br><br> ".$mese_stand."  TABELLA COPIATA<br><br>";
	
	$query_trunc="DELETE FROM ` ".$mese_stand." ` WHERE `CODICE_INSERIMENTO` = \"\";";
	$trunc=mysql_query($query_trunc);
	if($trunc)echo"<br><br> ".$mese."  ELIMINATI CODICI INSERIMENTO VUOTI<br><br>";

	
	
	
	echo "</div><!-- invisibbbole --><br><br>";
	


?>  

<span style="color:green;">OK</span><br><br>
			<!--div id="">
			<a href="statistiche_stands.php" class="bottoncini">vedi report</a></div-->
            
        </div><!-- /.col-lg-12 -->   
    </div><!-- /.row -->
</div><!-- /#page-wrapper -->


<?php include_once("bottom.php"); ?>
