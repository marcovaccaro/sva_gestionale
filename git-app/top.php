<?php

			include_once("libreria_php/auth.inc.php");
			include("libreria_php/config.php");
			include("libreria_php/connett_db.php");
			$UPLOAD_DIR = UPLOAD_DIR;   
			if (isset($_GET["mese"]))
			{
				$mese = $_GET["mese"].'_'.ANNO;
			}else{
				$mese = MESE_CORRENTE;
			}
			//$tabella = $_SESSION["tabella"];			// prob non serve
			//$tabella_sva = $_SESSION["tabella_sva"];	// prob non serve					

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SVA Admin Version 1.0 - TOP</title>

    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Blank -->
	<link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
	<link href="SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />
    
	<!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body>

    <!--div style="position:fixed; top:0; left:5%;min-height: 50px;  margin-bottom: 20px; z-index: 999999;width: 90%;text-align: center;padding: 10px;color: white;background-color: red;">TEST ENVIRONMENT</div-->

    <div id="wrapper">
    
    <?php if (isset ($_SESSION["utenza"]) && $_SESSION["utenza"] == 0) include_once("00_menu.php"); ?>
    <?php if (isset ($_SESSION["utenza"]) && $_SESSION["utenza"] == 1) include_once("00_menu.php"); ?>
    <?php if (isset ($_SESSION["utenza"]) && $_SESSION["utenza"] == 2) include_once("00_menu.php"); ?>
    <?php if (isset ($_SESSION["utenza"]) && $_SESSION["utenza"] == 3) include_once("00_menu.php"); ?>
    <?php if (isset ($_SESSION["utenza"]) && $_SESSION["utenza"] == 4) include_once("04_menu.php"); ?>