<?php
if(isset($edit_data)){
	$edit_data = $edit_data->result_array();
}
?>
<div class="page-header position-relative">
    <h1>
        Edit doctor : <?php echo $edit_data[0]['doc_name']; ?>
        <small>
            <i class="icon-double-angle-right"></i>
            Please fill all the required input box to add new group
        </small>
    </h1>
</div>
<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->

        <?php echo form_open(site_url('doctors/add_save'),'class="form-horizontal"');?>
            <div class="control-group">
                <label class="control-label" for="doctorName">Doctor Name</label>

                <div class="controls">
                    <input required name="txt_docName" type="text"  minlength="3" id="full_name" value="<?php echo $edit_data[0]['doc_name']; ?>" placeholder="Full Name">
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
			<div class="control-group">
                <label class="control-label" for="sex">Email</label>
                <div class="controls">
                    <input required name="txt_docEmail" type="email"  minlength="3" id="email" placeholder="name@example.com">
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
                    	if($hospital_data->num_rows() > 0){
                    		foreach($hospital_data->result() as $values){
                    			echo '<option value="'.$values->hos_id.'">'.$values->hos_name.'</option>';
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
                    	if($doctors_data->num_rows() > 0){
                    		foreach($doctors_data->result() as $values){
                    			echo '<option value="'.$values->doc_id.'">'.$values->doc_name.'</option>';
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
                    <input name="txt_docStatus" checked="checked" type="checkbox" id="status" placeholder="Status" class="ace ace-switch ace-switch-7">
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
<!--
<script type="text/javascript">
    $(document).ready(function() {
        var uri = [$('[name="base_url"]').val(),
            $('[name="segment1"]').val(),
            $('[name="segment2"]').val()];
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
-->