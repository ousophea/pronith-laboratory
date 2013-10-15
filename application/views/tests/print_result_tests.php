<?php
	if($patients_tests_data->num_rows() > 0){
		$patients_tests_data = $patients_tests_data->result_array();
	}else{
		$patients_tests_data = FALSE;
	}
?>
<!-- apply for date time picker -->
<script type="text/javascript" language="JavaScript" src="<?php echo site_url(JS.'jquery.simple-dtpicker.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo site_url(CSS.'jquery.simple-dtpicker.css') ?>" />
<style type="text/css" media="print">
	#main-content{
		margin-left: 0px !important;
	}
	.banner_header{
		height: 100px;
	}
</style>
<div class="page-header position-relative hidden-print">
    <h1>
        បង្កើតតេស្ថ​ថ្មី : ដំ​ណាក់​កាល​ ចេញ​វិក័យប័ត្រ
        <small>
            <i class="icon-double-angle-right"></i>
            	សូម​ព្រីន​វិក័យ​ប័ត្រ មុន​នឹង​បន្ត​កិច្ច​ការ​របស់​អ្នក
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
				<table class="table table-bordered">
					<tr class="success">
						<th class="success">Description</th>
						<th class="success">Result</th>
						<th class="success">Dimention</th>
						<th class="success">Valeur Normale - <?php echo strtoupper($patients_tests_data[0]['pat_sex']); ?></th>	
					</tr>
					<?php
					$ills_groups = '';
					$ills = '';
					if($patients_tests_results_data->num_rows() > 0){
						foreach($patients_tests_results_data->result() as $rows){
							if($rows->groups_name != $ills_groups){
					?>
					<tr class="ills_groups">
						<td colspan="4" class="warning"><b><?php echo $rows->groups_name; ?></b></td>
					</tr>
					<?php
								$ills_groups = $rows->groups_name;
							}
							if($rows->ills_name != $ills){
					?>
					<tr class="ills">
						<td colspan="4" class="warning"><b><i><?php echo $rows->groups_name.' &gt;&gt; '.$rows->ills_name; ?></i></b></td>
					</tr>
					<?php
								$ills = $rows->ills_name;
							}
					?>
					<tr>
						<td><?php echo $rows->ill_ite_name; ?></td>
						<td>
						<?php
						$arr_split = ($patients_tests_data[0]['pat_sex']=='m')?$rows->ill_ite_value_male:$rows->ill_ite_value_female;
						$arr_split = explode('-', $arr_split);
						//var_dump($arr_split);
						
						//if($rows->pat_tes_res_value < $arr_split[0] || $rows->pat_tes_res_value > $arr_split[1]){
						?>
							<!--<label for="value">=<span class="red"> <?php echo $rows->pat_tes_res_value; ?></span></label>-->
						<?php
						//}else{
						?>
							<label for="value">=<span class=""> <?php echo $rows->pat_tes_res_value; ?></span></label>
						<?php
						//}
						?>
						</td>
						<td><?php echo $rows->ill_ite_dim_value; ?></td>
						<td>(<?php echo (($patients_tests_data[0]['pat_sex'] == 'm')?$rows->ill_ite_value_male:(($patients_tests_data[0]['pat_sex'] == 'f')?$rows->ill_ite_value_female:'--')); ?>)</td>
					</tr>
					<?php
						}
					}
					?>
				</table>
				<div style="margin-bottom: 50px;margin-right: 20px;text-align: right;"><b>Signature du technicien</b></div>
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