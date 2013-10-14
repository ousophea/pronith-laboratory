<?php
if($patients_tests_data->num_rows() > 0){
	$patients_tests_data = $patients_tests_data->result_array();
}else{
	$patients_tests_data = FALSE;
}
?>
<style type="text/css" media="print">
	#main-content{
		margin-left: 0px !important;
	}
</style>
<div class="page-header position-relative hidden-print">
    <h1>
        ព្រីចេញ​វិក័យប័ត្រ បង់​ប្រាក់​នៅ​សល់
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
<div><img width="50%" src="<?php echo site_url(IMG.'invoice_banner.png')?>" alt="" /></div>
<div style="text-align: right; font-weight: bold;">
	វិក័យ​ប័ត្រលេខ ៖ <?php echo string_digit($patients_tests_data[0]['pat_tes_id']); ?>(1)
	<br/>
	យោង​តាម​វិក័យ​ប័ត្រ​លេខ ៖ <?php echo string_digit($patients_tests_data[0]['pat_tes_id']); ?>
</div>
<div class="row-fluid">
	<div class="invoice_test">
		<p>ថ្ងៃ ខែ ឆ្នាំ ៖ <?php echo date('d-F-Y'); ?></p>
		<p>លេខ​ទូរស័ព្ទ ៖ 012 22 64 71<br/>012 88 77 76<br/>011 93 03 20</p>
	</div>
    <div class="span12" id="test_add">
        <!--PAGE CONTENT BEGINS-->
        <?php echo form_open(site_url('tests/lists'),'class="form-horizontal" id="frmPrint"');?>
            <div class="control-group">
            	<p>មន្ទីរ​ពិសោធន៍ វេជ្ជសាស្រ្ត ប្រ​ណីត</p>
                <p>ឈ្មោះ អ្នក​ជំងឺ ៖ <?php echo $patients_tests_data[0]['pat_firstName'].' '.$patients_tests_data[0]['pat_lastName'];?></p>
                <p>ភេទ ៖ <?php echo ($patients_tests_data[0]['pat_sex'] == 'm')?'ប្រុស':'ស្រី';?></p>
            </div>
            <div class="control-group">
          		<h3>វិក័យប័ត្រ-បង់​ប្រាក់​បង្គ្រប់</h3>
				<table class="table table-bordered">
					<tr class="success">
						<th class="success">ពិ​ពណ៌នា</th>
						<th class="success">តំលៃ (៛)</th>	
					</tr>
					<tr>
						<td>ប្រាក់​ជំ​ពាក់</td>
						<td><?php echo number_format($patients_tests_data[0]['pat_tes_owe'],0);?>៛</td>
					</tr>
					<tr>
						<td>ប្រាក់​​ត្រូវ​បង់</td>
						<td><b><?php echo number_format($patients_tests_data[0]['pat_tes_owe'],0);?>៛</b></td>
					</tr>
				</table>
				<div style="margin-bottom: 50px;margin-right: 50px;text-align: right;"><b>ហត្ថលេខា បេឡាករ</b></div>
            </div>
            <div class="invoice-footer" style="text-align: center;">
            	<p>អាសយដ្ឋាន ផ្ទះលេខ ៥០៨, ផ្លូវលេខ ៥៩៨, សង្កាត់ភ្នំពេញថ្មី, ខណ្ឌសែនសុខ, ក្រុងភ្នំពេញ ព្រះរាជាណាចក្រកម្ពុជា</p>
            	<p>No. 508, Phnom Penh Thmey, Sen Sok, Phnom Penh, Cambodia</p>
            	<p>Tel: 012 22 64 71 / 012 88 77 76 / 011 93 03 20</p>
            </div>
            <div class="form-actions hidden-print">
                &nbsp; &nbsp; &nbsp;
                <button id="btn_print" class="btn btn-info" type="submit">
                    <i class="icon-print bigger-110"></i>
                    	ព្រីន​វិក័យ​ប័ត្រ
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
            	$this->session->set_flashdata('msg_success','វិក័យ​ប័ត្រ​បង់​ប្រាក់ បង្គ្រប់​ត្រូវ​បាន​ព្រីន​ចេញ');
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