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
                <label for="date" >ចណ្លោះថ្ងៃទី: <input type="text" name="date" value="<?php echo set_value('date'); ?>" class="date-range-picker" id="date" />
                <span class="input-group-addon">
                    <i class="icon-calendar bigger-110"></i>
                </span>
                </label>
                <input type="submit" value="Filter" class="btn btn-primary"/>
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
                    <th>នាម</th>
                    <th>គោត្តនាម</th>
                    <th>ភេទ</th>
                    <th>ទូរសព្ឋ</th>
                    <th >អ៊ីម៉ែល</th>
                    <th>ឋានៈ</th>
                    <th>ធ្វើការនៅ</th>
                    <th>ណែ​នាំ​ពី​វេជ្ជ​បណ្ឌិត</th>
                    <!--<th>Status</th>-->
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
                            <!--<td class=" "><input data-user="<?php echo json_encode(array('data' => $row)); ?>" name="<?php echo 'status'; ?>" <?php echo ($row['doc_status']) ? 'checked' : ''; ?> type="checkbox" id="<?php echo 'status'; ?>" placeholder="Status" class="ace ace-switch ace-switch-7" /><span class="lbl"></span></td>-->
                        </tr>

                        <?php
                    }
                }
                ?>

            </tbody>
        </table>

    </div>
</div>
<script src="<?php echo base_url() . JS; ?>data.table.js"></script>
<script src="<?php echo base_url() . JS; ?>daterangepicker.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('input[name=date], .icon-calendar').daterangepicker({
            format: 'YYYY-MM-DD',
            separator: ' to ',
            timePicker: true,
            showDropdowns: true,
            showWeekNumbers: true
        });

    });
</script>
