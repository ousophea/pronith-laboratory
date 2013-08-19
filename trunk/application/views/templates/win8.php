<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Dashboard - W8 Admin</title>
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

        <!--ace styles-->

        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>w8.min.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>w8-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>w8-skins.min.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>ace.min.css" />

        <!--[if lte IE 8]>
          <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>ace-ie.min.css" />
        <![endif]-->

        <!--inline styles if any-->
        <script src="<?php echo base_url() . JS; ?>jquery.min.js"></script>
    </head>

    <body>
        <?php
        echo form_open();
        echo form_hidden('base_url', base_url());
        echo form_hidden('segment1', $this->uri->segment(1));
        echo form_hidden('segment2', $this->uri->segment(2));
        echo form_close();
        ?>
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

                <div id="page-content" class="clearfix">

                    <?php $this->load->view($this->uri->segment(1) . '/' . $this->uri->segment(2)); ?>
                </div><!--/#page-content-->

                <div id="ace-settings-container">
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
                </div><!--/#ace-settings-container-->
            </div><!--/#main-content-->
        </div><!--/.fluid-container#main-container-->

        <a href="#" id="btn-scroll-up" class="btn btn-small btn-inverse">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>

        <!--basic scripts-->


        <script src="<?php echo base_url() . JS; ?>bootstrap.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>jquery-ui-1.10.3.custom.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>jquery.ui.touch-punch.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>fullcalendar.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>bootbox.min.js"></script>

        <script src="<?php echo base_url() . JS; ?>jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>jquery.easy-pie-chart.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>jquery.sparkline.min.js"></script>

        <script src="<?php echo base_url() . JS; ?>jquery.flot.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>jquery.flot.pie.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>jquery.flot.resize.min.js"></script>

        <!--w8 scripts-->

        <script src="<?php echo base_url() . JS; ?>w8-elements.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>w8.min.js"></script>

        <!--inline scripts related to this page-->

<!--        <script type="text/javascript">
            $(function() {

                $('.dialogs,.comments').slimScroll({
                    height: '300px'
                });

                $('#tasks').sortable();
                $('#tasks').disableSelection();
                $('#tasks input:checkbox').removeAttr('checked').on('click', function() {
                    if (this.checked)
                        $(this).closest('li').addClass('selected');
                    else
                        $(this).closest('li').removeClass('selected');
                });

                var oldie = $.browser.msie && $.browser.version < 9;
                $('.easy-pie-chart.percentage').each(function() {
                    var $box = $(this).closest('.infobox');
                    var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
                    var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
                    var size = parseInt($(this).data('size')) || 50;
                    $(this).easyPieChart({
                        barColor: barColor,
                        trackColor: trackColor,
                        scaleColor: false,
                        lineCap: 'butt',
                        lineWidth: parseInt(size / 10),
                        animate: oldie ? false : 1000,
                        size: size
                    });
                })

                $('.sparkline').each(function() {
                    var $box = $(this).closest('.infobox');
                    var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
                    $(this).sparkline('html', {tagValuesAttribute: 'data-values', type: 'bar', barColor: barColor, chartRangeMin: $(this).data('min') || 0});
                });




                var data = [
                    {label: "social networks", data: 38.7, color: "#68BC31"},
                    {label: "search engines", data: 24.5, color: "#2091CF"},
                    {label: "ad campaings", data: 8.2, color: "#AF4E96"},
                    {label: "direct traffic", data: 18.6, color: "#DA5430"},
                    {label: "other", data: 10, color: "#FEE074"}
                ];

                var placeholder = $('#piechart-placeholder').css({'width': '90%', 'min-height': '150px'});
                $.plot(placeholder, data, {
                    series: {
                        pie: {
                            show: true,
                            tilt: 0.8,
                            highlight: {
                                opacity: 0.25
                            },
                            stroke: {
                                color: '#fff',
                                width: 2
                            },
                            startAngle: 2

                        }
                    },
                    legend: {
                        show: true,
                        position: "ne",
                        labelBoxBorderColor: null,
                        margin: [-30, 15]
                    }
                    ,
                    grid: {
                        hoverable: true,
                        clickable: true
                    },
                    tooltip: true, //activate tooltip
                    tooltipOpts: {
                        content: "%s : %y.1",
                        shifts: {
                            x: -30,
                            y: -50
                        }
                    }

                });


                var $tooltip = $("<div class='tooltip top in' style='display:none;'><div class='tooltip-inner'></div></div>").appendTo('body');
                placeholder.data('tooltip', $tooltip);
                var previousPoint = null;

                placeholder.on('plothover', function(event, pos, item) {
                    if (item) {
                        if (previousPoint != item.seriesIndex) {
                            previousPoint = item.seriesIndex;
                            var tip = item.series['label'] + " : " + item.series['percent'] + '%';
                            $(this).data('tooltip').show().children(0).text(tip);
                        }
                        $(this).data('tooltip').css({top: pos.pageY + 10, left: pos.pageX + 10});
                    } else {
                        $(this).data('tooltip').hide();
                        previousPoint = null;
                    }

                });






                var d1 = [];
                for (var i = 0; i < Math.PI * 2; i += 0.5) {
                    d1.push([i, Math.sin(i)]);
                }

                var d2 = [];
                for (var i = 0; i < Math.PI * 2; i += 0.5) {
                    d2.push([i, Math.cos(i)]);
                }

                var d3 = [];
                for (var i = 0; i < Math.PI * 2; i += 0.2) {
                    d3.push([i, Math.tan(i)]);
                }


                var sales_charts = $('#sales-charts').css({'width': '100%', 'height': '220px'});
                $.plot("#sales-charts", [
                    {label: "Domains", data: d1},
                    {label: "Hosting", data: d2},
                    {label: "Services", data: d3}
                ], {
                    hoverable: true,
                    shadowSize: 0,
                    series: {
                        lines: {show: true},
                        points: {show: true}
                    },
                    xaxis: {
                        tickLength: 0
                    },
                    yaxis: {
                        ticks: 10,
                        min: -2,
                        max: 2,
                        tickDecimals: 3
                    },
                    grid: {
                        backgroundColor: {colors: ["#fff", "#fff"]},
                        borderWidth: 1,
                        borderColor: '#555'
                    }
                });


                $('#recent-box [data-rel="tooltip"]').tooltip({plw8ment: tooltip_plw8ment});
                function tooltip_plw8ment(context, source) {
                    var $source = $(source);
                    var $parent = $source.closest('.tab-content')
                    var off1 = $parent.offset();
                    var w1 = $parent.width();

                    var off2 = $source.offset();
                    var w2 = $source.width();

                    if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2))
                        return 'right';
                    return 'left';
                }
            })
        </script>-->
    </body>
</html>
