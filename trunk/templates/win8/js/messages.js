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

/**
 * 
 * @param {Array} data_array
 * @param {String} title
 * @returns {void}
 */
function view(html,title){
    
    //$(".element").html(html.join(""));
    title = (title!=null)?title:'View details';
    $('#modal-view #modal-header').html(title);
    $('#modal-view .modal-body .view').html(html);
    $('#modal-view').modal('toggle');
}

function htmlView(field,value){
    var opentag = '<div class="profile-info-row"><div class="profile-info-name">';
    var middletag = '</div><div class="profile-info-value"><span>';
    var endtag = '</span></div></div>';
    return(opentag+field+middletag+value+endtag);
}
/**
 * 
 * @returns {json}
 */
$.fn.toJSON = function() {
    var json = {};
    $.map($(this).serializeArray(), function(n, i) {
        json[n['name']] = n['value'];
    });
    return json;
};


