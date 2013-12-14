<div class="page-header position-relative">
    <h1>
        បញ្ចូល​ការ​ចំ​ណាយ​ផ្សេងៗ
        <small>
            <i class="icon-double-angle-right"></i>
            	សូម​បំ​ពេញ​រាល់​ពត៌មាន​ អោយ​បាន​គ្រប់​ជ្រុង​ជ្រោយ
        </small>
    </h1>
</div>
<?php
if($this->session->flashdata('msg_error')){
?>
<div class="msg_error">
	<?php echo '<p>'.$this->session->flashdata('msg_error').'</p>'; ?>
</div>
<?php
}
?>
<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->
        <?php echo form_open(site_url('expends/add_save'),'class="form-horizontal"');?>
            <div class="control-group">
                <label class="control-label" for="title">ឈ្មោះ​​ការ​ចំ​ណាយ</label>
                <div class="controls">
                    <input required name="txt_expendTitle" type="text"  minlength="3" id="expend_title" placeholder="ឈ្មោះ​​ការ​ចំ​ណាយ">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="description">ពិពណ៌នា​</label>

                <div class="controls">
                    <textarea name="txt_expendDescription" required id="expend_description" placeholder="ពិ​ពណ៌នា​ការ​ចំ​ណាយ"></textarea>
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="amount">ចំ​នួន​(៛)</label>
                <div class="controls">
                    <input required name="txt_expendAmount" type="text"  minlength="1" id="expend_amount" placeholder="0" value="0">៛
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="is_paid">ប្រាក់​បាន​បង់</label>
                <div class="controls">
                    <input name="txt_expendIsPaid" checked="checked" type="checkbox" id="is_paid" placeholder="Status" class="ace ace-switch ace-switch-7">
                    <span class="lbl"></span>
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="status">ស្ថាន​ភាព</label>
                <div class="controls">
                    <input name="txt_expendStatus" checked="checked" type="checkbox" id="status" placeholder="Status" class="ace ace-switch ace-switch-7">
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
        <?php echo form_close(); ?>
    </div><!--/.span-->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var uri = [$('[name="base_url"]').val(),
            $('[name="segment1"]').val(),
            $('[name="segment2"]').val()];
        $('.doc_phone span[name="add_more"]').click(function(){
        	var html = <?php echo json_encode(doctor_phone()); ?>;
        	$('#phone_container').append(html);
        });
        
        $(document).on('click','.control-group span[name="remove_phone"]',function(){
        	$(this).parent().parent().remove();
        });
        
        
        $('form[name="add"]').find("input,select").not('[type="submit"]').jqBootstrapValidation(
                {
                    submitSuccess: function($form, event) {
                        var d = {data: $('form[name="add"]').toJSON()};
                        console.log(d);
                        go_loader();
                        $.ajax({
                            type: 'POST',
                            data: d,
                            dataType: 'json',
                            url: uri[0] + 'doctors/add_save'
                        }).done(function(data) {
                            console.log(data);
                            //data.result 0:Invalid, 1:Success, 2: Could not create
                            if (data.result == 1) {
                                notify('Done! ', 'Create new ill group successfully', 'gritter-success');
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