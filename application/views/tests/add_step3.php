<!-- apply for date time picker -->
<script type="text/javascript" language="JavaScript" src="<?php echo site_url(JS.'jquery.simple-dtpicker.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo site_url(CSS.'jquery.simple-dtpicker.css') ?>" />
<div class="page-header position-relative hidden-print">
    <h1>
        បង្កើតតេស្ថ​ថ្មី : ដំ​ណាក់​កាលបញ្ចប់
        <small>
            <i class="icon-double-angle-right"></i>
            	សូម​ផ្ទៀង​ផ្ទាត់ របាយការណ៍​ឡើង​វិញ មុន​នឹង​សំរេចចិត្ត បញ្ចូល
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
        <?php echo form_open(site_url('tests/add_save'),'class="form-horizontal" id="frmStepThree"');?>
            <div class="control-group">
                <label for="patient">
                	ឈ្មោះ អ្នក​ជំងឺ : <?php echo get_patient_name($this->session->userdata('txt_patId'));?>
                </label>
            </div>
            <div class="control-group">
                <label for="patient">
                	ជំងឺ​ទទួល​បាន? : <?php echo ($this->session->userdata('txt_isReceiveIll') == 1)?'ទទួល​បាន':'មិន​ទាន់ ទទួល​បាន';?>
                </label>
            </div>
            <div class="control-group">
                <label for="datetime_receive">
                	ថ្ងៃ​ខែ ត្រឡប់​មក​យក លទ្ធផល : <?php echo $this->session->userdata('txt_dateTimeReceived');?>
                </label>
            </div>
            <div class="control-group">
                <label for="ill_selected_detail">ពត៌មាន​លំអិត អំពី​ជំងឺ​ ដែល​ត្រូវ​បាន​ជ្រើស​រើស</label>
				<table class="table table-bordered">
					<tr class="success">
						<th class="success">ឈ្មោះ</th>
						<th class="success">តំលៃមួយ​ឯកតា (៛)</th>	
					</tr>
					<?php
					$total_price = 0;
					if(count($ills_selected_data) > 0){
						foreach($ills_selected_data as $keys_groups=>$arr_values){
					?>
					<tr class="warning">
						<td colspan="2" class="warning">ប្រភេទ​ជំងឺ ៖ <?php echo $keys_groups; ?></td>
					</tr>
					<?php
							foreach($arr_values as $keys=>$values){
								$total_price += $values;
					?>
					<tr>
						<td><?php echo $keys; ?></td>
						<td><?php echo number_format($values,0); ?>៛</td>
					</tr>
					<?php
							}
						}
					}
					?>
					<tr class="sub_total_price">
						<td align="right">តំលៃ​</td>
						<td><b><?php echo number_format($total_price,0); ?>៛</b></td>
					</tr>
					<tr class="discount">
						<td align="right">បញ្ចុះតំលៃ</td>
						<td><b><?php echo $this->session->userdata['txt_discount']; ?>%</b></td>
					</tr>
					<tr class="tax">
						<td align="right">ពន្ធ</td>
						<td><b><?php echo $this->session->userdata['txt_tax']; ?>%</b></td>
					</tr>
					<?php
					if($this->session->userdata('txt_isPaid') == 1){
					?>
					<tr class="deposit">
						<td align="right">ប្រាក់កក់</td>
						<td><b><?php echo number_format($this->session->userdata('txt_deposit'),0); ?>៛</b></td>
					</tr>
					<tr class="owe">
						<td align="right">ប្រាក់ ជំពាក់</td>
						<td><b><?php echo number_format($this->session->userdata('txt_owe'),0); ?>៛</b></td>
					</tr>
					<tr class="paid">
						<td colspan="2">សំគាល់៖ វិក័យ​ប័ត្រ​ ត្រូវ​បាន​បង់​ប្រាក់​គ្រប់</td>
					</tr>
					<?php
					}else{
					?>
					<tr class="deposit">
						<td align="right">ប្រាក់កក់</td>
						<td><b><?php echo number_format($this->session->userdata('txt_deposit'),0); ?>៛</b></td>
					</tr>
					<tr class="owe">
						<td align="right">ប្រាក់ ជំពាក់</td>
						<td><b><?php echo number_format($this->session->userdata('txt_owe'),0); ?>៛</b></td>
					</tr>
					<?php
					}
					?>
					
				</table>
            </div>
            <div class="form-actions">
            	<a href="<?php echo site_url('tests/add_step2'); ?>">
            	<button id="btn_back_step_three" class="btn btn-info" type="button">
                    <i class="icon-arrow-left bigger-110"></i>
                    	ត្រ​ឡប់​ក្រោយ
                </button>
               </a>
                &nbsp; &nbsp; &nbsp;
                <button id="btn_step_three" class="btn btn-info" type="submit">
                    <i class="icon-print bigger-110"></i>
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