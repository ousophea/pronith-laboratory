<div class="page-header position-relative">

    <?php
    if ($this->session->flashdata('msg_success')) {
        ?>
        <div class="msg_success">
            <?php echo '<p>' . $this->session->flashdata('msg_success') . '</p>'; ?>
        </div>
    <?php } ?>

    <h1>
        បញ្ជី​កំរៃ​ជើងសារ
        <small>
            <i class="icon-double-angle-right"></i>
            បញ្ជី​កំរៃ​ជើងសារ និង វេជ្ជបណ្ឌិត
        </small>
    </h1>
</div><div  class=""><label>កំរៃ​​ជើង​សារ <select id="toolbar_comm">
            <option value="0" selected="selected">ត្រូវបង់</option><option value="1">បានបង់​រួច</option><option value="-1">បង្ហាញទាំងអស់</option></select></label></div>
<span id="doctor_comm_table">        
    <div class="row-fluid">
        <div id="sample-table-2_wrapper" class="dataTables_wrapper" role="grid">

            <table id="sample-table-2" class="table table-striped table-bordered table-hover dataTable" aria-describedby="sample-table-2_info">
                <thead>
                    <tr role="row">
                        <th class="center sorting_disabled">
                            <label>
                                <input type="checkbox" class="ace">
                                <span class="lbl"></span>
                            </label>
                        </th>
                        <th class="sorting">ឈ្មោះ វេជ្ជបណ្ឌិត</th>
                        <th class="sorting">ប្រាក់ត្រូវទទួល (៛)</th>
                        <th class="sorting">ប្រាក់បានទទួល (៛)</th>
                        <!--<th style="width: 161px;">ប្រគល់ប្រាក់?</th>-->
                        <th >ផ្សេងៗ</th>
                    </tr>
                </thead>
                <span id="part_test_info" data-object=''></span>
                <tbody role="alert" aria-live="polite" aria-relevant="all">

                    <?php
                    if ($data->num_rows()) {
                        foreach ($data->result_array() as $row) {
                            ?>

                            <tr class="odd object" data-object='<?php echo json_encode(array('data' => $row)); ?>'>
                                <td class="center">
                                    <label>
                                        <input type="checkbox" name="id[]" value="<?php echo $row[DOC_ID]; ?>" class="ace">
                                        <span class="lbl"></span>
                                    </label>

                                </td>

                                <td class=" "><?php echo $row[DOC_FNAME] . " " . $row[DOC_LNAME]; ?></td>
                                <td class="ali_right"><?php echo formatMoney($row[DOCCOMM_AMMOUNT], TRUE, "៛"); ?></td>
                                <td class="ali_right "><?php echo ($row[DOCCOMM_GETPAID] == 0) ? formatMoney($row[DOCCOMM_GETPAID], TRUE, "៛") : formatMoney($row[DOCCOMM_AMMOUNT], TRUE, "៛"); ?></td>
                                <!--<td id="paidBTN" class=" "><input <?php echo ($row[DOCCOMM_STATUS]) ? 'checked' : ''; ?> type="checkbox" id="<?php echo DOCCOMM_STATUS; ?>" class="ace status ace-switch ace-switch-7"><span class="lbl"></span></td>-->
            <!--                            <td class=" ">
                                    <div class="hidden-phone visible-desktop action-buttons">
                                <?php if ($row[DOCCOMM_GETPAID] <= 0) { ?>
                                                                     <a href="<?php echo site_url('doctors_commissions/invioce/' . $row[DOC_ID]); ?>">
                                                                        បង់​ប្រាក់ <i class="icon-money"></i>
                                                                    </a>
                                                                   
                                    <?php
                                } else {
                                    echo '<span class="green">បង់​រួច</span>';
                                }
                                ?>
                                    </div>
                                </td>-->
                                <td class=" ">
                                    <div class="hidden-phone visible-desktop action-buttons">
                                        <a class="blue view-modal" href="<?php echo base_url(); ?>doctors_commissions/get_pat_test_info" style="cursor:pointer; ">
                                            ពត៌មានលំអិត <i class="icon-eye-open"></i>&nbsp;&nbsp;
                                        </a>

                                                        <!--                                    <a class="green edit" href="<?php echo base_url(); ?>ill_items/edit">
                                                                                                <i class="icon-pencil bigger-130"></i>
                                                                                            </a>

                                                                                            <a class="red delete" href="<?php echo base_url(); ?>ill_items/delete/">
                                                                                                <i class="icon-trash bigger-130"></i>
                                                                                            </a>-->
                                        <!-- Button to trigger modal -->
                                        <!--<a href="#myModal" role="button" class="btn" data-toggle="modal">Launch demo modal</a>-->


                                        <?php if ($row[DOCCOMM_GETPAID] <= 0) { ?>
                                            <a href="<?php echo site_url('doctors_commissions/invioce/' . $row[DOC_ID]); ?>">
                                                បង់​ប្រាក់ <i class="icon-money"></i>
                                            </a>

                                            <?php
                                        } else {
                                            echo '<span class="green">បង់​រួច</span>';
                                        }
                                        ?>

                                    </div>
                                </td>
                                <!--<td class=" "><input <?php echo ($row[DOCCOMM_STATUS]) ? 'checked' : ''; ?> type="checkbox" id="<?php echo DOCCOMM_STATUS; ?>" class="ace status ace-switch ace-switch-7"><span class="lbl"></span></td>-->
                            </tr>

                            <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</span>
<script type="text/javascript">

    $(document).ready(function() {
        var object, parents;
        // Register
        var uri = [$('[name="base_url"]').val(),
            $('[name="segment1"]').val(),
            $('[name="segment2"]').val()];
        
        // View detail modal popup
        $('.view-modal').on('click',function(){
            parents = $(this).parents(".object");
            object = $(parents).data('object');
            $.ajax({
                type: "POST",
                url: this.href,
                data: object
            }).done(function(data) {
                //                alert(data);
                //                $("#part_test_info").html("Hello");
                //                var html = '';
                
                view(data,'ពត៌មានលំអិតនៃការធ្វើតេស្ថ');// Popup
            });
            
           
            return false;
        });

    });
</script>

<script type="text/javascript">
    jQuery(function($) {
        $('#toolbar_comm').on('change',function(){
            //            parents = $(this).parents(".object");
            //            object = $(parents).data('object');
            var form_data = {
                comm_status : $(this).val()
            };
            $.ajax({
                type: "POST",
                url: 'view_doctor_comm',
                data: form_data
            }).done(function(data) {
                //                alert(data);
                //                $("#part_test_info").html("Hello");
                //                var html = '';
                
                $('#doctor_comm_table').html(data);
            });
            
           
            return false;
        });
        
        //
        //        $('#toolbar_comm').on('change', function() {
        ////             alert($(this).val());return;
        //             var form_data = {
        //                    comm_status : $(this).val()
        //                };
        //            
        //            $.ajax({
        //                type: "POST",
        //                url: 'doctor_commissions/view_doctor_comm',
        //                data: form_data
        //            }).done(function(data) {
        //                alert($(this).val());return;
        //                $('#doctor_comm_table').html("Hello");
        //            }); 
        //            
        ////            return false;
        //        });
                
                
        //        $('.row-fluid.span6#sample-table-2_length').html('');
        //        var oTable1 = $('#sample-table-2').dataTable({
        //            "aoColumns": [
        //                {"bSortable": false},
        //                null, null, null, null, null, null, null, null, null,
        //                {"bSortable": false}
        //            ]});

        //        var oTable1 = $('#sample-table-2').dataTable();


        //        $('table th input:checkbox').on('click', function() {
        //            var that = this;
        //            $(this).closest('table').find('tr > td:first-child input:checkbox')
        //            .each(function() {
        //                this.checked = that.checked;
        //                $(this).closest('tr').toggleClass('selected');
        //            });
        //
        //        });

        //
        //        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        //        function tooltip_placement(context, source) {
        //            var $source = $(source);
        //            var $parent = $source.closest('table')
        //            var off1 = $parent.offset();
        //            var w1 = $parent.width();
        //
        //            var off2 = $source.offset();
        //            var w2 = $source.width();
        //            
        //            if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2))
        //                return 'right';
        //            return 'left';
        //        }
        //        
        
        //    $('.row-fluid.span6').append('<div id="sample-table-2_length" class="dataTables_length"><label>បង្ហាញ <select aria-controls="sample-table-2"><option value="10" selected="selected">10</option><option value="20">20</option><option value="30">30</option><option value="40">40</option><option value="50">50</option><option value="-1">បង្ហាញទាំងអស់</option></select> ជួរ</label></div>')
        
    })
</script>
<script src="<?php echo base_url() . JS; ?>data.table.js"></script>
