<?php
if (isset($edit_data)) {
	$edit_data = $edit_data -> result_array();
}
?>
<div class="page-header position-relative">
    <h1>
        Edit doctor : <?php echo $edit_data[0]['doc_firstName'] . ' ' . $edit_data[0]['doc_lastName']; ?>
        <small>
            <i class="icon-double-angle-right"></i>
            Please fill all the required input box to add new group
        </small>
    </h1>
</div>
<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->

        <?php echo form_open(site_url('doctors/edit_save'), 'class="form-horizontal"', array('doc_id' => $edit_data[0]['doc_id'])); ?>
            <div class="control-group">
                <label class="control-label" for="doctorFirstName">First Name</label>

                <div class="controls">
                    <input required name="txt_docFirstName" type="text"  minlength="3" id="first_name" placeholder="First Name" value="<?php echo $edit_data[0]['doc_firstName']; ?>">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="doctorLastName">Last Name</label>

                <div class="controls">
                    <input required name="txt_docLastName" type="text"  minlength="3" id="last_name" placeholder="Last Name" value="<?php echo $edit_data[0]['doc_lastName']; ?>">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="sex">Sex</label>
                <div class="controls">
                    <select name="txt_docSex">
                    	<option value="0">-SEX-</option>
                    	<option value="m" <?php echo ($edit_data[0]['doc_sex'] == 'm')?'selected="selected"':'' ?>>Male</option>
                    	<option value="f" <?php echo ($edit_data[0]['doc_sex'] == 'f')?'selected="selected"':'' ?>>Female</option>
                    </select>
                    <span class="help-inline"></span>
                </div>
            </div>
            <?php
            if($phones_data->num_rows() > 0){
            	foreach($phones_data->result() as $rows){
            ?>
            <div class="control-group" id="phone_group_<?php echo $rows->doc_pho_id;?>">
                <label class="control-label" for="sex">Phone</label>
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
	                <label class="control-label" for="phone">Phone</label>
	                <div class="controls">
	                    <input name="txt_docPhone[]" value="" type="number"  minlength="10" id="phone" placeholder="(855)">
	                    <span class="icon-plus-sign" style="cursor: pointer;" name="add_more"></span>
	                    <span class="help-inline"></span>
	                </div>
	            </div>
	            <div id="phone_container"></div>
            </div>
			<div class="control-group">
                <label class="control-label" for="sex">Email</label>
                <div class="controls">
                    <input name="txt_docEmail" type="email"  minlength="3" id="email" placeholder="name@example.com" value="<?php echo $edit_data[0]['doc_email']; ?>">
                    <span class="help-inline"></span>
                </div>
            </div>
			<div class="control-group">
                <label class="control-label" for="position">Position</label>
                <div class="controls">
                    <select name="txt_docPosition">
                    	<option value="0">-POSITION-</option>
                    	<option <?php echo ($edit_data[0]['doc_position'] == 'Doctor')?'selected="selected"':'' ?> value="Doctor">Doctor</option>
                    	<option <?php echo ($edit_data[0]['doc_position'] == 'Nurse')?'selected="selected"':'' ?> value="Nurse">Nurse</option>
                    	<option <?php echo ($edit_data[0]['doc_position'] == 'Other')?'selected="selected"':'' ?> value="Other">Other</option>
                    </select>
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="working">Working At</label>
                <div class="controls">
                    <select name="txt_docHospital">
                    	<option value="0">-SELECT HOSPITAL-</option>
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
                <label class="control-label" for="working">Doctor Recommanded</label>
                <div class="controls">
                    <select name="txt_docReference">
                    	<option value="0">-SELECT DOCTOR-</option>
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
                <label class="control-label" for="status">Status</label>

                <div class="controls">
                    <input name="txt_docStatus" <?php echo ($edit_data[0]['doc_status']==1)?'checked="checked"':''; ?> checked="checked" type="checkbox" id="status" placeholder="Status" class="ace ace-switch ace-switch-7">
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