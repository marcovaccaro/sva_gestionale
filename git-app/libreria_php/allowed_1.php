<?php
if ($_SESSION["utenza"]  > 1)
{
	header('Location:/'.ROOT.'/libreria_php/logout.php') ;
	exit;
}
?>