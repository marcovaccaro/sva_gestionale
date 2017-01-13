<?php
include_once("top.php");
include_once("libreria_php/allowed_1.php");
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        	<h1 class="page-header">Upload Excel <small>Mese di produzione: <? echo MESE_CORRENTE ;?></small></h1>
        </div><!-- /.col-lg-12 -->

<?php  
			//elenco tabelle OK
			
				//include("libreria_php/elenco_tabelle_inc.php");
			
			//fine elenco tabelle
			
?>
			
		<div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Scegli il mese e carica il file
						</div>
                	<div class="panel-body"> 

<?
//echo date("Y-m-d H:i:s");
?>

    <!--h3>Istruzioni</h3>
    <p>Angela crea un unico file, come da modello con tendine che abbiamo preparato, popolato da tutta la produzione di Torino (Angela + Ox)
    e Genova.<br />Il file, una volta caricato, aggiorna tutte le istanze del mese.</p><hr/-->
	<form action="upload_produzione_sva_modifiche.php" method="post" enctype="multipart/form-data">   
		<fieldset>
			<div class="form-group">
				<select name="mese" id="mese" class="form-control">
				<option value="gennaio" <? if ($mese == 'gennaio_'.ANNO) echo 'selected="selected"'; ?>>gennaio</option>
				<option value="febbraio" <? if ($mese == 'febbraio_'.ANNO) echo 'selected="selected"'; ?>>febbraio</option>
				<option value="marzo" <? if ($mese == 'marzo_'.ANNO) echo 'selected="selected"'; ?>>marzo</option>
				<option value="aprile" <? if ($mese == 'aprile_'.ANNO) echo 'selected="selected"'; ?>>aprile</option>
				<option value="maggio" <? if ($mese == 'maggio_'.ANNO) echo 'selected="selected"'; ?>>maggio</option>
				<option value="giugno" <? if ($mese == 'giugno_'.ANNO) echo 'selected="selected"'; ?>>giugno</option>
				<option value="luglio" <? if ($mese == 'luglio_'.ANNO) echo 'selected="selected"'; ?>>luglio</option>
				<option value="agosto" <? if ($mese == 'agosto_'.ANNO) echo 'selected="selected"'; ?>>agosto</option>
				<option value="settembre" <? if ($mese == 'settembre_'.ANNO) echo 'selected="selected"'; ?>>settembre</option>
				<option value="ottobre" <? if ($mese == 'ottobre_'.ANNO) echo 'selected="selected"'; ?>>ottobre</option>
				<option value="novembre" <? if ($mese == 'novembre_'.ANNO) echo 'selected="selected"'; ?>>novembre</option>
				<option value="dicembre" <? if ($mese == 'dicembre_'.ANNO) echo 'selected="selected"'; ?>>dicembre</option>
				</select>
			</div>
			<div class="form-group">
				<input type="file" name="filename">
			</div>
			<div class="form-group">
				<input name="" value="Upload" class="btn btn-default" type="submit">
			</div>
		</fieldset>
	</form>

                </div><!-- ./panel body -->
            </div><!-- ./panel panel -->
		</div>
    
    </div><!-- /.row -->
</div><!-- /#page-wrapper -->


<?php include_once("bottom.php"); ?>
