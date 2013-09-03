<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo (!empty($title)) ? $title : 'Welcome'; ?> | Pronith Laboratory</title>
        <meta name="description" content="This is page-header (.page-header &gt; h1)" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!--basic styles-->

        <link href="<?php echo base_url() . CSS; ?>bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo base_url() . CSS; ?>bootstrap-responsive.min.css" rel="stylesheet" />
        <link href="<?php echo base_url() . CSS; ?>fullcalendar.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo base_url() . FONT; ?>css/font-awesome.min.css" />

        <!--[if IE 7]>
          <link rel="stylesheet" href="<?php echo base_url() . FONT; ?>css/font-awesome-ie7.min.css" />
        <![endif]-->

        <!--page specific plugin styles-->

        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>prettify.css" />

        <!--fonts-->

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

        <!--        Form-->
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>jquery-ui-1.10.3.custom.min.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>chosen.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>datepicker.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>bootstrap-timepicker.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>daterangepicker.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>colorpicker.css" />
        <!---------------->
        <!--Gritter notification-->
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>jquery.gritter.css" />
        <!---------------->

        <!--W8 and ace styles-->
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>w8.min.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>ace.min.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>w8-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>w8-skins.min.css" />




        <!--[if lte IE 8]>
          <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>ace-ie.min.css" />
        <![endif]-->

        <!--inline styles if any-->
        <script src="<?php echo base_url() . JS; ?>jquery.min.js"></script>

        <!--Validation-->
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>prettify_bootstrap.css" />
        <script src="<?php echo base_url() . JS; ?>jqBootstrapValidation.js"></script>
        <script src="<?php echo base_url() . JS; ?>prettify.js"></script>
        <!----------------->
        
        <!--Messages-->
        <script src="<?php echo base_url() . JS; ?>messages.js"></script>
        <!----------------->
        
        
    </head>

    <body>
        <div style="display: none;">
            <?php
            echo form_open();
            echo form_hidden('base_url', base_url());
            echo form_hidden('segment1', $this->uri->segment(1));
            echo form_hidden('segment2', $this->uri->segment(2));
            echo form_close();
            ?>
        </div>


        <?php echo $this->load->view('templates/top'); ?>

        <div class="container-fluid" id="main-container">
            <a id="menu-toggler" href="#">
                <span></span>
            </a>

            <div id="sidebar">
                <?php echo $this->load->view('templates/sidebar_shortcuts'); ?>
                <?php echo $this->load->view('templates/sidebar_list'); ?>
                <div id="sidebar-collapse">
                    <i class="icon-double-angle-left"></i>
                </div>
            </div>

            <div id="main-content" class="clearfix">
                <div id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="#">Home</a>

                            <span class="divider">
                                <i class="icon-angle-right"></i>
                            </span>
                        </li>
                        <li class="active">Dashboard</li>
                    </ul><!--.breadcrumb-->

                    <div id="nav-search">
                        <form class="form-search">
                            <span class="input-icon">
                                <input type="text" placeholder="Search ..." class="input-small search-query" id="nav-search-input" autocomplete="off" />
                                <i class="icon-search" id="nav-search-icon"></i>
                            </span>
                        </form>
                    </div><!--#nav-search-->
                </div>

                <div class="loader" style="display: none;">
                    <div class="progress progress-mini progress-success progress-striped active" data-percent="0%"><div class="bar" style="width: 0%;"></div></div>
                    <!--<p style="padding-left: 20px">Loading...</p>-->
                </div>
                <div class="message"></div>
                <div id="page-content" class="clearfix">
                    <?php $this->load->view($this->uri->segment(1) . '/' . $this->uri->segment(2)); ?>
                </div><!--/#page-content-->

<!--                <div id="ace-settings-container">
                    <div class="btn btn-app btn-mini btn-warning" id="ace-settings-btn">
                        <i class="icon-cog"></i>
                    </div>

                    <div id="ace-settings-box">
                        <div>
                            <div class="pull-left">
                                <select id="skin-colorpicker" class="hidden">
                                    <option data-class="default" value="#438EB9">#438EB9</option>
                                    <option data-class="skin-1" value="#222A2D">#222A2D</option>
                                    <option data-class="skin-2" value="#C6487E">#C6487E</option>
                                    <option data-class="skin-3" value="#D0D0D0">#D0D0D0</option>
                                </select>
                            </div>
                            <span>&nbsp; Choose Skin</span>
                        </div>

                        <div>
                            <input type="checkbox" class="ace-checkbox-2" id="ace-settings-header" />
                            <label class="lbl" for="ace-settings-header"> Fixed Header</label>
                        </div>

                        <div>
                            <input type="checkbox" class="ace-checkbox-2" id="ace-settings-sidebar" />
                            <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                        </div>
                    </div>
                </div>-->
                <!--/#ace-settings-container-->
            </div><!--/#main-content-->
        </div><!--/.fluid-container#main-container-->

        <a href="#" id="btn-scroll-up" class="btn btn-small btn-inverse">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>

        <!--basic scripts-->
        <script src="<?php echo base_url() . JS; ?>bootstrap.min.js"></script>


        <script src="<?php echo base_url() . JS; ?>jquery-ui-1.10.3.custom.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>jquery.ui.touch-punch.min.js"></script>

        <!--Calenda-->
        <script src="<?php echo base_url() . JS; ?>fullcalendar.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>bootbox.min.js"></script>
        <!------->
        <!--Gritter Notification-->
        <script src="<?php echo base_url() . JS; ?>jquery.gritter.min.js"></script>
        <!------->

        <script src="<?php echo base_url() . JS; ?>jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>jquery.easy-pie-chart.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>jquery.sparkline.min.js"></script>

        <script src="<?php echo base_url() . JS; ?>jquery.flot.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>jquery.flot.pie.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>jquery.flot.resize.min.js"></script>

        <!--From-->
        <script src="<?php echo base_url() . JS; ?>fuelux.spinner.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>chosen.jquery.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>bootstrap-datepicker.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>bootstrap-timepicker.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>moment.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>daterangepicker.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>bootstrap-colorpicker.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>jquery.knob.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>jquery.autosize-min.js"></script>
        <script src="<?php echo base_url() . JS; ?>jquery.inputlimiter.1.3.1.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>jquery.maskedinput.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>bootstrap-tag.min.js"></script>
        <!------------>

        <!--w8 scripts-->

        <script src="<?php echo base_url() . JS; ?>w8-elements.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>w8.min.js"></script>
        
        
        <script src="<?php echo base_url() . JS; ?>loaders.js"></script>
        
    </body>
</html>
