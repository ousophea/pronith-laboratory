<div class="page-header position-relative">
    <h1>
        Edit user
        <small>
            <i class="icon-double-angle-right"></i>
            Please fill all the required input box to edit user account
        </small>
    </h1>
</div>
<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->

        <form class="form-horizontal" method="post" name="user">
            <div class="control-group">
                <label class="control-label" for="firstname">First name</label>

                <div class="controls">
                    <input name='<?php echo USE_ID; ?>' type='hidden' value='<?php echo $data[USE_ID] ?>'/>
                    <input name="<?php echo USE_FIRSTNAME; ?>" type="text" value='<?php echo $data[USE_FIRSTNAME] ?>' minlength="3" id="fistname" placeholder="First name">
                    <span class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="lastname">Last name</label>

                <div class="controls">
                    <input name="<?php echo USE_LASTNAME; ?>" type="text" value='<?php echo $data[USE_LASTNAME] ?>' minlength="3" id="lastname" placeholder="Last name">
                    <span class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="<?php echo USE_STATUS; ?>">Status</label>

                <div class="controls">
                    <input name="<?php echo USE_STATUS; ?>" <?php echo ($data[USE_STATUS])?'checked':''; ?> type="checkbox" id="<?php echo USE_STATUS; ?>" placeholder="Last name" class="ace ace-switch ace-switch-7">
                    <span class="lbl"></span>
                    <span class="help-inline"></span>
                </div>
            </div>

            <div class="form-actions">
                <button class="btn btn-info" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    Submit
                </button>

                &nbsp; &nbsp; &nbsp;
                <button class="btn" type="reset">
                    <i class="icon-undo bigger-110"></i>
                    Reset
                </button>
            </div>

        </form>
    </div><!--/.span-->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var uri = [$('[name="base_url"]').val(),
            $('[name="segment1"]').val(),
            $('[name="segment2"]').val()];
        $('form[name="user"]').find("input,select,textarea").not('[type="submit"]').jqBootstrapValidation(
                {
                    submitSuccess: function($form, event) {
                        var user = {data: $('form[name="user"]').toJSON()};
                        console.log(user);
                        go_loader();
                        $.ajax({
                            type: 'POST',
                            data: user,
                            dataType: 'json',
                            url: uri[0] + 'users/update'
                        }).done(function(data) {
                            console.log(data.result)
                            //data.result 0:Invalid, 1:Success, 2: Could not create
                            if (data.result == 1) {
                                
                                $('.message').html(message('Done! ', 'Modify user successfully', 'success'));
                                notify('Done! ', 'Modify successfully', 'gritter-success');
                                $('.loader').fadeOut();
                            }
                            else if (data.result == 0) {
                                //$('#signup-box .loading').fadeOut();
                                $('.message').html(message('Fail! ', 'could not update user, please try again', 'error'));
                                notify('Fail! ', 'Could not update user, please try again', 'gritter-error');
                                back_loader();

                            }
                            else {
                                $('.message').html(message('Fail! ', 'system could not add new, please contact to system administrator', 'error'));
                                notify('Fail! ', 'System could not add new, please contact to system administrator', 'gritter-error');
                                back_loader();
                            }
                        });
                        event.preventDefault();
//                        $.post(
//                                uri[0] + 'users/update',
//                                {
//                                <?php echo USE_FIRSTNAME; ?>: e,
//                                <?php echo USE_LASTNAME; ?>: p
//                                },
//                                function(data) {
//                                    //data.result 0:Invalid, 1:Success, 2: Could not create
//                                    if (data.result == 1) {
//                                        $('.message').html("<p class='alert alert-success'>Add new user successfully</p>");
//                                        $('.loader').fadeOut();
//                                    }
//                                    else if (data.result == 0) {
//                                        //$('#signup-box .loading').fadeOut();
//                                        $('.message').html("<p class='alert alert-error'>User or firstname already exit!!!</p>");
//                                        back_loader();
//
//                                    }
//                                    else if (data.result == 2) {
//                                        $('.message').html("<p class='alert alert-error'>System could not add new, please contact to system administrator</p>");
//                                        back_loader();
//                                    }
//                                }, 'json');

                    }
                }
        );
    });
</script>