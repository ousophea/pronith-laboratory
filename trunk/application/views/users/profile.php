<div class="page-header position-relative">
    <h1>
        សូមស្វាគមន៍
        <small>
            <i class="icon-double-angle-right"></i>
            គេហទំព័ររបស់អ្នកប្រើប្រាស់
            <?php
            $user = $this->session->userdata(USERS);
            //var_dump($user);
            ?>

            <?php
            //var_dump($this->session->userdata(GROUPS));
            ?>
        </small>
    </h1>
</div>
<div class="row-fluid">
    <div class="span12">
        <div class="hide" style="display: block;">
            <div id="user-profile-2" class="user-profile row-fluid">
                <div class="tabbable">
                    <ul class="nav nav-tabs padding-18">
                        <li class="active">
                            <a data-toggle="tab" href="#home">
                                <i class="icon-user bigger-120"></i>
                                ជីវប្រវត្តិសង្ខេប
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#password">
                                <i class="icon-key bigger-120"></i>
                                ប្ដូរកូដសម្ថាត់
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content no-border padding-24">

                        <div id="home" class="tab-pane active">
                            <div class="row-fluid">
                                <div class="span12">
                                    <h4 class="blue">
                                        <span class="middle"><?php echo $user[USE_USERNAME]; ?></span>
                                    </h4>

                                    <div class="profile-user-info">
                                        <div class="profile-info-row">
                                            <div class="profile-info-name">ឈ្មោះ</div>

                                            <div class="profile-info-value">
                                                <span><?php echo $user[USE_LASTNAME] . ' ' . $user[USE_FULLNAME] . '&nbsp;'; ?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name">ឋានៈ</div>

                                            <div class="profile-info-value">
                                                <span><?php echo $user[GRO_NAME] . '&nbsp;'; ?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name">ថ្ងៃចុះឈ្មោះ</div>

                                            <div class="profile-info-value">
                                                <span><?php echo $user[USE_DATACREATED] . '&nbsp;'; ?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name">ថ្ងៃកែប្រែ</div>

                                            <div class="profile-info-value">
                                                <span><?php echo $user[USE_DATAMODIFIED] . "&nbsp;"; ?></span>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div><!--/span-->
                        </div><!--/row-fluid-->


                        <div id="password" class="tab-pane">
                            <div class="row-fluid">
                                <div class="span12">

                                    <form class="form-horizontal" method="post" name="changepass">
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="passwordold">កូដសម្ងាត់ចាស់</label>

                                            <div class="controls">
                                                <input name="<?php echo USE_PASSWORD . 'old'; ?>" type="password" id="passwordold">
                                                <span class="help-inline"></span>
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="password">កូដសម្ងាត់ថ្មី</label>

                                            <div class="controls">
                                                <input required name="<?php echo USE_PASSWORD; ?>" type="password"  minlength="6" data-validation-minlength-message="កូដសម្ងាត់៦តួរអក្សរយ៉ាងតិច" id="password" data-validation-required-message="ចូរបញ្ចូលនិន្នន័យ">
                                                <span class="help-inline"></span>
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="passwordc">កូដសម្ងាត់ថ្មីម្កងទៀត</label>

                                            <div class="controls">
                                                <input required name="<?php echo USE_PASSWORD . 'c'; ?>"  data-validation-match-match="<?php echo USE_PASSWORD ; ?>" data-validation-match-message="កូដសម្ងាត់មិនដូចគ្នា"  type="password"  minlength="6" data-validation-minlength-message="កូដសម្ងាត់៦តួរអក្សរយ៉ាងតិច" id="passwordc" data-validation-required-message="ចូរបញ្ចូលនិន្នន័យ">
                                                <span class="help-inline"></span>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button class="btn btn-info" type="submit">
                                                <i class="icon-ok bigger-110"></i>
                                                ផ្លាស់ប្ដូរ
                                            </button>

                                            &nbsp; &nbsp; &nbsp;
                                            <button class="btn" type="reset">
                                                <i class="icon-undo bigger-110"></i>
                                                សារ​ដើម
                                            </button>
                                        </div>

                                    </form>

                                </div>
                            </div><!--/span-->
                        </div><!--/row-fluid-->

                        <div class="space-20"></div>

                    </div><!--#home-->

                </div>
            </div>
        </div>
    </div>
    <!--PAGE CONTENT ENDS-->
</div><!--/.span-->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var uri = [$('[name="base_url"]').val(),
            $('[name="segment1"]').val(),
            $('[name="segment2"]').val()];
        $('form[name="changepass"]').find("input,select,textarea").not('[type="submit"]').jqBootstrapValidation(
                {
                    submitSuccess: function($form, event) {
                        var object = {data: $('form[name="changepass"]').toJSON()};
                        go_loader();
                        $.ajax({
                            type: 'POST',
                            data: object,
                            dataType: 'json',
                            url: uri[0] + 'users/changepass'
                        }).done(function(data) {
                            //data.result 0:Invalid, 1:Success, 2: Could not create
                            if (data.result == 1) {
                                notify('ជោគជ័យ', 'ផ្លាស់ប្ដូរកូដសម្ងាត់បានសម្រេច', 'gritter-success');
                                $('.loader').fadeOut();
                            }
                            else if (data.result == 0) {
                                notify('បរាជ័យ! ', 'កូដសម្ងាត់ចាស់មិនត្រឹមត្រួវ ការផ្លាស់ប្ដូរកូដសម្ងាត់មិនបានសម្រេចទេ សូមព្យាយាមម្ដងទៀត', 'gritter-error');
                                back_loader();
                            }
                            // blocked
                            else if (data.result == 2) {
                                notify('បរាជ័យ! ', 'ឈ្មោះរបស់អ្នកបានផ្អាកដំណើរការ ពីព្រោះអ្នកបានព្យាយាមច្រើនដងលើសពីការកំណត់ សូមទំនាក់ទំនងអ្នកគ្រប់គ្រងប្រព័ន្ធដើម្បីជំនួយ', 'gritter-error');
                                back_loader();
                            }
                            
                            else {
                               notify('បរាជ័យ! ', 'ផ្លាស់ប្ដូរកូដសម្ងាត់មិនបានសម្រេចទេ សូមទំនាក់ទំនងអ្នកគ្រប់គ្រងប្រព័ន្ធ', 'gritter-error');
                                back_loader();
                            }
                        });
                        event.preventDefault();

                    }
                }
        );
    });
</script>