<?php
if ($_SESSION["utenza"]  > 3)
{
	header('Location:/'.ROOT.'/libreria_php/logout.php') ;
	exit;
}
?>