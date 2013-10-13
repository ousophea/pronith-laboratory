<div class="page-header position-relative">
    <h1>
        កែប្រែធាតុរបស់ជំងឺ
        <small>
            <i class="icon-double-angle-right"></i>
            សូម​បំ​ពេញ​​ពត៌មាន​អោយ​បាន​ត្រឹមត្រូវ
        </small>
    </h1>
</div>
<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->

        <form class="form-horizontal" method="post" name="edit">
            <div class="control-group">
                <label class="control-label" for="<?php echo ILI_NAME; ?>">ឈ្មោះធាតុ</label>

                <div class="controls">
                    <input name='<?php echo ILI_ID; ?>' type='hidden' value='<?php echo $data[ILI_ID] ?>'/>
                    <input required name="<?php echo ILI_NAME; ?>" value="<?php echo $data[ILI_NAME]; ?>" type="text"  minlength="3" id="<?php echo ILI_NAME; ?>" placeholder="Ill item name">
                    <span class="help-inline"></span>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="<?php echo ILI_DIMENTION; ?>">ខ្នាត</label>

                <div class="controls">
                    <!--<input required name="<?php echo ILI_DIMENTION; ?>" value="<?php echo $data[ILI_DIMENTION]; ?>" type="text"  minlength="1" id="<?php echo ILI_DIMENTION; ?>" placeholder="Dimention">-->
                    <?php echo form_dropdown(ILI_ILLID, dimention(), $data[ILI_DIMENTION], ' required="required"') ?>
                    <span class="help-inline"></span>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="<?php echo ILI_VALUEMALE; ?>">តម្លៃធម្មតាប្រុស</label>

                <div class="controls">
                    <input required name="<?php echo ILI_VALUEMALE; ?>"  value="<?php echo $data[ILI_VALUEMALE]; ?>" type="text"  minlength="1" id="<?php echo ILI_VALUEMALE; ?>" placeholder="Value Male">
                    <span class="help-inline"></span>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="<?php echo ILI_VALUEFEMALE; ?>">តម្លៃធម្មតាស្រី</label>

                <div class="controls">
                    <input required name="<?php echo ILI_VALUEFEMALE; ?>"  value="<?php echo $data[ILI_VALUEFEMALE]; ?>" type="text"  minlength="1" id="<?php echo ILI_VALUEFEMALE; ?>" placeholder="Value Female">
                    <span class="help-inline"></span>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="<?php echo ILG_ID; ?>">ប្រភេទ</label>

                <div class="controls">
                    <?php echo form_dropdown(ILG_ID, $ill_group) ?>
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="<?php echo ILI_ILLID; ?>">ជំងឺ</label>

                <div class="controls">
                    <?php echo form_dropdown(ILI_ILLID, $groups, $data[ILI_ILLID], ' required="required"') ?>
                    <span class="help-inline"></span>
                </div>
            </div>
            
            
            <div class="control-group">
                <label class="control-label" for="<?php echo ILI_DESCRIPTION; ?>">បរិយាយ</label>

                <div class="controls">
                    <textarea name="<?php echo ILI_DESCRIPTION; ?>"  value="<?php echo $data[ILI_DIMENTION]; ?>" id="<?php echo ILI_DESCRIPTION; ?>" placeholder="Description"></textarea>
                    <span class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="<?php echo ILI_STATUS; ?>">ស្ថានភាព</label>

                <div class="controls">
                    <input name="<?php echo ILI_STATUS; ?>"  <?php echo ($data[ILG_STATUS])?'checked':''; ?>  type="checkbox" id="<?php echo ILI_STATUS; ?>" placeholder="Last name" class="ace ace-switch ace-switch-7">
                    <span class="lbl"></span>
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="form-actions">
                <button class="btn btn-info" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    កែប្រែ
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
        // on submit form
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
                            url: uri[0] + 'ill_items/update'
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