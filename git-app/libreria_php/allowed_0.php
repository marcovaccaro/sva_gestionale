<?php
if ($_SESSION["utenza"]  > 0)
{
	header('Location:/'.ROOT.'/libreria_php/logout.php') ;
	exit;
}
?>