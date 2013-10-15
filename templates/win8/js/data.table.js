jQuery(function($) {
    var oTable1 = $('#sample-table-2').dataTable({
        "oLanguage": {
//            "sLengthMenu": "បង្ហាញ _MENU_ ជួរ",
            "sLengthMenu": 'បង្ហាញ <select>' +
                    '<option value="10">10</option>' +
                    '<option value="20">20</option>' +
                    '<option value="30">30</option>' +
                    '<option value="40">40</option>' +
                    '<option value="50">50</option>' +
                    '<option value="-1">បង្ហាញទាំងអស់</option>' +
                    '</select> ជួរ',
            "sZeroRecords": "គ្មានទិន្នន័យ",
            "sInfo": "បង្ហាញពីជួរទី _START_ រហូរដល់ជួរទី _END_ នៃជួរសរុប _TOTAL_ ជួរ",
            "sInfoEmpty": "បង្ហាញ 0 រហូរដល់ 0 នៃជួរសរុប 0 ជួរ",
            "sInfoFiltered": "(បានស្វែងរកពីជួរសរុប _MAX_ ជួរទាំងអស់)",
            "sSearch": "ស្វែងរក:"
        }
    });
});