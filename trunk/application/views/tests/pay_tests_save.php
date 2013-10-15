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
	.banner_header{
		height: 100px;
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
<div class="banner_header">&nbsp;</div>
<div class="row-fluid">
	<div class="invoice_test">
		<p><b>Invoice No: <?php echo string_digit($patients_tests_data[0]['pat_tes_id']); ?>-1</b></p>
		<p><b><i>Reference Invoice No: <?php echo string_digit($patients_tests_data[0]['pat_tes_id']); ?></i></b></p>
		<p>Date: <?php echo date('d-F-Y'); ?></p>
		<p>Tél: 012 22 64 71<br/>012 88 77 76<br/>011 93 03 20</p>
	</div>
    <div id="test_add">
        <!--PAGE CONTENT BEGINS-->
        <?php echo form_open(site_url('tests/lists'),'class="form-horizontal" id="frmPrint"');?>
            <div class="control-group">
                <p>Nom et Prénom: <?php echo $patients_tests_data[0]['pat_firstName'].' '.$patients_tests_data[0]['pat_lastName'];?></p>
                <p>Age: <?php echo $patients_tests_data[0]['pat_age'];?>A</p>
                <p>Sex: <?php echo strtoupper($patients_tests_data[0]['pat_sex']);?></p>
            </div>
            <div class="control-group">
          		<h3>Invoice - Last Payment</h3>
				<table class="table table-bordered">
					<tr class="success">
						<th class="success">Description</th>
						<th class="success">Price (៛)</th>	
					</tr>
					<tr>
						<td>Owe (៛)</td>
						<td><?php echo number_format($patients_tests_data[0]['pat_tes_owe'],0);?>៛</td>
					</tr>
					<tr>
						<td>Pay (៛)</td>
						<td><b><?php echo number_format($patients_tests_data[0]['pat_tes_owe'],0);?>៛</b></td>
					</tr>
				</table>
				<div style="margin-bottom: 50px;margin-right: 20px;text-align: right;"><b>Signature du technicien</b></div>
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