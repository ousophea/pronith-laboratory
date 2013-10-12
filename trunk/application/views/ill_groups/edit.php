<div class="page-header position-relative">
    <h1>
        កែប្រែប្រ​ភេទ​ជំ​ងឺ
        <small>
            <i class="icon-double-angle-right"></i>
            សូម​បំ​ពេញ​រាល់​ពត៌មាន​ អោយ​បាន​គ្រប់​ជ្រុង​ជ្រោយ
        </small>
    </h1>
</div>
<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->

        <form class="form-horizontal" method="post" name="user">
            <div class="control-group">
                <label class="control-label" for="firstname">ឈ្មោះ</label>

                <div class="controls">
                    <input name='<?php echo ILG_ID; ?>' type='hidden' value='<?php echo $data[ILG_ID] ?>'/>
                    <input name="<?php echo ILG_NAME; ?>" type="text" value='<?php echo $data[ILG_NAME] ?>' minlength="3" id="fistname" placeholder="ឈ្មោះប្រភេទជំងឺ">
                    <span class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="lastname">បរិយាយ</label>

                <div class="controls">
                    <textarea name="<?php echo ILG_DESCRIPTION; ?>" type="text" value='<?php echo $data[ILG_DESCRIPTION] ?>' minlength="3" id="lastname" placeholder="បរិយាយ" />
                    <span class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="<?php echo ILG_STATUS; ?>">ស្ថានភាព</label>

                <div class="controls">
                    <input name="<?php echo ILG_STATUS; ?>" <?php echo ($data[ILG_STATUS])?'checked':''; ?> type="checkbox" id="<?php echo ILG_STATUS; ?>" placeholder="Last name" class="ace ace-switch ace-switch-7">
                    <span class="lbl"></span>
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="form-actions">
                <button class="btn btn-info" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    ដែប្រែ
                </button>

                &nbsp; &nbsp; &nbsp;
                <button class="btn" type="reset">
                    <i class="icon-undo bigger-110"></i>
                    សារ​ដើម
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
                            url: uri[0] + 'ill_groups/update'
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
                        // avoid submit 
                        event.preventDefault();
                    }
                }
        );
    });
</script>