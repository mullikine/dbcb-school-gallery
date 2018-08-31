function searchselect() {
    $('input#bob').focus();
    $('input#bob').select();
}

function changequery(flags) {
    window.scrollTo(0, 0);
    var query = $('#bob').val();
    //$("#results").text(query);
    $('#search').submit();
}

$(document).ready(function() {
    $("#bob").bind('click',
                   function(e) {
                       searchselect();
                   });

    $("#bob").bind('keypress',
        function(e) {
            changequery();
        });

    $("#bob").bind('keydown',
        function(e) {
            changequery();
        });

    searchselect();

    $('form#search').submit(function() {
        $.ajax('search.php', {
            data: $(this).serialize(),
            type: $(this).attr('GET'),
            success: function(response) {

                $('#results').html(
                    response);
                // $('p.pages').fadeTo(100,
                //                     0.8,
                //                     function() {
                //                         $('p.pages').fadeTo(
                //                             200,
                //                             1.0);
                //                     });
                // $('ol.results li').fadeTo(
                //     500, 1.0,
                //     function() {
                //         //$("#q").focus();
                //     });

                //$(jqid).live('focus', function() { $(this).select(); });
                //$(jqid).live('mouseup', function() { $(this).select(); });
            }
        });
    });
});