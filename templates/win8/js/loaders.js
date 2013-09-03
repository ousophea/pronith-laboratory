$(document).ready(function() {
    $('.submenu a.ajax, .ajax').on('click', function() {
        $('.message').html('');
        $.post(
                this.href,
                {data: this.href},
        function(data) {
            content_loader(data);
        }
        );
        return false;
    });
});
// Loading when link to another content
function content_loader(data) {
    $(document).ready(function() {
        $('#page-content').html('');
        $('.loader').show();
        // loop count
        for (var i = 0; i < 100; i++) {
            $('.loader .progress .bar').width(i + '%');
            $('.loader .progress').attr('data-percent', i + '%');
        }
        // loat content
        $('#page-content').html(data);
        $('.loader').slideUp(2000, function() {
            $('.loader .progress .bar').width('0%');
            $('.loader .progress').attr('data-percent', '0%');
        });
    });
}
// load progress bar appare progress from 0% to 100% when submit
function go_loader() {
    $(document).ready(function() {
        $('.loader').show(0, function() {
            for (var i = 0; i < 100; i++) {
                $('.loader .progress .bar').width(i + '%');
                $('.loader .progress').attr('data-percent', i + '%');
            }
        });
    });
}
// load progress bar desappare progress from 100$ to 0% when submit fail
function back_loader() {
    $(document).ready(function() {
        for (var i = 0; i >= 0; i--) {
            $('.loader .progress .bar').width(i + '%');
            $('.loader .progress').attr('data-percent', i + '%');
        }
        $('.loader').fadeOut(2000);
    });

}