$(document).ready(function() {
    $('.submenu a.ajax, .ajax').click(function(e) {
        $('.message').html('');
        var parent1 = $(this).parent();
        var parent2 = parent1.parent().parent();
        
        // ajax-loader image
        var child = $(this).children('i');
        var current_class = child.attr('class');
        child.removeClass();
        child.addClass('ajax-loader');
        //-------------------------------------
        // message 
        $('#page-content').html('');
        $('.loader').show();
        // loader show
        for (var i = 0; i < 60; i++) {
            $('.loader .progress .bar').width(i + '%');
            $('.loader .progress').attr('data-percent', i + '%');
        }
        //-------------------------------

        $.ajax({
            url: this.href,
            data: this.href,
            type: "POST",
            //dataType:'json'
        }).done(function(data) {
            // loader show
            for (var i = 60; i < 80; i++) {
                $('.loader .progress .bar').width(i + '%');
                $('.loader .progress').attr('data-percent', i + '%');
            }
            //------------------------
            // load page
            content_loader(data);

            // set selected menu
            $('.nav li').removeClass('active');
            $(parent1).addClass('active');
            $(parent2).addClass('active');
            
            // loader show
             for (var i = 80; i <=100; i++) {
                $('.loader .progress .bar').width(i + '%');
                $('.loader .progress').attr('data-percent', i + '%');
            }
            //0---------------
            // restore menu selected image
            child.removeClass();
            child.addClass(current_class);
            //--------------
        });

        //$('#page-content').load(this.href);
        return false;
    });
});

// Loading when link to another content
function content_loader(data) {
    $(document).ready(function() {

        // loat content
        $('#page-content').html(data);
        $('.loader').fadeOut(2000, function() {
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