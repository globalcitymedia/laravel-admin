// CSRF protection
$.ajaxSetup(
    {
        headers:
        {
            'X-CSRF-Token': $('input[name="_token"]').val()
        }
    });

function ConfirmDelete()
{
    var x = confirm("Are you sure you want to delete?");
    if (x)
        return true;
    else
        return false;
}

//Move newsletter story up
function moveUp(btn) {

    var post_url = '/admin/features/line-up/move_up';
    var post_data = btn;
    var container = '#feature-list';
    console.log(post_data);
    callAjax(post_url,post_data,container)
}

//Move newsletter story up
function moveDown(btn) {

    var post_url = '/admin/features/line-up/move_down';
    var post_data = btn;
    var container = '#feature-list';
    console.log(post_data);
    callAjax(post_url,post_data,container)
}


function callAjax(post_url,post_data,container) {
    console.log(post_data)
    // Using the core $.ajax() method
    $.ajax({

        // The URL for the request
        url: post_url,

        // The data to send (will be converted to a query string)
        data: {
            keyword: post_data
        },

        // Whether this is a POST or GET request
        type: "POST",

        // The type of data we expect back
        // dataType : "any",
    })
    // Code to run if the request succeeds (is done);
    // The response is passed to the function
        .done(function( data ) {

            console.log(container);
            $(container).html(data);

        })
        // Code to run if the request fails; the raw request and
        // status codes are passed to the function
        .fail(function( xhr, status, errorThrown ) {
            //alert( "Sorry, there was a problem!" );
            console.log( "Error: " + errorThrown );
            console.log( "Status: " + status );
            console.dir( xhr );
        })
        // Code to run regardless of success or failure;
        .always(function( xhr, status ) {
            console.log( "The request is complete!" );
        });

}