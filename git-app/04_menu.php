        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">S.V.A. srl</a>
            </div>
            <!-- /.navbar-header -->
 			<ul class="nav navbar-top-links navbar-right">
				<li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown">
                <!--i class="fa fa-envelope fa-fw"></i-->
				<!--?php echo date("d-m-Y"); ?-->
                <?php echo GIORNO.' - '.MESEP.' - '.ANNO; ?>
                <!--i class="fa fa-caret-down"></i-->
                </a>
                </li>
                <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown">
                <!--i class="fa fa-envelope fa-fw"></i-->
				<?php echo $_SESSION["user"]; ?>
                <!--i class="fa fa-caret-down"></i-->
                </a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="admin_venditori_resp.php"><i class="fa fa-gear fa-fw"></i> Gestione</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="libreria_php/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        <!--li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group >
                        </li-->
                        <li>
                            <a href="venditori_garetta_resp.php"><i class="fa fa-dashboard fa-fw"></i> Garetta</a>
                        </li>
                        <li>
                            <a href="venditori_resp.php"><i class="fa fa-bar-chart-o fa-fw"></i> Situazione Pda<!--span class="fa arrow"></span--></a>
                            <!--ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Flot Charts</a>
                                </li>
                                <li>
                                    <a href="morris.html">Morris.js Charts</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
<?

// forse definitivo per abilitazione solo a chi ha crm id

if ($_SESSION["crm_id"] !== '')
{
echo'
                        <li>
						<a href="0004_appuntamenti_vend.php" style="color:#333"><i class="fa fa-users fa-fw"></i> Appuntamenti</a>
                        </li>
';
}

// /momentaneo per abilitazione raho tester

?>

                        <!--li>
                            <a href="tables.html"><i class="fa fa-table fa-fw"></i> Tables</a>
                        </li>
                        <li>
                            <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>
                        </li-->
                        <li>
                            <a href=""><i class="fa fa-gear fa-fw"></i> Account
                            <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin_venditori_resp.php">Gestione account</a>
                                </li>
                                <li>
                                    <a href="libreria_php/logout.php">Logout</a>
                                </li>
                                <!--li>
                                    <a href="notifications.html">Notifications</a>
                                </li>
                                <li>
                                    <a href="typography.html">Typography</a>
                                </li>
                                <li>
                                    <a href="grid.html">Grid</a>
                                </li-->
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <!--li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                <!--/li>
                            </ul>
                            <!-- /.nav-second-level -->
                        <!--/li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="blank.html">Blank Page</a>
                                </li>
                                <li>
                                    <a href="login.html">Login Page</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        <!--/li///////////// -->
                    </ul>
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
