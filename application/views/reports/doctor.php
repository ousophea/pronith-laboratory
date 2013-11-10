<?php
$reference = $data;
$doctor_reference[0] = "No reference";
foreach ($reference->result_array() as $value) {
    $doctor_reference[DOC_ID] = $value[DOC_FNAME];
}
?>
<div class="page-header position-relative">
    <h1>
        របាយការណ៍វេជ្ជបណ្ឌិត
        <small>
            <i class="icon-double-angle-right"></i>
            តារាងបង្ហាញអំពីរបាយការណ៍វេជ្ជបណ្ឌិត
        </small>
    </h1>
</div>
<div class="row-fluid">
    <div id="sample-table-2_wrapper" class="dataTables_wrapper" role="grid">
        <div>
            <form method="POST" action="<?php echo base_url(); ?>reports/doctor">
                <label>
                    Date from: <input type="text" name="start" />
                </label>
                <label>
                    To: <input type="text" name="end" />
                </label>
                <input type="submit" value="Filter" />
            </form>
        </div>
        <table id="sample-table-2" class="table table-striped table-bordered table-hover dataTable" aria-describedby="sample-table-2_info">
            <thead>
                <tr role="row">
                    <th class="center sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 56px;">
                        <label>
                            <input type="checkbox" class="ace">
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Sex</th>
                    <th>Phone</th>
                    <th >Email</th>
                    <th>Position</th>
                    <th>Working</th>
                    <th>Doctor Reference</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">

                <?php
                if ($data->num_rows()) {
                    foreach ($data->result_array() as $row) {
                        //unset($row[USE_PASSWORD]); // remove password
                        ?>

                        <tr class="odd">
                            <td class="center  sorting_1">
                                <label>
                                    <input type="checkbox" class="ace">
                                    <span class="lbl"></span>
                                </label>
                                <?php echo form_hidden(USERS . USE_ID, json_encode(array('data' => $row))); ?>
                            </td>

                            <td class=" "><?php echo $row['doc_firstName']; ?></td>
                            <td class=" "><?php echo $row['doc_lastName']; ?></td>
                            <td class=" "><?php echo (strtolower($row['doc_sex']) == 'm') ? 'Male' : 'Female'; ?></td>
                            <td class=" "><?php echo ($row['doc_pho_number'] != NULL) ? $row['doc_pho_number'] . '<span id="doctor_phone" rel=' . $row['doc_id'] . '>...</span>' : ''; ?></td>
                            <td class=" "><?php echo $row['doc_email']; ?></td>
                            <td class=" "><?php echo $row['doc_position']; ?></td>
                            <td class=" "><?php echo $row['hos_name']; ?></td>
                            <td class=" "><?php echo $doctor_reference[DOC_ID]; ?></td>
                            <td class=" "><input data-user="<?php echo json_encode(array('data' => $row)); ?>" name="<?php echo 'status'; ?>" <?php echo ($row['doc_status']) ? 'checked' : ''; ?> type="checkbox" id="<?php echo 'status'; ?>" placeholder="Status" class="ace ace-switch ace-switch-7" /><span class="lbl"></span></td>
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
                url: base_url + 'ills/status',
                data: object,
                type: "POST",
                dataType: 'json'
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
                        url: url,
                        data: object,
                        type: "POST",
                        dataType: 'json'
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

        // View detail modal popup
        $('.view-modal').on('click', function() {
            parents = $(this).parents(".object");
            object = $(parents).data('object').data;
            var html = '';
            html += htmlView("ឈ្មោះ", object['<?php echo ILL_NAME; ?>'] + "&nbsp;" + object['<?php echo ILL_NAMEKH; ?>']);
            html += htmlView("តម្លៃ", object['<?php echo ILL_PRICE; ?>'] + "$&nbsp;");
            html += htmlView("ប្រភេទ", object['<?php echo ILG_NAME; ?>'] + "&nbsp;");
            html += htmlView("ថ្ងៃបង្កើត", object['<?php echo ILL_DATECREATED; ?>'] + "&nbsp;");
            html += htmlView("ថ្ងៃកែប្រែ", object['<?php echo ILL_DATEMODIFIED; ?>'] + "&nbsp;");
            html += htmlView("ស្ថានភាព", (object['<?php echo ILL_STATUS; ?>'] == 1) ? 'On' : 'Off');
            view(html, 'បង្ហាញអំពីពត៌មានបន្ថែម');// Popup
        });




    });
</script>

<script type="text/javascript">
    jQuery(function($) {
//        var oTable1 = $('#sample-table-2').dataTable({
//            "aoColumns": [
//                {"bSortable": false},
//                null, null, null, null, null,
//                {"bSortable": false}
//            ]});


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
<script src="<?php echo base_url() . JS; ?>data.table.js"></script>
