<?php
	if($patients_tests_data->num_rows() > 0){
		$patients_tests_data = $patients_tests_data->result_array();
	}else{
		$patients_tests_data = FALSE;
	}
?>
<!-- apply for date time picker -->
<div class="page-header position-relative hidden-print">
    <h1>
        ព្រីន​លទ្ធផល​ នៃ​ការ​ធ្វើ​តេស្ថ
        <small>
            <i class="icon-double-angle-right"></i>
            	សូម​ព្រីនលទ្ធផល មុន​នឹង​បន្ត​កិច្ច​ការ​របស់​អ្នក
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
<style type="text/css" media="print">
	#main-content{
		margin-left: 0px !important;
	}
	.banner_header{
		height: 100px;
	}
</style>
<div class="banner_header">&nbsp;</div>
<div class="row-fluid">
	<div class="invoice_test">
		<p>Date: <?php echo date('d-F-Y'); ?></p>
		<p>Tél: 012 22 64 71<br/>012 88 77 76<br/>011 93 03 20</p>
	</div>
    <div class="" style="position: relative;" id="test_add">
        <!--PAGE CONTENT BEGINS-->
        <?php echo form_open(site_url('tests/lists'),'class="form-horizontal" id="frmPrint"');?>
            <div class="control-group">
                <p>Nom et Prénom: <?php echo $patients_tests_data[0]['pat_firstName'].' '.$patients_tests_data[0]['pat_lastName'];?></p>
                <p>Age: <?php echo $patients_tests_data[0]['pat_age'];?>A</p>
                <p>Sex: <?php echo strtoupper($patients_tests_data[0]['pat_sex']);?></p>
            </div>
            <div class="control-group">
          		<h3 style="text-align: center;">TESTS & RESULTATS</h3>
          		<!--<label for="ill_selected_detail">Test Result of Ills</label>-->
                <?php
                if($items_tests_data_ills->num_rows() > 0){
                ?>
                <div id="ill_blog">
	                <table class="table table-bordered">
	                	<tr>
	                		<th colspan="3" style="text-align: center;">
	                			Result of Ills
	                		</th>
	                	</tr>
	                	<tr>
	                		<th>Name</th>
	                		<th>Result</th>
	                		<th>Standard Dimention</th>
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
							<td><?php echo ($rows->pat_tes_res_value == '1')?'Positive':'Negative'; ?></td>
							<td>+/-</td>
						</tr>
						<?php
						}
						
						?>
	                </table>
                </div>
                <?php
				}
				if($items_tests_data_ills_items->num_rows() > 0){
                ?>
                <div id="ill_item_blog">
					<table class="table table-bordered">
						<tr>
	                		<th colspan="4" style="text-align: center;">
	                			Result of Ill Items
	                		</th>
	                	</tr>
						<tr class="success">
							<th class="success">Name</th>
							<th class="success">Result</th>
							<th class="success">Dimention</th>
							<th class="success">Standard<?php echo(($patients_tests_data[0]['pat_sex'] == 'm')?'Man':(($patients_tests_data[0]['pat_sex'] == 'f')?'Woman':'Unknown')); ?></th>	
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
							<td><?php echo $rows->ills_items_name; ?></td>
							<td><?php echo $rows->pat_tes_res_value; ?></td>
							<td><?php echo $rows->ill_ite_dimention; ?></td>
							<td>(<?php echo (($patients_tests_data[0]['pat_sex'] == 'm')?$rows->ill_ite_value_male:(($patients_tests_data[0]['pat_sex'] == 'f')?$rows->ill_ite_value_female:'--')); ?>)</td>
						</tr>
						<?php
						}
						
						?>
					</table>
				</div>
				<?php
				}
				if($items_tests_data_ills_items_subs->num_rows() > 0){
                ?>
				<table class="table table-bordered">
					<tr>
                		<th colspan="4" style="text-align: center;">
                			Result of Sub Ills Items
                		</th>
                	</tr>
					<tr class="success">
						<th class="success">Name</th>
						<th class="success">Result</th>
						<th class="success">Dimention</th>
						<th class="success">Standard <?php echo(($patients_tests_data[0]['pat_sex'] == 'm')?'Male':(($patients_tests_data[0]['pat_sex'] == 'f')?'Female':'Unknown')); ?></th>	
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
						if($rows->ills_items_parents_name != $ills_items){
					?>
					<tr class="ills">
						<td colspan="4" class="warning" style="font-style: italic;"><?php echo $rows->groups_name.' &gt;&gt; '.$rows->ills_name.' &gt;&gt; '.$rows->ills_items_parents_name; ?></td>
					</tr>
					<?php
							$ills_items = $rows->ills_items_parents_name;
						}
					?>
					<tr>
						<td><?php echo $rows->ills_items_name; ?></td>
						<td><?php echo $rows->pat_tes_res_value; ?></td>
						<td><?php echo $rows->ill_ite_dimention; ?></td>
						<td>(<?php echo (($patients_tests_data[0]['pat_sex'] == 'm')?$rows->ill_ite_value_male:(($patients_tests_data[0]['pat_sex'] == 'f')?$rows->ill_ite_value_female:'--')); ?>)</td>
					</tr>
					<?php
					}
					
					?>
				</table>
				<?php
				}
				?>
				<div style="margin-bottom: 50px;margin-right: 20px;text-align: right;"><b>Signature du technicien</b></div>
            </div>
            <div id="pagination_blog">
            	<?php
            	if($items_tests_data_ills->num_rows() > 0){
            	?>
            	<span id="nav_ill_blog">Ills</span> | 
            	<?php
            	}
            	if($items_tests_data_ills_items->num_rows() > 0){
                ?>
                <span id="nav_ill_item_blog">Ill Items</span> | 
                <?php
				}
                if($items_tests_data_ills_items_subs->num_rows() > 0){
                ?>
                
                <?php
				}
				?>
            </div>
            <div class="form-actions hidden-print">
                &nbsp; &nbsp; &nbsp;
                <button id="btn_print" class="btn btn-info" type="submit">
                    <i class="icon-print bigger-110"></i>
                    	ព្រីន​លទ្ធផល
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
            $("#frmPrint").submit(function(){
            	print();
            	<?php
				$this->session->set_flashdata('msg_success','លទ្ធផល​តេស្ថ ត្រូវ​បាន​ព្រីន​ចេញ។ សូម​រក្សា​ទុក រង់​ចាំ​អ្នក​ជំងឺ​មក​ទទួល​យក');
            	?>
            	return true;
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