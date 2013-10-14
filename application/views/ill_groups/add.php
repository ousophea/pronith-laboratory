<div class="page-header position-relative">
    <h1>
        បង្កើតប្រ​ភេទ​ជំ​ងឺ
        <small>
            <i class="icon-double-angle-right"></i>
            ចូរបង្កើតប្រ​ភេទ​ជំ​ងឺខាងក្រោម
        </small>
    </h1>
</div>
<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->

        <form class="form-horizontal" method="post" name="add">
            <div class="control-group">
                <label class="control-label" for="firstname">ឈ្មោះ</label>

                <div class="controls">
                    <input required name="<?php echo ILG_NAME; ?>" type="text"  minlength="3" id="fistname" placeholder="ឈ្មោះប្រភេទជំងឺ">
                    <input  name="<?php echo ILG_NAMEKH; ?>" type="text"  placeholder="ឈ្មោះខ្មែរ">
                    <span class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="<?php echo ILG_DESCRIPTION; ?>">បរិយាយ</label>

                <div class="controls">
                    <textarea name="<?php echo ILG_DESCRIPTION; ?>" type="text"  minlength="3" id="<?php echo ILG_DESCRIPTION; ?>" placeholder="បរិយាយ" />
                    <span class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="<?php echo ILG_STATUS; ?>">ស្ថានភាព</label>

                <div class="controls">
                    <input name="<?php echo ILG_STATUS; ?>" checked="checked" type="checkbox" id="<?php echo ILG_STATUS; ?>" placeholder="Last name" class="ace ace-switch ace-switch-7">
                    <span class="lbl"></span>
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
        $('form[name="add"]').find("input,select,textarea").not('[type="submit"]').jqBootstrapValidation(
                {
                    submitSuccess: function($form, event) {
                        var object = {data: $('form[name="add"]').toJSON()};
                        console.log(object);
                        go_loader();
                        $.ajax({
                            type: 'POST',
                            data: object,
                            dataType: 'json',
                            url: uri[0] + 'ill_groups/create'
                        }).done(function(data) {
                            console.log(data);
                            //data.result 0:Invalid, 1:Success, 2: Could not create
                            if (data.result == 1) {
                                notify('Done! ', 'Create new ill group successfully', 'gritter-success');
                                $('input, textarea, select').val("");
                                $('.loader').fadeOut();
                            }
                            else if (data.result == 3) {
                                notify('Fail! ', 'Ill group name already exist, please try another name!', 'gritter-error');
                                back_loader();
                            }
                            else if (data.result == 0) {
                                notify('Fail! ', 'Could not create new ill group, please try again', 'gritter-error');
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