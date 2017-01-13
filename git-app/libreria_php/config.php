<?php

// V.develop 20/05/2016

// ERROR REPORTING SI/NO
include("error_reporting.php");

//EX HOSTING ALLIUMTECH
//define('DBURI', 'localhost');
//define('DBUSER', 'xlinuxz0_cannas');
//define('DBPASS', 'svasrl');
//define('DBNAME', 'xlinuxz0_svasrl');

//LOCAL HOST XAMPP
/**/
define('DBURI', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
//define('DBNAME', 'fkuafbrw_cannas');
define('DBNAME', 'fkuafbrw_cannas2');


//ARUBA BUSINESS (M.GRAVA)
/*
define('DBURI', 'localhost');
define('DBUSER', 'fkuafbrw_pale');
define('DBPASS', 'M4rc0p!!Q');
define('DBNAME', 'fkuafbrw_cannas');
*/

//define("ROOT", "00_app_resp_1.5");
define("ROOT", "2.0-dev");

define("UPLOAD_DIR", "upload/");

setlocale(LC_TIME, 'ita', 'it_IT.utf8');
//print utf8_encode(strftime ("%A %d %B %Y %H:%M"));

date_default_timezone_set("Europe/Rome");

//ANNO AUTOMATICO
//define("ANNO", (int)date("Y"));
define("ANNO", "2017");
define("MESE", (int)date("m"));
define("MESEP", utf8_encode(strftime ("%B")));
define("GIORNO", (int)date("d"));

define("MESE_CORRENTE", MESEP."_".ANNO);
define("MESE_CORRENTE_STAND",  MESEP."_".ANNO."_stand");

define("LINK_ADMIN", "https://linc001.arubabusiness.it:2083/");

?>