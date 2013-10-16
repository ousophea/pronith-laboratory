<div class="page-header position-relative">
    <h1>
        កែប្រែជំអឺ
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
                <label class="control-label" for="firstname">ឈ្មោះ</label>

                <div class="controls">
                    <input name='<?php echo ILL_ID; ?>' type='hidden' value='<?php echo $data[ILL_ID] ?>'/>
                    <input name="<?php echo ILL_NAME; ?>" type="text" value='<?php echo $data[ILL_NAME] ?>' id="fistname" placeholder="ឈ្មោះជំងឺ">
                    <input name="<?php echo ILL_NAMEKH; ?>" type="text" value='<?php echo $data[ILL_NAMEKH] ?>' id="fistname" placeholder="ឈ្មោះខ្មែរ">
                    <span class="help-inline"></span>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="<?php echo ILL_GROUPID; ?>">ប្រភេទ</label>

                <div class="controls">
                    <?php echo form_dropdown(ILL_GROUPID, $groups, $data[ILL_GROUPID], ' required="required"') ?>
                    <span class="help-inline"></span>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="<?php echo ILL_PRICE; ?>">តម្លៃ</label>

                <div class="controls">
                    <input required name="<?php echo ILL_PRICE; ?>" type="text" value='<?php echo $data[ILL_PRICE] ?>' id="<?php echo ILL_PRICE; ?>" placeholder="តម្លៃ"  data-validation-required-message="ចូរបញ្ចូលតម្លៃ">$
                    <span class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="<?php echo ILL_STATUS; ?>">ស្ថានភាព</label>

                <div class="controls">
                    <input name="<?php echo ILL_STATUS; ?>" <?php echo ($data[ILL_STATUS])?'checked':''; ?> type="checkbox" id="<?php echo ILL_STATUS; ?>" class="ace ace-switch ace-switch-7">
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