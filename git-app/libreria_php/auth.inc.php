<?
ob_start();
session_start();
			if (!($_SESSION["user"]))
			{
			//tengo traccia della pagina di provenienza
			$_SESSION["FromPage"]=$_SERVER["PHP_SELF"] ;
			echo 'non loggato: goto login page';
			echo "<script>javascript:window.location.href='login.php'</script>";
			//header('Location: index.php');
			exit;
			}
?>