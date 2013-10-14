<?php
if($patients_tests_data->num_rows() > 0){
	$patients_tests_data = $patients_tests_data->result_array();
}else{
	
}
?>
<div class="page-header position-relative hidden-print">
    <h1>
        កែប្រែ វិក័យប័ត្របង់​ប្រាក់
        <small>
            <i class="icon-double-angle-right"></i>
            	សូម​ផ្ទៀង​ផ្ទាត់ វិក័យប័ត្រ​អោយ​បាន​ច្បាស់​លាស់​​ មុន​នឹង​សំរេច​ចិត្ត​បន្ត
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
        <?php echo form_open(site_url('tests/pay_tests_save'),'class="form-horizontal" id="frmPayTes"');?>
        	<input type="hidden" name="txt_patTesId" value="<?php echo $patients_tests_data[0]['pat_tes_id']; ?>" />
        	<div class="control-group">
                <label for="invoice">
                	យោង​តាម​វិក័យ​ប័ត្រ លេខ ៖ <?php echo string_digit($patients_tests_data[0]['pat_tes_id']);?>
                </label>
            </div>
            <div class="control-group">
                <label for="patient">
                	ឈ្មោះ អ្នក​ជំងឺ ៖ <?php echo $patients_tests_data[0]['pat_firstName'].' '.$patients_tests_data[0]['pat_lastName'];?>
                </label>
            </div>
            <div class="control-group">
                <label for="deposit">
                	ប្រាក់​កក់ (៛) ៖ <?php echo $patients_tests_data[0]['pat_tes_deposit'];?>៛
                </label>
            </div>
            <div class="control-group">
                <label for="owe">
                	ប្រាក់​ត្រូវ​បង់ (៛) ៖ <?php echo number_format($patients_tests_data[0]['pat_tes_owe'],0);?>៛
                </label>
            </div>
            <div class="control-group">
                <label class="control-label" for="pay">បង់​ប្រាក់​បង្រ្គប់</label>
                <div class="controls">
                    <input type="text" name="txt_patTesPay" id="txt_patTesPay" value="0" /><input type="checkbox" name="txt_payAll" value="1" style="opacity: 1;" />
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="form-actions">
                <button id="btn_step_three" class="btn btn-info" type="submit">
                    <i class="icon-save bigger-110"></i>
                    	បញ្ចប់
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
        $('[name=txt_payAll]').click(function(){
			if($(this).prop('checked')){
				$('[name=txt_patTesPay]').val(<?php echo json_encode($patients_tests_data[0]['pat_tes_owe']); ?>);
				$('[name=txt_patTesPay]').attr('readonly','readonly');
			}else{
				$('[name=txt_patTesPay]').val(0);
				$('[name=txt_patTesPay]').removeAttr('readonly');
			}
		});
		
		$('[name="txt_patTesPay"]').keyup(function(){
		    var value = $(this).val();
		    value = value.replace(/[^0-9]+/g, '');
		    $(this).val(value);
		});
		
		$('#frmPayTes').submit(function(){
			if(parseInt($('[name=txt_patTesPay]').val()) != parseInt(<?php echo json_encode($patients_tests_data[0]['pat_tes_owe']); ?>)){
				bootbox.alert('សូម​បញ្ចូល​តំ​លៃ​ទឹក​ប្រាក់​អោយ​ត្រូវ​នឹង វិក័យ​ប័ត្រ​ជំពាក់​ប្រាក់។ ទឹក​ប្រាក់​ដែល​អ្នក​ត្រូវ​បង់គឺ '+<?php echo json_encode(number_format($patients_tests_data[0]['pat_tes_owe'],0)); ?>+'៛');
				return false;
			}
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