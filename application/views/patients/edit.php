<?php
if(isset($edit_data)){
	$edit_data = $edit_data->result_array();
}
?>
<div class="page-header position-relative">
    <h1>
        Edit patient : <?php echo $edit_data[0]['pat_firstName'].' '.$edit_data[0]['pat_lastName']; ?>
        <small>
            <i class="icon-double-angle-right"></i>
            Please fill all the required input box to edit patient
        </small>
    </h1>
</div>
<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->

        <?php echo form_open(site_url('patients/edit_save'),'class="form-horizontal"',array('pat_id'=>$edit_data[0]['pat_id']));?>
            <div class="control-group">
                <label class="control-label" for="patientFirstName">First Name</label>

                <div class="controls">
                    <input required name="txt_patFirstName" value="<?php echo $edit_data[0]['pat_firstName']; ?>" type="text"  minlength="3" id="first_name" placeholder="First Name">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="patientLastName">Last Name</label>

                <div class="controls">
                    <input required name="txt_patLastName" value="<?php echo $edit_data[0]['pat_lastName']; ?>" type="text"  minlength="3" id="last_name" placeholder="Last Name">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="sex">Sex</label>
                <div class="controls">
                    <select name="txt_patSex">
                    	<option value="0">-SEX-</option>
                    	<option value="m" <?php echo ($edit_data[0]['pat_sex'] == 'm')?'selected="selected"':'' ?>>Male</option>
                    	<option value="f" <?php echo ($edit_data[0]['pat_sex'] == 'f')?'selected="selected"':'' ?>>Female</option>
                    </select>
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="patientIdentityCard">National Identity Card</label>

                <div class="controls">
                    <input name="txt_patIdentityCard" value="<?php echo $edit_data[0]['pat_identityCard']; ?>" type="number"  minlength="3" id="identity_card" placeholder="National Identity Card">
                    <span class="help-inline"></span>
                </div>
            </div>
			<div class="control-group">
                <label class="control-label" for="patEmail">Email</label>
                <div class="controls">
                    <input name="txt_patEmail" type="email" value="<?php echo $edit_data[0]['pat_email']; ?>"  minlength="3" id="email" placeholder="name@example.com">
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="pat_phone">
            	<div class="control-group">
	                <label class="control-label" for="patPhones">Phone</label>
	                <div class="controls">
	                    <input name="txt_patPhone[]" type="text"  minlength="3" placeholder="(855)">
	                    <span class="help-inline"></span>
	                    <span class="add_more_phone">Add More</span>
	                </div>
	            </div>
            </div>
			<div class="control-group">
                <label class="control-label" for="patDoctor">Recommanded from Doctor</label>
                <div class="controls">
                    <select name="txt_docReference">
                    	<option value="0">-None-</option>
                    	<?php
                    	if($doctors_data->num_rows() > 0){
                    		foreach($doctors_data->result() as $values){
                    			echo '<option value="'.$values->doc_id.'" '.(($edit_data[0]['pat_doc_id'] == $values->doc_id)?'selected="selected"':'').'>'.$values->doc_name.'</option>';
                    		}
                    	}
                    	?>
                    </select>
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="patStatus">Status</label>

                <div class="controls">
                    <input name="txt_patStatus" <?php echo ($edit_data[0]['pat_status']==1)?'checked="checked"':''; ?> type="checkbox" id="status" placeholder="Status" class="ace ace-switch ace-switch-7">
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