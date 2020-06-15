<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Telkomsel | SQL generator</title>
        <link href="<?php echo base_url()?>assets/css/styles.css" rel="stylesheet" />
        <link href="<?php echo base_url()?>assets/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="<?php echo base_url()?>assets/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html"><i class="fa fa-cube" aria-hidden="true"></i> SQLgen v2</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
            ><!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Settings</a><a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="login.html">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="<?php echo base_url()?>"> 
                                <div class="sb-nav-link-icon"><i class="fa fa-cogs" aria-hidden="true"></i></div>
                                Generate
                            </a>
                            <a class="nav-link" href="<?php echo base_url('archives')?>"> 
                                <div class="sb-nav-link-icon"><i class="fa fa-archive" aria-hidden="true"></i></div>
                                Archives
                            </a>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts"
                                ><div class="sb-nav-link-icon"><i class="fa fa-wrench" aria-hidden="true"></i></div>
                                Configuration
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="<?php echo base_url('config/template')?>">Template</a><a class="nav-link" href="#">Meta Info</a></nav>
                            </div>
                            <a class="nav-link" href="<?php echo base_url('about')?>"
                                ><div class="sb-nav-link-icon"><i class="fa fa-question-circle" aria-hidden="true"></i></div>
                                About</a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        PRO Admin
                    </div>
                </nav>
            </div>
            
            <div id="layoutSidenav_content">
                
                <?php
                    $this->load->view('component/'.$component);
                ?>

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">IT Product Enablement | Telkomsel</div>
                            <div>
                                <!--
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                                -->
                            </div>
                        </div>
                    </div>
                </footer>
            </div>

            
        </div>
        <script src="<?php echo base_url()?>assets/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url()?>assets/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url()?>assets/js/scripts.js"></script>
        <script src="<?php echo base_url()?>assets/Chart.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url()?>assets/assets/demo/chart-area-demo.js"></script>
        <script src="<?php echo base_url()?>assets/assets/demo/chart-bar-demo.js"></script>
        <script src="<?php echo base_url()?>assets/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url()?>assets/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url()?>assets/assets/demo/datatables-demo.js"></script>
    </body>
</html>
