$(function() {
    var clicked;

    $('i.fi-alert').on('click', function (event) {
        // console.log($(this).attr('id'));

        // populate event info and created
        $('#eventinfo').text($(this).parents('tr').find('.event').text());
        var d = new Date();
        $('#done').attr('value', d.getFullYear() + '-'
            + ('0' + (d.getMonth() + 1)).slice(-2) + '-'
            + ('0' + d.getDate()).slice(-2) + ' '
            + ('0' + d.getHours()).slice(-2) + ':'
            + ('0' + d.getMinutes()).slice(-2) + ':'
            + ('0' + d.getSeconds()).slice(-2));

        // show a modal asking if you are done with this
            // handled automatically by foundation

        clicked = $(this);

    });

    // if no is clicked close the modal
    $('button.alert').on('click', function (event) {
        event.preventDefault();
        $('button.close-button').trigger('click');
    });

    // if yes is clicked
    $('button.success').on('click', function (event) {
        event.preventDefault();
        // send an ajax request
        var historyId = clicked.attr('id').replace('h_', '');
        $.ajax({
            type : 'post',
            url : $('#setDoneForm').attr('action') + '/' + historyId,
            dataType : 'json',
            data : {
                done : $('#done').val()
            },
            error : function(jqXHR, textStatus, errorThrown){},
            success : function(data, textStatus, jqXHR){
                if (data.saved) {
                    // change the icon to done
                    clicked.removeClass('fi-alert s150').addClass('fi-check');
                    //detach the event handler
                    clicked.removeAttr('data-open').removeAttr('aria-controls').removeAttr('aria-haspopup');
                    // put info to status
                    var currentHtml = clicked.parents('tr').find('.status').html();
                    clicked.parents('tr').find('.status').html(currentHtml
                        + '<em>'
                        + $('#username').text()
                        + ' ('
                        + $('#done').val()
                        + ')'
                        + '</em>');
                    //close the modal
                    $('button.close-button').trigger('click');
                }
            }
        });
    });
});
