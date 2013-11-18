<!-- apply for date time picker -->
<div class="page-header position-relative">
    <h1>
        បង្កើតតេស្ថ​ថ្មី : ដំ​ណាក់​កាល ទី២
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
    <div id="test_add">
        <!--PAGE CONTENT BEGINS-->
        <?php echo form_open(site_url('tests/add_step3'),'class="form-horizontal"');?>
            <div class="control-group">
                <label for="patient">
                	ឈ្មោះ​ អ្នក​ជំងឺ : <?php echo get_patient_name($this->session->userdata('txt_patId'));?>
                </label>
            </div>
            <div class="control-group">
                <label for="patient">
                	ជំងឺ​ទទួល​បាន? : <?php echo ($this->session->userdata('txt_isReceiveIll') == 1)?'ទទួល​បាន':'មិន​ទាន់ ទទួល​បាន';?>
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
					<tr class="total_price">
						<td align="right">តំលៃ​សរុប</td>
						<td><b><?php echo number_format($total_price,0); ?>៛</b></td>
					</tr>
				</table>
            </div>
            <input type="hidden" name="txt_subTotal" value="<?php echo $total_price; ?>" />
            <div class="control-group">
                <label class="control-label" for="receive_time">ថ្ងៃ​ខែ ត្រឡប់​មក​យក លទ្ធផល</label>

                <div class="controls">
                    <!--<input type="text" name="txt_dateTimeReceived" value="<?php echo ($this->session->userdata('txt_dateTimeReceived'))?$this->session->userdata('txt_dateTimeReceived'):''; ?>" />-->
					<div id="datetimepicker1" class="input-append">
						<input name="txt_dateTimeReceived" value="<?php echo ($this->session->userdata('txt_dateTimeReceived'))?$this->session->userdata('txt_dateTimeReceived'):''; ?>" data-format="yyyy-MM-dd hh:mm:ss" type="text"></input>
						<span class="add-on">
						<i data-time-icon="icon-time" data-date-icon="icon-calendar">
						</i>
						</span>
					</div>
					<script type="text/javascript" language="JavaScript" src="<?php echo site_url(JS.'bootstrap-datetimepicker.min.js') ?>"></script>
					<link rel="stylesheet" type="text/css" href="<?php echo site_url(CSS.'bootstrap-datetimepicker.min.css') ?>" />
                    <script type="text/javascript">
					  $(function() {
						  $('#datetimepicker1').datetimepicker({
						  	language: 'en'
						  });
					  });
					</script>
                    <span class="help-inline"></span>
                </div>
                
                <!--
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
				-->
            </div>
            <div class="control-group">
                <label class="control-label" for="discount">បញ្ចុះតំលៃ</label>
                <div class="controls">
                    <input type="number" name="txt_discount" value="<?php echo ($this->session->userdata('txt_discount'))?$this->session->userdata('txt_discount'):0; ?>" />
                    <span class="help-inline">%</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="deposit">ប្រាក់​កក់</label>
                <div class="controls">
                    <input type="number" name="txt_deposit" value="<?php echo ($this->session->userdata('txt_deposit'))?$this->session->userdata('txt_deposit'):0; ?>" />
                    <span class="help-inline">៛</span>
                    &nbsp;បង់​ទាំង​អស់? <input type="checkbox" <?php echo ($this->session->userdata('txt_payAll') && $this->session->userdata('txt_payAll') == 1)?'checked="checked"':''; ?> name="txt_payAll" value="1" id="depositPayAll" style="opacity: 1;" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="owe">ប្រាក់​ជំពាក់</label>
                <div class="controls">
                	<?php
                	$owe = 0;
                	$deposit = ($this->session->userdata('txt_deposit'))?$this->session->userdata('txt_deposit'):0;
					$discount = ($this->session->userdata('txt_discount'))?$this->session->userdata('txt_discount'):0;
                	$owe = ($total_price-($total_price*$discount/100)) - $deposit;
                	?>
                    <input type="number" readonly="readonly" name="txt_owe" value="<?php echo $owe; ?>" />
                    <span class="help-inline">៛</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="deposit">ពន្ធ</label>
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
                    	ត្រឡប់​ក្រោយ
                </button>
               </a>
                &nbsp; &nbsp; &nbsp;
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
            
        $('[name="txt_deposit"]').blur(function(){
        	if($(this).val() == '') $(this).val('0');
        	var deposit = parseInt($(this).val());
	    	var total = parseInt(<?php echo json_encode($total_price); ?>);
	    	var discount = $('[name="txt_discount"]').val();
	    	var owe = (total-((total*discount)/100 + deposit));
	    	$('[name=txt_owe]').val(owe);
        });
        
        $('[name="txt_deposit"]').keyup(function(){
		    var value = $(this).val();
		    value = value.replace(/[^0-9]+/g, '');
		    $(this).val(value);
		});
		
		$('[name="txt_discount"]').blur(function(){
			if($(this).val() == '') $(this).val('0');
			if(parseInt($(this).val()) >= 0){
		    	var deposit = parseInt($('[name=txt_deposit]').val());
		    	var total = parseInt(<?php echo json_encode($total_price); ?>);
		    	var discount = $(this).val();
		    	var owe = (total-((total*discount)/100 + deposit));
		    	$('[name=txt_owe]').val(owe);
		    }
		});
		
		$('[name="txt_discount"]').keyup(function(){
		    var value = $(this).val();
		    value = value.replace(/[^0-9]+/g, '');
		    $(this).val(value);
		});
		
		$('#depositPayAll').click(function(){
			if($(this).prop('checked')){
		    	var owe = 0;
		    	var total = parseInt(<?php echo json_encode($total_price); ?>);
		    	var discount = $('[name=txt_discount]').val();
		    	var deposit = (total-((total*discount)/100));
		    	$('[name=txt_owe]').val(owe);
		    	$('[name=txt_deposit]').val(deposit);
				$('[name=txt_deposit]').attr('readonly','readonly');
			}else{
		    	var total = parseInt(<?php echo json_encode($total_price); ?>);
		    	var discount = $('[name=txt_discount]').val();
		    	var owe = (total-((total*discount)/100));
		    	var deposit = 0;
		    	$('[name=txt_owe]').val(owe);
		    	$('[name=txt_deposit]').val(deposit);
				$('[name=txt_deposit]').removeAttr('readonly');
				
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