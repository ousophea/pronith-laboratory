<div class="page-header position-relative">
    <h1>
        Add new ill
        <small>
            <i class="icon-double-angle-right"></i>
            Please fill all the required input box to all an ill
        </small>
    </h1>
</div>
<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->

        <form class="form-horizontal" method="post" name="add">
            <div class="control-group">
                <label class="control-label" for="<?php echo ILI_NAME; ?>">Ill item name</label>

                <div class="controls">
                    <input required name="<?php echo ILI_NAME; ?>" type="text"  minlength="3" id="<?php echo ILI_NAME; ?>" placeholder="Ill item name">
                    <span class="help-inline"></span>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="<?php echo ILI_DIMENTION; ?>">Dimention</label>

                <div class="controls">
                    <input required name="<?php echo ILI_DIMENTION; ?>" type="text"  minlength="1" id="<?php echo ILI_DIMENTION; ?>" placeholder="Dimention">
                    <span class="help-inline"></span>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="<?php echo ILI_VALUEMALE; ?>">Value Male</label>

                <div class="controls">
                    <input required name="<?php echo ILI_VALUEMALE; ?>" type="text"  minlength="1" id="<?php echo ILI_VALUEMALE; ?>" placeholder="Value Male">
                    <span class="help-inline"></span>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="<?php echo ILI_VALUEFEMALE; ?>">Value Female</label>

                <div class="controls">
                    <input required name="<?php echo ILI_VALUEFEMALE; ?>" type="text"  minlength="1" id="<?php echo ILI_VALUEFEMALE; ?>" placeholder="Value Female">
                    <span class="help-inline"></span>
                </div>
            </div>
            
            
            <div class="control-group">
                <label class="control-label" for="<?php echo ILI_DESCRIPTION; ?>">Description</label>

                <div class="controls">
                    <textarea name="<?php echo ILI_DESCRIPTION; ?>"  id="<?php echo ILI_DESCRIPTION; ?>" placeholder="Description"></textarea>
                    <span class="help-inline"></span>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="<?php echo ILG_ID; ?>">Ill group</label>

                <div class="controls">
                    <?php echo form_dropdown(ILG_ID, $ill_group, '', ' required="required"') ?>
                    <span class="help-inline"></span>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="<?php echo ILI_ILLID; ?>">Ill</label>

                <div class="controls">
                    <?php echo form_dropdown(ILI_ILLID, $groups, '', ' required="required"') ?>
                    <span class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="<?php echo ILI_STATUS; ?>">Status</label>

                <div class="controls">
                    <input name="<?php echo ILI_STATUS; ?>" checked="checked" type="checkbox" id="<?php echo ILI_STATUS; ?>" placeholder="Last name" class="ace ace-switch ace-switch-7">
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
        
        // on change dropdown ill group
        $('[name="<?php echo ILG_ID; ?>"]').on('change',function(){
            var val = $(this).val();
            if(val!=''){
                $.ajax({
                    type: 'POST',
                    data: {<?php echo ILG_ID; ?>:val},
                    dataType: 'json',
                    url: uri[0] + 'ill_items/get_ills_by_group_id'
                }).done(function(data) {
                    $('[name="<?php echo ILI_ILLID; ?>"] option').remove();
                    var html;
                    $.each(data.result, function(val, text) {
                        html = $('<option></option>').val(val).html(text);
                        if(val=='')
                            html.attr('selected', 'selected');
                        $('[name="<?php echo ILI_ILLID; ?>"]').append(html);  
                    });
                });
            }
        });
        
        $('form[name="add"]').find("input,select,textarea").not('[type="submit"]').jqBootstrapValidation(
                {
                    submitSuccess: function($form, event) {
                        var object = {data: $('form[name="add"]').toJSON()};
                        go_loader();
                        $.ajax({
                            type: 'POST',
                            data: object,
                            dataType: 'json',
                            url: uri[0] + 'ill_items/create'
                        }).done(function(data) {
                            //data.result 0:Invalid, 1:Success, 2: Could not create
                            if (data.result == 1) {
                                notify('Done! ', 'Create new ill successfully', 'gritter-success');
                                $('.loader').fadeOut();
                            }
                            else if (data.result == 3) {
                                notify('Fail! ', 'Ill item name already exist, please try another name!', 'gritter-error');
                                back_loader();
                            }
                            else if (data.result == 0) {
                                notify('Fail! ', 'Could not create new ill, please try again', 'gritter-error');
                                back_loader();
                            }
                            else {
                                notify('Fail! ', 'System could not add new, please contact to system administrator', 'gritter-error');
                                back_loader();
                            }
                        });
                        event.preventDefault();

                    }
                }
        );
    });
</script>