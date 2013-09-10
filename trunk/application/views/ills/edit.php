<div class="page-header position-relative">
    <h1>
        Edit ill
        <small>
            <i class="icon-double-angle-right"></i>
            Please fill all the required input box to edit ill
        </small>
    </h1>
</div>
<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->

        <form class="form-horizontal" method="post" name="edit">
            <div class="control-group">
                <label class="control-label" for="firstname">Ill name</label>

                <div class="controls">
                    <input name='<?php echo ILL_ID; ?>' type='hidden' value='<?php echo $data[ILL_ID] ?>'/>
                    <input name="<?php echo ILL_NAME; ?>" type="text" value='<?php echo $data[ILL_NAME] ?>' minlength="3" id="fistname" placeholder="Ill name">
                    <span class="help-inline"></span>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="<?php echo ILL_GROUPID; ?>">Ill Group</label>

                <div class="controls">
                    <?php echo form_dropdown(ILL_GROUPID, $groups, $data[ILL_GROUPID], ' required="required"') ?>
                    <span class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="<?php echo ILL_STATUS; ?>">Status</label>

                <div class="controls">
                    <input name="<?php echo ILL_STATUS; ?>" <?php echo ($data[ILL_STATUS])?'checked':''; ?> type="checkbox" id="<?php echo ILL_STATUS; ?>" class="ace ace-switch ace-switch-7">
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
        $('form[name="edit"]').find("input,select,textarea").not('[type="submit"]').jqBootstrapValidation(
                {
                    submitSuccess: function($form, event) {
                        var object = {data: $('form[name="edit"]').toJSON()};
                        console.log(object);
                        go_loader();
                        $.ajax({
                            type: 'POST',
                            data: object,
                            dataType: 'json',
                            url: uri[0] + 'ills/update'
                        }).done(function(data) {
                            console.log(data.result)
                            //data.result 0:Invalid, 1:Success, 2: Could not create
                            if (data.result == 1) {
                                
                                //$('.message').html(message('Done! ', 'Modify ill successfully', 'success'));
                                notify('Done! ', 'Modify successfully', 'gritter-success');
                                $('.loader').fadeOut();
                            }
                            else if (data.result == 0) {
                                //$('#signup-box .loading').fadeOut();
                                //$('.message').html(message('Fail! ', 'could not update ill, please try again', 'error'));
                                notify('Fail! ', 'Could not update ill, please try again', 'gritter-error');
                                back_loader();

                            }
                            else {
                                //$('.message').html(message('Fail! ', 'system could not add new, please contact to system administrator', 'error'));
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