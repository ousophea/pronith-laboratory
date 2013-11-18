<?php
if($patients_tests_data->num_rows() > 0){
	$patients_tests_data = $patients_tests_data->result_array();
}else{
	$patients_tests_data = FALSE;
}
?>
<div class="page-header position-relative hidden-print">
    <h1>
        បញ្ចូល​លទ្ធផលតេស្ថ​
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
        <?php echo form_open(site_url('tests/input_result_tests_save'),'class="form-horizontal" id="frmInputResult"');?>
        	<input type="hidden" name="txt_patTesId" value="<?php echo $pat_tes_id; ?>" />
            <div class="control-group">
                <label for="patient">
                	ថ្ងៃ ខែ ឆ្នាំ ធ្វើ​តេស្ថ ៖ <?php echo date('d-F-Y', strtotime($patients_tests_data[0]['pat_tes_dateCreated']));?>
                </label>
            </div>
            <div class="control-group">
                <label for="datetime_receive">
                	ថ្ងៃ​ខែ ត្រឡប់​មក​យក លទ្ធផល : <?php echo date('d-F-Y H:i:s', strtotime($patients_tests_data[0]['pat_tes_dateTimeReceived']));?>
                </label>
            </div>
            <div class="control-group">
                <label for="ill_selected_detail">បំ​ពេញ​លទ្ធផល លំអិត​ខាងក្រោម</label>
                <?php
                if($items_tests_data_ills->num_rows() > 0){
                ?>
                <table class="table table-bordered">
                	<tr>
                		<th colspan="3" style="text-align: center;">
                			បញ្ចូល​លទ្ធផល​នៃ​ជំ​ងឺ
                		</th>
                	</tr>
                	<tr>
                		<th>ឈ្មោះ</th>
                		<th>លទ្ធផល</th>
                		<th>ខ្នាត</th>
                	</tr>
                	<?php
					$ill_groups = '';
					foreach ($items_tests_data_ills->result() as $rows){
						if($rows->groups_name != $ill_groups){
					?>
					<tr class="ills_groups">
						<td colspan="4" class="warning" style="font-weight: bold;"><?php echo $rows->groups_name; ?></td>
					</tr>
					<?php
							$ills_groups = $rows->groups_name;
						}
					?>
					<tr>
						<td><?php echo $rows->ills_name; ?></td>
						<td>
							<input type="hidden" name="txt_illId[]" value="<?php echo $rows->ill_id; ?>" />
							<select name="txt_illResult[]">
								<option value="1">Positive</option>
								<option value="0">Negative</option>
							</select>
						</td>
						<td>+/-</td>
					</tr>
					<?php
					}
					
					?>
                </table>
                <?php
				}

				if($items_tests_data_ills_items->num_rows() > 0){
                ?>
				<table class="table table-bordered">
					<tr>
                		<th colspan="4" style="text-align: center;">
                			បញ្ចូល​លទ្ធផល​នៃ​ប្រភេទ​ជំ​ងឺ
                		</th>
                	</tr>
					<tr class="success">
						<th class="success">ឈ្មោះ</th>
						<th class="success">លទ្ធផល</th>
						<th class="success">ខ្នាត</th>
						<th class="success">តំលៃ​ធម្មតា<?php echo(($pat_sex == 'm')?'បុរស':(($pat_sex == 'f')?'ស្រ្តី':'មិន​ស្គាល់')); ?></th>	
					</tr>
					<?php
					$ills_groups = '';
					$ills = '';
					
					foreach($items_tests_data_ills_items->result() as $rows){
						if($rows->groups_name != $ills_groups){
					?>
					<tr class="ills_groups">
						<td colspan="4" class="warning" style="font-weight: bold;"><?php echo $rows->groups_name; ?></td>
					</tr>
					<?php
							$ills_groups = $rows->groups_name;
						}
						if($rows->ills_name != $ills){
					?>
					<tr class="ills">
						<td colspan="4" class="warning" style="font-style: italic;"><?php echo $rows->groups_name.' &gt;&gt; '.$rows->ills_name; ?></td>
					</tr>
					<?php
							$ills = $rows->ills_name;
						}
					?>
					<tr>
						<td><?php echo $rows->ill_ite_name; ?></td>
						<td>
							<input type="hidden" name="txt_illItemId[]" value="<?php echo $rows->ill_ite_id; ?>" />
							<input type="text" required="required" minlength="1" name="txt_illItemResult[]" />
						</td>
						<td><?php echo $rows->ill_ite_dimention; ?></td>
						<td>(<?php echo (($pat_sex == 'm')?$rows->ill_ite_value_male:(($pat_sex == 'f')?$rows->ill_ite_value_female:'--')); ?>)</td>
					</tr>
					<?php
					}
					
					?>
				</table>
				<?php
				}

				if($items_tests_data_ills_items_subs->num_rows() > 0){
                ?>
				<table class="table table-bordered">
					<tr>
                		<th colspan="4" style="text-align: center;">
                			បញ្ចូល​លទ្ធផល​នៃ​ប្រភេទ​ជំ​ងឺ ក្នុង​ប្រភេទ​ជំ​ងឺ
                		</th>
                	</tr>
					<tr class="success">
						<th class="success">ឈ្មោះ</th>
						<th class="success">លទ្ធផល</th>
						<th class="success">ខ្នាត</th>
						<th class="success">តំលៃ​ធម្មតា<?php echo(($pat_sex == 'm')?'បុរស':(($pat_sex == 'f')?'ស្រ្តី':'មិន​ស្គាល់')); ?></th>	
					</tr>
					<?php
					$ills_groups = '';
					$ills = '';
					$ills_items = '';
					foreach($items_tests_data_ills_items_subs->result() as $rows){
						if($rows->groups_name != $ills_groups){
					?>
					<tr class="ills_groups">
						<td colspan="4" class="warning" style="font-weight: bold;"><?php echo $rows->groups_name; ?></td>
					</tr>
					<?php
							$ills_groups = $rows->groups_name;
						}
						if($rows->ills_name != $ills){
					?>
					<tr class="ills">
						<td colspan="4" class="warning" style="font-style: italic; font-weight: bold;"><?php echo $rows->groups_name.' &gt;&gt; '.$rows->ills_name; ?></td>
					</tr>
					<?php
							$ills = $rows->ills_name;
						}
						if($rows->ill_ite_name_parent != $ills_items){
					?>
					<tr class="ills">
						<td colspan="4" class="warning" style="font-style: italic;"><?php echo $rows->groups_name.' &gt;&gt; '.$rows->ills_name.' &gt;&gt; '.$rows->ill_ite_name_parent; ?></td>
					</tr>
					<?php
							$ills_items = $rows->ill_ite_name_parent;
						}
					?>
					<tr>
						<td><?php echo $rows->ill_ite_name; ?></td>
						<td>
							<input type="hidden" name="txt_illItemId[]" value="<?php echo $rows->ill_ite_id; ?>" />
							<input type="text" required="required" minlength="1" name="txt_illItemResult[]" />
						</td>
						<td><?php echo $rows->ill_ite_dimention; ?></td>
						<td>(<?php echo (($pat_sex == 'm')?$rows->ill_ite_value_male:(($pat_sex == 'f')?$rows->ill_ite_value_female:'--')); ?>)</td>
					</tr>
					<?php
					}
					
					?>
				</table>
				<?php
				}
				?>
            </div>
            <div class="form-actions">
                <button id="btn_input_result" class="btn btn-info" type="submit">
                    <i class="icon-save bigger-110"></i>
                    	បញ្ចូល
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
        $('#frmInputResult').submit(function(){
        	if(!confirm('ទិន្ន័យ​លទ្ធផល បញ្ចូល​ហើយ មិន​អាច​កែ​ប្រែ​បាន​ទេ។ សូម​ធ្វើ​ការ​ត្រួត​ពិនិត្យ​ អោយ​បាន​ច្បាស់​មុន​នឹង​បន្ត​។\nតើ​អ្នក​ពិតជា ចង់​បន្ត​មែន​ទេ?')) return false;
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