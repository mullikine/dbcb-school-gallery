function changequery(flags) {
    window.scrollTo(0, 0);
    var query = $('#bob').val();
    $("#results").text(query);
}

$(document).ready(function() {
    $("#bob").bind('keypress',
        function(e) {
            changequery();
        });});