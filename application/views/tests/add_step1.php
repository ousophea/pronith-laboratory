<?php
if($this->session->userdata('new_patient_exam_test')) $this->session->unset_userdata('new_patient_exam_test');
//var_dump($ills_data);
?>
<div class="page-header position-relative">
    <h1>
        បង្កើតតេស្ថ​ថ្មី : ដំ​ណាក់​កាល ទី១
        <small>
            <i class="icon-double-angle-right"></i>
            	សូម​បំ​ពេញ​រាល់​ពត៌មាន​ អោយ​បាន​គ្រប់​ជ្រុង​ជ្រោយ
        </small>
    </h1>
    <?php
	if($this->session->flashdata('msg_success')){
	?>
	<div class="msg_success">
		<?php echo '<p>'.$this->session->flashdata('msg_success').'</p>'; ?>
	</div>
	<?php	
	}
	if($this->session->flashdata('msg_error')){
	?>
	<div class="msg_error">
		<?php echo '<p>'.$this->session->flashdata('msg_error').'</p>'; ?>
	</div>
	<?php
	}
	if($this->session->flashdata('msg_info')){
	?>
	<div class="msg_info">
		<?php echo '<p>'.$this->session->flashdata('msg_info').'</p>'; ?>
	</div>
	<?php
	}
	?>
</div>
<div class="row-fluid">
    <div class="span12" id="test_add">
        <!--PAGE CONTENT BEGINS-->
        <?php echo form_open(site_url('tests/add_step2'),'class="form-horizontal"');?>
            <div class="control-group">
                <label class="control-label" for="doctorFirstName">ជ្រើស​រើស ឈ្មោះ​អ្នកជំងឺ</label>

                <div class="controls">
                	<select name="txt_patId">
                    	<option value="0"><?php echo DROPDOWN_DEFAULT; ?></option>
                    	<?php
                    	if($patients_data->num_rows() > 0){
                    		foreach($patients_data->result() as $values){
                    			if($this->session->flashdata('pat_id')){
                    				echo '<option value="'.$values->pat_id.'" '.(($values->pat_id == $this->session->flashdata('pat_id'))?'selected="selected"':'').'>'.$values->pat_firstName.' '.$values->pat_lastName.'</option>';
                    			}else if($this->session->userdata('txt_patId')){
                    				echo '<option value="'.$values->pat_id.'" '.(($values->pat_id == $this->session->userdata('txt_patId'))?'selected="selected"':'').'>'.$values->pat_firstName.' '.$values->pat_lastName.'</option>';
                    			}else{
                    				echo '<option value="'.$values->pat_id.'">'.$values->pat_firstName.' '.$values->pat_lastName.'</option>';	
                    			}
                    		}
                    	}
                    	?>
                    </select>
                    <span class="help-inline"></span>
                    <a href="<?php echo site_url('tests/add_patient'); ?>" alt="បញ្ចូលថ្មី">Add New Patient</a>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="status">ជំងឺ​ទទួល​បាន?</label>
                <div class="controls">
                    <select name="txt_isReceiveIll">
                    	<option value="1" <?php echo (($this->session->userdata('txt_isReceiveIll') && $this->session->userdata('txt_isReceiveIll') == '1')?'selected="selected"':'');?>>ទទួល​បាន</option>
                    	<option value="0" <?php echo (($this->session->userdata('txt_isReceiveIll') && $this->session->userdata('txt_isReceiveIll') == 0)?'selected="selected"':'');?>>មិនទាន់​ ទទួល​បាន</option>
                    </select>
                    <span class="help-inline"></span>
                </div>
            </div>
            
            <div class="control-group">            	
                <label class="control-label" for="doctorLastName">ជ្រើស​រើស ជំ​ងឺ</label>

                <div class="controls">
                	<div class="accordion">
                	<?php
					if(count($ills_data) > 0){
						foreach($ills_data as $keys_groups=>$arr_values){
					?>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="" href="#collapse<?php echo $keys_groups; ?>">
								ប្រភេទ​ជំងឺ ៖ <?php echo $keys_groups; ?>
								</a>
							</div>
							<div id="collapse<?php echo $keys_groups; ?>" class="accordion-body collapse">
						<?php
						foreach($arr_values as $keys=>$values){
						?>
								<div class="accordion-inner">
									<label class="checkbox">
									<?php
									if($this->session->userdata('txt_ills')){
										$check_ill = $this->session->userdata('txt_ills');
										if(in_array($keys, $check_ill)){
									?>
										<input type="checkbox" checked="checked" name="txt_ills[]" style="opacity: 1;" value="<?php echo $keys; ?>"><?php echo $values; ?>
									<?php
										}else{
									?>
										<input type="checkbox" name="txt_ills[]" style="opacity: 1;" value="<?php echo $keys; ?>"><?php echo $values; ?>
									<?php
										}
									}else{
									?>	
										<input type="checkbox" name="txt_ills[]" style="opacity: 1;" value="<?php echo $keys; ?>"><?php echo $values; ?>
									<?php
									}
									?>
									</label>
								</div>
						<?php
						}
						?>
							</div>
						</div>
					<?php
						}
					}
					?>		
                	</div>
            	</div>
            </div>
            <div class="form-actions">
                <button id="btn_step_one" class="btn btn-info" type="submit">
                    <i class="icon-arrow-right bigger-110"></i>
                    	បន្ទាប់
                </button>

                &nbsp; &nbsp; &nbsp;
                <button class="btn" type="reset">
                    <i class="icon-undo bigger-110"></i>
                    	សារដើម
                </button>
                &nbsp; &nbsp; &nbsp;
                <a href="<?php echo site_url('tests/add_cancel')?>">
                <button type="button" class="btn btn-danger">
                	<i class="icon-eject"></i>
                	បោះបង់
                </button>
                </a>
            </div>
        <?php echo form_close(); ?>
    </div><!--/.span-->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var uri = [$('[name="base_url"]').val(),
            $('[name="segment1"]').val(),
            $('[name="segment2"]').val()];
        $('#btn_step_one').click(function(){
        	
        });
        
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