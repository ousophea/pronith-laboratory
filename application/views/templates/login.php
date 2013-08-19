
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login Page - Ace Admin</title>

        <meta name="description" content="User login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!--basic styles-->

        <link href="<?php echo base_url() . CSS; ?>bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo base_url() . CSS; ?>bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo base_url() . TEMPLATE; ?>/font-awesome/css/font-awesome.min.css" />

        <!--[if IE 7]>
          <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>font-awesome/css/font-awesome-ie7.min.css" />
        <![endif]-->

        <!--page specific plugin styles-->

        <!--fonts-->

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

        <!--ace styles-->

        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>w8.min.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>w8-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>w8-skins.min.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>ace.min.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>prettify_bootstrap.css" />

        <!--[if lte IE 8]>
          <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>ace-ie.min.css" />
        <![endif]-->

        <!--inline styles related to this page-->

        <!--ace settings handler-->

        <!--<script src="<?php echo base_url() . JS; ?>ace-extra.min.js"></script>-->
    </head>

    <body class="login-layout">
        <?php
        echo form_open();
        echo form_hidden('base_url', base_url());
        echo form_hidden('segment1', $this->uri->segment(1));
        echo form_hidden('segment2', $this->uri->segment(2));
        echo form_close();
        ?>
        <div class="main-container container-fluid">
            <div class="main-content">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="login-container">
                            <div class="row-fluid">
                                <div class="center">
                                    <h1>
                                        <i class="icon-leaf green"></i>
                                        <span class="red">QMS</span>
                                        <span class="white">System</span>
                                    </h1>
                                    <h4 class="blue">International Technology</h4>
                                </div>
                            </div>

                            <div class="space-6"></div>

                            <div class="row-fluid">
                                <div class="position-relative">
                                    <div id="login-box" class="login-box visible widget-box no-border">
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <h4 class="header blue lighter bigger">
                                                    <i class="icon-coffee green"></i>
                                                    Please Enter Your Information
                                                </h4>

                                                <div class="space-6"></div>

                                                <form>
                                                    <fieldset>
                                                        <label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input type="text" class="span12" placeholder="Username" />
                                                                <i class="icon-user"></i>
                                                            </span>
                                                        </label>

                                                        <label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input type="password" class="span12" placeholder="Password" />
                                                                <i class="icon-lock"></i>
                                                            </span>
                                                        </label>

                                                        <div class="space"></div>

                                                        <div class="clearfix">
                                                            <label class="inline">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"> Remember Me</span>
                                                            </label>

                                                            <button onclick="return false;" class="width-35 pull-right btn btn-small btn-primary">
                                                                <i class="icon-key"></i>
                                                                Login
                                                            </button>
                                                        </div>

                                                        <div class="space-4"></div>
                                                    </fieldset>
                                                </form>

                                                <!--                                                <div class="social-or-login center">
                                                                                                    <span class="bigger-110">Or Login Using</span>
                                                                                                </div>
                                                
                                                                                                <div class="social-login center">
                                                                                                    <a class="btn btn-primary">
                                                                                                        <i class="icon-facebook"></i>
                                                                                                    </a>
                                                
                                                                                                    <a class="btn btn-info">
                                                                                                        <i class="icon-twitter"></i>
                                                                                                    </a>
                                                
                                                                                                    <a class="btn btn-danger">
                                                                                                        <i class="icon-google-plus"></i>
                                                                                                    </a>
                                                                                                </div>-->
                                            </div><!--/widget-main-->

                                            <div class="toolbar clearfix">
                                                <div>
                                                    <a href="#" onclick="show_box('forgot-box');
                                                                    return false;" class="forgot-password-link">
                                                        <i class="icon-arrow-left"></i>
                                                        I forgot my password
                                                    </a>
                                                </div>

                                                <div>
                                                    <a href="#" onclick="show_box('signup-box');
                                                                    return false;" class="user-signup-link">
                                                        I want to register
                                                        <i class="icon-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div><!--/widget-body-->
                                    </div><!--/login-box-->

                                    <div id="forgot-box" class="forgot-box widget-box no-border">
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <h4 class="header red lighter bigger">
                                                    <i class="icon-key"></i>
                                                    Retrieve Password
                                                </h4>

                                                <div class="space-6"></div>
                                                <p>
                                                    Enter your email and to receive instructions
                                                </p>

                                                <form>
                                                    <fieldset>
                                                        <label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input type="email" class="span12" placeholder="Email" />
                                                                <i class="icon-envelope"></i>
                                                            </span>
                                                        </label>

                                                        <div class="clearfix">
                                                            <button onclick="return false;" class="width-35 pull-right btn btn-small btn-danger">
                                                                <i class="icon-lightbulb"></i>
                                                                Send Me!
                                                            </button>
                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div><!--/widget-main-->

                                            <div class="toolbar center">
                                                <a href="#" onclick="show_box('login-box');
                                                                    return false;" class="back-to-login-link">
                                                    Back to login
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div><!--/widget-body-->
                                    </div><!--/forgot-box-->

                                    <div id="signup-box" class="signup-box widget-box no-border">
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <h4 class="header green lighter bigger">
                                                    <i class="icon-group blue"></i>
                                                    New User Registration
                                                </h4>

                                                <div class="space-6"></div>
                                                <p> Enter your details to begin: </p>

                                                <form name="register" method="post">
                                                    <fieldset>
                                                        <div class="control-group">
                                                            <!--<label class="control-label">Email address</label>-->
                                                            <div class="controls">
                                                                <span class="block input-icon input-icon-right">
                                                                    <input required name="email" type="email" class="span12" placeholder="Email" />
                                                                    <i class="icon-envelope"></i>
                                                                </span>
                                                                <p class="help-block"></p>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <!--<label class="control-label">Email address</label>-->
                                                            <div class="controls">
                                                                <label>
                                                                    <span class="block input-icon input-icon-right">
                                                                        <input required name="password" minlength="6" maxlength="30" type="password" class="span12" placeholder="Password" />
                                                                        <i class="icon-lock"></i>
                                                                    </span>
                                                                </label>
                                                                <p class="help-block"></p>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <!--<label class="control-label">Email address</label>-->
                                                            <div class="controls">
                                                                <label>
                                                                    <span class="block input-icon input-icon-right">
                                                                        <input required name="passwordc" type="password" data-validation-match-match="password" data-validation-match-message="Password not match!!!" class="span12" placeholder="Repeat password" />
                                                                        <i class="icon-retweet"></i>
                                                                    </span>
                                                                </label>
                                                                <p class="help-block"></p>
                                                            </div>
                                                        </div>

                                                        <div class="control-group">
                                                            <!--<label class="control-label">Email address</label>-->
                                                            <div class="controls">
                                                                <label>
                                                                    <input required data-validation-required-message="Please accept agreement" name="accept" type="checkbox" class="ace" />
                                                                    <span class="lbl">
                                                                        I accept the
                                                                        <a href="#">User Agreement</a>
                                                                    </span>
                                                                </label>
                                                                <p class="help-block"></p>
                                                            </div>
                                                        </div>


                                                        <div class="loading" style="display: none;" >
                                                            <div class="progress progress-success progress-mini progress-striped active">
                                                                <div class="bar" style="width: 40%;"></div>
                                                            </div>
                                                        </div>
                                                        <div class="space-24"></div>

                                                        <div class="clearfix">
                                                            <button type="reset" class="width-30 pull-left btn btn-small">
                                                                <i class="icon-refresh"></i>
                                                                Reset
                                                            </button>

                                                            <button type="submit" name="btn-register" class="width-65 pull-right btn btn-small btn-success">
                                                                Register
                                                                <i class="icon-arrow-right icon-on-right"></i>
                                                            </button>
                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div>

                                            <div class="toolbar center">
                                                <a href="#" onclick="show_box('login-box');
                                                                    return false;" class="back-to-login-link">
                                                    <i class="icon-arrow-left"></i>
                                                    Back to login
                                                </a>
                                            </div>
                                        </div><!--/widget-body-->
                                    </div><!--/signup-box-->
                                </div><!--/position-relative-->
                            </div>
                        </div>
                    </div><!--/.span-->
                </div><!--/.row-fluid-->
            </div>
        </div><!--/.main-container-->

        <!--basic scripts-->

        <!--[if !IE]>-->

        <script src="<?php echo base_url() . JS; ?>jquery.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>jqBootstrapValidation.js"></script>
        <script src="<?php echo base_url() . JS; ?>prettify.js"></script>
        <!--<![endif]-->

        <!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

        <!--[if !IE]>-->

        <script type="text/javascript">
                                                                window.jQuery || document.write("<script src='<?php echo base_url() . JS; ?>jquery-2.0.3.min.js'>" + "<" + "/script>");
        </script>

        <!--<![endif]-->

        <!--[if IE]>
<script type="text/javascript">
window.jQuery || document.write("<script src='<?php echo base_url() . JS; ?>jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

        <script src="<?php echo base_url() . JS; ?>bootstrap.min.js"></script>

        <!--page specific plugin scripts-->

        <!--ace scripts-->

        <script src="<?php echo base_url() . JS; ?>w8-elements.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>w8.min.js"></script>


        <!--inline scripts related to this page-->

        <script type="text/javascript">

            function show_box(id) {
                $('.widget-box.visible').removeClass('visible');
                $('#' + id).addClass('visible');
            }

            /*
             $(document).ready(function() {
             var uri = [$('[name="base_url"]').val(),
             $('[name=""]').val(),
             $('[name=""]').val()];
             
             $('[name="register"]').submit(function() {
             var e = $('[name="email"]').val();
             var p = $('[name="password"]').val();
             var pc = $('[name="passwordc"]').val();
             if (p != pc) {
             $('.register-message').html('<p class="text-error">Password not match!!!</p>');
             return false;
             }
             if ($('[name="accept"]').is(':checked')) {
             $.post(
             uri[0] + 'users/register',
             {
             email: e,
             password: p
             },
             function(data) {
             alert(data.email);
             }, 'json'
             
             );
             }
             else {
             $('.register-message').html('<p class="text-error">Please accept agreement!!!</p>');
             
             }
             return false;
             });
             });
             */

            $(document).ready(function() {
                var uri = [$('[name="base_url"]').val(),
                    $('[name="segment1"]').val(),
                    $('[name="segment2"]').val()];
                $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(
                        {
                            submitSuccess: function($form, event) {
                                var e = $('[name="email"]').val();
                                var p = $('[name="password"]').val();
                                $('#signup-box .loading').show();
                                for (var i = 0; i <= 90; i++) {
                                    $('#signup-box .progress .bar').width(i + "%");
                                }
                                $.post(
                                        uri[0] + 'users/register',
                                        {
                                            email: e,
                                            password: p
                                        },
                                function(data) {
                                    alert(data.email);
                                }, 'json');
                                event.preventDefault();
                            }
                        }
                );
            });
        </script>
    </body>
</html>
