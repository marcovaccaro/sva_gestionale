<?php

			include_once("libreria_php/auth.inc.php");
			include("libreria_php/config.php");
			include("libreria_php/connett_db.php");
			$UPLOAD_DIR = UPLOAD_DIR;   
			if (isset($_GET["tab"]))
			{
				$tabella = $_GET["tab"];
			}else{
				$tabella = $_SESSION["tabella"];
			}

mysql_connect(DBURI ,DBUSER ,DBPASS);
mysql_select_db(DBNAME);

$query="select * from $tabella;";
//$result= mysql_query($query);
//$numfields = mysql_num_fields($result);

//$conn->close();

//$res = @$conn->query($query);
//include("../libreria_php/controllo_res_query.php");
//$conn->close();

$result= mysql_query($query);
$numfields = mysql_num_fields($result);

echo '<link rel="stylesheet" type="text/css" href="css/css.css" />';
echo "<h3>Tabella: " . $tabella . "</h3>";

echo "<table border='1'>\n<tr>";
for ($i=0; $i < $numfields; $i++) 
  { 
   echo '<th>'.mysql_field_name($result, $i).'</th>'; 
   }
   echo "</tr>\n";
   
   while ($row = mysql_fetch_row($result)) 
  { 
   echo '<tr><td>'.implode($row,'</td><td>')."</td></tr>\n"; 
  }
echo "</table>\n";
  ?>
  
<?php include("libreria_php/footer_sess.php"); ?>
