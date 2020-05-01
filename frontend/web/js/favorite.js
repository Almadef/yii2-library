$('#favorite-btn').on('click', function() {
    switch($(this).attr('data-action')) {
        case 'add': {
            $.post(
                '/' + $(this).attr('data-lng') + '/favorite/add',
                {'book_id': $(this).attr('data-book_id')},
                onSuccessAdd
            );
            break;
        }
        case 'del': {
            $.post(
                '/' + $(this).attr('data-lng') + '/favorite/del',
                {'book_id': $(this).attr('data-book_id')},
                onSuccessDel
            );
            break;
        }
        default: {
            console.log('Unknown action');
        }
    }
});

function onSuccessAdd(data) {
    $('#favorite-btn').attr({'class' : 'btn btn-danger', 'data-action' : 'del', 'title' : data.textBtn});
    $('#favorite-btn').text(data.textBtn);
}

function onSuccessDel(data) {
    $('#favorite-btn').attr({'class' : 'btn btn-success', 'data-action' : 'add', 'title' : data.textBtn});
    $('#favorite-btn').text(data.textBtn);
}

