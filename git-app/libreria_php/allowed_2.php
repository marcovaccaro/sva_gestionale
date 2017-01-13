<?php
if ($_SESSION["utenza"]  > 2)
{
	header('Location:/'.ROOT.'/libreria_php/logout.php') ;
	exit;
}
?>