<?php
if($this->session->userdata('new_patient_exam_test')) $this->session->unset_userdata('new_patient_exam_test');
//var_dump($ills_data);
?>
<!-- apply for date time picker -->
<script type="text/javascript" language="JavaScript" src="<?php echo site_url(JS.'jquery.simple-dtpicker.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo site_url(CSS.'jquery.simple-dtpicker.css') ?>" />
<div class="page-header position-relative">
    <h1>
        Add new exam test : finish
        <small>
            <i class="icon-double-angle-right"></i>
            Please fill all the required input box to add new exam test
        </small>
    </h1>
</div>
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
<div class="row-fluid">
    <div class="span12" id="test_add">
        <!--PAGE CONTENT BEGINS-->
        <?php echo form_open(site_url('tests/add_save'),'class="form-horizontal"');?>
            <div class="control-group">
                <label for="patient">
                	Patient Name : <?php echo get_patient_name($this->session->userdata('txt_patId'));?>
                </label>
            </div>
            <div class="control-group">
                <label for="patient">
                	Receive Ill for Test? : <?php echo ($this->session->userdata('txt_isReceiveIll') == 1)?'Yes, Received':'Not Receive Yet';?>
                </label>
            </div>
            <div class="control-group">
                <label for="datetime_receive">
                	Date Time Receive Result : <?php echo $this->session->userdata('txt_dateTimeReceived');?>
                </label>
            </div>
            <div class="control-group">
                <label for="ill_selected_detail">Ills selected detail</label>
				<table class="table table-bordered">
					<tr class="success">
						<th class="success">Ill Name</th>
						<th class="success">Unit Price (៛)</th>	
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
						<td align="right">Sub Total</td>
						<td><b><?php echo number_format($total_price,0); ?>៛</b></td>
					</tr>
					<tr class="discount">
						<td align="right">Discount</td>
						<td><b><?php echo $this->session->userdata['txt_discount']; ?>%</b></td>
					</tr>
					<tr class="tax">
						<td align="right">Tax</td>
						<td><b><?php echo $this->session->userdata['txt_tax']; ?>%</b></td>
					</tr>
					<?php
					if($this->session->userdata('txt_isPaid') == 1){
					?>
					<tr class="paid">
						<td align="right">Note</td>
						<td><b>Invoice is already paid</b></td>
					</tr>
					<?php
					}else{
					?>
					<tr class="deposit">
						<td align="right">Deposit (ប្រាក់កក់)</td>
						<td><b><?php echo number_format($this->session->userdata('txt_deposit'),0); ?>៛</b></td>
					</tr>
					<tr class="owe">
						<td align="right">Owed (ប្រាក់ ជំពាក់)</td>
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
                    Back Previous Step
                </button>
               </a>
                &nbsp; &nbsp; &nbsp;
                <button id="btn_step_one" class="btn btn-info" type="submit">
                    <i class="icon-print bigger-110"></i>
                    Finish & Print
                </button>
                &nbsp; &nbsp; &nbsp;
                <button type="button" class="btn btn-danger">
                	<i class="icon-eject"></i>
                	Cancel
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