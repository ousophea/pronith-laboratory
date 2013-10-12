<?php
if (isset($edit_data)) {
	$edit_data = $edit_data -> result_array();
}
?>
<div class="page-header position-relative">
    <h1>
        កែប្រែ មន្ទីរពេទ្យ : <?php echo $edit_data[0]['hos_name']; ?>
        <small>
            <i class="icon-double-angle-right"></i>
            	សូម​បំ​ពេញ​រាល់​ពត៌មាន​ អោយ​បាន​គ្រប់​ជ្រុង​ជ្រោយ
        </small>
    </h1>
</div>
<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->

        <?php echo form_open(site_url('hospitals/edit_save'), 'class="form-horizontal"', array('hos_id' => $edit_data[0]['hos_id'])); ?>
            <div class="control-group">
                <label class="control-label" for="hosName">ឈ្មោះ​មន្ទីរ​ពេទ្យ</label>

                <div class="controls">
                    <input required name="txt_hosName" type="text"  minlength="3" id="hos_name" placeholder="ឈ្មោះ​មន្ទីរ​ពេទ្យ" value="<?php echo $edit_data[0]['hos_name'] ?>">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="hosAddress">អាស័យដ្ឋាន</label>

                <div class="controls">
                    <textarea name="txt_hosAddress" id="hos_address" placeholder="អាស័យដ្ឋាន"><?php echo $edit_data[0]['hos_address'] ?></textarea>
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="status">ស្ថាន​ភាព</label>

                <div class="controls">
                    <input name="txt_hosStatus" <?php echo ($edit_data[0]['hos_status']==1)?'checked="checked"':''; ?> checked="checked" type="checkbox" id="status" placeholder="Status" class="ace ace-switch ace-switch-7">
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
                    	សារដើម
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

		$(document).on('click', '.control-group span[name="remove_phone"]', function() {
			$(this).parent().parent().remove();
		});

		$('.control-group span[name="ajax_remove_phone"]').click(function() {
			var pho_id = $(this).attr('rel');
			$.post(<?php echo json_encode(site_url('doctors/ajax_remove_phone')); ?>, {
				id : pho_id
			}).done(function(data) {
				$('#phone_group_'+pho_id).html('<label class="control-label"></label><div class="controlls" style="color:green;">phone number removed</div>');
			}).fail(function(err){
				//case false of ajax do
				$('#phone_group_'+pho_id).html('<label class="control-label"></label><div class="controlls" style="color:red;">phone number removed with error</div>');
			});
		});

				$('form[name="add"]').find("input,select").not('[type="submit"]').jqBootstrapValidation({
					submitSuccess : function($form, event) {
						var d = {
							data : $('form[name="add"]').toJSON()
						};
						console.log(d);
						go_loader();
						$.ajax({
							type : 'POST',
							data : d,
							dataType : 'json',
							url : uri[0] + 'doctors/add_save'
						}).done(function(data) {
							console.log(data);
							//data.result 0:Invalid, 1:Success, 2: Could not create
							if (data.result == 1) {
								notify('Done! ', 'Create new ill group successfully', 'gritter-success');
								$('.loader').fadeOut();
							} else if (data.result == 3) {
								notify('Fail! ', 'Ill group name already exist, please try another name!', 'gritter-error');
								back_loader();
							} else if (data.result == 0) {
								notify('Fail! ', 'Could not create new ill group, please try again', 'gritter-error');
								back_loader();
							} else {
								notify('Fail! ', 'System could not add new, please contact to system administrator', 'gritter-error');
								back_loader();
							}
						});
						event.preventDefault();

					}
				});
				});
</script>