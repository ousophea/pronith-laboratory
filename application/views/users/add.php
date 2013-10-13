<div class="page-header position-relative">
    <h1>
        បង្កើតអ្នកប្រើប្រាស់
        <small>
            <i class="icon-double-angle-right"></i>
            សូម​បំ​ពេញ​​ពត៌មាន​អោយ​បាន​ត្រឹមត្រូវ
        </small>
    </h1>
</div>
<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->

        <form class="form-horizontal" method="post" name="register">
            <div class="control-group">
                <label class="control-label" for="email">ឈ្មោះ</label>

                <div class="controls">
                    <input name="email" type="text" required="required" id="email" placeholder="ឈ្មោះ">
                    <span class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="password">កូដសម្ងាត់</label>

                <div class="controls">
                    <input name="password" type="password" required="required" minlength="6" maxlength="30" id="passowrd" placeholder="កូដសម្ងាត់">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="passwordc">កូដសម្ងាត់ម្ដងទៀត</label>

                <div class="controls">
                    <input name="passwordc" type="password" required="required" id="passowrdc" placeholder="កូដសម្ងាត់ម្ដងទៀត" data-validation-match-match="password" data-validation-match-message="Password not match!!!">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="<?php echo USE_GROUPID; ?>">ឋានៈ</label>

                <div class="controls">
                    <?php echo form_dropdown('group', $groups, '', ' required="required"') ?>
                    <span class="help-inline"></span>
                </div>
            </div>

            <div class="form-actions">
                <button class="btn btn-info" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    បង្កើត
                </button>

                &nbsp; &nbsp; &nbsp;
                <button class="btn" type="reset">
                    <i class="icon-undo bigger-110"></i>
                    សារដើម
                </button>
            </div>

        </form>
    </div><!--/.span-->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        try {
            // add new user
            var uri = [$('[name="base_url"]').val(),
                $('[name="segment1"]').val(),
                $('[name="segment2"]').val()];
            $('form[name="register"]').find("input,select,textarea").not('[type="submit"]').jqBootstrapValidation(
                    {
                        submitSuccess: function($form, event) {
                            var e = document.register.email.value;
                            var p = document.register.password.value;
                            var g = document.register.group.value;
                            go_loader();
                            $.post(
                                    uri[0] + 'users/register',
                                    {
                                    <?php echo USE_USERNAME; ?>: e,
                                    <?php echo USE_PASSWORD; ?>: p,
                                    <?php echo USE_GROUPID; ?>: g
                                    },
                                    function(data) {

                                        //data.result 0:Invalid, 1:Success, 2: Could not create
                                        if (data.result == 1) {
                                            $('.message').html(message('Done! ', 'new user create successfully', 'success'));

                                            $.gritter.add({
                                                // (string | mandatory) the heading of the notification
                                                title: 'Done!',
                                                // (string | mandatory) the text inside the notification
                                                text: 'new user create successfully',
                                                class_name: 'gritter-success'
                                            });


                                            $('.loader').fadeOut();
                                        }
                                        else if (data.result == 0) {
                                            //$('#signup-box .loading').fadeOut();
                                            $.gritter.add({
                                                // (string | mandatory) the heading of the notification
                                                title: 'Fail!',
                                                // (string | mandatory) the text inside the notification
                                                text: 'User or email already exit!!!, please try again.',
                                                class_name: 'gritter-error'
                                            });
                                            $('.message').html(message('Fail! ', 'User or email already exit!!!','error'));
                                            back_loader();

                                        }
                                        else if (data.result == 2) {
                                            $.gritter.add({
                                                // (string | mandatory) the heading of the notification
                                                title: 'Fail!',
                                                // (string | mandatory) the text inside the notification
                                                text: 'User or email already exit!!!, please try again.',
                                                class_name: 'gritter-error'
                                            });
                                            $('.message').html(message('Fail! ', 'System could not add new, please contact to system administrator','error'));
                                            back_loader();
                                        }
                                    }, 'json');
                            event.preventDefault();
                        }
                    }
            );
        } catch (e) {
            alert(e)
        }
    });
</script>