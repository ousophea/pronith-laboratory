<div class="page-header position-relative">
    <h1>
        បង្ហាញ​របាយការណ៍ តេស្ថ​ជំងឺ​
        <small>
            <i class="icon-double-angle-right"></i>
            បង្ហាញ​រាល់​ពត៌មាន ដែល​ទាក់​ទង​នឹង​​ការ​ធ្វើ​តេស្ថ
        </small>
    </h1>
</div>
<div class="row-fluid">
    <div id="sample-table-2_wrapper" class="dataTables_wrapper" role="grid">
        <form method="POST" action="<?php echo base_url(); ?>reports/test">

            <label for="date" >ចណ្លោះថ្ងៃទីធ្វើតេស្ថ: <input type="text" name="date" value="<?php echo set_value('date'); ?>" class="date-range-picker" id="date" title="សូមទុកប្រអប់នេះទទេប្រសិនបើអ្នកចង់ស្វែងរកតេស្ថរាល់ថ្ងៃខែទាំងអស់" />
                <span class="input-group-addon">
                    <i class="icon-calendar bigger-110"></i>
                </span>
            </label>
            <input type="submit" value="Filter" class="btn btn-primary"/>
        </form>    
        <table id="sample-table-2" class="table table-striped table-bordered table-hover dataTable" aria-describedby="sample-table-2_info">
            <thead>
                <tr role="row">
                    <th class="sorting">អ្នក​ជំ​ងឺ</th>
                    <th class="sorting">អ្នក​បង្កើត</th>
                    <th class="sorting">ថ្ងៃ​ខែ​បង្កើត</th>
                    <th class="sorting">ថ្ងៃ​មក​យក​លទ្ធផល</th>
                    <th class="sorting">លទ្ធផល​បាន​យក</th>
                    <th class="sorting">លទ្ធផល​ចេញ</th>
                    <th class="sorting">ទទួល​ជំ​ងឺ​តេស្ថ</th>
                    <th class="sorting">តំ​លៃ</th>
                    <th class="sorting">ប្រាក់​កក់</th>
                    <th class="sorting">ជំ​ពាក់</th>
                    <th class="sorting">បង់​រួច</th>
                    <th class="sorting">បញ្ចុះ​តំ​លៃ</th>
                    <th class="sorting">ពន្ធ</th>
                    <th class="sorting">កំរៃ​ជើងសារ</th>
                </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">

                <?php
                if ($data->num_rows()) {
                    foreach ($data->result_array() as $row) {
                        ?>

                        <tr class="odd object" data-object='<?php echo json_encode(array('data' => $row)); ?>'>

                            <td class=" "><?php echo $row['pat_name']; ?></td>
                            <td class=" "><?php echo $row['use_name']; ?></td>
                            <td class=" "><?php echo $row['pat_tes_dateCreated']; ?></td>
                            <td class=" "><?php echo $row['pat_tes_dateTimeReceived']; ?></td>
                            <td class=" "><?php echo ($row['pat_tes_isReceive'])?'បាន​យក':'មិន​ទាន់​យក'; ?></td>
                            <td class=" "><?php echo ($row['pat_tes_isResult'] == 1) ? 'លទ្ធផល​បាន​ចេញ' : 'លទ្ធផល​មិន​ទាន់​ចេញ'; ?></td>
                            <td class=" "><?php echo ($row['pat_tes_isReceiveIll'] == 1) ? 'ទទួល​បាន' : 'មិនទទួល​បាន'; ?></td>
                            <td class=" "><?php echo number_format($row['pat_tes_subTotal'], 0); ?>៛</td>
                            <td class=" "><?php echo number_format($row['pat_tes_deposit'], 0); ?>៛</td>
                            <td class=" "><?php echo number_format($row['pat_tes_owe'], 0); ?>៛</td>
                            <td class=" "><?php echo ($row['pat_tes_isPaid'] == 1) ? '<span class="green">បង់​រួច</span>' : '<span class="red">មិន​ទាន់​បង់​រួច</span>'; ?></td>
                            <td class=" "><?php echo $row['pat_tes_discount']; ?>%</td>
                            <td class=" "><?php echo $row['pat_tes_tax']; ?>%</td>
                            <td class=" "><?php echo ($row['pat_tes_doctorCommission'] == 0) ? 'ពុំមាន' : number_format($row['pat_tes_doctorCommission'], 0) . '៛'; ?></td>
                            
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
        $('input[name="date"]').daterangepicker({
            format: 'YYYY-MM-DD',
            separator: ' to ',
            timePicker: true,
            showDropdowns: true,
            showWeekNumbers: true
        });

    });
</script>