    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Datetimepicker -->
	<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="js/locales/bootstrap-datetimepicker.it.js" charset="UTF-8"></script>
    
    <script type="text/javascript">
        $('.form_datetime').datetimepicker({
            language:  'it',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 1,
            minuteStep: 15
            //showMeridian: 1
        });
    </script>

    <!-- Page-Level Plugin Scripts - Tables -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
	<script src="SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>

    <script>
    $(document).ready(function() {
    $('#dataTables-calendario').dataTable();
    });
		
	$(document).ready(function() {
    $('#dataTables-venditori').dataTable();
    });
		
	$(document).ready(function() {
    $('#dataTables-appuntamenti').dataTable();
    });
    </script>

	<script type="text/javascript">
	var CollapsiblePanel<? echo $jtab++; ?> = new Spry.Widget.CollapsiblePanel("CollapsiblePanel<? echo $vtab++; ?>", { contentIsOpen: false });
	</script>

	<?php
		include("libreria_php/footer_sess.php");
	?>
    
</body>

</html>
