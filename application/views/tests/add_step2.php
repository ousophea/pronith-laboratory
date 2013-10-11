<?php
if($this->session->userdata('new_patient_exam_test')) $this->session->unset_userdata('new_patient_exam_test');
//var_dump($ills_data);
?>
<!-- apply for date time picker -->
<script type="text/javascript" language="JavaScript" src="<?php echo site_url(JS.'jquery.simple-dtpicker.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo site_url(CSS.'jquery.simple-dtpicker.css') ?>" />
<div class="page-header position-relative">
    <h1>
        Add new exam test : step 2
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
        <?php echo form_open(site_url('tests/add_step3'),'class="form-horizontal"');?>
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
					<tr class="total_price">
						<td align="right">Total</td>
						<td><b><?php echo number_format($total_price,0); ?>៛</b></td>
					</tr>
					<?php
					
					?>
				</table>
            </div>
            <input type="hidden" name="txt_subTotal" value="<?php echo $total_price; ?>" />
            <div class="control-group">
                <label class="control-label" for="receive_time">Date Time Receive Result</label>

                <div class="controls">
                    <input type="text" name="txt_dateTimeReceived" />
                    <span class="help-inline"></span>
                </div>
                <script type="text/javascript" language="JavaScript">
                	$(document).ready(function(){
                		$('*[name=txt_dateTimeReceived]').appendDtpicker({
							"inline": true
							<?php
								if($this->session->userdata('txt_dateTimeReceived')){
							?>
							,"current": <?php echo json_encode($this->session->userdata('txt_dateTimeReceived')); ?>
							<?php		
								}
							?>
						});
                	});
						
				</script>
            </div>
            <div class="control-group">
                <label class="control-label" for="discount">Discount</label>
                <div class="controls">
                    <input type="number" name="txt_discount" value="<?php echo ($this->session->userdata('txt_discount'))?$this->session->userdata('txt_discount'):0; ?>" />
                    <span class="help-inline">%</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="deposit">Deposit Pay (ប្រាក់​កក់)</label>
                <div class="controls">
                    <input type="number" name="txt_deposit" value="<?php echo ($this->session->userdata('txt_deposit'))?$this->session->userdata('txt_deposit'):0; ?>" />
                    <span class="help-inline">៛</span>
                    &nbsp;Pay All? <input type="checkbox" <?php echo ($this->session->userdata('txt_payAll') && $this->session->userdata('txt_payAll') == 1)?'checked="checked"':''; ?> name="txt_payAll" value="1" id="depositPayAll" style="opacity: 1;" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="owe">Credit Owed (ប្រាក់​ជំពាក់)</label>
                <div class="controls">
                    <input type="number" readonly="readonly" name="txt_owe" value="<?php echo ($this->session->userdata('txt_owe') || $this->session->userdata('txt_owe') == '0')?$this->session->userdata('txt_owe'):$total_price; ?>" />
                    <span class="help-inline">៛</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="deposit">Tax</label>
                <div class="controls">
                    <select name="txt_tax">
                    	<option value="0" <?php echo ($this->session->userdata('txt_tax') && $this->session->userdata('txt_tax') == 0)?'selected="selected"':''; ?>>0%</option>
                    	<option value="5" <?php echo ($this->session->userdata('txt_tax') && $this->session->userdata('txt_tax') == 5)?'selected="selected"':''; ?>>5%</option>
                    	<option value="10" <?php echo ($this->session->userdata('txt_tax') && $this->session->userdata('txt_tax') == 10)?'selected="selected"':''; ?>>10%</option>
                    	<option value="15" <?php echo ($this->session->userdata('txt_tax') && $this->session->userdata('txt_tax') == 15)?'selected="selected"':''; ?>>15%</option>
                    	<option value="20" <?php echo ($this->session->userdata('txt_tax') && $this->session->userdata('txt_tax') == 20)?'selected="selected"':''; ?>>20%</option>
                    </select>
                    <span class="help-inline"></span>
                </div>
            </div>
            <div class="form-actions">
            	<a href="<?php echo site_url('tests/add_step1'); ?>">
            	<button id="btn_back_step_two" class="btn btn-info" type="button">
                    <i class="icon-arrow-left bigger-110"></i>
                    Back Previous Step
                </button>
               </a>
                &nbsp; &nbsp; &nbsp;
                <button id="btn_step_one" class="btn btn-info" type="submit">
                    <i class="icon-arrow-right bigger-110"></i>
                    Next Step
                </button>
                &nbsp; &nbsp; &nbsp;
                <button class="btn" type="reset">
                    <i class="icon-undo bigger-110"></i>
                    Reset
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
        
        $('[name="txt_deposit"]').keyup(function(){
		    var value = $(this).val();
		    value = value.replace(/[^0-9]+/g, '');
		    $(this).val(value);
		    var deposit = ($(this).val() == '')?0:$(this).val();
			var owe = <?php echo json_encode($total_price); ?> - deposit;
			$('[name=txt_owe]').val(owe);
		});
		
		$('[name="txt_discount"]').keyup(function(){
		    var value = $(this).val();
		    value = value.replace(/[^0-9]+/g, '');
		    $(this).val(value);
		});
		
		$('#depositPayAll').click(function(){
			if($(this).prop('checked')){
				$('[name=txt_deposit]').val('<?php echo json_encode($total_price); ?>');
				$('[name=txt_deposit]').attr('readonly','readonly');
				$('[name=txt_owe]').val(0);
			}else{
				$('[name=txt_owe]').val('<?php echo json_encode($total_price); ?>');
				$('[name=txt_deposit]').removeAttr('readonly');
				$('[name=txt_deposit]').val(0);
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