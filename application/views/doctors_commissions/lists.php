<div class="page-header position-relative">
    
    <?php
if($this->session->flashdata('msg_success')){
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
</div>
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
                            <td class="ali_right "><?php echo ($row[DOCCOMM_GETPAID]==0)?formatMoney($row[DOCCOMM_GETPAID], TRUE, "៛"):formatMoney($row[DOCCOMM_AMMOUNT], TRUE, "៛"); ?></td>
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
            
            //            
            //            parents = $(this).parents(".object");
            //            object = $(parents).data('object').data;
            //            var html = '';
            //            html +=htmlView("Name", object['<?php echo DOC_FNAME; ?>']);
            //            html +=htmlView("Dimention", object['<?php echo ILI_DIMENTION; ?>']);
            //            html +=htmlView("Ill", object['<?php echo ILI_NAME; ?>']);
            //            html +=htmlView("Ill group", object['<?php echo ILG_NAME; ?>']);
            //            html +=htmlView("Value male", object['<?php echo ILI_VALUEMALE; ?>']);
            //            html +=htmlView("Value female", object['<?php echo ILI_VALUEFEMALE; ?>']);
            //            html +=htmlView("Date created", object['<?php echo ILI_DATECREATED; ?>']);
            //            html +=htmlView("Date modified", object['<?php echo ILI_DATEMODIFIED; ?>']);
            //            html +=htmlView("Status", (object['<?php echo ILI_STATUS; ?>']==1)?'On':'Off');
            //            html +=htmlView("Ill item description", object['<?php echo ILI_NAME; ?>']);
            //            view(html,'Ill item view detail');// Popup
            return false;
        });
        // $('.view-modal').on('click',function(){
        //            parents = $(this).parents(".object");
        //            object = $(parents).data('object').data;
        //            var html = '';
        //            html +=htmlView("Name", object['<?php echo DOC_FNAME; ?>']);
        //            html +=htmlView("Dimention", object['<?php echo ILI_DIMENTION; ?>']);
        //            html +=htmlView("Ill", object['<?php echo ILI_NAME; ?>']);
        //            html +=htmlView("Ill group", object['<?php echo ILG_NAME; ?>']);
        //            html +=htmlView("Value male", object['<?php echo ILI_VALUEMALE; ?>']);
        //            html +=htmlView("Value female", object['<?php echo ILI_VALUEFEMALE; ?>']);
        //            html +=htmlView("Date created", object['<?php echo ILI_DATECREATED; ?>']);
        //            html +=htmlView("Date modified", object['<?php echo ILI_DATEMODIFIED; ?>']);
        //            html +=htmlView("Status", (object['<?php echo ILI_STATUS; ?>']==1)?'On':'Off');
        //            html +=htmlView("Ill item description", object['<?php echo ILI_NAME; ?>']);
        //            view(html,'Ill item view detail');// Popup
        //        });
        // Load page edit and passing data
        $('.edit').on('click', function() {
            parents = $(this).parents(".object");
            object = $(parents).data('object');
            $('.message').html('');
            $.ajax({
                type: "POST",
                url: this.href,
                data: object
            }).done(function(data) {
                content_loader(data);
            });
            return false;
        });

        // status
        $(".status").on('click', function() {
            //bootbox.alert("You are sure!");
            var base_url = $('[name="base_url"]').val();
            go_loader();
            object = $(this).data('object');
            console.log(object)
            $.ajax({
                url:base_url+'ills/status',
                data:object,
                type:"POST",
                dataType:'json'
            }).done(function(data) {
                if (data.result == 1) {
                    // call notification
                    notify('Done!', 'Status have been changed.', 'gritter-success');
                    $('.loader').fadeOut();
                    return true;
                            
                }
                else if (data.result == 0) {
                    // call notification
                    notify('Fail!', 'Could not change status, please try again.', 'gritter-error');
                    back_loader();
                    return false;
                    //bootbox.alert('Could not delete user');
                }
                else if (data.result == 2) {
                    notify('Fail!', data.result + ': System not allow to change status, please contact to system administrator', 'gritter-error');
                    back_loader();
                    return false;
                    //bootbox.alert(data.result + ':System not allow to delete user, please contact to system administrator');
                }
                else {
                    notify('Fail!', data.result + ': Could not change status, please try again', 'gritter-error');
                    back_loader();
                    return false;
                    //bootbox.alert(data.result + ':Could not delete user, please try again');
                }
            });
            
        });

        // Delete
        $(".delete").on('click', function() {
            var url = this.href;
            parents = $(this).parents(".object");
            object = $(parents).data('object');
            bootbox.confirm("Are you sure want to delete ill?", function(result) {
                if (result) {
                    //bootbox.alert("You are sure!");
                    go_loader();
                    $.ajax({
                        url:url,
                        data:object,
                        type:"POST",
                        dataType:'json'
                    }).done(function(data) {
                        if (data.result == 1) {
                            // call notification
                            notify('Done!', 'Delete user successully.', 'gritter-success');
                            $(parents).fadeOut(2000, function() {
                                this.remove()
                            });
                            $('.loader').fadeOut();
                        }
                        else if (data.result == 0) {
                            // call notification
                            notify('Fail!', 'Could not delete ill group, please try again.', 'gritter-error');
                            back_loader();
                            //bootbox.alert('Could not delete user');
                        }
                        else if (data.result == 2) {
                            notify('Fail!', data.result + ': System not allow to delete ill group, please contact to system administrator', 'gritter-error');
                            back_loader();
                            //bootbox.alert(data.result + ':System not allow to delete user, please contact to system administrator');
                        }
                        else {
                            notify('Fail!', data.result + ': Could not delete ill group, please try again', 'gritter-error');
                            back_loader();
                            //bootbox.alert(data.result + ':Could not delete user, please try again');
                        }
                    });
                }

            });
            return false;
        });

    });
</script>

<script type="text/javascript">
    jQuery(function($) {
        //        var oTable1 = $('#sample-table-2').dataTable({
        //            "aoColumns": [
        //                {"bSortable": false},
        //                null, null, null, null, null, null, null, null, null,
        //                {"bSortable": false}
        //            ]});

        var oTable1 = $('#sample-table-2').dataTable();


        $('table th input:checkbox').on('click', function() {
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
            .each(function() {
                this.checked = that.checked;
                $(this).closest('tr').toggleClass('selected');
            });

        });


        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            var w2 = $source.width();

            if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2))
                return 'right';
            return 'left';
        }
    })
</script>

