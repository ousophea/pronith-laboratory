<?php
if (isset($edit_data)) {
	$edit_data = $edit_data -> result_array();
}
?>
<div class="page-header position-relative">
    <h1>
        កែប្រែ​វេជ្ជ​បណ្ឌិត : <?php echo $edit_data[0]['doc_firstName'] . ' ' . $edit_data[0]['doc_lastName']; ?>
        <small>
            <i class="icon-double-angle-right"></i>
            	សូម​បំ​ពេញ​រាល់​ពត៌មាន​ អោយ​បាន​គ្រប់​ជ្រុង​ជ្រោយ
        </small>
    </h1>
</div>
<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->

        <?php echo form_open(site_url('doctors/edit_save'), 'class="form-horizontal"', array('doc_id' => $edit_data[0]['doc_id'])); ?>
            <div class="control-group">
                <label class="control-label" for="doctorFirstName">គោត្តនាម</label>

                <div class="controls">
                    <input required name="txt_docFirstName" type="text"  minlength="3" id="first_name" placeholder="គោត្តនាម" value="<?php echo $edit_data[0]['doc_firstName']; ?>">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="doctorLastName">នាម</label>

                <div class="controls">
                    <input required name="txt_docLastName" type="text"  minlength="3" id="last_name" placeholder="នាម" value="<?php echo $edit_data[0]['doc_lastName']; ?>">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="sex">ភេទ</label>
                <div class="controls">
                    <select name="txt_docSex">
                    	<option value="0">-ភេទ-</option>
                    	<option value="m" <?php echo ($edit_data[0]['doc_sex'] == 'm')?'selected="selected"':'' ?>>ប្រុស</option>
                    	<option value="f" <?php echo ($edit_data[0]['doc_sex'] == 'f')?'selected="selected"':'' ?>>ស្រី</option>
                    </select>
                    <span class="help-inline"></span>
                </div>
            </div>
            <?php
            if($phones_data->num_rows() > 0){
            	foreach($phones_data->result() as $rows){
            ?>
            <div class="control-group" id="phone_group_<?php echo $rows->doc_pho_id;?>">
                <label class="control-label" for="sex">លេខទូរស័ព្ទ</label>
                <div class="controls">
                    <span class="pho_number"><?php echo $rows -> doc_pho_number; ?></span>
                    <span class="icon-trash" style="cursor: pointer;" name="ajax_remove_phone" rel="<?php echo $rows -> doc_pho_id; ?>"></span>
                    <span class="help-inline"></span>
                </div>
            </div>
            <?php
				}
			}
            ?>
            <div class="doc_phone">
            	<div class="control-group">
	                <label class="control-label" for="phone">លេខទូរស័ព្ទ</label>
	                <div class="controls">
	                    <input name="txt_docPhone[]" value="" type="number"  minlength="10" id="phone" placeholder="(855)">
	                    <span class="icon-plus-sign" style="cursor: pointer;" name="add_more"></span>
	                    <span class="help-inline"></span>
	                </div>
	            </div>
	            <div id="phone_container"></div>
            </div>
			<div class="control-group">
                <label class="control-label" for="sex">អ៊ីម៉ែល</label>
                <div class="controls">
                    <input name="txt_docEmail" type="email"  minlength="3" id="email" placeholder="name@example.com" value="<?php echo $edit_data[0]['doc_email']; ?>">
                    <span class="help-inline"></span>
                </div>
            </div>
			<div class="control-group">
                <label class="control-label" for="position">មុខ​តំ​ណែង</label>
                <div class="controls">
                    <select name="txt_docPosition">
                    	<option value="0">-ជ្រើសរើស-</option>
                    	<option <?php echo ($edit_data[0]['doc_position'] == 'វេជ្ជបណ្ឌិត')?'selected="selected"':'' ?> value="វេជ្ជបណ្ឌិត">វេជ្ជបណ្ឌិត</option>
                    	<option <?php echo ($edit_data[0]['doc_position'] == 'គិលានុបដ្ឋករ')?'selected="selected"':'' ?> value="គិលានុបដ្ឋករ">គិលានុបដ្ឋករ</option>
                    	<option <?php echo ($edit_data[0]['doc_position'] == 'ផ្សេងទៀត')?'selected="selected"':'' ?> value="ផ្សេងទៀត">ផ្សេងទៀត</option>
                    </select>
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="working">ធ្វើការ​នៅ</label>
                <div class="controls">
                    <select name="txt_docHospital">
                    	<option value="0">-ជ្រើស​រើស-</option>
                    	<?php
						if ($hospitals_data -> num_rows() > 0) {
							foreach ($hospitals_data->result() as $values) {
								echo '<option value="' . $values -> hos_id . '" ' . (($edit_data[0]['doc_hos_id'] == $values -> hos_id) ? 'selected="selected"' : '') . '>' . $values -> hos_name . '</option>';
							}
						}
                    	?>
                    </select>
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="working">ណែ​នាំ​ពី​វេជ្ជ​បណ្ឌិត</label>
                <div class="controls">
                    <select name="txt_docReference">
                    	<option value="0">-គ្មាន-</option>
                    	<?php
						if ($doctors_data -> num_rows() > 0) {
							foreach ($doctors_data->result() as $values) {
								echo '<option value="' . $values -> doc_id . '" ' . (($edit_data[0]['doc_reference'] == $values -> doc_id) ? 'selected="selected"' : '') . '>' . $values -> doc_firstName . ' ' . $values -> doc_lastName . '</option>';
							}
						}
                    	?>
                    </select>
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="status">ស្ថាន​ភាព</label>

                <div class="controls">
                    <input name="txt_docStatus" <?php echo ($edit_data[0]['doc_status']==1)?'checked="checked"':''; ?> checked="checked" type="checkbox" id="status" placeholder="Status" class="ace ace-switch ace-switch-7">
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