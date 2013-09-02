/**
 * 
 * @param {string} type
 * @param {string} keyword (Done!, OK!, Fail!)
 * @param {string} message
 * @returns {String}
 */
function message(keyword, message, class_name) {
    var html = '<div class = "alert alert-' + class_name + '"><button type = "button" class = "close"data-dismiss = "alert" ><i class = "icon-remove" ></i></button><strong>' + keyword + '</strong>' + message + '<br ></div>';
    return html;
}

/**
 * 
 * @param {string} titles
 * @param {string} message
 * @param {string} classs (gritter-success, gritter-error,...)
 * @returns {undefined}
 */
function notify(titles, message, class_name) {
    $(document).ready(function() {
        $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: titles,
            // (string | mandatory) the text inside the notification
            text: message,
            class_name: class_name
        });
    });
}

$.fn.toJSON = function() {
    var json = {};
    $.map($(this).serializeArray(), function(n, i) {
        json[n['name']] = n['value'];
    });
    return json;
};

