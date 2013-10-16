<?php // echo $doc_com_data->num_rows(); exit();  ?>
<div class="page-header position-relative hidden-print">
    <style type="text/css" media="print">
        #main-content{
            margin-left: 0px !important;
        }
/*        .form-horizontal .contant_invoice{
            min-height: 400px;
        }*/
    </style>

    <h1>
        វិក័យប័ត្រ : ដំ​ណាក់​កាល​ ចេញ​វិក័យប័ត្រ
        <small>
            <i class="icon-double-angle-right"></i>
            សូម​ព្រីន​វិក័យ​ប័ត្រ មុន​នឹង​បន្ត​កិច្ច​ការ​របស់​អ្នក
        </small>
    </h1>
</div>
<div><img src="<?php echo site_url(IMG . 'invoice_banner2.png') ?>" alt="" /></div>
<div style="text-align: right; font-weight: bold;">វិក័យ​ប័ត្រលេខ៖ <?php echo string_digit($this->session->userdata('txt_testId')); ?></div>
<div class="row-fluid">
    <div class="invoice_test">
        <p>ថ្ងៃ ខែ ឆ្នាំ ៖ <?php echo date('d-F-Y'); ?></p>
        <p>លេខ​ទូរស័ព្ទ ៖ 012 22 64 71<br/>012 88 77 76<br/>011 93 03 20</p>
    </div>
    <div class="span12" id="test_add">
        <!--PAGE CONTENT BEGINS-->
        <?php echo form_open(site_url('doctors_commissions/update'), 'class="form-horizontal" id="frmPrint"'); ?>
        <div class="control-group">
            <p>មន្ទីរ​ពិសោធន៍ វេជ្ជសាស្រ្ត ប្រ​ណីត</p>
            <p>ឈ្មោះ វេជ្ជ​បណ្ឌិត ៖ <?php echo $doc_name; ?></p>
            <p>ភេទ ៖ <?php echo ($doc_sex == 'm') ? 'ប្រុស' : 'ស្រី'; ?></p>
        </div>
        <div class="control-group contant_invoice">
            <h3>វិក័យប័ត្រ</h3>
            <table class="table table-bordered" style="border-bottom: 0px;">
                <tr class="success">
                    <th class="success">លរ</th>
                    <th class="success">ឈ្មោះអ្នក​ជំ​ងឺ</th>
                    <th class="success">ថ្ងៃ​ខែ​ធ្វើតេស្ថ</th>
                    <th class="success">កំរៃ​ជើងសារ (៛)</th>	
                </tr>
                <?php
                $total_price = 0;
                $no = 1;
                if ($doc_com_data->num_rows() > 0) {
                    foreach ($doc_com_data->result_array() as $row) {
//							foreach($arr_values as $keys=>$values){
//								$total_price += $values;
                        $total_price += $row[DOCCOMM_AMMOUNT];
                        ?>
                        <tr>
                            <td style="<?php echo (($no == 1) ? 'border-bottom:0px;' : 'border-bottom:0px;border-top:0px;'); ?>"><?php echo $no; ?></td>
                            <td  style="<?php echo ($no == 1) ? 'border-bottom:0px;' : 'border-bottom:0px;border-top:0px;'; ?>"><?php echo $row[PARTIENT_FNAME] . ' ' . $row[PARTIENT_LNAME]; ?></td>
                            <td style="<?php echo ($no == 1) ? 'border-bottom:0px;' : 'border-bottom:0px;border-top:0px;'; ?>"><?php echo $row[PARTIENTSTEST_DATE] ?></td>
                            <td class="ali_right" style="<?php echo ($no == 1) ? 'border-bottom:0px;' : 'border-bottom:0px;border-top:0px;'; ?>"><?php echo formatMoney($row[DOCCOMM_AMMOUNT], TRUE, '៛'); ?></td>
                        </tr>
                        <?php
                        $no++;
                    }
//						}
                }
                ?>
                <tr class="sub_total_price">
                    <td style="border-left: 0px solid; border-bottom: 0px solid; border-right: 0px solid;">&nbsp;</td>
                    <td style="border-left: 0px solid; border-bottom: 0px solid; border-right: 0px solid;">&nbsp;</td>
                    <td style="border-left: 0px solid; border-bottom: 0px solid; text-align: right;">សរុប (៛)</td>
                    <td class="ali_right" style="border-bottom: 0px solid;"><b><?php echo formatMoney($total_price, TRUE, '៛'); ?></b></td>
                </tr>


            </table>
            <?php
            if ($this->session->userdata('txt_isPaid') == 1) {
                ?>
                <div><p>*សំគាល់៖ វិក័យ​ប័ត្រ​ ត្រូវ​បាន​បង់​ប្រាក់​គ្រប់</p></div>
                <?php
            }
            ?>
            <div style="margin-bottom: 50px;margin-right: 250px;text-align: right;"><b>ហត្ថលេខា បេឡាករ</b></div>
        </div>
        <div class="invoice-footer" style="text-align: center;">
            <p>អាសយដ្ឋាន ផ្ទះលេខ ៥០៨, ផ្លូវលេខ ៥៩៨, សង្កាត់ភ្នំពេញថ្មី, ខណ្ឌសែនសុខ, ក្រុងភ្នំពេញ ព្រះរាជាណាចក្រកម្ពុជា</p>
            <p>No. 508, Phnom Penh Thmey, Sen Sok, Phnom Penh, Cambodia</p>
            <p>Tel: 012 22 64 71 / 012 88 77 76 / 011 93 03 20</p>
        </div>
        <div class="form-actions hidden-print">
            
            	<button class="btn btn-info btn_back"  type="button">
                    <i class="icon-arrow-left bigger-110"></i>
                    	ត្រឡប់​ក្រោយ
                </button>
            
            
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
$this->session->set_flashdata('msg_success', 'តេស្ថ​ត្រូវ​បាន​បង្កើត រួម​ជា​មួយ​​វិក័យ​ប័ត្រ ត្រូវ​បាន​ព្រីន​ចេញ។ សូម​បញ្ចូល​លទ្ធផល​តេស្ថ បន្ទាប់​ពី​អ្នក​ ទទួល​បាន​លទ្ធផល ពី​ Laboratory Doctor');
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
            
            
$('.btn_back').click(function(){
    window.history.back();

});
            });
</script>