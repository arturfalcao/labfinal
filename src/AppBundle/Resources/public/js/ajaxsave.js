/**
 * Created by Celso on 22-08-2015.
 */


function sendForm(form, callback) {
    // Get all form values
    var values = {};
    $.each( form[0].elements, function(i, field) {
        if (field.type != 'checkbox' || (field.type == 'checkbox' && field.checked)) {
            values[field.name] = field.value;
        }
    });

    // Post form
    $.ajax({
        type        : form.attr( 'method' ),
        url         : form.attr( 'action' ),
        data        : values,
        success     : function(result) { callback( result ); }
    });
}


function OpenRightSide() {
}








$(function() {
    $('select[id=appbundle_tparametros_fnMetodo]')
        .append($('<option>', {value : 'new', text: 'Add new role'}))
        .on('change', function () {
            if ($( "select[id=appbundle_tparametros_fnMetodo] option:selected").val() === 'new') {
                $('#new_role').modal('show');
            }
        });

    $('#save_role').on('click', function( e ){
        e.preventDefault();
        sendForm( $('#new_role').find('form'), function( response ){
            if (typeof response == "object") {
                $('select[id=appbundle_tparametros_fnMetodo]')
                    .prepend($('<option>', {value : response.id, text: response.name}))
                    .val(response.id);
                $('#new_role').modal('hide');
            }
            else {
                $('#new_role').find('.modal-body').html(response);
            }
        });
    });
});